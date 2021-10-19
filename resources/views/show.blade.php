@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href={{ asset('css/index.css') }}>

        <div class='container'>
           
           <div class='top'>
               <h4 class="show-title">
                  {{ $post->title }}
               </h4>
               <div class='frame'>
                   <img src="{{ $post->image_path }}" width="500px" height='350px'>
               </div>
               
           </div>
           
           <div class='box'>
               <br>投稿者: <a>{{ $post->user->name }}</a>
               <br>値段：¥<a>{{ $post->price }}</a>
               <br>タグ:
               @foreach($post->tags as $tag)
               <p class='tag'>#{{ $tag->name }}</p>
               @endforeach
               <div class="content">
                  <div class="content__post">
                    <p>{{ $post->body }}</p>    
                  </div>
               </div>
           </div>
           
           <div class='google-maps'>
               店舗名:<a id='address'>{{ $post->place }}</a>
               <div id="map" style='height:400px; width:500px'></div>
               <script src="{{ asset('/js/result.js') }}"></script>
               <script async src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('services.google-map.apikey') }}&callback=initMap" defer></script> 
           </div>
           
           
           
           @can('update', $post)
           <a href="/posts/{{ $post->id }}/edit" class='btn-denim1 button1'>edit</a>
           @endcan
           
           <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline">
           @csrf
           @method('DELETE')
           
           @can('update', $post)
           <button type="submit" class='btn-denim1'>delete</button> 
           @endcan
           
           </form>
           <div class="footer">
                <a href="/" class='btn-denim1 back1' >戻る</a>
           </div>
        </div>
@endsection
            
