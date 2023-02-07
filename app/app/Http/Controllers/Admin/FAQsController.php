<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\ApiCredential;
use App\Faq;
use Illuminate\Http\Request;

class FAQsController extends AdminController {

    public function __construct()
    {
        parent::__construct();
        view()->share('type', '');
    }

	public function view()
	{
        $title = "FAQs";
        $faqs = Faq::all()->toArray();
		return view('admin.faqs.view',  compact('faqs'));
	}
	public function save(Request $req)
	{
        $data = $req->all();
        if ( empty( $data['faqs'] )) {
            $items = [];
        } else{

        $items = $data['faqs'];
        }
        $title = "FAQs";
        $faqs = Faq::all();
        \Log::info("data = " .json_encode( $data ));
        foreach ( $items as $item ) {
            if ( !empty( $item['id'] )) {
                $id = $item['id'];
                foreach ( $faqs as $faq ) {
                    if ( (string) $faq->id == $id ) {
                        $faq->update([
                            'question' => $item['question'],
                            'answer' => $item['answer']
                        ]);
                    }

                }
            } else {
                Faq::create([
                    'question' => $item['question'],
                    'answer' => $item['answer']
                ]);
            }
        }
        foreach ( $faqs as $faq ) {
            $faq_id = $faq['id'];
            $found = FALSE;
            foreach ( $items as $item ) {
                if ( !empty( $item['id'] ) && $item['id'] == $faq_id ) {
                    $found = TRUE;
                }
            }
            if ( !$found ) {
                $faq->delete();
            }
        }
        $session = $req->session();
        $session->flash('message', 'FAQs saved successfully..');
        return redirect("/admin/faqs");
	}
    }