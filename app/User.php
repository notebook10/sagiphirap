<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Response;
use DB;
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $table = 'users';
    public function insertuser($dataArray){
        $insert = new User();
        $insert->firstname = $dataArray['firstname'];
        $insert->lastname = $dataArray['lastname'];
        $insert->user_type = $dataArray['user_type'];
        $insert->contact_number = $dataArray['contact'];
        $insert->address = $dataArray['address'];
        $insert->email = $dataArray['email'];
        $insert->password = bcrypt($dataArray['password']);
        $insert->save();
    }
    public static function checkusertype($id){
        $currentuser = User::where('id',$id)->first();
        if($currentuser->user_type == 1){
            return 'admin/dashboard';
        }else if($currentuser->user_type == 2){
            return 'admin/dashboard';
        }
    }
    public static function getuserbyid($id){
        return DB::table('users')
            ->where('id',$id)
            ->first();
    }
    public function reset($id,$dataArray){
        return DB::table('users')
            ->where('id',$id)
            ->update($dataArray);
    }
    public function checkEmailIfExisting($email){
        return DB::table("users")
            ->where("email", $email)
            ->first();
    }
    public function getalldata(){
        return DB::table("users")
            ->get();
    }
    public function changePassword($dataArray,$id){
        return DB::table('users')
            ->where('id',$id)
            ->update($dataArray);
    }
    public function editUser($dataArray, $id){
        return DB::table('users')
            ->where('id', $id)
            ->update($dataArray);
    }
}
