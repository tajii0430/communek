@extends('layouts.superadmin')

@section('content')

<!DOCTYPE html>
<html>

<head>

    <title>Registration Submitted</title>

    <meta name="viewport"
        content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body style="
    background:#f3f4f6;
    font-family:Arial;
">

    <div class="container d-flex justify-content-center align-items-center"
        style="height:100vh;">

        <div style="
            background:white;
            padding:50px;
            border-radius:20px;
            width:100%;
            max-width:500px;
            text-align:center;
            box-shadow:0 5px 20px rgba(0,0,0,0.08);
        ">

            <div style="
                font-size:70px;
                margin-bottom:20px;
            ">
                ✅
            </div>

            <h1 style="
                font-weight:700;
                margin-bottom:20px;
            ">

                Registration Submitted

            </h1>

            <p style="
                font-size:18px;
                color:#6b7280;
                margin-bottom:30px;
            ">

                Your account is waiting for approval from the barangay worker.

            </p>

            <a href="/login"
                class="btn btn-primary btn-lg">

                Back to Login

            </a>

        </div>

    </div>

</body>

</html>

@endsection