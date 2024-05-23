@extends('layouts.app')

@section('page_title', '投稿作成')

@section('page_meta')
@endsection

@section('page_css')
@endsection

@section('page_js')
<script>
    $('#img_name').on('change', function(){
    
        // 選択された画像をプレビューする
    	var $fr = new FileReader();
    	$fr.onload = function(){
    		$('#preview').attr('src', $fr.result);
    	}
    	$fr.readAsDataURL(this.files[0]);
    	
    	// サンプル画像を非表示にする
    	$("#sample_img").remove();
    });
</script>
@endsection



@section('content')
    
    <section>
        <h2 class="mb-5 text-center">投稿作成</h2>
        
        <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label for="title" class="col-form-label">タイトル</label>
            
                            <div>
                                <input id=title"" type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="タイトルをご入力ください" value="" required>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="place" class="col-form-label">場所</label>
            
                            <div>
                                <input id=place"" type="text" class="form-control @error('place') is-invalid @enderror" placeholder="神奈川県横浜市南区x-x-x" name="place" value="">
                                @error('place')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="size_of_area" class="col-form-label">区画面積[㎡]</label>
            
                            <div>
                                <input id=size_of_area"" type="text" class="form-control @error('size_of_area') is-invalid @enderror" name="size_of_area" placeholder="7" value="" required>
                                @error('size_of_area')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="price_by_month" class="col-form-label">月額料金[円]</label>
            
                            <div>
                                <input id=price_by_month"" type="text" class="form-control @error('price_by_month') is-invalid @enderror" name="price_by_month" value="" placeholder="12000" required>
                                @error('price_by_month')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="one_word_message" class="col-form-label">一言メッセージ</label>
            
                            <div>
                                <input id=one_word_message"" type="text" class="form-control @error('one_word_message') is-invalid @enderror" name="one_word_message" placeholder="初めての投稿です！" value="">
                                @error('one_word_message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label for="img_name" class="col-form-label">写真アップロード</label>
                            <div>
                                <input id="img_name" type="file" class="form-control @error('img_name') is-invalid @enderror" name="img_name">
                                @error('img_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div>
                                <div class="bg-secondary d-flex justify-content-center align-items-center" style="position:relative;overflow:hidden;">
                                    <img id="sample_img" src="{{asset('sample_image.jpg')}}" alt="sample_image" class="object-fit-contain w-100">
                                    <img id="preview" class="object-fit-contain w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <div class="mt-5 d-flex justify-content-evenly">
                <button type="submit" class="w-25 btn btn-primary">保存</button>
            </div>
        </form>
    </section>
    
@endsection