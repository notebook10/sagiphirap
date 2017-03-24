<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function send(Request $request){
        $content = "test";
        Mail::send('email.mail',['title' => 'Titulo', 'content' => $content], function($message){
            $message->from('enricobarandon@gmail.com','Enrico Barandon');
            $message->to('enricobarandon2@gmail.com');
        });
        return response()->json(['message' => 'Request completed']);
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
