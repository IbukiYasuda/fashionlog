<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Post;
use App\Tag;
use Storage;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('index')->with(['posts' => $post->getPaginate()]);
    }
    
    public function show(Post $post) 
    {
        return view('show')->with(['post' => $post]);
        
    }
    
    public function create()
    {
        return view('create');
    }
    
    public function store(Post $post, PostRequest $request)
    {
        
        
        $input = $request['post'];
        $post->user_id = Auth::id();
        $post->fill($input)->save();

        //#(ハッシュタグ)で始まる単語を取得。結果は、$matchに多次元配列で代入される。
        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $request->tags, $match);
        
        $tags = [];
        foreach ($match[1] as $tag) {
            $record = Tag::firstOrCreate(['name' => $tag]); //firstOrCreateメソッドで、tags_tableのnameカラムに該当のない$tagは新規登録される。
            array_push($tags, $record); //$recordを配列に追加します(=$tags)
        };
        
        //投稿に紐付けされるタグのidを配列化
        $tags_id = [];
        foreach ($tags as $tag) {
            array_push($tags_id, $tag['id']);
        };
        $post->tags()->attach($tags_id); 
        //投稿ににタグ付するために、attachメソッドをつかい、モデルを結びつけている中間テーブルにレコードを挿入します。
        
         $form = $request->all();

         //s3アップロード開始
         $image = $request->file('image');
         //dd($image);
         // バケットの`myprefix`フォルダへアップロード
         $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
         // アップロードした画像のフルパスを取得
         $post->image_path = Storage::disk('s3')->url($path);

         $post->save();
        
        return redirect('/posts/' . $post->id);
        
    }
    
    
    public function edit(Post $post)
    {
        return view('edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        
        //s3アップロード開始
         $image = $request->file('image');
         // バケットの`myprefix`フォルダへアップロード
         $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
         // アップロードした画像のフルパスを取得
         $post->image_path = Storage::disk('s3')->url($path);
         
         $post->save();
         
         $post->tags()->detach();
         
         preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $request->tags, $match);
        
        $tags = [];
        foreach ($match[1] as $tag) {
            $record = Tag::firstOrCreate(['name' => $tag]); //firstOrCreateメソッドで、tags_tableのnameカラムに該当のない$tagは新規登録される。
            array_push($tags, $record); //$recordを配列に追加します(=$tags)
        };
        
        //投稿に紐付けされるタグのidを配列化
        $tags_id = [];
        foreach ($tags as $tag) {
            array_push($tags_id, $tag['id']);
        };
        $post->tags()->attach($tags_id);
        
        return redirect('/posts/' . $post->id);
        
         
         
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'delete']);
        // 追加
        $this->middleware('can:update,post')->only(['edit', 'update']);
        $this->middleware('verified')->only('create');
    }
}
?>