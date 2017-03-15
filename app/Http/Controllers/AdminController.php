<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class AdminController extends Controller
{
    public function index(){}
    public function submitcompany(Request $request){
        $data = array(
            'name' => $request->input('comp_name'),
            'description' => $request->input('comp_desc'),
            'cperson' => $request->input('comp_contact_person'),
            'cnumber' => $request->input('comp_contact_number'),
            'address' => $request->input('comp_address')
        );
    }
}
