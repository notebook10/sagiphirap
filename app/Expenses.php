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
            ->orderBy('date')
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
            $insert->date = $dataArray['date'];
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
}