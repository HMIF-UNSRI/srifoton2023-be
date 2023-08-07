<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Srifoton 2023 | Verifikasi Email</title>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap");

        * {
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
            color: #718096;
        }
    </style>
</head>

<body style="background-color: #edf2f7;
            padding: 1.5rem;
            position: relative;">

    <div style="width:100%; margin: 1rem 0; text-align: center;">
        <img src="https://lh3.googleusercontent.com/pw/AIL4fc-D5wVxLo_gmG9VpJRp_jXxW3FJLdh3Cp0Of5lOBxzewN0p-sz2s9kvYdQtlTL04Q-FXxLVTF87T5ClRg42vFpW80wO-hPAApJPCaAQB4dz0-yAV4QHqpFkp8dGziif2PcfAZaJCnMySklVBTMzMsU7=w912-h176-s-no"
            alt="logo-srifoton" height="30">
    </div>
    <div
        style="max-width: 400px;
            background-color: #ffffff;
            padding: 2rem 1.5rem;
            border-radius: 8px;
            margin: 0 auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);">
        <h3 style="color: #494b7c;
            margin-bottom: 1rem;">Halo, {{ $user->name }}</h3>
        <p style="font-size: 14px">
            Klik tombol dibawah untuk melakukan verifikasi email
        </p>

        <div style="margin: 1.5rem 0; text-align: center;">
            <a href="{{ $verificationUrl }}"
                style="text-decoration: none;
                        font-weight: bold;
                        background-color: #2e7bef;
                        color: #ffffff;
                        padding: 8px 14px;
                        border-radius: 5px;">Verifikasi
                Email</a>
        </div>

        <p style="font-size: 14px">Jika anda merasa tidak melakukan permintaan ini, abaikan pesan ini. Ini adalah email
            yang dibuat secara otomatis, tolong jangan balas email ini.</p>
        <br>
        <p style="font-size: 14px">Terima kasih,</p>
        <p style="font-size: 14px">Srifoton 2023</p>

        <hr style="margin: 1rem 0">

        <p style="font-size: 12px;">
            Jika anda mengalami masalah saat mengeklik tombol "Verifikasi Email",
            salin dan tempel URL ini ke web browser anda: {{ $verificationUrl }}
        </p>
    </div>

    <div style="width:100%; margin: 8px 0; text-align: center;">
        <p style="font-size: 10px;">© 2023 Srifoton2023. All rights reserved.</p>
    </div>
</body>

</html>
