<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Handle post-login redirection.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated($request, $user)
    {
        
        if ($user->is_admin === 1) {
            // Przekierowanie na panel admina
            return redirect()->route('admin.dashboard');
        } elseif ($user->role == 'nauczyciel') {
            // Przekierowanie na panel nauczyciela
            return redirect()->route('teacher.dashboard');
        } elseif ($user->role == 'uczeń') {
            // Przekierowanie na panel ucznia
            return redirect()->route('student.dashboard');
        }
        // W przeciwnym razie przekieruj na stronę domową
        return redirect('/home');
    }
}
