<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\ActivationService;
use Session;
use App\Stat;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $activationService;
    protected $loginPath = 'auth/login';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(ActivationService $activationService)
    {

        $this->middleware($this->guestMiddleware(), ['except' => 'getLogout']);
        $this->activationService = $activationService;
    }

    //Catch default register function and send activation email
    public function register(Request $request)
    {
    $validator = $this->validator($request->all());

    if ($validator->fails()) {
        $this->throwValidationException(
            $request, $validator
        );
    }

    $user = $this->create($request->all());

    $this->activationService->sendActivationMail($user);

    return redirect('auth/login')->with('status', 'Wir haben dir einen Aktivierungscode geschickt. Bitte überprüfe deine Email.');
    }

    //Check if User is Authenticated
    public function authenticated(Request $request, $user)
    {
    if (!$user->activated) {
        $this->activationService->sendActivationMail($user);
        auth()->logout();
        return back()->with('warning', 'Du musst deinen Account bestätigen. Wir haben dir einen Aktivierungscode geschickt. Bitte überprüfe deine Email.');
    }
    return redirect()->intended($this->redirectPath());
    } 

    public function activateUser($token)
    {
    if ($user = $this->activationService->activateUser($token)) {
        auth()->login($user);
        return redirect($this->redirectPath());
    }
    abort(404);
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
            'bName' => 'required|max:255',
            'Vorname' => 'required',
            'Nachname' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'ageCheck' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        //Create user
        $user = User::create([
            'bName' => $data['bName'],
            'Vorname' => $data['Vorname'],
            'Nachname' => $data['Nachname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        //create stats entry
        $stat = New Stat;

        $stat->userId = $user->id;

        $stat->save();

        // Return $user to create
        return $user;
    }
}
