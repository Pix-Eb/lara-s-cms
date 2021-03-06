<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// USE LIBRARIES
use App\Libraries\GoSms;
use App\Libraries\MailchimpHelper;

class DevController extends Controller
{
    /**
     * GOSMS
     */
    public function gosms_send(Request $request)
    {
        // SET THE PARAMETERS
        $mobile = $request->input('mobile_phone');
        $message = $request->input('message');
        $trxid = uniqid();
        $type = 0;
        $debug = false;

        $result = GoSms::send($mobile, $message, $trxid, $type, $debug);

        dd($result); // Boolean
    }

    /**
     * MAILCHIMP
     */
    public function mailchimp_list()
    {
        $result = MailchimpHelper::list();

        dd($result);
    }

    public function mailchimp_status(Request $request)
    {
        // SET THE PARAMETERS
        $email_address = $request->input('email');
        $result = MailchimpHelper::status($email_address);

        dd($result);
    }

    public function mailchimp_subscribe(Request $request)
    {
        // SET THE PARAMETERS
        $email_address = $request->input('email');
        $result = MailchimpHelper::add_subscribe($email_address);

        dd($result);
    }

    public function mailchimp_tags()
    {
        $result = MailchimpHelper::get_tags();

        dd($result);
    }

    public function mailchimp_add_tag(Request $request)
    {
        // SET THE PARAMETERS
        $tag_name = $request->input('name');

        $result = MailchimpHelper::add_tag($tag_name);

        dd($result);
    }

    public function mailchimp_add_tag_to_contact(Request $request)
    {
        // SET THE PARAMETERS
        $email_address = $request->input('email');
        $tag_id = $request->input('tag_id');

        $result = MailchimpHelper::add_tag_to_contact($email_address, $tag_id);

        dd($result);
    }

    public function mailchimp_view_tags_in_contact(Request $request)
    {
        // SET THE PARAMETERS
        $email_address = $request->input('email');

        $result = MailchimpHelper::view_tags_in_contact($email_address);

        dd($result);
    }

    /**
     * EMAIL
     */
    /**
     * EMAIL
     */
    public function email_send(Request $request)
    {
        // GET THE DATA
        $data = '';

        // SET EMAIL SUBJECT
        $subject_email = '';

        $email_address = $request->email;
        if (!$email_address) {
            // rendering email in browser
            // return (new SyllabusRequest($data, $subject_email))->render(); 
        }

        try {
            // SEND EMAIL
            // Mail::to($email_address)->send(new SyllabusRequest($data, $subject_email));
        } catch (\Exception $e) {
            // Debug via $e->getMessage();
            dd($e->getMessage());
            return "We've got errors!";
        }

        dd('Successfully sent email to ' . $email_address);
    }
}
