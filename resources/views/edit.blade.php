@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href={{ asset('css/index.css') }}>

<body>
    <div class='container'>
        <h1 class="title">Edit</h1>
        <div class="content">
        <form action="/posts/{{ $post->id }}" method="POST"  enctype='multipart/form-data'>
            @csrf
            @method('PUT')
            <div class='content__title'>
                <h2>Title</h2>
                <input type='text' name='post[title]' value="{{ $post->title }}">
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            
            <div class='content__image_path'>
                <h2>Picture</h2>
                <input type="file" name="image" value="{{ $post->image_path }}">
                <p class="image__error" style="color:red">{{ $errors->first('image') }}</p>
            </div>
            
            <div class='content__price price'>
                <h2>Price</h2>
                <input type='text' name='post[price]' value="{{ $post->price }}">
            </div>
            
            <div class='content__tag'>
                <h2>Tags</h2>
                <input
                    id="tags"
                    name="tags"
                    class="form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}"
                    value="{{ old('tags') }}"
                    type="text"
                    placeholder="タグ"
                >
            </div>
            
            <div class='content__body body'>
                <h2>Body</h2>
                <input type='text' name='post[body]' value="{{ $post->body }}">
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            
            <div class='content__place'>
                <h2>Place</h2>
                <input type='text' name='post[place]' value="{{ $post->place }}">
            </div>
            
            <input type="submit" value="保存">
        </form>
        </div>
         <div class='back'>
            <a href="/" class="btn-denim1">戻る</a>
        </div> 
    </div>
    
</body>
@endsection