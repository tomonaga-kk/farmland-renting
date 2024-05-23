@extends('layouts.app')

@section('page_meta')
@endsection

@section('page_css')
@endsection

@section('page_js')
@endsection

@section('content')

    <section>
        <h2 class="mb-5 text-center">{{$user->name}} さんのプロフィール</h2>
        
        <form method="POST" action="{{ route('users.update', $user->id) }}" class="w-75 mx-auto">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <label for="name" class="col-form-label">名前</label>

                <div>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

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
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

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
                <label for="one_word_message" class="col-form-label">1言メッセージ</label>

                <div>
                    <input id="one_word_message" type="text" class="form-control @error('one_word_message') is-invalid @enderror" name="one_word_message" value="{{ $user->one_word_message }}" required>
                    
                    @error('one_word_message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            
            
            <div class="mt-5 d-flex justify-content-evenly">
                <a href="{{route('users.show', $user->id)}}" class="w-25 btn btn-outline-secondary">キャンセル</a>
                <button type="submit" class="w-25 btn btn-primary">保存</button>
            </div>
        </form>
    </section>
    
@endsection