<?php

namespace App;

use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Database\Eloquent\Model;
use DB;

class Company extends Model
{
    protected $table = 'company';
    protected $primaryKey = 'id';
    public function getAll(){
        return DB::table($this->table)
            ->where('status',1)
            ->orderBy('name')
            ->get();
    }
    public function insertNewCompany($dataArray){
        $insert = new Company();
        $insert->name = $dataArray['name'];
        $insert->description = $dataArray['description'];
        $insert->contact_person = $dataArray['cperson'];
        $insert->contact_number = $dataArray['cnumber'];
        $insert->contact_address = $dataArray['address'];
        $insert->agent_id = $dataArray['agentid'];
        $insert->status = 1;
        $insert->state = $dataArray['state'];
        $insert->company_email = $dataArray['company_email'];
        $insert->save();
    }
    public function editCompany($dataArray,$id){
        return DB::table($this->table)
            ->where($this->primaryKey,$id)
            ->update($dataArray);
    }
    public function getCompanyDataWithId($id){
        return DB::table($this->table)
            ->where('id',$id)
            ->first();
    }
    public function test(){
        return DB::table($this->table)->where('id',42)->first();
    }
    public function filter($filter, $start, $end){
        return DB::table($this->table)
            ->where($filter,1)
            ->whereBetween('created_at',[$start.' 00:00:00', $end.' 23:59:59'])
            ->get();
    }
    public function confirmed($confirm, $paid){
        return DB::table($this->table)
            ->where('confirm',$confirm)
            ->where('paid', $paid)
            ->get();
    }
    public function filterByAgent($firstname){
        $user = new User();
        $name = $user->getIDusingFname($firstname);
        $id = "";
        foreach ($name as $index => $value){
            $id = $value->id;
        }
        return DB::table($this->table)
            ->where('agent_id',$id)
            ->get();
    }
}
