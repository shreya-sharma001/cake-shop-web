<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function Category()
    {
        $category = DB::table('categories')->get();

        return view("admin.masters.category.category", ["categorys" => $category]);

    }

    public function addCategory(Request $request)
    {
        $addCat = DB::table('categories')->insert([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ]);
        if ($addCat) {
            return redirect()->route('category')->with('success', 'category added successfully!');
        } else {
            return redirect()->route('category')->with('error', 'Update failed. Please try again.');
        }
        // dd($request);
    }

    public function editCategory($id)
    {
        $data = DB::table('categories')->where("id", "=", $id)->first();

        return view('admin.masters.category.editcategoryform', ['category' => $data]);
    }



    public function updateCategory(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ]);

        $updateCat = [
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
        ];

        $updated = DB::table('categories')->where('id', '=', $id)->update($updateCat);

        if ($updated) {
            return redirect()->route('category')->with('success', 'Category updated successfully!');
        } else {
            return redirect()->route('category')->with('error', 'Update failed. Please try again.');
        }
    }

    public function deleteCategory($id)
    {
        $deletecat = DB::table('categories')->where('id', '=', $id)->delete();

        if ($deletecat) {
            return redirect()->route('category')->with('success', 'Class deleted successfully!');
        } else {
            return redirect()->route('category')->with('error', 'Delete failed. Please try again.');
        }
    }

}
