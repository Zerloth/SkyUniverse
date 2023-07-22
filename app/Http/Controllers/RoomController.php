<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $partner_id = $user->gender == 'male' ? substr_replace($user->id, "2", -1) : substr_replace($user->id, "1", -1);
        $partnerExists = User::find($partner_id)->exists();
        if ($partnerExists) {
            return redirect()->route("partner", ["room_id" => substr($partner_id, 0, 6)]);
        } else {
            return redirect()->route("tictactoe", ["room_id" => $user->id]);
        }
    }

    public function tictactoe()
    {
    }

    public function partner()
    {
    }

    public function checkout()
    {
    }
}
