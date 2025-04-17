<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Peminjam;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
    protected $redirectTo = '/';

    public function login(Request $request)
    {
        // Log::info('Login attempt started.');

        try {
            $validated = $request->validate([
                'login' => ['required', 'string'],
                'password' => ['required', 'string'],
            ]);
            // Log::info('Validation passed.', $validated);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log::error('Validation error: ' . $e->getMessage());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $credentials = $request->only('login', 'password');
        // Log::info('Credentials extracted.', $credentials);

        // Log out from all guards before attempting a new login
        Auth::guard('admin')->logout();
        Auth::guard('peminjam')->logout();
        // Log::info('Logged out from all guards.');

        // Attempt peminjam login
        # nis
        if (Auth::guard('peminjam')->attempt(['nis' => $credentials['login'], 'password' => $credentials['password']])) {
            // Log::info('Peminjam logged in with NIS.', ['user' => Auth::guard('peminjam')->user()]);
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Berhasil Login sebagai Peminjam');
        }
        # nip
        if (Auth::guard('peminjam')->attempt(['nip' => $credentials['login'], 'password' => $credentials['password']])) {
            // Log::info('Peminjam logged in with NIP.', ['user' => Auth::guard('peminjam')->user()]);
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Berhasil Login sebagai Peminjam');
        }
        # email
        if (Auth::guard('peminjam')->attempt(['email' => $credentials['login'], 'password' => $credentials['password']])) {
            // Log::info('Peminjam logged in with Email.', ['user' => Auth::guard('peminjam')->user()]);
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Berhasil Login sebagai Peminjam');
        }

        // Attempt admin login
        # email
        if (Auth::guard('admin')->attempt(['email' => $credentials['login'], 'password' => $credentials['password']])) {
            // Log::info('Admin logged in.', ['user' => Auth::guard('admin')->user()]);
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Berhasil Login sebagai Admin');
        }

        // Check if any guard is authenticated
        if (Auth::guard('peminjam')->check()) {
            // Log::info('Peminjam is already authenticated.', ['user' => Auth::guard('peminjam')->user()]);
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Berhasil Login sebagai Peminjam');
        }

        if (Auth::guard('admin')->check()) {
            // Log::info('Admin is already authenticated.', ['user' => Auth::guard('admin')->user()]);
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Berhasil Login sebagai Admin');
        }

        // Log::warning('Invalid login attempt.', $credentials);
        return back()->withErrors(['login' => 'Maaf, data login yang Anda masukkan salah.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        Auth::guard('peminjam')->logout();
        // Log::info('Logged out from all guards.');

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout!');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web,admin,peminjam')->only('login'); // Restrict 'guest' middleware to 'login'
        $this->middleware('auth:admin,peminjam')->only('logout'); // Ensure 'auth' middleware applies to 'logout'
    }
}
