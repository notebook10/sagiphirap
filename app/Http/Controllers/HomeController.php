<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Theme;
use Validator;
use Auth;
class HomeController extends Controller
{
    public function index(){
        if(Auth::check()){
            $user = Auth::user();
            $direct = User::checkusertype($user->id);
            return Redirect::to($direct);
        }else{
            return view('default/login');
        }
    }
    public function login(Request $request){
        $username = $request->input('email');
        $password = $request->input('password');
        $data = [
            'email' => $username,
            'password' => $password
        ];
        $rules = [
            'email' => 'required|min:2',
            'password' => 'required|min:2'
        ];
        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            return Redirect::to('/');
        }else{
            if(Auth::attempt(['email' => $username, 'password' => $password])){
                return Redirect::to('/');
            }else{
                return Redirect::to('/')
                    ->withErrors([
                        'validate' => 'Invalid'
                    ]);
            }
        }
    }
    public function showRegister(){
        return view('default/register');
    }
    public function insertuser(Request $request){
        $data = array(
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact'),
            'address' => $request->input('address'),
            'user_type' => $request->input('user_type'),
            'password' => $request->input('password')
        );
        $user = new User();
        $user->insertuser($data);
        return Redirect::to('/')->with('status', 'Profile updated!');
    }
    public function logout(){
        Auth::logout();
        return Redirect::to('/');
    }
    public function dashboard(){
        $company = new Company();
        $allData = $company->getAll();
        $dataArray = array(
            'data' => $allData
        );
        return view('admin/dashboard',$dataArray);
    }
}
