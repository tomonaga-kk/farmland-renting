@extends('layouts.app')

@section('page_title', '投稿詳細')

@section('page_meta')
@endsection

@section('page_css')
@endsection

@section('page_js')
@endsection



@section('content')
    <section>
        <div class="mb-5 p-5 bg-success text-white text-center fs-5">
            気になる畑が見つかりましたら、投稿者様にメールでお問い合わせください。
        </div>
    </section>

    <section>
        <h2 class="mb-5 text-center">{{$post->title}}</h2>
        
        <div class="mx-auto mb-5 w-50">
            <img src="{{asset($post->img_name)}}" class="img-fluid rounded-start object-fit-cover h-100" alt="投稿サムネイル" style="filter:brightness(100%); saturate(200%);">
        </div>
        
        <table class="mx-auto w-75 table">
            <tr>
              <th scope="col" style="width:150px;">id</th>
              <td scope="row">{{$post->id}}</td>
            </tr>
            <tr>
              <th scope="col">投稿者</th>
              <td>
                  <a href="{{route('users.show', $post->user()->first()->id)}}">{{$post->user()->first()->name}}</a>
                  （メールアドレス：<a href="mailto:{{$post->user()->first()->email}}">{{$post->user()->first()->email}}</a>）
              </td>
            </tr>
            <tr>
              <th scope="col">場所</th>
              <td>{{$post->place}}</td>
            </tr>
            <tr>
              <th scope="col">月額料金</th>
              <td>{{number_format($post->price_by_month)}}円</td>
            </tr>
            <tr>
              <th scope="col">広さ</th>
              <td>{{number_format($post->size_of_area)}}㎡</td>
            </tr>
            <tr>
              <th scope="col">1言メッセージ</th>
              <td>{{$post->one_word_message}}</td>
            </tr>
            <tr>
              <th scope="col">登録日</th>
              <td>{{date('Y/m/d' ,strtotime($post->created_at))}}</td>
            </tr>
        </table>
        
        @if(Auth::user()->id == $post->user_id)
            <div class="mt-5 d-flex justify-content-evenly">
                <a href="{{route('posts.edit', $post->id)}}" class="w-25 btn btn-primary">編集</a>
                <form action="{{route('posts.destroy', $post->id)}}" method="POST" class="w-25">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="w-100 btn btn-danger"
                    onclick="return confirm('削除してもよろしいですか？')">削除</button>
                </form>
            </div>
        @endif
    </section>

@endsection