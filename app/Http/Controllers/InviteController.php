<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use PDF;

class InviteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {

        $user = auth()->user();


        
        return Inertia::render('Teacher/Invite', [
            'user' => $user,
        ]);
        //view()->share('Teacher/Invite');
        //$pdf = PDF::loadView('pdf_view');
        // download PDF file with download method
        //return $pdf->download('pdf_file.pdf');
    }
    public function invitepdf(Request $request)
    {

        $user = auth()->user();

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('invite', compact('user'));
        return $pdf->stream('invite.pdf');
    
    }
}
