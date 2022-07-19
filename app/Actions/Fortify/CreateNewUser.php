<?php

namespace App\Actions\Fortify;

use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\Users
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'nationalid' => ['required', 'string', 'max:255'],
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'mobilenumber' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'krapin' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'linkedin' => ['required', 'string', 'max:255'],
            'companyname' => ['required', 'string', 'max:255'],
            'websitelink' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return Users::create([
            'fname' => $input['fname'],
            'lname' => $input['lname'],
            'nationalid' => $input['nationalid'],
            'mobilenumber' => $input['mobilenumber'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'krapin' => $input['krapin'],
            'address' => $input['address'],
            'linkedin' => $input['linkedin'],
            'companyname' => $input['companyname'],
            'usertype' => $input['usertype'],
            'role' => $input['role'],
            'websitelink' => $input['websitelink'],
            //'profilepic' => $input['profilepic'],
            //'bio' => $input['bio'],
        ]);
    }
}
