<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Company extends Model
{
    protected $table = 'company';
    protected $primaryKey = 'id';
    public function getAll(){
        return DB::table($this->table)
            ->where('status',1)
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
    public function filter($filter){
        return DB::table($this->table)
            ->where($filter,1)
            ->get();
    }
}
