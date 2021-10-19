<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;

class UsersController extends Controller
{
    public function show(User $user)
    {
        $user = User::find($user->id); //idが、リクエストされた$userのidと一致するuserを取得
        $posts = Post::where('user_id', $user->id) //$userによる投稿を取得
            ->orderBy('created_at', 'desc') // 投稿作成日が新しい順に並べる
            ->paginate(10); // ページネーション; 
        return view('layouts.user', [
            'user_name' => $user->name, // $user名をviewへ渡す
            'posts' => $posts, // $userの書いた記事をviewへ渡す
     ]);
    }
}