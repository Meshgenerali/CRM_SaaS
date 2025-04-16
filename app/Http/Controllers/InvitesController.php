<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Invitation;
use App\Models\User;

class InvitesController extends Controller
{
    public function accept($token) {
        $invitation = Invitation::where('token', $token)->firstOrFail();
        return view('livewire.business.invites_register', [
            'email' => $invitation->email,
            'token' => $token
        ]);
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|exists:invitations,email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required|string|exists:invitations,token',
        ]);

    // Retrieve invitation by token
    $invitation = Invitation::where('token', $request->token)->firstOrFail();

    // Ensure the email matches the one in the invitation
    if ($invitation->email !== $request->email) {
        return redirect()->back()->withErrors(['email' => 'Invalid email for this invitation.']);
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Attach the user to the business
    $user->businesses()->attach($invitation->business_id);
    
    return redirect()->route('dashboard');
    }
}
