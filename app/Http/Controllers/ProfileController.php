<?php

namespace App\Http\Controllers;

use App\Notifications\EmailChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit(){

    return view('profile.edit', [
        'user'=> Auth::user()
    ]);

    }

    public function update(Request $request){

    $user = Auth::user();

    // dd($request->all());

    $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'min:3', 'max:255',
            Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'max:255'],
    ]);

    $originalEmail = $user->email;


    $user->update([
        'name'=> $request->name,
        'email'=>$request->email,
        'password'=> $request->password ?? $user->password

    ]);
// Send notification to email to notify email has been changed!
    // if($originalEmail !== $request->email){
    //     Notification::route('mail', $originalEmail)->notify(new EmailChanged($user, $originalEmail));
    // }

    return redirect()->route('profile.edit')->with('success', 'Profile Updated!');

    }
}
