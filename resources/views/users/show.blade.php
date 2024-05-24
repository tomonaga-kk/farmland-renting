@extends('layouts.app')

@section('page_meta')
@endsection

@section('page_css')
@endsection

@section('page_js')
@endsection

@section('content')
    
    <section class="mb-5 pb-5">
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
            {{--
            <tr>
              <th scope="col">ユーザ種別</th>
              <td>{{$user->user_type == 0 ? '管理者' : '一般'}}</td>
            </tr>
            --}}
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
    
    
    
    <section class="mb-5">
        
        <ul class="mx-auto mb-3 nav nav-tabs" style="width: 85%;">
          <li class="nav-item">
            <a class="nav-link @if(Request::routeIs('users.show')) active @endif" aria-current="page" href="{{ route('users.show', $user->id) }}">
              投稿（{{$user->posts_count}}）
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(Request::routeIs('users.show_likes')) active @endif" href="{{ route('users.show_likes', $user->id) }}">
              お気に入り一覧（{{$user->likeposts_count}}）
            </a>
          </li>
        </ul>
        
        @include('posts.comp_posts_list', ['posts' => $posts])
    </section>
    
@endsection