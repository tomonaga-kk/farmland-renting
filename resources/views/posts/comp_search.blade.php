<div class="mb-5 mx-auto pb-5" style="max-width: 980px; width:80%;">
  <h3 class="border-bottom">検索フォーム</h3>
    
  <form action="{{route('posts.index')}}" method="GET">
    
    <div class="mx-auto row">
        <div class="col-md-6">
          
            <div class="row mb-3">
                <label for="title" class="col-form-label">タイトル（部分一致）</label>

                <div>
                    <input id=title"" type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="タイトルをご入力ください" value="{{in_array("send", $params) ? $params['title'] : null}}">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="place" class="col-form-label">場所（部分一致）</label>

                <div>
                    <input id=place"" type="text" class="form-control @error('place') is-invalid @enderror" placeholder="神奈川県横浜市南区x-x-x" name="place" value="{{in_array("send", $params) ? $params['place'] : null}}">
                    @error('place')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="d-md-none">
                @include('posts.part_search')
            </div>
            
            <div class="row mb-3">
                <label for="one_word_message" class="col-form-label">一言メッセージ（部分一致）</label>

                <div>
                    <input id=one_word_message"" type="text" class="form-control @error('one_word_message') is-invalid @enderror" name="one_word_message" placeholder="初めての投稿です！" value="{{in_array("send", $params) ? $params['one_word_message'] : null}}">
                    @error('one_word_message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
            
        <div class="col-md-6 d-md-block d-none">
            @include('posts.part_search')
        </div>
        
        
    </div>
        
    
    <div class="mt-3 d-flex justify-content-evenly">
        <a href="{{route('posts.index')}}" class="w-25 btn btn-outline-secondary">キャンセル</a>
        <button type="submit" class="w-25 btn btn-primary" name="operation" value="send">検索</button>
    </div>
  </form>
</div>