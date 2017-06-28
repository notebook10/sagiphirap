<?php
namespace App\Http\Controllers;
use App\Company;
use App\Expenses;
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
        $confirm = $request->input('confirm') ? $request->input('confirm') : '0';
        $arr = [
            'emailsent' => $request->input('emailsent') ? $request->input('emailsent') : '0',
            'sendattachment' => $request->input('sendattachment') ? $request->input('sendattachment') : '0',
            'followupcall' => $request->input('followupcall') ? $request->input('followupcall') : '0',
            'statementofaccount' => $request->input('statementofaccount') ? $request->input('statementofaccount') : '0',
            'bankaccountinfo' => $request->input('bankaccountinfo') ? $request->input('bankaccountinfo') : '0',
            'lastpaid' => $request->input('lastpaid') ? $request->input('lastpaid') : '0',
            'confirm' => $request->input('confirm') ? $request->input('confirm') : '0',
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
            'created_at' => $request->input('date'),
            'company_email' => $request->input('email'),
            'confirm' => $confirm,
            'amount' => $request->amount
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
            'created_at' => $request->input('date'),
            'company_email' => $request->input('email'),
            'confirm' => $confirm,
            'amount' => $request->amount
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
            'date' => $row->created_at,
            'email' => $row->company_email,
            'amount' => $row->amount
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
        $user = new User();
        $filter = $request->selectReport;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        switch ($filter){
            case "all":
                $filteredData = $company->getAll();
                $title = "All Company Report";
                $total = $company->getAllTotal();
                break;
            case "paid":
                $filteredData = $company->filter($filter,date('Y-m-d',strtotime($start_date)),date('Y-m-d',strtotime($end_date)));
                $title = 'Paid Companies Report from ' . date('Y-M-d',strtotime($start_date)) . ' to ' . date('Y-M-d', strtotime($end_date));
                $total = $company->getPaidTotal();
                break;
            case 'confirmnotpaid':
                $filteredData = $company->confirmed(1,0);
                $title = 'Confirmed Companies but not yet Paid';
                $total = 'Not Paid';
                break;
            case 'agent':
                $filteredData = $company->filterByAgent($request->input('agentInput'));
                $title = 'Companies added by ' . $request->input('agentInput');
                $agent = $user->getIDusingFirstFname($request->input('agentInput'));
                $total = $company->getTotalById($agent->id);
                break;
            default:

                break;
        }
        $dataArray = [
            'paidcompanies' => $filteredData,
            'title' => $title,
            'start' => $start_date ? $start_date : '',
            'end' => $end_date ? $end_date : '',
            'total' => $total
        ];
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.paidreport',$dataArray);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
    }
    public function deleteuser(Request $request){
        $user = new User();
        $user->deleteuser($request->id);
    }
    public function sendKeyword(Request $request){
        $user = new User();
        $keyword = $request->input('keyword');
        return $user->filterAgentsWithName($keyword);
    }

    public function expenses(){
        $expenses = new Expenses();
        $allExpenses = $expenses->getAllExpenses();
        $dataArray = array(
            'expenses' => $allExpenses
        );
        $theme = Theme::uses('default')->layout('default')->setTitle('Expenses');
        return $theme->of('admin.expenses', $dataArray)->render();
    }
    public function getExpenses(Request $request){
        $id =  $request->input('id');
        $expenses = new Expenses();
        $row = $expenses->getExpensesbyID($id);
        $dataArray = [
            'admin_id' => $row->admin_id,
            'category' => $row->category,
            'description' => $row->description,
            'amount' => $row->amount,
            'created_at' => $row->created_at

        ];
        return $dataArray;
    }
    public function submitExpenses(Request $request){
        $ex_status = $request->input('ex_status');
        $id = $request->input('id');
        $data = array(
//            'admin_id' => $request->input('admin_id'),
            'admin_id' => Auth::user()->id,
            'category' => $request->input('category'),
            'description' => $request->input('description'),
            'amount' => $request->input('amount'),
            'created_at' => $request->input('expense_date')
        );
        $data2 = array(
            'category' => $request->input('category'),
            'description' => $request->input('description'),
            'amount' => $request->input('amount'),
            'created_at' => $request->input('expense_date')
        );
        $expenses = new Expenses();
        $ex_status == 0 ? $expenses->addExpenses($data) : $expenses->updateExpenses($data2,$id);

    }
    public function reportExpenses(Request $request){
        $expenses = new Expenses();
        $filter = $request->selectReportExpense;
        $start_date_expense = $request->start_date_expense;
        $end_date_expense = $request->end_date_expense;
        $Category = $request->filterReportExpense;
        $filteredExpense = "";
        $totalExpense = "";
        $expenseTitle = "";
        switch($filter){
            case "allExpense":
                $filteredExpense = $expenses->getAll();
                $expenseTitle = "All Expenses Report";
                $totalExpense = $expenses->getTotalExpense();
                break;
            case "byDateExpense":
                $filteredExpense = $expenses->filter($filter,date('Y-m-d',strtotime($start_date_expense)),date('Y-m-d',strtotime($end_date_expense)));
                $expenseTitle = "All Expenses Report from "  . date('Y-M-d',strtotime($start_date_expense)) . ' to ' . date('Y-M-d', strtotime($end_date_expense));
                $totalExpense = $expenses->getTotalExpensebyDate($filter,date('Y-m-d',strtotime($start_date_expense)),date('Y-m-d',strtotime($end_date_expense)));
                break;
            case "byCategory":
                $filteredExpense = $expenses->getTotalExpenseByCategory($Category);
                $expenseTitle = "All Expenses Report from " . $filter;
                $totalExpense = $expenses->getTotalExpense();
                break;
            default;
                break;
        }
        $dataArray = [
            'allExpenses' => $filteredExpense,
            'title' => $expenseTitle,
            'startDate' => $start_date_expense ? $start_date_expense : '',
            'endDate' => $end_date_expense ? $end_date_expense : '',
            'totalexpense' => $totalExpense
        ];
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.expensereport',$dataArray);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream();
    }
}
