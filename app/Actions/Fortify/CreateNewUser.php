<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Spatie\Honeypot\Events\SpamDetectedEvent;
use Spatie\Honeypot\Exceptions\SpamException;
use Spatie\Honeypot\ProtectAgainstSpam;
use Spatie\Honeypot\SpamProtection;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $this->spamCheck();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }

    public function spamCheck() {
        try {
            app(SpamProtection::class)->check(request()->all());
        } catch (SpamException) {
            event(new SpamDetectedEvent(request()));
            abort(403, 'Spam detected');
        }
            
    }
}
