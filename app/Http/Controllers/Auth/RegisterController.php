<?php

namespace Devoogle\Http\Controllers\Auth;

use Devoogle\Src\User\Model\User;
use Devoogle\Src\User\Repository\CharacterRepositoryRead;
use Devoogle\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

    /**
     * @var \Devoogle\Src\User\Repository\CharacterRepositoryRead
     */
    private $characterRepositoryRead;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CharacterRepositoryRead $characterRepositoryRead)
    {
        $this->middleware('guest');
        $this->characterRepositoryRead = $characterRepositoryRead;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $this->obtainName(),
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    private function obtainName()
    {

        $character = $this->characterRepositoryRead->random();

        return $character->name;

    }
}
