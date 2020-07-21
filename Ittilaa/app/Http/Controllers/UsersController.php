<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

use Validator,Redirect,Response;
use App\User;
use App\Role;
use App\Permission;
use Session;

class UsersController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('permission:approve-notifications', ['only' => ['admin']]);

        $this->middleware('permission:approve-notifications', ['only' => ['dataForm']]);
    }
    
    public function index(){
        return view('pages.home');
    }

    public function login(){
        return view('auth.login');
    }  

    public function register(){
        return view('auth.register');
    }

    public function admin(){
        return view('pages.admin');
    }

    public function dataForm(){
        return view('pages.data_entry_form');
    }

    public function loginUser(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($validator)) {
            // Authentication passed...

            // if redirected from another page to login
            $invalidPostLoginRoutes = [ RouteServiceProvider::INDEX, RouteServiceProvider::REGISTER, 
                                        RouteServiceProvider::LOGIN, RouteServiceProvider::HOME];

            $url = session()->get('url.intended');
            if (Arr::has($invalidPostLoginRoutes, $url)) {
                return redirect()->intended('/');
            }

            return $this->directToDashboard();
        }

        return redirect()->intended(RouteServiceProvider::LOGIN)->withSuccess('Invalid credentials.');
    }

    public function registerUser(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:x_users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:x_users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $check = $this->create($data);

        return $this->directToDashboard()->withSuccess('Registered successfully.');
    }

    public function directToDashboard(){

        if (auth()->check()){

            // check if it is admin, login to admin page
            // $admin_role = Role::where('name', 'admin')->first();
            if (auth()->user()->hasRole('admin')){
                return redirect()->intended("/admin");
            }
            
            // check if it is data operator, login to data entry form page
            // $operator_role = Role::where('name', 'data-operator')->first();
            if (auth()->user()->hasRole('data-operator')){
                return redirect()->intended("/data_entry");
            }

            // otherwise open home page
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return redirect()->intended(RouteServiceProvider::LOGIN)->withSuccess('Invalid credentials.');
    }

    public function create(array $data)
    {
		$user = new User();
		$user->name = $data['name'];
		$user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role_id = Role::GetId('data-operator');
		$user->save();

        return $user;
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect(RouteServiceProvider::LOGIN);
    }
}
