<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmailController extends Controller
{
    public function store(Request $request)
    {
        $addEmail = DB::table('email')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => NOW(),
        ]);
        if ($addEmail) {
            echo "<script>alert('Thank You For Contacting Cakshop')</script>";
            return view('contact');
        } else {
            echo "<script>alert('KaEK eRROR CHE')</script>";
        }
        // dd($request);
    }
}
