@extends('layouts.app')

@section('page_meta')
@endsection

@section('page_css')
@endsection

@section('page_js')
@endsection

@section('content')
    <section>
        <h2 class="mb-5 text-center">ユーザ一覧</h2>
        <table class="mx-auto w-75 table table-striped table-hover">
            <thead>
                <tr>
                  <th scope="col">id</th>
                  <th scope="col">名前</th>
                  <th scope="col">メールアドレス</th>
                  <th scope="col">ユーザ種別</th>
                  <th scope="col">登録日</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->user_type == 0 ? '管理者' : '一般'}}</td>
                        <td>{{date('Y/m/d' ,strtotime($user->created_at))}}</td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
        
        <div class="mt-5 d-flex justify-content-center">
            {{$users->links()}}
        </div>
        
        @if(empty($users))
            <p class="text-center fw-bold">※※登録済みユーザがいません※※</p>
        @endif
    </section>
@endsection


