<?php
namespace App\Http\Controllers;
use App\Company;
use App\User;
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
            'agentid' => Auth::user()->id,
            'state' => $request->input('json')
        );
        $data2 = array(
            'name' => $request->input('name'),
            'description' => $request->input('desc'),
            'contact_person' => $request->input('cperson'),
            'contact_number' => $request->input('cnumber'),
            'contact_address' => $request->input('caddress'),
            'status' => 1,
            'state' => $request->input('json')
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
            'agent_id' => $row->agent_id,
            'name' => $row->name,
            'desc' => $row->description,
            'cperson' => $row->contact_person,
            'cnumber' => $row->contact_number,
            'caddress' => $row->contact_address,
            'state' => $row->state,
            'paid' => $row->paid
        ];
        return $dataArray;
    }
    public function users(){
        $users = new User();
        $usersdata = $users->getalldata();
        $dataArray = [
            'users' => $usersdata
        ];
        return view('admin.users', $dataArray);
    }
    public function changepass(Request $request){
        $id = $request->input("id");
        $password = $request->input("password");
        $data = [
            'password' => bcrypt($password)
        ];
        $users = new User();
        $foo = $users->changePassword($data, $id);
        return $foo;
    }
    public function getuserdata(Request $request){
        $id = $request->input("id");
        $row = User::getuserbyid($id);
        $data = [
            'firstname' => $row->firstname,
            'lastname' => $row->lastname,
            'contact' => $row->contact_number,
            'address' => $row->address,
            'email' => $row->email,
            'type' => $row->user_type
        ];
        return $data;
    }
}
