@extends('layouts.app')

@section('page_title', 'トップページ')

@section('page_meta')
@endsection

@section('page_css')
@endsection

@section('page_js')
@endsection



@section('content')

    @auth
        <section >
            <h2 class="mb-5 text-center">投稿一覧</h2>
            
            <div class="my-5 mx-auto text-end" style="max-width: 980px; width:80%;">
              <a href="{{route('posts.create')}}" class="btn btn-primary">投稿作成</a>
            </div>
            
            
            
            <div class="row justify-content-center">
                @foreach($posts as $post)
                
                  <div class="card mb-3 p-0" style="max-width: 980px; width:80%;">
                    <div class="row g-0">
                      
                      <div class="col-md-5">
                        <img src="{{asset($post->img_name)}}" class="img-fluid rounded-start object-fit-cover h-100" alt="投稿サムネイル" style="filter:brightness(100%); saturate(200%);">
                      </div>
                      
                      <div class="col-md-7">
                        <div class="card-body h-100">
                          
                          <div class="container text-center h-100">
                            
                            <div class="row border-bottom align-items-center" style="height:33%;">
                              <div class="col-8">
                                <p class="card-title">
                                  <a href="{{route('posts.show', $post->id)}}">
                                    {{$post->title}}
                                  </a>
                                </p>
                              </div>
                              <div class="col-4 border-start">
                                <p class="card-text">
                                  <a href="{{route('users.show', $post->user_id)}}">
                                    {{$post->user()->first()->name}}
                                  </a>
                                </p>
                              </div>
                            </div>
                            
                            <div class="row border-bottom align-items-center" style="height:33%;">
                              <div class="col">
                                <p class="card-text">{{$post->place}}</p>
                              </div>
                            </div>
                            
                            <div class="row align-items-center" style="height:33%;">
                              <div class="col">
                                <p class="card-text">{{number_format($post->price_by_month)}}円</p>
                              </div>
                              <div class="col border-start">
                                <p class="card-text"><small class="text-body-secondary">{{number_format($post->size_of_area)}}㎡</small></p>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                
                @endforeach
                
                <div class="mt-5 d-flex justify-content-center">
                    {{$posts->links()}} 
                </div>
                
            </div>
            
        </section>
        
        
        
    @else
        <section class="mb-5 pb-5 row justify-center">
            <h2 class="mb-5 text-center">ようこそfarmland rentingへ</h2>
            <div class="mx-auto w-75 text-center">
                <img class="object-fit-contain w-100" style="filter:brightness(150%); saturate(200%);" src="{{asset('farmland_renting_img1.jpg')}}" alt="top-img">
            </div>
        </section>
        
        <section class="mb-5 pb-5 row justify-center">
            <h2 class="mb-5 text-center">farmland rentingとは</h2>
            <p class="mx-auto w-75">
                畑を「貸したい人」と「借りたい人」を繋ぐマッチングサービスです。<br><br>

                都市部の庭先で家庭菜園を始めたい方や、週末に自然と触れ合いたい方に最適なスペースを提供します。貸す側は、使わなくなった畑や空き地を有効活用して収入を得ることができ、借りる側は、自分だけの農園で新鮮な野菜や果物を育てる喜びを味わえます。<br><br>

                さあ、あなたも今すぐ、土の香りと収穫の楽しみを体験してみませんか？
            </p>
        </section>
    @endauth

@endsection
