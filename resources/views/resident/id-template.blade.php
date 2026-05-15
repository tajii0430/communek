<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>
        @page {
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .id-card {
            width: 1020px;
            height: 600px;
            margin: auto;
            transform: scale(0.78);
            transform-origin: center;
            position: relative;
            overflow: hidden;
            border-radius: 35px;
            border: 4px solid #13398d;
            background: white;
        }

        .top-blue {
            position: absolute;
            top: 0;
            left: 0;
            width: 30%;
            height: 110px;
            background: #13398d;
            border-bottom-right-radius: 180px;
        }

        .bottom-blue {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 20px;
            background: #13398d;
        }

        .gold-line {
            position: absolute;
            bottom: 20px;
            left: 0;
            width: 100%;
            height: 5px;
            background: #f4b400;
        }

        .left-logo {
            position: absolute;
            top: 20px;
            left: 30px;
            width: 120px;
        }

        .right-logo {
            position: absolute;
            top: 20px;
            right: 30px;
            width: 120px;
        }

        .header {
            position: absolute;
            top: 25px;
            width: 100%;
            text-align: center;
            color: #13398d;
        }

        .header h1 {
            font-size: 45px;
            margin: 0;
            font-weight: bold;
            line-height: 1;
        }

        .header h2 {
            margin: 5px 0;
            font-size: 20px;
        }

        .header p {
            margin-top: 8px;
            font-size: 15px;
        }

        .photo-box {
            position: absolute;
            left: 40px;
            top: 170px;
            width: 240px;
            height: 240px;
            border-radius: 25px;
            overflow: hidden;
            border: 4px solid #13398d;
            background: #eee;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .resident-id {
            position: absolute;
            left: 30px;
            bottom: 80px;
            width: 240px;
            background: #13398d;
            color: white;
            text-align: center;
            padding: 15px;
            font-weight: bold;
            font-size: 28px;
        }

        .info-section {
            position: absolute;
            left: 360px;
            top: 220px;
            width: 360px;
            color: #111;
        }

        .info {
            margin-bottom: 10px;
            border-bottom: 1px solid #bbb;
            padding-bottom: 8px;
        }

        .label {
            color: #13398d;
            font-size: 15px;
            font-weight: bold;
        }

        .value {
            font-size: 18px;
            font-weight: bold;
            margin-top: 3px;
        }

        .qr-box {
            position: absolute;
            right: 40px;
            top: 190px;
            width: 240px;
            text-align: center;
        }

        .qr-box img {
            width: 220px;
            height: 220px;
            border: 4px solid #13398d;
            border-radius: 20px;
            padding: 10px;
            background: white;
        }

        .scan-text {
            background: #13398d;
            color: white;
            padding: 10px;
            border-radius: 30px;
            margin-top: -10px;
            font-size: 18px;
            font-weight: bold;
        }

        .bg-watermark {
            position: absolute;
            right: 160px;
            top: 180px;
            width: 380px;
            opacity: 0.06;
        }
    </style>
</head>

<body>

    <div class="id-card">

        <div class="top-blue"></div>

        <div class="bottom-blue"></div>

        <div class="gold-line"></div>

        <img
            src="{{ public_path('images/batac-logo.png') }}"
            class="left-logo">

        <img
            src="{{ public_path('images/bagong-pilipinas.png') }}"
            class="right-logo">

        <div class="header">

            <div style="font-size:18px;font-weight:bold;">
                REPUBLIC OF THE PHILIPPINES
            </div>

            <div style="font-size:18px;font-weight:bold;">
                PROVINCE OF ILOCOS NORTE
            </div>

            <div style="font-size:18px;font-weight:bold;">
                CITY OF BATAC
            </div>

            <h2>
                BARANGAY {{ strtoupper($resident->barangay) }}
            </h2>

            <h1>
                RESIDENT ID
            </h1>

            <p>
                “Serbisyong Tapat, Barangay na Maunlad”
            </p>

        </div>

        <!-- PROFILE PHOTO -->

        <div class="photo-box">

            @if($resident->profile_photo)

            <img
                src="{{ $resident->profile_photo }}"
                alt="Resident Photo">

            @else

            <img
                src="{{ public_path('images/default-avatar.png') }}"
                alt="Default Avatar">

            @endif

        </div>

        <!-- RESIDENT ID -->

        <div class="resident-id">

            {{ $resident->resident_id_number }}

        </div>

        <!-- RESIDENT INFORMATION -->

        <div class="info-section">

            <div class="info">

                <div class="label">
                    Name:
                </div>

                <div class="value">
                    {{ $resident->full_name }}
                </div>

            </div>

            <div class="info">

                <div class="label">
                    Contact Number:
                </div>

                <div class="value">
                    {{ $resident->contact_number }}
                </div>

            </div>

            <div class="info">

                <div class="label">
                    Gender:
                </div>

                <div class="value">
                    {{ $resident->gender }}
                </div>

            </div>

            <div class="info">

                <div class="label">
                    Sitio:
                </div>

                <div class="value">
                    {{ $resident->address }}
                </div>

            </div>

            <div class="info">

                <div class="label">
                    Barangay:
                </div>

                <div class="value">
                    {{ $resident->barangay }}
                </div>

            </div>

        </div>

        <!-- QR CODE -->

        <div class="qr-box">

            <img
                src="{{ $qrCode }}"
                alt="QR Code">

            <div class="scan-text">
                SCAN TO VIEW PROFILE
            </div>

        </div>

    </div>

</body>

</html>