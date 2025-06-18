<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function Tag()
    {
        $tags = DB::table('tags')->get();
        $products = DB::table('products')->get();

        return view("admin.masters.tags.tags", ["tags" => $tags, "products" => $products]);

    }

    public function showtagForm()
    {
        $products = DB::table('products')->get();
        // dd($tag);
        return view("admin.masters.tags.add_tags_form", ["products" => $products]);

    }


    public function addTag(Request $request)
    {
        $addCat = DB::table('tags')->insert([
            'tag' => $request->tag,
            'created_at' => NOW(),
            'updated_at' => NOW(),
            'product_id' => $request->product_id,
        ]);
        if ($addCat) {
            return redirect()->route('tags')->with('success', 'tag added successfully!');
        } else {
            return redirect()->route('tags')->with('error', 'Update failed. Please try again.');
        }
        // dd($request);
    }

    public function editTag($id)
    {
        $tag = DB::table('tags')->where("id", "=", $id)->first();
        $products = DB::table('products')->get();

        return view('admin.masters.tags.edit_tags_form', ['tags' => $tag, 'products' => $products]);
    }

    public function updateTag(Request $request, $id)
    {

        $validated = $request->validate([
            'tag' => 'required',
            // 'product_id' => 'required',
        ]);

        $updateTag = [
            'tag' => $request->tag,
            // 'product_id' => $request->product_id,
        ];

        $updated = DB::table('tags')->where('id', '=', $id)->update($updateTag);

        if ($updated) {
            return redirect()->route('tags')->with('success', 'tag updated successfully!');
        } else {
            return redirect()->route('tags')->with('error', 'Update failed. Please try again.');
        }
    }

    public function deletetag($id)
    {
        $deletecat = DB::table('tags')->where('id', '=', $id)->delete();

        if ($deletecat) {
            return redirect()->route('tags')->with('success', 'tag deleted successfully!');
        } else {
            return redirect()->route('tags')->with('error', 'Delete failed. Please try again.');
        }
    }
}
