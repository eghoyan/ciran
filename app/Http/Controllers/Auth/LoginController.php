<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmEmail;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
     protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }
    public function login(Request $request){

        $vali = $this->validator($request->all());
        
        if ($vali->fails()) {
            return Redirect::back()->withErrors($vali)->withInput();
        } else{

            $user=User::where ('email',$request->input('email'))->first();
            $auth=Hash::check($request->input('password'),$user->password);

            if($auth){

                if ($user->status == User::UNBLOCK) {
                    if(!$user->hasVerifiedEmail()){
                        Mail::to($user->email)->send(new ConfirmEmail($user));
                    } else {
                        toastr()->success('Data has been saved successfully!');
                       $this->attemptLogin($request);
                    }
                } else{
                     toastr()->error('The admin has blocked you.');

                }

            }else{
               toastr()->error('The password you entered is incorrect.', 'Inconceivable!');
            }
        }
        
        return Redirect::back();
    }
}
