<?php

namespace App\Helper;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
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

    public static function sendAlertToFinance($competitionName, $teamName, $paymentMethod, $link)
    {
        $client = new Client();
        $options = [
            'json' => [
                'device_id' => env('DEVICE_ID'),
                'group' => 'CP Srifoton 2022',
                'message' => "Pemberitahuan!\n" .
                    "Terdapat pendaftar baru di kompetisi *$competitionName* dengan nama tim *$teamName* dengan metode pembayaran *$paymentMethod*. Segera lakukan verifikasi pembayaran di link berikut: $link\n" .
                    "Terima Kasih"
            ]
        ];
        $request = new Request('POST', 'https://app.whacenter.com/api/sendGroup');
        $client->sendAsync($request, $options)->wait();
    }
}
