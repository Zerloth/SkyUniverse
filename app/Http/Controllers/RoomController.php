<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $partner_id = $user->gender == 'male' ? substr_replace($user->id, "2", -1) : substr_replace($user->id, "1", -1);
        $partner = User::find($partner_id);
        if ($partner) {
            return redirect()->route("partner", ["room" => substr($partner_id, 0, 6)]);
        } else {
            $room = Room::whereNull('user1_id')
                ->orWhereNull('user2_id')
                ->join('users AS u1', 'u1.id', '=', 'rooms.user1_id')
                ->join('users AS u2', 'u2.id', '=', 'rooms.user2_id')
                ->where('u1.gender', '<>', $user->gender)
                ->orWhere('u2.gender', '<>', $user->gender)
                ->first();

            if (!$room) {
                $room = Room::create([
                    'user1_id' => $user->id
                ]);
            }

            return redirect()->route("tictactoe", ["room" => $room->id]);
        }
    }

    public function tictactoe(Room $room)
    {
        if ($room->user1_id && $room->user2_id) {
            return redirect()->route("home");
        }
        return view("tictactoe");
    }

    public function partner()
    {
    }

    public function checkout()
    {
        return view('checkout');
    }
    public function checkoutForm(Request $request){
        // dd($request->all());
        return view('checkout_form', ['value'=>$request->inlineRadioOptions]);
    }
    public function bayar(Request $request){
        dd($request->all());
        $validated =  $request->validate([
            
        ]);
    }
}
