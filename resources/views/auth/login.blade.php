<x-guest-layout>
    <!-- Session Status -->

    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card-group d-block d-md-flex row">
                        <div class="card col-md-7 p-4 mb-0">
                            <div class="card-body">
                                <h1>Login</h1>
                                <p class="text-medium-emphasis">Sign In to your account</p>

                                <x-auth-session-status class="mb-4 alert-info" :status="session('status')" />


                                <form method="POST" action="{{ route('login') }}" class="was-validated needs-validation"
                                    novalidate>
                                    @csrf
                                    <div class="input-group mb-3"><span class="input-group-text">
                                            <svg class="icon">
                                                <use xlink:href="{{ asset('assets/icons/sprites/free.svg') }}#cil-user">
                                                </use>
                                            </svg></span>


                                        <x-text-input id="email" class="form-control" type="email" name="email"
                                            :value="old('email')" required autofocus autocomplete="username"
                                            placeholder="Email" />

                                        <x-input-error :messages="$errors->get('email')" class="mt-2 d-block" />


                                    </div>



                                    <div class="input-group mb-4"><span class="input-group-text">
                                            <svg class="icon">
                                                <use
                                                    xlink:href="{{ asset('assets/icons/sprites/free.svg') }}#cil-lock-locked">
                                                </use>
                                            </svg></span>



                                        <x-text-input id="password" class="form-control" type="password"
                                            name="password" required autocomplete="current-password"
                                            placeholder="Password" />


                                        <x-input-error :messages="$errors->get('password')" class="mt-2 d-block" />


                                    </div>


                                    <!-- Remember Me -->
                                    <div class="block mb-3">
                                        <label for="remember_me" class="inline-flex items-center">
                                            <input id="remember_me" type="checkbox"
                                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                                name="remember">
                                            <span
                                                class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                        </label>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">

                                            <x-primary-button class="btn btn-primary px-4">
                                                {{ __('Log in') }}
                                            </x-primary-button>
                                        </div>
                                        <div class="col-6 text-end">

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                                    {{ __('Forgot your password?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="card col-md-5 text-white bg-primary py-5">
                            <img 
                            src="{{ asset('assets/img/1.png') }}" 
                            alt="Logo BD" 
                            class="sidebar-brand-full" 
                            width="400"  
                            height="200"  
                            style="object-fit: contain;"
                        >                          
                               
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
