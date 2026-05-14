<!DOCTYPE html>
<html>

<head>

    <title>Resident Verification</title>

    <style>
        body {
            font-family: Arial;
            background: #f1f5f9;
            padding: 40px;
        }

        .card {
            background: white;
            max-width: 500px;
            margin: auto;
            padding: 30px;
            border-radius: 20px;
            text-align: center;
        }

        img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }

        h1 {
            color: #0f172a;
        }

        .info {
            background: #f8fafc;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 15px;
            text-align: left;
        }
    </style>

</head>

<body>

    <div class="card">

        <h1>
            VERIFIED RESIDENT
        </h1>

        @if($resident->profile_photo)

        <img
            src="{{ asset('storage/' . $resident->profile_photo) }}">

        @endif

        <div class="info">

            <strong>Name:</strong>

            {{ $resident->full_name }}

        </div>

        <div class="info">

            <strong>Barangay:</strong>

            {{ $resident->barangay }}

        </div>

        <div class="info">

            <strong>Resident ID:</strong>

            {{ $resident->resident_id_number }}

        </div>

    </div>

</body>

</html>