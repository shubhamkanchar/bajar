<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessCategory;
use App\Models\BusinessTime;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSellerReview;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BusinessController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->load(['ratings', 'activeSubscription', 'address']);
        
        // Business Stats
        $time = BusinessTime::where('user_id', $user->id)->where('day', date("l"))->first();
        $businessTime = ($time && $time->open_time && $time->close_time) 
            ? date("g:i A", strtotime($time->open_time)) . ' - ' . date("g:i A", strtotime($time->close_time)) 
            : 'Closed';

        $businessStar = ProductSellerReview::where('seller_id', $user->id)
            ->sum(DB::raw('communication_and_professionalism + quality_or_service + recommendation')) ?? 0;

        $businessRatingsCount = ProductSellerReview::where('seller_id', $user->id)
            ->where('is_expert', 1)
            ->count();

        // Products
        $products = Product::with(['images', 'category'])->where('user_id', $user->id)->get();
        // Grouped for initial view if needed, or just list
        // Livewire grouped them: $allProducts computed property
        
        // Categories
        $catIds = Product::where('user_id', $user->id)->pluck('category_id');
        $myCategories = Category::where('type', 'product')->whereIn('id', $catIds)->get();
        $allCategories = Category::where('type', 'product')->get(); // For dropdown

        return view('profile.business-profile', compact(
            'user', 'businessTime', 'businessStar', 'businessRatingsCount', 'products', 'myCategories', 'allCategories'
        ));
    }

    public function saveProduct(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'brand_name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'showPrice' => 'required',
            'product_tag' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required',
            'id' => 'nullable|integer'
        ]);
        
        $user = Auth::user();
        if(!$request->id) {
            $request->validate(['product_image1' => 'required|image|max:2048']);
        }

        $product = $request->id ? Product::findOrFail($request->id) : new Product();
        $product->name = $request->product_name;
        $product->brand_name = $request->brand_name;
        $product->description = $request->description;
        $product->category_id = $request->category;
        $product->show_price = $request->showPrice;
        $product->product_tag = $request->product_tag;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->user_id = $user->id;
        $product->business_id = 1; // Default
        $product->is_approved = 0;
        $product->save();

        // Images
        // If edit, images might come as files (new) or ignored (kept old).
        // Livewire logic: product_image1..6
        
        for($i=1; $i<=6; $i++) {
            $fileKey = 'product_image'.$i;
            if($request->hasFile($fileKey)) {
                $path = $request->file($fileKey)->store('products', 'public');
                ProductImage::updateOrCreate(
                    ['product_id' => $product->id, 'order' => $i],
                    ['path' => $path]
                );
            }
        }

        return response()->json(['success' => true, 'message' => 'Product saved successfully']);
    }

    public function deleteProduct($id)
    {
        $product = Product::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        foreach($product->images as $img) {
            $path = public_path("storage/".$img->path);
            if(file_exists($path)) unlink($path);
        }
        $product->images()->delete();
        $product->delete();
        return response()->json(['success' => true, 'message' => 'Product deleted successfully']);
    }
    
    public function getProduct($id)
    {
        $product = Product::with('images')->where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        return response()->json(['success' => true, 'product' => $product]);
    }
}
