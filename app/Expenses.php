<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 6/8/2017
 * Time: 7:30 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Expenses extends Model
{
    protected $table = 'expenses';
    protected $primaryKey = 'id';

    public function getAllExpenses(){
        return DB::table($this->table)
            ->where('status',1)
            ->orderBy('created_at')
            ->get();
    }
    public function getAll(){
        return DB::table($this->table)
            ->where('status',1)
            ->orderBy('created_at')
            ->get();
    }
    public function getExpensesbyID($id){
        return DB::table($this->table)
            ->where('id',$id)
            ->first();
    }

    public function addExpenses($dataArray){
            $insert = new Expenses();
            $insert->admin_id = $dataArray['admin_id'];
            $insert->category = $dataArray['category'];
            $insert->description = $dataArray['description'];
            $insert->amount = $dataArray['amount'];
            $insert->created_at = $dataArray['created_at'];
            $insert->save();
    }

//    public function updateExpenses($id,$dataArray){
//        return DB::table($this->table)
//            ->where($this->primaryKey,$id)
//            ->update($dataArray);
//    }

    public function updateExpenses($dataArray,$id)
    {
        return DB::table($this->table)
            ->where($this->primaryKey, $id)
            ->update($dataArray);
    }

    public function getTotalExpense(){
        return DB::table($this->table)
            ->sum('amount');
    }

    public function getTotalExpensebyDate($start, $end){
        return DB::table($this->table)
            ->where('status',1)
            ->whereBetween('created_at',[$start.' 00:00:00', $end.' 23:59:59'])
            ->sum('amount');
    }

//    public function filter_expense($filter_expense, $startDate, $endDate){
//        return DB::table($this->table)
//            ->where($filter_expense,1)
//            ->orderBy('category')
//            ->whereBetween('created_at',[$startDate.' 00:00:00', $endDate.' 23:59:59'])
//            ->sum('amount');
//    }
    public function filter($filter, $start, $end){
        return DB::table($this->table)
            ->where('status',1)
            ->whereBetween('created_at',[$start.' 00:00:00', $end.' 23:59:59'])
            ->get();
    }

    public function getTotalExpenseByCategory($Category){
        return DB::table($this->table)
            ->where('category',$Category)
            ->sum('amount');
    }

    public function filterExpense($start, $end){
        return DB::table($this->table)
            ->where('status',1)
            ->orderBy('category')
            ->whereBetween('created_at',[$start.' 00:00:00', $end.' 23:59:59'])
            ->get();
    }
//    public function getFilterTotal(){
//        return DB::table($this->table)
//            ->where('status',1)
//            ->sum('amount');
//    }
}