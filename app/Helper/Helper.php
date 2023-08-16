<?php

namespace App\Helper;

use Illuminate\Support\Facades\Mail;
use App\Mail\WhatsappGroupInvitationEmail;

class Helper
{
    public static function sendWhatsappGroupInvitationEmail($destination, $name, $team_name, $competition, $link)
    {
        $data = [
            'name' => $name,
            'team_name' => $team_name,
            'link' => $link,
            'competition' => $competition
        ];

        Mail::to($destination)->send(new WhatsappGroupInvitationEmail($data));

        return response()->json([
            'message' => 'Email berhasil dikirim',
        ]);
    }
}
