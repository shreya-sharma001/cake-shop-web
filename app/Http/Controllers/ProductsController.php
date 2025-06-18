<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductsController extends Controller
{
    public function Product()
    {

        $products = DB::table('products')->get();

        return view("admin.masters.product.product", ["products" => $products]);

    }

    public function showproductForm()
    {
        $categories = DB::table('categories')->get();
        $tag = DB::table('tags')->get();
        // dd($tag);
        return view("admin.masters.product.add_product_form", ["categories" => $categories, "tags" => $tag]);

    }

    public function addProduct(Request $request)
    {
        // dd($request->file('image')); // for debugging (remove in production)

        // Validate the request
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'image_path.*' => 'image|mimes:jpg,jpeg,png|max:2048', // for multiple images
        ]);

        // Store the main product image
        $imagePath = $request->file('image')->store('products', 'public');
        // dd($imagePath);
        // Convert tag_ids to comma-separated string
        //$tagIds = implode(',', $request->tag_id);


        if (is_array($request->tag_id)) {
            $tagIds = implode(',', $request->tag_id);
        } else {
            $tagIds = $request->tag_id;
        }

        // Insert product into the products table
        $productId = DB::table('products')->insertGetId([  // Use insertGetId to get the product ID
            'name' => $request->name,
            'slug' => $request->slug,
            'title' => $request->title,
            'small_description' => $request->small_description,
            'description' => $request->description,
            'price' => $request->price,
            'size' => $request->size,
            'SKU' => $request->SKU,
            'color' => $request->color,
            'tag_id' => $tagIds,
            // 'tag_id' => $request->$tagIds,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Check if product was successfully inserted
        if ($productId) {
            // Handle multiple image uploads
            if ($request->hasFile('image_path')) {
                foreach ($request->file('image_path') as $image) {
                    // Store each image in the 'products' folder
                    $imagePath = $image->store('products', 'public');

                    // Insert image in the products_images table with the associated product_id
                    DB::table('products_images')->insert([
                        'product_id' => $productId,  // Use the actual product ID
                        'image_path' => $imagePath,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // Success redirect
            return redirect()->route('product')->with('success', 'Product added successfully!');
        } else {
            // Failure redirect
            return redirect()->route('product')->with('error', 'Product creation failed. Please try again.');
        }
    }

    public function editProduct($id)
    {
        $data = DB::table('products')->where("id", "=", $id)->first();

        if (!$data) {
            return redirect()->route('product')->with('error', 'Product not found.');
        }

        $tagid = explode(",", $data->tag_id);
        // dd($tagid);
        $cat = DB::table('categories')->where("id", "=", $data->category_id)->get();
        // $cat = DB::table('categories')->get();
        $productimage = DB::table('products_images')->where("product_id", "=", $data->id)->get();
        $tags = DB::table('tags')->whereIn('id', $tagid)->get();
        // dd($tags);
        return view('admin.masters.product.edit_product_form', [
            'products' => $data,
            'categories' => $cat,
            'productimages' => $productimage,
            'tags' => $tags
        ]);
    }


    public function updateProduct(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'title' => 'required',
            'small_description' => 'required',
            'description' => 'required',
            'price' => 'required',
            'size' => 'required',
            'SKU' => 'required',
            'color' => 'required',
            'tag_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // single main image
            // 'image_path.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // multiple additional images
            // // 'product_image_id' => 'required',
            // 'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category_id' => 'required',
        ]);

        // Process new image if uploaded
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $tagIds = is_array($request->tag_id) ? implode(',', $request->tag_id) : $request->tag_id;

        $updateCat = [
            'name' => $request->name,
            'slug' => $request->slug,
            'title' => $request->title,
            'small_description' => $request->small_description,
            'description' => $request->description,
            'price' => $request->price,
            'size' => $request->size,
            'SKU' => $request->SKU,
            'tag_id' => $tagIds,
            // 'product_image_id' => $request->product_image_id,
            // 'image' => $request->imagePath,
            'color' => $request->color,
            'category_id' => $request->category_id,
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ];

        if ($imagePath) {
            $updateCat['image'] = $imagePath;
        }

        $updated = DB::table('products')->where('id', '=', $id)->update($updateCat);

        if ($updated) {
            return redirect()->route('product')->with('success', 'product updated successfully!');
        } else {
            return redirect()->route('product')->with('error', 'Update failed. Please try again.');
        }
    }

    public function deleteProduct($id)
    {
        $deletecat = DB::table('products')->where('id', '=', $id)->delete();

        if ($deletecat) {
            return redirect()->route('product')->with('success', 'Class deleted successfully!');
        } else {
            return redirect()->route('product')->with('error', 'Delete failed. Please try again.');
        }
    }


    public function getProduct()
    {
        $products = DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('tags', 'products.tag_id', '=', 'tags.id')
            ->select('products.*', 'categories.name as CategoryName')->get();
        // dd($products);
        return view("shop", ["products" => $products]);
    }

    public function getShopDetails($id)
    {

        $product = DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('products_images', 'products.id', '=', 'products_images.product_id')
            ->leftJoin('tags', 'products.tag_id', '=', 'tags.id')
            ->select('products.*', 'categories.name as CategoryName', 'tags.tag as tagName', 'products_images.image_path as images')
            ->where('products.id', '=', $id)
            ->first();
        // dd($product);
        $images = DB::table('products_images')
            ->where('product_id', '=', $id)
            ->pluck('image_path');

        // Optionally attach the images to the product object
        $product->images = $images;


        $allproducts = DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('tags', 'products.tag_id', '=', 'tags.id')
            ->select('products.*', 'products.id as pid', 'categories.name as CategoryName', 'tags.tag as tagName')
            ->where('categories.id', '=', $product->category_id)
            ->get();

        // dd($allproducts);
        // Optionally attach the images to the product object
        // dd($allproducts);
        return view("shop-details", ["product" => $product, 'relProducts' => $allproducts]);

    }

    public function addToCart($id)
    {
        if (Auth::check()) {
            $userid = Auth::user()->id;
            $oldCart = DB::table('cart')
                ->where('product_id', '=', $id)
                ->where('user_id', '=', $userid)
                ->first();
            // dd($oldCart);
            if ($oldCart == null) {
                $product = DB::table('products')
                    ->where('id', '=', $id)
                    ->first();
                $total = $product->price * 1;
                $productId = DB::table('cart')->insertGetId([  // Use insertGetId to get the product ID
                    'product_id' => $id,
                    'user_id' => Auth::user()->id,
                    'price' => $product->price,
                    'quantity' => 1,
                    'total' => $total,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                if ($productId) {

                    return redirect()->route('shop')->with('success', 'Product added successfully!');
                } else {
                    // Failure redirect
                    return redirect()->route('shop')->with('error', 'Product creation failed. Please try again.');
                }
            } else {
                $newQty = $oldCart->quantity + 1;
                $newTotal = $oldCart->price * $newQty;
                DB::table(table: 'cart')
                    ->where('user_id', '=', $userid)
                    ->where('product_id', '=', $id)
                    ->update(
                        [
                            'quantity' => $newQty,
                            'total' => $newTotal
                        ],
                    );
                return redirect()->route('shop')->with('success', 'Product added successfully!');
            }

        } else {
            $product = DB::table('products')
                ->where('id', '=', $id)
                ->first();
            $total = $product->price * 1;
            $productId = DB::table('cart')->insertGetId([  // Use insertGetId to get the product ID
                'product_id' => $id,
                'price' => $product->price,
                'quantity' => 1,
                'total' => $total,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            if ($productId) {
                $sessproduct = [
                    'product_id' => $id,
                    'price' => $product->price,
                    'quantity' => 1,
                    'total' => $total,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                session()->put('productData', $sessproduct);
                $sessionData = session()->get('productData');
                return redirect()->route("home");
            }
        }
    }

    public function getCart()
    {
        if (Auth::check()) {
            $userid = Auth::user()->id;
            $products = DB::table(table: 'products')
                ->leftJoin('cart', 'products.id', '=', 'cart.product_id')
                ->select('products.*', 'cart.quantity as quantity', 'cart.price', 'cart.total')
                ->where('cart.user_id', '=', $userid)
                ->get();

            return view("shoping-cart", ["product" => $products]);
        } else {
            $products = DB::table(table: 'products')
                ->leftJoin('cart', 'products.id', '=', 'cart.product_id')
                ->select('products.*', 'cart.quantity as quantity', 'cart.price', 'cart.total')
                ->where('cart.user_id', '=', NULL)
                ->get();

            return view("shoping-cart", ["product" => $products]);
        }
    }


    public function UpdateQuantity(Request $request)
    {
        // dd($request->id);
        if (Auth::check()) {
            $userid = Auth::user()->id;
            DB::table(table: 'cart')
                ->where('user_id', '=', $userid)
                ->where('product_id', '=', $request->id)
                ->update(
                    [
                        'quantity' => $request->quantity,
                        'total' => $request->totalPrice
                    ],
                );
            return redirect("shoping-cart");
        } else {
            return redirect()->route("login_Form");
        }
    }

    public function remove_from_cart(Request $request)
    {
        $id = $request->id;

        $deleted = DB::table('cart')->where('id', '=', $id)->delete();

        if ($deleted) {
            return redirect('shoping-cart')->with('success', 'Item removed.');
        } else {
            return redirect('shoping-cart')->with('error', 'Item not found.');
        }
    }


    public function checkout()
    {
        // dd(session()->all());
        $userid = Auth::user()->id;
        $products = DB::table(table: 'products')
            ->leftJoin('cart', 'products.id', '=', 'cart.product_id')
            ->select('products.*', 'cart.quantity as quantity', 'cart.price', 'cart.total')
            ->where('cart.user_id', '=', $userid)
            ->get();
        // dd($products);
        return view("checkout", ["product" => $products]);
    }

    public function shipping(Request $request)
    {

        $userid = Auth::user()->id;
        $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'address1' => 'nullable|string|max:255',
            'address2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'order_notes' => 'nullable|string',
        ]);

        $shipping = DB::table('shipping_address')->insert([
            'user_id' => $userid,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'country' => $request->country,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'phone' => $request->phone,
            'email' => $request->email,
            'order_notes' => $request->order_notes,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $totalPrice = 0;
        $products = DB::table(table: 'products')
            ->leftJoin('cart', 'products.id', '=', 'cart.product_id')
            ->select('products.*', 'cart.quantity as quantity', 'cart.price', 'cart.total')
            ->where('cart.user_id', '=', $userid)
            ->get();
        foreach ($products as $p) {
            $totalPrice += $p->total;
        }

        if ($products) {
            $order = DB::table('orders')->insertGetId([
                'user_id' => $userid,
                'order_number' => rand(0, 25),
                'total_price' => $totalPrice,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            foreach ($products as $p) {
                $order_items = DB::table('order_items')->insertGetId([
                    'order_id' => $order,
                    'product_id' => $p->id,
                    'quantity' => $p->quantity,
                    'price' => $p->price,
                    'total' => $p->total,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        $Cartdeleted = DB::table('cart')->where('user_id', '=', $userid)->delete();

        if ($shipping) {
            return redirect()->route('shop')->with('success', 'Order placed successfully!');
        } else {
            return redirect()->route('shop')->with('error', 'Failed to place order. Please try again.');
        }
    }

}
