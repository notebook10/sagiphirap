<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Company extends Model
{
    protected $table = 'company';
    protected $primaryKey = 'id';
    public function getAll(){
        return DB::table($this->table)->get();
    }
    public function insertNewCompany($dataArray){
        $insert = new Company();
        $insert->name = $dataArray['name'];
        $insert->description = $dataArray['description'];
        $insert->contact_person = $dataArray['cperson'];
        $insert->contact_number = $dataArray['cnumber'];
        $insert->contact_address = $dataArray['address'];
        $insert->agent_id = $dataArray['agentid'];
        $insert->save();
    }
}
