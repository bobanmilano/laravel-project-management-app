@extends('layouts.app')

@section('content')
<div class="container">
        <div class="flex flex-wrap justify-center">
            <div class="card w-1/2 mt-20" style="padding:45px;">
                <div class="card-header subtitle m-b-md text-center mb-10">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-6">
                            <label for="email" class="col-md-4 col-form-label  text-md-right">{{ __('E-Mail Address') }}</label>

                            <div>
                                <input id="email" type="email" class="form-control mt-2 mb-2 w-full border p-2 rounded-sm  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="password" class="col-md-4 mb-2 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6 mb-4">
                                <input id="password" type="password" class="form-control border mt-2 p-2 w-full rounded-sm @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4 mb-8">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-6">
                            <div class="flex justify-between items-center">
                                <button type="submit" class="button">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <span class="ml-3">
                                    <a  href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </form>
                       <p class="text-center text-gray-500 text-xs mt-20">
            &copy;2019 Freelancer Corp. All rights reserved.
          </p>
                </div>
            </div>
        </div>
</div>
@endsection
