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
        $operation = $request->input('operation');
        $id = $request->input('id');
        $data = array(
            'name' => $request->input('name'),
            'description' => $request->input('desc'),
            'cperson' => $request->input('cperson'),
            'cnumber' => $request->input('cnumber'),
            'address' => $request->input('caddress'),
            'agentid' => Auth::user()->id
        );
        $data2 = array(
            'name' => $request->input('name'),
            'description' => $request->input('desc'),
            'contact_person' => $request->input('cperson'),
            'contact_number' => $request->input('cnumber'),
            'contact_address' => $request->input('caddress'),
            'agent_id' => Auth::user()->id
        );
        $company = new Company();
        $operation == 0 ? $company->insertNewCompany($data) : $company->editCompany($data2,$id);
//        return Redirect::to('/')->with('message','Success');
    }
    public function getcompanydata(Request $request){
        $id =  $request->input('id');
        $company = new Company();
        $row = $company->getCompanyDataWithId($id);
        $dataArray = [
            'name' => $row->name,
            'desc' => $row->description,
            'cperson' => $row->contact_person,
            'cnumber' => $row->contact_number,
            'caddress' => $row->contact_address
        ];
        return $dataArray;
    }
}
