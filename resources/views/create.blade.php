    @extends('layouts.app')
    @section('content')
    
    <link rel="stylesheet" type="text/css" href={{ asset('css/index.css') }}>
    
        <div class='container'>
        <h1>New Post</h1>
        <form action="/posts" method="POST" enctype='multipart/form-data'>
            @csrf
            
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="post[title]" placeholder="ブランド名、種類" value="{{ old('post.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            
            <div class='main-image'>
                <h2>Picture</h2>
                <input type="file" name="image">
                <p class="image__error" style="color:red">{{ $errors->first('image') }}</p>
            </div>
            
            <div class='price'>
                <h2>Price</h2>
                <input type="text" name="post[price]" placeholder="値段" value="{{ old('post.price') }}"/>円
            </div>
           
           <div>
               <h2>Tags</h2>
               <div class="form-group">
                    <input
                        id="tags"
                        name="tags"
                        class="form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}"
                        value="{{ old('tags') }}"
                        type="text"
                        placeholder="タグ"
                    />
                    @if ($errors->has('tags'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tags') }}
                        </div>
                    @endif
                </div>
           </div>
            
           <div class="body">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="詳細情報">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
           </div>
           
           <div class='maps'>
               <div id="header"><h3>Google Maps - 場所検索</h3></div>
            
               <input id="address" type="textbox" name='post[place]' value="{{ old('post.place') }}" >
            
               
           </div>
            <input type="submit" value="保存"/>
         </form>
        
        <div >
            <a href="/" class="btn-denim1">戻る</a>
        </div>    
        
        </div>
        
        
    
    @endsection
    
    
    
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
            
    <script src="{{ asset('/js/result.js') }}"></script>
    
    <script async src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('services.google-map.apikey') }}&callback=initMap" defer></script> 
    
    
    
    