<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ClassCakesController extends Controller
{

    public function shows()
    {
        $userscake = DB::table('cake_class')->get();

        return view("usersCakeTable", ["userscake" => $userscake]);

    }

    public function addUsers(Request $request)
    {
        $cakeclass = DB::table('cake_class')->insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'class' => $request->class,
            'requirements' => $request->requirements,
            'created_at' => NOW(),
        ]);
        if ($cakeclass) {
            return redirect()->route('usersCake')->with('success', 'Class updated successfully!');
        } else {
            return redirect()->route('usersCake')->with('error', 'Update failed. Please try again.');
        }
        // dd($request);
    }

    public function editUsers($id)
    {
        $data = DB::table('cake_class')->where("id", "=", $id)->first();

        return view('editCakeUsers', ['usercake' => $data]);
    }



    public function updateUsers(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'class' => 'required',
            'requirements' => 'required',
        ]);

        $cakeclass = [
            'name' => $request->name,
            'phone' => $request->phone,
            'class' => $request->class,
            'requirements' => $request->requirements,
        ];

        $updated = DB::table('cake_class')->where('id', '=', $id)->update($cakeclass);

        if ($updated) {
            return redirect()->route('usersCake')->with('success', 'Class updated successfully!');
        } else {
            return redirect()->route('usersCake')->with('error', 'Update failed. Please try again.');
        }
    }

    public function deleteUsers($id)
    {
        $deleted = DB::table('cake_class')->where('id', '=', $id)->delete();

        if ($deleted) {
            return redirect()->route('usersCake')->with('success', 'Class deleted successfully!');
        } else {
            return redirect()->route('usersCake')->with('error', 'Delete failed. Please try again.');
        }
    }
}
