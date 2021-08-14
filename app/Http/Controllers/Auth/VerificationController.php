<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */

        public function index (int $id) {

            $user = User::findorFail($id);
            if(!$user->hasVerifiedEmail()){
                $user->markEmailAsVerified();
                toastr()->success('My name is Inigo Montoya. You killed my father, prepare to die!');
            }
            
            return Redirect::to('/login');
        }



}
