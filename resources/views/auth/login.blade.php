<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="log-in">
        <div class="container-login">
            <div class="wrap-login">
                <form method="POST" class="login-form validate-form" action="{{ route('login') }}">
                    <span class="login-form-title p-b-48">
                        <img class="mx-auto" src="{{ asset('login/assets/images/mobio-logoaa.png') }}" style="width:120px; height:100px; !important">
                    </span>
                    <h1 class=" mb-5" style="font-size: 26px; font-weight:600;">
                        Welcome Back
                    </h1>
                    @csrf

                    <div class="wrap-input validate-input">
                        <input type="text" class="form-control" placeholder="Enter User Name"
                            name="user_name">
                        <x-input-error :messages="$errors->get('user_name')" class="mt-2" />
                    </div>

                    <div class="wrap-input validate-input" data-validate="Enter password">
                        <input type="password" class="form-control" id="pwd" placeholder="Enter Password"
                            name="password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="contact-form-checkbox">
                        <input class="input-checkbox" id="ckb1" type="checkbox" name="remember">
                        <label class="label-checkbox" for="ckb1">
                            Remember me
                        </label>
                    </div>

                    <div class="container-login-form-btn">
                        <div class="wrap-login-form-btn">
                            <div class="login-form-bgbtn"></div>
                            <input type="submit" id="" class="login-form-btn fw-bold" value="SIGN IN">
                        </div>
                    </div>

                    <div class="text-center mt-4 txt2">
                        <span>Forget Password ?</span>
                    </div>
            </div>
        </div>
    </div>
    </form>
</x-guest-layout>
