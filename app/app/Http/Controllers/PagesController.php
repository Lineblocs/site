<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\MainHelper;
use App\Helpers\EmailHelper;
use App\User;
use \Config;
use \Mail;
use Illuminate\Http\Request;
use DateTime;
use DB;
use PDF;
use App\Helpers\WorkspaceHelper;
use App\Helpers\InvoiceHelper;

class PagesController extends BaseController {

  public function privacyPolicy()
  {
    return view('pages.privacy_policy');
  }

  public function termsOfService()
  {
    return view('pages.terms_of_service');
  }

  public function serviceAgreement(){
    return view('pages.service_level_agreement');  
  }

  public function emailTest(){
    return 'Hello';
    // $email = 'tgblinkss@gmail.com';
    // $user = User::findOrFail(234);

    // $link = route('email-verify', ['hash' => $user->email_verify_hash]);
    // $data = [
    //       'user' => $user,
    //       'link' => $link
    //     ];
    // $subject =MainHelper::createEmailSubject("Verify Your Email");
    // $result = EmailHelper::sendEmail($subject, $email, 'verify_email', $data);

    // $user = User::all()[0];
    // // $all = $request->all();
    // $month = new DateTime();
    // $month->modify('first day of this month');
    // $invoice = MainHelper::getMonthlyInvoice($user, $month);
    // $pdf = InvoiceHelper::generatePrettyInvoice($user, $workspace, $invoice);
    // $pdf = PDF::loadView('pdf.invoice', ['rows' => $data, 'dateRange' => $dateRange]);
    // return $pdf->download('monthly_invoice.pdf');
    // // Simulate static user data
    // $user = User::all()[0];

    // $month = new DateTime();
    // $month->modify('first day of this month');

    // $invoice = (object) [
    //     'invoice_number' => 'INV123',
    //     'total_amount' => 500.00,
    //     'issued_date' => $month->format('Y-m-d'),
    //     // ... other invoice fields
    // ];

    // // Simulate static workspace data
    // $workspace = (object) [
    //     'name' => 'Workspace A',
    //     'location' => 'City X',
    //     // ... other workspace fields
    // ];

    // $data = []; // Replace with actual data for the view
    // $dateRange = 'Some Date Range'; // Replace with actual date range

    // $pdf = PDF::loadView('pdf.invoice', ['rows' => $data, 'dateRange' => $dateRange]);

    // return $pdf->download('monthly_invoice.pdf');

    $status = 'recieved';
    $mail = Config::get("mail");
          $data = [
              'user' => 'tgblinkss@gmail.com',
              'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
              molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
              numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium
              optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis
              obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam
              nihil, eveniet aliquid culpa officia aut! Impedit sit sunt qaerat, odit,
              tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,
              quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos 
              sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam
              recusandae alias error harum maxime adipisci amet laborum. Perspiciatis 
              minima nesciunt dolorem! Officiis iure rerum voluptates a cumque velit 
              quibusdam sed amet tempora. Sit laborum ab, eius fugit doloribus tenetur',
          ];
            $subject = "Admin Email";
            $result = EmailHelper::sendEmail($subject, 'tgblinkss@gmail.com', 'admin_email' , $data);
        

    return json_encode($result);  
  }

}

