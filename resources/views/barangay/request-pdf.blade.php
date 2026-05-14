<!DOCTYPE html>
<html>

<head>

    <title>Barangay Document</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
        }

        .center {
            text-align: center;
        }

        .title {
            margin-top: 30px;
            margin-bottom: 40px;
        }

        .content {
            margin-top: 40px;
            line-height: 2;
            font-size: 18px;
        }

        .signature {
            margin-top: 80px;
            text-align: right;
        }
    </style>

</head>

<body>

    <div class="center">

        <h2>Republic of the Philippines</h2>

        <h3>Barangay {{ $request->user->barangay }}</h3>

    </div>

    <div class="title center">

        <h1>
            {{ $request->document_type }}
        </h1>

    </div>

    <div class="content">

        <p>

            This is to certify that

            <strong>
                {{ $request->user->name }}
            </strong>

            is a resident of Barangay
            {{ $request->user->barangay }}.

        </p>

        <p>

            This certification is issued upon
            the request of the above-named
            person for the purpose of:

            <strong>
                {{ $request->purpose }}
            </strong>

        </p>

        <p>

            Issued this
            {{ now()->format('F d, Y') }}.

        </p>

    </div>

    <div class="signature">

        <h4>Barangay Captain</h4>

    </div>

</body>

</html>