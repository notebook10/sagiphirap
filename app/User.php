<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Response;
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
        }
    }
}
