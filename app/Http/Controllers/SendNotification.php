<?php

namespace App\Http\Controllers;

use App\Notifications\InvoicePaid;
use App\User;
use Illuminate\Http\Request;

class SendNotification extends Controller
{
    public function sendNotification(Request $request){
        $user = User::first();
        $user->notify(new InvoicePaid());
        return "Notifikasi berhasil terkirim";
    }
}
