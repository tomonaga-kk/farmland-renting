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
        <section>
            <h2 class="mb-5 text-center">投稿一覧</h2>
            　
            {{-- 検索フォーム --}}
            @include('posts.comp_search')
            
            {{-- 投稿一覧　　※「, ['posts' => $posts]」は記述不要だが、コンポーネント内で使う変数を明示している--}}
            @include('posts.comp_posts_list', ['posts' => $posts])
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
