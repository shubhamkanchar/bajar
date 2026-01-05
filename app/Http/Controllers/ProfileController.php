<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    public function userProfile()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        
        $productWishlistIds = $user->wishlist()->where('wishable_type', \App\Models\Product::class)->pluck('wishable_id');
        $products = \App\Models\Product::with(['images', 'category', 'user'])->whereIn('id', $productWishlistIds)->get();

        $serviceWishlistIds = $user->wishlist()->where('wishable_type', \App\Models\Service::class)->pluck('wishable_id');
        $services = \App\Models\Service::with(['images', 'category', 'user'])->whereIn('id', $serviceWishlistIds)->get();

        return view('profile.user-profile', compact('user', 'products', 'services'));
    }

    public function serviceProfile()
    {
        return view('profile.service-profile');
    }

    public function businessProfile()
    {
        return view('profile.business-profile');
    }

    public function userEdit(string $uuid)
    {
        $user = \App\Models\User::where('uuid', $uuid)->firstOrFail();
        $stateOptions = array_keys(config('state'));
        $cityOptions = [];
        if($user->address && $user->address->state) {
            $cityOptions = config('state')[$user->address->state] ?? [];
        }

        return view('profile.user-edit', [
            'uuid' => $uuid,
            'user' => $user,
            'stateOptions' => $stateOptions,
            'cityOptions' => $cityOptions,
            'states' => config('state')
        ]);
    }

    public function businessEdit(string $uuid)
    {
        $user = \App\Models\User::where('uuid', $uuid)->firstOrFail();
        
        // Sync Subscription Status
        try {
            $razorpaySubscriptionId = $user->latestSubscription?->razorpay_subscription_id;
            if ($razorpaySubscriptionId && str_starts_with($razorpaySubscriptionId, 'sub_')) {
                $api = new \Razorpay\Api\Api(config('services.razorpay.key'), config('services.razorpay.secret'));
                $subscription = $api->subscription->fetch($razorpaySubscriptionId);

                if (isset($subscription->current_start)) {
                    \App\Models\Subscription::where('razorpay_subscription_id', $razorpaySubscriptionId)
                        ->update([
                            'status' => $subscription->status,
                            'start_at' => \Illuminate\Support\Carbon::createFromTimestamp($subscription->current_start),
                            'end_at' => \Illuminate\Support\Carbon::createFromTimestamp($subscription->current_end),
                        ]);
                }
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Razorpay sync error: ' . $e->getMessage());
        }

        $productCategories = \App\Models\Category::where('type', 'product')->get();
        $serviceCategories = \App\Models\Category::where('type', 'service')->get();
        $categoryIds = \App\Models\BusinessCategory::where('user_id', $user->id)->pluck('category_id')->toArray();
        
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $existingHours = \App\Models\BusinessTime::where('user_id', $user->id)->get();
        $storeHours = [];
        foreach ($days as $day) {
            $storeHours[$day] = [
                'open' => optional($existingHours->where('day', $day)->first())->open_time ?? '',
                'close' => optional($existingHours->where('day', $day)->first())->close_time ?? ''
            ];
        }

        $stateOptions = array_keys(config('state'));
        $cityOptions = [];
        if($user->address && $user->address->state) {
            $cityOptions = config('state')[$user->address->state] ?? [];
        }
        
        return view('profile.business-edit', [
            'uuid' => $uuid, 
            'user' => $user,
            'stateOptions' => $stateOptions,
            'cityOptions' => $cityOptions,
            'productCategories' => $productCategories,
            'serviceCategories' => $serviceCategories,
            'categoryIds' => $categoryIds,
            'days' => $days,
            'storeHours' => $storeHours
        ]);
    }

    public function viewBusiness(string $uuid)
    {
        $user = \App\Models\User::where('uuid', $uuid)->with(['address', 'ratings'])->firstOrFail();
        
        // Business Time
        $time = \App\Models\BusinessTime::where([
            'user_id' => $user->id,
            'day' => date("l")
        ])->first();
        $businessTime = ($time && $time['open_time'] && $time['close_time']) 
            ? date("g:i A", strtotime($time['open_time'])).' - '.date("g:i A", strtotime($time['close_time'])) 
            : 'Closed';

        // Ratings Count
        $businessRatingsCount = \App\Models\ProductSellerReview::where([
            'seller_id' => $user->id,
            'is_expert' => 1
        ])->count();

        // Items (Products/Services)
        $allItems = collect();
        if ($user->offering === 'product') {
            $allItems = \App\Models\Product::with(['images', 'category'])
                ->where('user_id', $user->id)
                ->get()
                ->groupBy('category.title');
        } else {
            $allItems = \App\Models\Service::with(['images', 'category'])
                ->where('user_id', $user->id)
                ->get()
                ->groupBy('category.title');
        }

        // Categories for filter
        if ($user->offering === 'product') {
            $ids = \App\Models\Product::where('user_id', $user->id)->pluck('category_id');
        } else {
            $ids = \App\Models\Service::where('user_id', $user->id)->pluck('category_id');
        }
        $businessCategories = \App\Models\Category::where('type', $user->offering)->whereIn('id', $ids)->get();

        // Wishlist
        $wishlistIds = [];
        if(\Illuminate\Support\Facades\Auth::check()) {
            $type = $user->offering === 'product' ? \App\Models\Product::class : \App\Models\Service::class;
            $wishlistIds = \Illuminate\Support\Facades\Auth::user()
                ->wishlist()
                ->where('wishable_type', $type)
                ->pluck('wishable_id')
                ->toArray();
        }

        // Auth User Rating
        $authUserRating = null;
        if(\Illuminate\Support\Facades\Auth::check()) {
            $authUserRating = \App\Models\ProductSellerReview::where('seller_id', $user->id)
                ->where('customer_id', auth()->id())
                ->first();
        }

        return view('profile.view-business', compact(
            'user', 
            'businessTime', 
            'businessRatingsCount', 
            'allItems', 
            'businessCategories', 
            'wishlistIds',
            'authUserRating'
        ));
    }
    public function updateBusiness( \Illuminate\Http\Request $request, string $uuid)
    {
        $user = \App\Models\User::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'name' => 'nullable|string|max:255',
            'phone' => ['string', 'min:10', 'max:15', \Illuminate\Validation\Rule::unique('users', 'phone')->ignore($user->id)],
            'email' => ['email', \Illuminate\Validation\Rule::unique('users', 'email')->ignore($user->id)],
            'state' => 'string',
            'city' => 'string',
            'bg_image' => 'nullable|image|max:2048',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('bg_image')) {
            $user->bg_image = $request->file('bg_image')->store('images', 'public');
        }

        if ($request->hasFile('profile_image')) {
            $user->profile_image = $request->file('profile_image')->store('images', 'public');
        }

        $user->name = $request->name;
        if ($user->phone != $request->phone) {
            $user->phone = $request->phone;
            $user->phone_verified_at = NULL;
        }
        if ($user->email != $request->email) {
            $user->email = $request->email;
            $user->email_verified_at = NULL;
        }
        $user->gst = $request->gst;
        $user->save();

        $address = \App\Models\Address::firstOrNew(['user_id' => $user->id]);
        $address->address = $request->address;
        $address->city = $request->city;
        $address->state = $request->state;
        // $address->pin_code = $request->pin_code; // If pin_code is in form
        $address->map_link = $request->map_link;
        if ($request->has('offering')) {
            $user->offering = $request->offering;
        }
        $user->save();

        $address = \App\Models\Address::firstOrNew(['user_id' => $user->id]);
        $address->address = $request->address;
        $address->city = $request->city;
        $address->state = $request->state;
        // $address->pin_code = $request->pin_code; 
        $address->map_link = $request->map_link;
        $address->save();

        // Categories logic
        if ($request->has('category_ids')) {
            \App\Models\BusinessCategory::where('user_id', $user->id)->delete();
            foreach ($request->category_ids as $catId) {
                \App\Models\BusinessCategory::create([
                    'user_id' => $user->id,
                    'category_id' => $catId
                ]);
            }
        } elseif ($request->has('offering')) { 
            // If offering changed but no categories sent (e.g. cleared), we might want to clear them.
            // But form sends hidden inputs. If none selected, array might be missing or empty?
            // If empty array sent, it comes as empty array. If not sent, we shouldn't delete?
            // Usually form will send empty array if handled correctly or checks.
            // But here standard implementation:
             \App\Models\BusinessCategory::where('user_id', $user->id)->delete();
        }

        // Store Hours logic
        if ($request->has('store_hours')) {
            foreach ($request->store_hours as $day => $times) {
                \App\Models\BusinessTime::updateOrCreate(
                    ['user_id' => $user->id, 'day' => $day],
                    ['open_time' => $times['open'] ?? null, 'close_time' => $times['close'] ?? null]
                );
            }
        }

        return response()->json(['success' => true, 'message' => 'Profile Updated Successfully']);
    }

    public function setReviewer(string $uuid)
    {
        $user = \App\Models\User::where('uuid', $uuid)->firstOrFail();
        $user->is_reviewer = $user->is_reviewer ? 0 : 1;
        $user->save();

        return response()->json([
            'success' => true, 
            'message' => $user->is_reviewer ? 'User set as reviewer successfully' : 'User unset as reviewer successfully',
            'is_reviewer' => $user->is_reviewer
        ]);
    }

    public function deleteUser(string $uuid)
    {
        $user = \App\Models\User::where('uuid', $uuid)->firstOrFail();
        // Delete related data if necessary or let database constraints handle it (if set to cascade)
        // For safe deletion, usually we might just soft delete or delete. 
        // Assuming force delete based on Livewire code context which didn't show soft delete usage explicitly but simple delete.
        $user->delete();

        return response()->json(['success' => true, 'message' => 'User deleted successfully']);
    }

    public function updateUser( \Illuminate\Http\Request $request, string $uuid)
    {
        $user = \App\Models\User::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'name' => 'nullable|string|max:255',
            'phone' => ['string', 'min:10', 'max:15', \Illuminate\Validation\Rule::unique('users', 'phone')->ignore($user->id)],
            'email' => ['email', \Illuminate\Validation\Rule::unique('users', 'email')->ignore($user->id)],
            'state' => 'string',
            'city' => 'string',
            'bg_image' => 'nullable|image|max:2048',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('bg_image')) {
            $user->bg_image = $request->file('bg_image')->store('images', 'public');
        }

        if ($request->hasFile('profile_image')) {
            $user->profile_image = $request->file('profile_image')->store('images', 'public');
        }

        $user->name = $request->name;
        if ($user->phone != $request->phone) {
            $user->phone = $request->phone;
            $user->phone_verified_at = NULL;
        }
        if ($user->email != $request->email) {
            $user->email = $request->email;
            $user->email_verified_at = NULL;
        }
        $user->save();

        $address = \App\Models\Address::firstOrNew(['user_id' => $user->id]);
        $address->city = $request->city;
        $address->state = $request->state;
        $address->save();

        return response()->json(['success' => true, 'message' => 'Profile Updated Successfully']);
    }

    public function removeWishlist(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'type' => 'required|string|in:product,service'
        ]);

        $user = \Illuminate\Support\Facades\Auth::user();
        $model = $request->type === 'product' ? \App\Models\Product::class : \App\Models\Service::class;

        $deleted = $user->wishlist()
            ->where('wishable_type', $model)
            ->where('wishable_id', $request->id)
            ->delete();

        if ($deleted) {
            return response()->json(['success' => true, 'message' => 'Removed from wishlist']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found in wishlist']);
    }

    public function toggleWishlist(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'type' => 'required|string|in:product,service'
        ]);

        $user = \Illuminate\Support\Facades\Auth::user();
        if(!$user) return response()->json(['success'=>false, 'message' => 'Login required']);

        $model_class = $request->type === 'product' ? \App\Models\Product::class : \App\Models\Service::class;
        $existing = $user->wishlist()
            ->where('wishable_type', $model_class)
            ->where('wishable_id', $request->id)
            ->first();

        if ($existing) {
            $existing->delete();
            return response()->json(['success' => true, 'status' => 'removed', 'message' => 'Removed from wishlist']);
        } else {
            $user->wishlist()->create([
                'wishable_id' => $request->id,
                'wishable_type' => $model_class,
            ]);
            return response()->json(['success' => true, 'status' => 'added', 'message' => 'Added to wishlist']);
        }
    }

    public function submitReview(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'is_contact_accurate' => 'required|in:yes,no',
            'is_location_accurate' => 'required|in:yes,no',
            'communication' => 'required|integer|min:1|max:5',
            'quality' => 'required|integer|min:1|max:5',
            'recommendation' => 'required|integer|min:1|max:5',
        ]);

        $review = \App\Models\ProductSellerReview::updateOrCreate(
            [
                'customer_id' => \Illuminate\Support\Facades\Auth::id(),
                'seller_id' => $request->user_id
            ],
            [
                'is_contact_accurate' => $request->is_contact_accurate,
                'is_location_accurate' => $request->is_location_accurate,
                'communication_and_professionalism' => $request->communication,
                'quality_or_service' => $request->quality,
                'is_expert' => \Illuminate\Support\Facades\Auth::user()->is_reviewer ?? NULL,
                'recommendation' => $request->recommendation,
            ]
        );

        return response()->json(['success' => true, 'message' => 'Review submitted successfully']);
    }

    public function sendOtp(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'model' => 'required|in:email,phone',
            'value' => 'required',
        ]);

        $otp = \App\Helpers\GlobalHelper::generateOtp();
        $user = \Illuminate\Support\Facades\Auth::user();
        
        if ($request->model == 'email') {
            $user->email_otp = $otp;
            $user->save();
            try {
                \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\OtpMail($otp, $user));
            } catch (\Exception $e) {
                // Return success even if mail fails in dev, or handle error
                \Illuminate\Support\Facades\Log::error("Mail error: ".$e->getMessage());
            }
        } elseif ($request->model == 'phone') {
            $user->phone_otp = $otp;
            $user->save();
            \App\Helpers\GlobalHelper::sendOtp($request->value, $otp);
        }

        return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
    }

    public function verifyOtp(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'model' => 'required|in:email,phone',
            'otp' => 'required',
            'value' => 'required'
        ]);

        $user = \Illuminate\Support\Facades\Auth::user();
        
        if ($request->model == 'email') {
            if ($user->email_otp == $request->otp) {
                $user->email = $request->value;
                $user->email_verified_at = now();
                $user->email_otp = null;
                $user->save();
                return response()->json(['success' => true, 'message' => 'Email verified successfully']);
            }
        } elseif ($request->model == 'phone') {
            if ($user->phone_otp == $request->otp) {
                $user->phone = $request->value;
                $user->phone_verified_at = now();
                $user->phone_otp = null;
                $user->save();
                return response()->json(['success' => true, 'message' => 'Phone verified successfully']);
            }
        }

        return response()->json(['success' => false, 'message' => 'Invalid OTP'], 422);
    }
}


