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
        <h2 class="mb-4 text-center">会員登録</h2>
        
        <div class="col-md-8">
            <div class="pt-3 px-5 card">
                <!--<div class="card-header">新規登録</div>-->

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-form-label">名前</label>

                            <div>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-form-label">メールアドレス</label>

                            <div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        　
                        
                        
                        {{-- 管理者ユーザ作成用　※管理ユーザ登録の際はmdelの$fillable設定も変更する必要あり！
                        <div class="row mb-3">
                            <label for="user_type" class="col-form-label">ユーザ種別</label>
                            <div>
                                <select id="user_type" name="user_type" class="form-control">
                                    <option value=0>管理者</option>
                                    <option value=1>一般</option>
                                </select>
                            </div>
                        </div>
                        --}}
                        
                        

                        <div class="row mb-3">
                            <label for="password" class="col-form-label">パスワード</label>

                            <div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-5">
                            <label for="password-confirm" class="col-form-label">パスワード確認</label>

                            <div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        
                        <div class="row mb-0">
                            <div>
                                <button type="submit" class="w-100 btn btn-primary">登録</button>
                            </div>
                        </div>
                        
                        <div class="row mt-5">
                            <div class="mb-3 w-75 mx-auto border"></div>
                            <div class="text-center">
                                会員登録済みですか？<a href="{{route('login')}}">ログイン</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
