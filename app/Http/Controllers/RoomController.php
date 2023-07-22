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
        $partner = User::find($partner_id);
        if ($partner) {
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
