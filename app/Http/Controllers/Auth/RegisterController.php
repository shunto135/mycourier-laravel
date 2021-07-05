<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserInfo;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
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
    protected $redirectTo = '';

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
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        //dd($data);
			DB::beginTransaction();
       try{
				 $user = User::create([
					 'name' => $data['name'],
					 'email' => $data['email'],
					 'password' => Hash::make($data['password']),
				 ]);

				 $userInfo = UserInfo::create([
					 'user_id' => $user->id,
					 'updated_at' =>  Carbon::now(),
					 'created_at' =>  Carbon::now()

				 ]);
				 DB::commit();
			 }
			 catch (\Exception $exception) {
				 DB::rollback();
				 $this->redirectTo = '/login';
			 }

        if($data['isEmployee'] == "1") {
            $user->attachRole('employee');
            $this->redirectTo = '/employee';
        }
        else {
            $user->attachRole('customer');
            $this->redirectTo = '/user';
        }
        return $user;
    }
}
