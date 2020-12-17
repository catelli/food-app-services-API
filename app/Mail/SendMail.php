<?php 

namespace App\Mail;

use Illuminate\Support\Facades\Mail;
use Mailgun\Mailgun;

class SendMail 
{

    static function sendEmail($data) {
        Mail::send( $data['view'], $data, function($m) use ($data){
            $m->from('no-reply@torimarket.com.br', 'Tori');
            $m->subject('Tori - Produtos Orientais');
            $m->to($data['email']);
        });
    }
    
}