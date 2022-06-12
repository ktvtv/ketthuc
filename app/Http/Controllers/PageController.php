<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Email;
use phpDocumentor\Reflection\Types\This;
use Symfony\Contracts\Service\Attribute\Required;

class PageController extends Controller
{
    public function mainpage(){
        return view("mainpage");
    }


    public function LoginController(){

        return view("login");
    }
    public function customLogin (Request $request)
    {

        $this->validate($request,
        [     
            'email' => 'required|email',
            'password' => 'required|min:3|max:20',
        ],
        [    
            'email.required' => 'Vui lòng nhập email.',
            'email.email'    => 'Email không đúng định dạng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu ít nhất 3 kí tự.',
            'password.max' => 'Mật khẩu không vượt quá 20 kí tự.'
            
        ]
    );
    //dd($requred);
    $Email=$request->email;
    $Password=$request->password;
    $into = array('email'=>$Email, 'password'=>$Password);

    //print_r($infor);
    if(Auth::attempt($into)){
        //$ten = User::select('Hoten')->where('Email',$req->email)->first();
        return redirect()->route('index');
    }
    else{
        return redirect()->back()->with('error','Đăng nhập ko thành công');
    }
}

//Đăng kí

    public function RegisterController(){
        return view ("register");
    }

    public function customRegistration(Request $request)
    {
        $validated = $request->validate([
            // username hay name
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = $this->create($validated);

        // auth()->login($user); login neu can

        return redirect("Login")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {


        return User::create([

            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),

        ]);
    }

/////////////////////////////////////////////////////////////////////////////



    public function mainpag()
    {
        if (Auth::check()) {
            return view('mainpage');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut()
    {

        Auth::logout();

        return Redirect('login');
    }

    public function cart(){
        return view("cart");
    }
    public function wishlist(){
        return view("wishlist");
    }
    public function shop(){
        return view("shop");
    }
}
