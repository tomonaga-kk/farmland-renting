<div class="mb-5 mx-auto row" style="max-width: 980px; width:80%;">

    <h3 id="target" class="border-bottom">投稿：{{$posts->total()}}件</h3>
      
    {{-- 新規投稿ボタン --}}
    <div class="my-3 px-0 text-end">
      <a href="{{route('posts.create')}}" class="px-5 m-0 btn btn-primary">投稿作成</a>
    </div>
    
    @foreach($posts as $post)
    
      <div class="card mb-3 p-0">
        <div class="row g-0">
          
          {{-- カード左側 --}}
          <div class="col-md-5">
            <img src="{{asset($post->img_name)}}" class="img-fluid rounded-start object-fit-cover h-100" alt="投稿サムネイル" style="filter:brightness(100%); saturate(200%);">
          </div>
          
          {{-- カード右側 --}}
          <div class="col-md-7">
            <div class="card-body h-100">
              
              <div class="container text-center h-100">
                
                {{-- 1行目 --}}
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
                
                {{-- 2行目 --}}
                <div class="row border-bottom align-items-center" style="height:33%;">
                  <div class="col">
                    <p class="card-text">{{$post->place}}</p>
                  </div>
                </div>
                
                {{-- 3行目 --}}
                <div class="row align-items-center" style="height:33%;">
                  <div class="col">
                    <p class="card-text">{{number_format($post->price_by_month)}}円/月</p>
                  </div>
                  <div class="col border-start">
                    <p class="card-text">{{number_format($post->size_of_area)}}㎡</p>
                  </div>
                  <div class="col border-start d-flex align-items-center">
                      <div id="likeButtonArea-{{$post->id}}">
                        @if($post->isLiked())
                            {{-- 通常
                            <form action="{{ route('likes.destroy', $post->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <input id="unlikeButton" class="btn" type="submit" value="★">
                            </form>
                            --}}
                            
                          {{-- Ajax通信 --}}
                          <button class="btn unlike-button" data-post-id="{{$post->id}}">★</button>
                        @else
                            {{-- 通常 
                            <form action="{{ route('likes.store', $post->id) }}" method="POST">
                              @csrf
                              <input id="likeButton" class="btn" type="submit" value="☆">
                            </form>
                            --}}
                            
                          {{-- Ajax通信 --}}
                          <button class="btn like-button" data-post-id="{{$post->id}}">☆</button>
                        @endif
                      </div>
                    
                      @php
                        $post->loadRelationshipCounts();
                      @endphp
                      <div id="likeCountArea-{{$post->id}}">
                        <p class="card-text">{{$post->likeusers_count}}</p>
                      </div>
                      
                      {{-- loadRelationshipCounts()を使わず、独自にカウント --}}
                      {{--<p class="card-text">{{ $post->likeUsers()->where('post_id', $post->id)->count() }}</p>--}}
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



<script>
  $(document).ready(function(){
    
    // 「いいね」機能
    $(document).on('click', '.like-button', function(){
      let postId = $(this).data('post-id');
      
      $.ajax({
        url: `/post/${postId}/like`,
        method: 'POST',
        data: {
          post_id: postId,
          _token: '{{ csrf_token() }}'
        },
        
        // 成功時の処理
        success: function(response){
          console.log('success');
          
          // 要素挿入箇所の親要素取得 & 要素を挿入
          $("#likeButtonArea-" + postId).children().remove();
          $("#likeButtonArea-" + postId).append(`<button class="btn unlike-button" data-post-id="${postId}">★</button>`);
          
          // いいね数の書き替え
          $("#likeCountArea-" + postId).children().remove();
          $("#likeCountArea-" + postId).append(`<p class="card-text">${response.likeCount}</p>`);
        },
        
        // 失敗時の処理
        error: function(xhr){
          console.log('faile');
        }
      });
    });
    
  
  
    // 「いいね」解除機能
    $(document).on('click', '.unlike-button', function(){
      let postId = $(this).data('post-id');
      
      $.ajax({
        url: `/post/${postId}/unlike`,
        method: 'DELETE',
        data: {
          post_id: postId,
          _token: '{{ csrf_token() }}'
        },
        
        // 成功時の処理
        success: function(response){
          console.log('success');
          
          // 要素挿入箇所の親要素取得 & 要素を挿入
          $("#likeButtonArea-" + postId).children().remove();
          $("#likeButtonArea-" + postId).append(`<button class="btn like-button" data-post-id="${postId}">☆</button>`);
          
          // いいね数の書き替え
          $("#likeCountArea-" + postId).children().remove();
          $("#likeCountArea-" + postId).append(`<p class="card-text">${response.likeCount}</p>`);
        },
        
        // 失敗時の処理
        error: function(xhr){
          console.log('faile');
        }
      });
    });
  });
  
  
  {{--
  function like(id){
    let xhr = new XMLHttpRequest();
    
    // 通信先URL
    xhr.open('POST', `/post/${id}/like`);
    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded;charset=UTF-8');
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector("meta[name='csrf-token']").getAttribute("content"))
    
    xhr.send();
    
    xhr.onreadystatechange = function(){
      console.log(JSON.stringify(xhr));
      if(xhr.readyState === 4 && xhr.status === 200){
        console.log(xhr.responseText);
      }
    }
  }
  --}}
</script>