<?php
namespace App\Http\Controllers;
use App\Company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\App;
use Theme;

class AdminController extends Controller
{
    public function index(){}
    public function submitcompany(Request $request){
        $operation = $request->input('operation');
        $id = $request->input('id');
        $arr = [
            'emailsent' => $request->input('emailsent') ? $request->input('emailsent') : '0',
            'sendattachment' => $request->input('sendattachment') ? $request->input('sendattachment') : '0',
            'followupcall' => $request->input('followupcall') ? $request->input('followupcall') : '0',
            'statementofaccount' => $request->input('statementofaccount') ? $request->input('statementofaccount') : '0',
            'bankaccountinfo' => $request->input('bankaccountinfo') ? $request->input('bankaccountinfo') : '0',
            'lastpaid' => $request->input('lastpaid') ? $request->input('lastpaid') : '0'
        ];
        $json = json_encode($arr);
        $data = array(
            'name' => $request->input('name'),
            'description' => $request->input('desc'),
            'cperson' => $request->input('cperson'),
            'cnumber' => $request->input('cnumber'),
            'address' => $request->input('caddress'),
            'agentid' => Auth::user()->id,
            'state' => $json,
            'created_at' => $request->input('date')
        );
        $data2 = array(
            'name' => $request->input('name'),
            'description' => $request->input('desc'),
            'contact_person' => $request->input('cperson'),
            'contact_number' => $request->input('cnumber'),
            'contact_address' => $request->input('caddress'),
            'status' => 1,
            'state' => $json,
            'paid' => $request->input('lastpaid') ? $request->input('lastpaid') : '0',
            'created_at' => $request->input('date')
        );
//        $lastpaid = $request->input('json');
//        $decode = json_decode($lastpaid);
//        dd($decode->lastpaid);
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
            'paid' => $row->paid,
            'date' => $row->created_at
        ];
        return $dataArray;
    }
    public function users(){
        $users = new User();
        $usersdata = $users->getalldata();
        $dataArray = [
            'users' => $usersdata
        ];
        $theme = Theme::uses('default')->layout('default')->setTitle('Users');
        return $theme->of('admin.users', $dataArray)->render();
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
    public function submitfilter(Request $request){
        $company = new Company();
        $filter = $request->selectReport;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        switch ($filter){
            case "all":
                $filteredData = $company->getAll();
                $title = "All Company Report";
                break;
            case "paid":
                $filteredData = $company->filter($filter,date('Y-m-d',strtotime($start_date)),date('Y-m-d',strtotime($end_date)));
                $title = 'Paid Companies Report from ' . date('Y-M-d',strtotime($start_date)) . ' to ' . date('Y-M-d', strtotime($end_date));
                break;
            default:
                break;
        }
        $dataArray = [
            'paidcompanies' => $filteredData,
            'title' => $title,
            'start' => $start_date ? $start_date : '',
            'end' => $end_date ? $end_date : ''
        ];
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.paidreport',$dataArray);
        return $pdf->stream();
    }
    public function deleteuser(Request $request){
        $user = new User();
        $user->deleteuser($request->id);
    }
}
