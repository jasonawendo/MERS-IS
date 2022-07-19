<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- First Name -->
            <br>
            <br>
            
            <div class="mt-4">
                <x-jet-label for="fname" value="{{ __('First Name') }}" />
                <x-jet-input id="fname" placeholder="John" class="block mt-1 w-full" type="text" name="fname" :value="old('fname')" required autofocus autocomplete="fname" />
            </div>

            <!-- Last Name -->
            <div class="mt-4">
                <x-jet-label for="lname" value="{{ __('Last Name') }}" />
                <x-jet-input id="lname" placeholder="Doe" class="block mt-1 w-full" type="text" name="lname" :value="old('lname')" required autofocus autocomplete="lname" />
            </div>

            <!-- National ID Number -->
            <div class="mt-4">
                <x-jet-label for="nationalid" value="{{ __('National ID Number') }}" />
                <x-jet-input id="nationalid" placeholder="xxxxxxxx" class="block mt-1 w-full" type="text" name="nationalid" :value="old('nationalid')" required />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" placeholder="johndoe@something.com" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Mobile Number -->
            <div class="mt-4">
                <x-jet-label for="mobilenumber" value="{{ __('Mobile Number') }}" />
                <x-jet-input id="mobilenumber" class="block mt-1 w-full" type="text" name="mobilenumber" :value="old('mobilenumber')" required />
            </div>

            <!-- KRA PIN -->
            <div class="mt-4">
                <x-jet-label for="krapin" value="{{ __('KRA PIN') }}" />
                <x-jet-input id="krapin" class="block mt-1 w-full" type="text" name="krapin" :value="old('krapin')" required />
            </div>

            <!-- Address -->
            <div class="mt-4">
                <x-jet-label for="address" value="{{ __('Address-County') }}" />
                <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />
            </div>

            <!-- Linkedin -->
            <div class="mt-4">
                <x-jet-label for="linkedin" value="{{ __('Linkedin-Link') }}" />
                <x-jet-input id="linkedin" class="block mt-1 w-full" type="text" name="linkedin" :value="old('linkedin')" required />
            </div>

            <!-- Company Name -->
            <div class="mt-4">
                <x-jet-label for="companyname" value="{{ __('Company Name') }}" />
                <x-jet-input id="companyname" class="block mt-1 w-full" type="text" name="companyname" :value="old('companyname')" />
            </div>

            <!-- Website Link -->
            <div class="mt-4">
                <x-jet-label for="websitelink" value="{{ __('Website-Link') }}" />
                <x-jet-input id="websitelink" class="block mt-1 w-full" type="text" name="websitelink" :value="old('websitelink')" />
            </div>

            <!-- Customer Type -->
            <div class="mt-4">
                <x-jet-label for="usertype" value="{{ __('User Type') }}" />

                <select id="usertype" class="block mt-1 w-full" name="usertype">
                <option value="individual" >
                     Individual
                 </option>
                 <option value="organization" >
                     Organization
                 </option>
            </select>
            </div>

            <!-- Role -->
            <div class="mt-4">
                <x-jet-label for="role" value="{{ __('Role') }}" />
                <select id="role" class="block mt-1 w-full" name="role" >
                <option value="Customer" >
                     Customer
                 </option>
                 <option value="Equipment Owner" >
                     Equipment Owner
                 </option>
                 </select>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>


            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
