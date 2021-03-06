@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href={{ asset('css/index.css') }}>

    <div class='container'>
           <h2 class='main-title'>Time Line</h2>
           <a href='/posts/create' class='button06'><span>投稿する</span></a>
           <div class='row'>
                       @foreach ($posts as $post)
                       <div class='col-3'>
                           <div class='card  mb-4'>
                            @if ($post->image_path)
                              <!-- 画像を表示 -->
                              <a href='/posts/{{ $post->id }}'><img src="{{ $post->image_path }}" style='height: 200px' class='card-img-top'></a>
                            @endif
                            <div class='card-body'>
                                <h4 class="card-title"><a href='/posts/{{ $post->id }}'>{{ $post->title }}</a></h4>
                                <div class='card-text'>
                                    投稿者：<a href="/users/{{ $post->user_id }}">{{ $post->user->name }}</a>
                                    <br>値段：¥<a>{{ $post->price }}</a>
                                    <br>タグ:
                                    @foreach($post->tags as $tag)
                                    <p class='tag'>#{{ $tag->name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div> 
                       </div>
                        @endforeach
                        
                   </div>
                   <div class='paginate'>
                        {{ $posts ->links() }}
                        </div>
    </div>
        
        
@endsection

