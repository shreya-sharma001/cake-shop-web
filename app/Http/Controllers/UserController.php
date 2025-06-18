<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function show()
    {
        // dd(session()->all());
        $products = DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('tags', 'products.tag_id', '=', 'tags.id')
            ->select('products.*', 'categories.name as CategoryName')->get();
        // dd($products);
        return view("home", ["products" => $products]);
    }

    public function loginPage()
    {
        return view("login_Form");
    }

    public function showProfile()
    {
        // dd(session()->all());
        // $sessiondata = session()->all();
        // $sessionid = session()->id();
        // if()
        // dd(Auth::user());
        return view("myprofile");
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function adminLogout()
    {
        Auth::logout();
        return redirect('/login_Form');
    }
    public function addUser(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            // 'confirm_password' => 'required|confirmed|min:6',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $user = DB::table('users')->insert([
            'type' => $request->type,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->input('password')),
            // 'confirm_password' => Hash::make($request->input('confirm_password')),
            'address' => $request->address,
            'phone' => $request->phone,
            'created_at' => NOW(),
        ]);
        if ($user) {
            echo "<script>alert('Register Succesfully')</script>";
            return view('login_Form');
        } else {
            echo "<script>alert('ERROR')</script>";
        }

        dd($request);
    }

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->type == 'admin') {
                return redirect()->route('dashboard');
            } else if (Auth::user()->type == 'employee') {
                return redirect()->route('dashboard');
            } else if (Auth::user()->type == 'customer') {
                return redirect('/');
            } else {
                return back()->withErrors(['login' => 'Invalid Type']);
            }
        } else {
            return back()->withErrors(['login' => 'Invalid credentials']);
        }
    }

    public function adminLogin()
    {
        return view("admin.login");
    }

    public function showDashboard()
    {
        // if (Auth::check() && (Auth::user()->type == 'admin' || Auth::user()->type == 'employee')) {
        return view("admin.dashboard");
        // } else {
        //     return redirect('/login_Form');
        // }
    }

}
