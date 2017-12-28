<?php

namespace Devoogle\Http\Controllers\Auth;

use Devoogle\Http\Controllers\Controller;
use Devoogle\Src\User\Model\User;
use Devoogle\Src\Social\Handler\SocialHandler;
use Devoogle\Src\Social\Command\SocialHandlerCommand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    use ActivationTrait;

    public function getSocialRedirect($provider)
    {
        $providerKey = Config::get('services.' . $provider);

        if (empty($providerKey)) {
            return view('pages.status')->with('error', trans('socials.noProvider'));
        }

        return Socialite::driver($provider)->redirect();
    }

    public function getSocialHandle($provider)
    {

        try {

            if (Input::get('denied') != '') {
                return redirect()->to('login')->with('status', 'danger')->with('message', trans('socials.denied'));
            }

            DB::beginTransaction();

            $command = new SocialHandlerCommand($provider);

            $handler = app(SocialHandler::class);
            $handler($command);

            DB::commit();

            if ($handler->isLoginWithRegister()) {
                return redirect('home')->with('success', trans('socials.registerSuccess'));
            }

            return redirect('home');

        } catch (\Exception $e) {

            DB::rollback();

            throw $e;

            return redirect()->to('login')->with('status', 'danger')->with('message', 'Error al loguearse con redes sociales.');
        }

    }

}
