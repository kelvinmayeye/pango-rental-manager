<?php

namespace App\Http\Controllers\Sms;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Tenant;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    function sms(Request $request){
        $academicGradeStudent = Tenant::find($request->ternantId);
        if (!$academicGradeStudent) {
            Session::flash('error', 'This ternant was not fount');
            return back();
        }
        $api_key = config('constant.sms.api_key');
        $secret_key = config('constant.sms.secret_key');


        $postData = array(
            'source_addr' => 'BRAINYIELD',
            'encoding' => 0,
            'schedule_time' => '',
            'message' => 'Usajili wako umekamilika karibu',
            'recipients' => [array('recipient_id' => $academicGradeStudent->student->parent->phonenumber, 'dest_addr' => $academicGradeStudent->student->parent->phonenumber)]
        );

        info('sms body', [
            'body' => $postData
        ]);

        $Url = config('constant.sms.url');

        $ch = curl_init($Url);
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));

        $response = curl_exec($ch);

        if ($response === FALSE) {
            // echo $response;
            Session::flash('error', 'Something went wrong please try again');
            return back();
        }
        $toJson = json_decode($response);

        if (!isset($toJson->request_id)) {
            $toJson->request_id = null;
            $toJson->valid = null;
            $toJson->invalid = null;
            $toJson->duplicates = null;
        }

        DB::table('sms_responses')
            ->insert([
                'dest_addr' => 'address',
                'request_id' => $toJson->request_id,
                'code' => $toJson->code,
                'message' => $toJson->message,
                'valid' => $toJson->valid,
                'invalid' => $toJson->invalid,
                'duplicates' => $toJson->duplicates,
                'claim_amount'=> 800,
                'academic_grade_student_id'=> 9,
                'created_at' => now()->format('Y-m-d H:i:s')
            ]);

        if ($toJson->code == 100) {
            Session::flash('success', 'Messege Sent');
            return back();
        }
        if ($toJson->code == 120) {
            Session::flash('error', 'Invalid phone number, failed to send messege');
            return back();
        }
        if ($toJson->code == 102) {
            Session::flash('error', 'Insufficient balance, please recharge and try again');
            return back();
        } else {

            Session::flash('error', 'Something went wrong, check phone number or contact system developer');
            return back();
        }
    }
}
