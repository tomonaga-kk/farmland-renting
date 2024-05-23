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
        
        <table class="mx-auto w-75 table">
            <tr>
              <th scope="col">id</th>
              <td scope="row">{{$user->id}}</td>
            </tr>
            <tr>
              <th scope="col">名前</th>
              <td>{{$user->name}}</td>
            </tr>
            <tr>
              <th scope="col">メールアドレス</th>
              <td>{{$user->email}}</td>
            </tr>
            <!--<tr>-->
            <!--  <th scope="col">ユーザ種別</th>-->
            <!--  <td>{{$user->user_type == 0 ? '管理者' : '一般'}}</td>-->
            <!--</tr>-->
            <tr>
              <th scope="col">1言メッセージ</th>
              <td>{{$user->one_word_message}}</td>
            </tr>
            <tr>
              <th scope="col">登録日</th>
              <td>{{date('Y/m/d' ,strtotime($user->created_at))}}</td>
            </tr>
        </table>
        
        @if(Auth::user()->id == $user->id)
          <div class="mt-5 d-flex justify-content-evenly">
              <a href="{{route('users.edit', $user->id)}}" class="w-25 btn btn-primary">編集</a>
              <form action="{{route('users.destroy', $user->id)}}" method="POST" class="w-25">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-100 btn btn-danger"
                  onclick="return confirm('退会すると、ユーザ情報及びこれまでの全ての投稿が削除されます。よろしいですか？')">退会</button>
              </form>
          </div>
        @endif
    </section>
    
@endsection