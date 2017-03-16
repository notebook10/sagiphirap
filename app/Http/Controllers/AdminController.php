<?php
namespace App\Http\Controllers;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function index(){}
    public function submitcompany(Request $request){
        $data = array(
            'name' => $request->input('name'),
            'description' => $request->input('desc'),
            'cperson' => $request->input('cperson'),
            'cnumber' => $request->input('cnumber'),
            'address' => $request->input('caddress'),
            'agentid' => Auth::user()->id
        );
        $company = new Company();
        $company->insertNewCompany($data);
        return Redirect::to('/')->with('message','Success');
    }
}
