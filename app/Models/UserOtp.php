<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Twilio\Rest\Client;

class UserOtp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'otp',
        'expired_at',

    ];

    public function sendSMS($receiverNumber){
        $message = 'Login OTP is '.$this->otp;

        try{
           $account_id = getenv("TWILIO_SID");
           $auth_token = getenv("TWILIO_TOKEN");
           $twillio_number = getenv("TWILIO_FROM");

          $client = new Client($account_id,$auth_token);
        
          $client->messages->create($receiverNumber,[
            'from' => $twillio_number,
            'body' => $message
          ]);

          info('SMS Sent Successfully');
        }catch(\Exception $e){
          info("Error: ".$e->getMessage());
        }
    }
}
