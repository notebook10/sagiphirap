<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class EmailController extends Controller
{
    public function sendemail(Request $request){
        $recepient = $request->input("email");
        $user = new User();
        $checkEmail = $user->checkEmailIfExisting($recepient);
        if($checkEmail){
            $from = "enricobarandon@gmail.com";
            $name = "Enrico Barandon";
            Mail::send('email.mail',['title' => 'Titulo', 'content' => "Content"], function($message)use ($recepient, $from, $name){
                $message->from($from,$name);
                $message->to($recepient);
            });
            return response()->json(['message' => 'Request completed']);
        }else{
            return Redirect::to("forgotpassword")
                ->withErrors([
                    "message" => "Email don't exists."
                ]);
        }
    }
    public function test(Request $request){
        // 8 = $2y$10$z9MCwluvlCPV8QOF7AToceQbqivELuhlkPLEHCUd/XziozwNGKzu2
        $pass = bcrypt('test');
        $foo = new User();
        $data = [
            'password' => bcrypt('kikoisawesome')
        ];
        $foo->reset(8,$data);
        return "Success";
    }
}
