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
}
