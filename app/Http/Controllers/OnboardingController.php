<?php

namespace App\Http\Controllers;

class OnboardingController extends Controller
{
    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user->role == 'superadmin' || $user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->onboard_completed) {
            if ($user->role == 'individual') {
                return redirect()->route('user.profile');
            } else if ($user->offering == 'product') {
                return redirect()->route('business.profile');
            } else if ($user->offering == 'service') {
                return redirect()->route('service.profile');
            }
        }

        $stateOptions = array_keys(config('state'));
        $states = config('state');
        $productCategories = \App\Models\Category::where('type', 'product')->get();
        $serviceCategories = \App\Models\Category::where('type', 'service')->get();
        $user = auth()->user();

        return view('onboarding', compact('stateOptions', 'states', 'productCategories', 'serviceCategories', 'user'));
    }

    public function validateStep(\Illuminate\Http\Request $request)
    {
        $step = $request->input('step');
        $userType = $request->input('type', 'individual');

        $rules = [];
        if ($step == 2) {
            $rules = [
                'name' => 'required|string|max:255',
                'phone' => [
                    'required',
                    'string',
                    'min:10',
                    'max:15',
                    \Illuminate\Validation\Rule::unique('users', 'phone')->ignore(auth()->id()),
                ],
                'email' => [
                    'required',
                    'email',
                    \Illuminate\Validation\Rule::unique('users', 'email')->ignore(auth()->id()),
                ],
                'state' => 'required|string',
                'city' => 'required|string',
            ];

            if ($userType == 'business') {
                $rules['address'] = 'required';
                $rules['gst_number'] = 'nullable|min:15|max:15';
                $rules['google_map_link'] = 'required|url';
            }
        }

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        return response()->json(['success' => true]);
    }

    public function save(\Illuminate\Http\Request $request)
    {
        try {
            $user = \Illuminate\Support\Facades\Auth::user();
            $type = $request->input('type');

            if ($type == 'individual') {
                $user->name = $request->name;
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->type = 'individual';
                $user->role = 'individual';
                $user->onboard_completed = 1;
                $user->save();

                $address = \App\Models\Address::firstOrNew(['user_id' => $user->id]);
                $address->city = $request->city;
                $address->state = $request->state;
                $address->save();

                return response()->json(['success' => true, 'redirect' => route('user.profile')]); // Updated redirect logic handled in JS preferably, but responding route is good
            } elseif ($type == 'business') {
                $user->name = $request->name;
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->type = 'business';
                $user->role = 'business';
                $user->offering = $request->offering;
                $user->gst = $request->gst_number;
                $user->onboard_completed = 1;
                $user->save();

                $address = \App\Models\Address::firstOrNew(['user_id' => $user->id]);
                $address->address = $request->address;
                $address->city = $request->city;
                $address->state = $request->state;
                $address->map_link = $request->google_map_link;
                $address->save();

                if ($request->has('categoryIds')) {
                    foreach ($request->categoryIds as $category) {
                         \App\Models\BusinessCategory::updateOrCreate([
                            'user_id' => $user->id,
                            'category_id' => $category
                        ], [
                            'user_id' => $user->id,
                            'category_id' => $category
                        ]);
                    }
                }
                
                $redirect = ($user->offering == 'product') ? route('business.profile') : route('service.profile');
                return response()->json(['success' => true, 'redirect' => $redirect]);

            }

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}


