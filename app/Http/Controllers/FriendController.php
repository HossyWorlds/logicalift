<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Menu;
use App\Models\User;
use App\Models\Category;
use App\Models\Result;
use App\Models\Friend;

class FriendController extends Controller
{
    //
    public function friends()
    {
        $friends = Friend::where('user_id', Auth::id())->orWhere('friend_id', Auth::id())->get();
        
        $friendRequests = Friend::where('friend_id', Auth::id())->where('status', 'pending')->get();
        
        return view('friends.friends', compact('friends', 'friendRequests'));
    }
    
    public function adminFriend()
    {
        return view('friends.adminFriend');
    }
    
}
