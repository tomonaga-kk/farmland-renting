@extends('layouts.app')


@section('page_meta')
@endsection

@section('page_css')
@endsection

@section('page_js')
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h2 class="mb-4 text-center">ログイン</h2>
        
        <div class="col-md-8">
            <div class="pt-3 px-5 card">
                <!--<div class="card-header">ログイン</div>-->

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-form-label">メールアドレス</label>
                            <div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-5">
                            <label for="password" class="col-form-label">パスワード</label>

                            <div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <!--<div class="row mb-3">-->
                        <!--    <div class="col-md-6 offset-md-4">-->
                        <!--        <div class="form-check">-->
                        <!--            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>-->
                        <!--            <label class="form-check-label" for="remember">Remember Me</label>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->

                        <div class="row mb-0">
                            <div>
                                <p class="mb-0">
                                    <button type="submit" class="w-100 btn btn-primary">ログイン</button>
                                </p>
                                
                                {{--
                                @if (Route::has('password.request'))
                                    <p>
                                        <a class="btn btn-link" href="{{route('password.request')}}">
                                            Forgot Your Password?
                                        </a>
                                    </p>
                                @endif
                                --}}
                                
                            </div>
                        </div>
                        
                        
                        
                        <div class="row mt-5">
                            <div class="mb-3 w-75 mx-auto border"></div>
                            <div class="text-center">
                                はじめて利用しますか？<a href="{{route('register')}}">新規登録</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection