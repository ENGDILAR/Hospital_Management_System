<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function showLoginForm()
    {
        return view('Dashboard.User.auth.signin');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        if($request->user()->role==='admin')
              {
                    return redirect(RouteServiceProvider::Admin);
              } 
               else if($request->user()->role==='doctor')
              {
                      return redirect(RouteServiceProvider::Doctor);
              } 
              else if($request->user()->role==='ray')
              {
                      return redirect(RouteServiceProvider::Ray);
              } 
              else if($request->user()->role==='lab')
              {
                      return redirect(RouteServiceProvider::Lab);
              } 
                 else if($request->user()->role==='user')
                    
              {
                    return redirect(RouteServiceProvider::HOME);
              }
    
        return redirect()->back()->withErrors([
            'name' => trans('Dashboard/auth.failed')
        ]);
    }
    

    public function logout(Request $request)
    {

        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
