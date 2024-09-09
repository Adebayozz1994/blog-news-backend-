<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    public function getUser(Request $request){
        $id = substr($request->token, -1);
            $user = User::where('id', $id)->first();
          if($request->token === $user->token){
            return response()->json([
              'status' => true,
              'user' => $user
            ]);
          } else{
            return response()->json([
              'status' => false,
              'message' => 'Please login again'
            ]);
          }
        
      }
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
   
    {
        $credentials = $request ->only('email','password');
        if(Auth::attempt($credentials)) {
          $user = Auth::user();
          $token = time().$user->id;
          User::where('email', $user->email)->update([
            'token' => $token
          ]);
          return response()->json([
            'status' => true,
            'token' => $token,
            
          ]);
        } else {
          return response()->json([
            'status' => false,
            'error' => 'The provided credentials do not match our records.',
          ]);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        // Auth::guard('web')->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        // return redirect('/');
        $id = substr($request->token, -1);
        User::where('id',$id)->update([
           'token' => time().$id
        ]);
    }
}
