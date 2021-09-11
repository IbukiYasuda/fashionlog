@extends('layouts.app')
@section('content')

        <div class='container'>
           <h4>Title</h1>
           <h4 class="title">
            {{ $post->title }}
           </h4>
           <h4>Picture</h4>
           <img src="{{ $post->image_path }}" width="500px" height='350px'>
           <br>投稿者: <a>{{ $post->user->name }}</a>
           <br>値段：¥<a>{{ $post->price }}</a>
            <br>タグ:
            @foreach($post->tags as $tag)
            <a>{{ $tag->name }}</a>
            @endforeach
           <div class="content">
              <div class="content__post">
                <h4>Body</h3>
                <p>{{ $post->body }}</p>    
              </div>
           </div>
           店舗名:<a id='address'>{{ $post->place }}</a>
           <div id="map" style='height:400px; width:500px'></div>
           <script src="{{ asset('/js/result.js') }}"></script>
           <script async src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('services.google-map.apikey') }}&callback=initMap" defer></script> 
           
           @can('update', $post)
           <p class="edit">[<a href="/posts/{{ $post->id }}/edit">edit</a>]</p>
           @endcan
           
           <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline">
           @csrf
           @method('DELETE')
           
           @can('update', $post)
           <button type="submit">delete</button> 
           @endcan
           
           </form>
           <div class="footer">
                <a href="/">戻る</a>
           </div>
        </div>
@endsection
            
