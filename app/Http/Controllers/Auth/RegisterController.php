<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LogUser;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\ActionPointService;
use App\Services\ReferralService;
use App\Services\UserService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'gender' => ['required', 'integer', 'min:0','max:1'],
            'phone' => ["required","regex:/^([0-9\s\\-\+\(\)]*)$/",'unique:users,Phone'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
       $user=User::create([
                         'name' => $data['name'],
                         'email' => $data['email'],
                         'phone' => $data['phone'],
                         'gender' => $data['gender'],

                         'password' => Hash::make($data['password']),
                     ]);
       UserService::logUser($user->id,0,'register');
        $point=ActionPointService::getActionPoint('new_account_points');
        if($point>0){
            $user->chargePoints($point, 'new account points');
        }
        //generate referral code
        $user->generateNewReferralCode();
        //check if user registered with referral

        ReferralService::registerReferralIfExists($user);
        return  $user;
    }

}
