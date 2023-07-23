<?php

namespace App\Http\Controllers;

use App\Events\TictactoeTurn;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lokasi;
use App\Models\Transaction;
use Redirect;

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
            $room = Room::whereNull('user2_id')
                ->join('users', 'users.id', '=', 'rooms.user1_id')
                ->where('users.gender', '<>', $user->gender)
                ->select('rooms.id')
                ->first();

            if (!$room) {
                $room = Room::create([
                    'user1_id' => $user->id
                ]);
            } else {
                $room->user2_id = $user->id;
                $room->save();
            }

            return redirect()->route("tictactoe", ["room" => $room->id]);
        }
    }

    public function tictactoe(Room $room)
    {
        $user = Auth::user();
        if ($room->user1_id != $user->id  && $room->user2_id != $user->id) {
            return redirect()->route("home");
        }
        $symbol = $room->user1_id == $user->id ? 'x' : 'o';

        return view("tictactoe", ['symbol' => $symbol, "dating_code" => $user->dating_code]);
    }

    public function partner($room)
    {
        $user = Auth::user();
        $partner_id = $user->gender == 'male' ? $room . '02' : $room . '01';
        $partner = User::find($partner_id);
        return view('partner', ['partner' => $partner]);
    }

    public function checkout()
    {

        $lokasi = Lokasi::all();
        return view('checkout', ['lokasi' => $lokasi]);
    }
    public function checkoutFilter($lokasi)
    {

        $lokasi = Lokasi::where('lokasi', '=', $lokasi)->get();
        return view('checkout', ['lokasi' => $lokasi]);
    }
    public function checkoutForm(Request $request)
    {
        // dd($request);
        return view('checkout_form', ['request' => $request->all()]);
    }
    public function bayar(Request $request)
    {
        // dd($request->all());
        $validated =  $request->validate([
            "penerima" => 'required|regex:/^[\pL\s]+$/u',
            "alamat" => 'required',
            "nomortelepon" => 'required|regex:/^[0-9]{10,14}$/',
            "kurir" => 'required',
            "harga" => 'required',
            "pembayaran" => 'required',
        ]);
        if(!$validated){
            return Redirect::back()->withErrors($validator)->withInput($request->input());
        }
        // $transaction = Transaction::create([
        //     'penerima' => $request->penerima,
        //     'alamat_kirim' => $request->alamat,
        //     'nomor_telepon' => $request->telepon,
        //     'kurir' => $request->kurir,
        //     'metode_pembayaran' => $request->metode_pembayaran,
        //     'total' => $request->total,
        //     'id_user' => Auth::id()
        // ]);

        return Redirect::back()->withErrors("Success bro")->withInput($request->input());
    }

    public function test(Request $request)
    {
        event(new TictactoeTurn($request->room, $request->cell, $request->symbol));

        return response()->json(["success" => "yeah"]);
    }
}
