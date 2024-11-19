<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $users = User::leftJoin("likes", "users.id", "=", "likes.liked_to")
                    ->select("users.id", "users.name", "users.email", "likes.like_from")
                    ->get();

        return view("dashboard", compact("users"));
    }

    public function toggleLikes(string $id)
    {
        $user = Auth::user();
        $user_clicked = User::find($id);
        if(empty($user_clicked))
        {
            return redirect()->back();
        }

        $like = Like::where("like_from", $user->id)->where("liked_to", $id)->first();
        if(!empty($like))
        {
            $like->delete();
        }
        else
        {
            Like::create([
                "like_from" => $user->id,
                "liked_to" => $id
            ]); 
        }
        
        return redirect()->route("dashboard");
    }
}
