<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use App\Notifications\UserLikedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $users = User::leftJoin("likes", "users.id", "=", "likes.liked_to")
                    ->select("users.id", "users.name", "users.email", "likes.like_from")
                    ->whereNot("users.id", Auth::id())
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
        DB::beginTransaction();
        try
        {
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
                $this->notify($user_clicked);
            }
            DB::commit();
            return redirect()->route("dashboard");
        }
        catch(\Exception $ex)
        {
            DB::rollBack();
            throw $ex->getMessage();
        }
    }

    public function notify(User $user_to_notify)
    {
        $user = Auth::user();
        if(empty($user_to_notify) || empty($user))
        {
            return redirect()->route("dashboard");
        }

        $user_to_notify->notify(new UserLikedNotification($user));
    }
}
