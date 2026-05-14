<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Resident Portal</title>

    <!-- GOOGLE FONT -->

    <link rel="preconnect"
        href="https://fonts.googleapis.com">

    <link rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- FONT AWESOME -->

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- BOOTSTRAP -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>
        * {

            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {

            --primary: #071129;
            --secondary: #1b2940;

            --bg: #eef2f7;

            --card: #ffffff;

            --text: #0f172a;
            --muted: #64748b;

            --border: #e2e8f0;

            --shadow:
                0 10px 30px rgba(15, 23, 42, 0.06);
        }

        body {

            background: var(--bg);

            font-family: 'Inter', sans-serif;

            display: flex;
            justify-content: center;

            overflow-x: hidden;
        }

        .mobile-container {

            width: 100%;
            max-width: 430px;

            min-height: 100vh;

            background: #f8fafc;

            position: relative;

            overflow: hidden;
        }

        .main-content {

            padding: 18px;
            padding-bottom: 120px;

            min-height: 100vh;
        }

        /* TOPBAR */

        .topbar {

            background:
                linear-gradient(135deg,
                    var(--primary),
                    var(--secondary));

            border-radius: 32px;

            padding: 28px 24px;

            color: white;

            margin-bottom: 22px;

            position: relative;

            overflow: hidden;
        }

        .topbar::before {

            content: '';

            position: absolute;

            width: 200px;
            height: 200px;

            border-radius: 50%;

            background:
                rgba(255, 255, 255, 0.04);

            top: -90px;
            right: -70px;
        }

        .welcome-text {

            font-size: 14px;

            font-weight: 500;

            opacity: .8;

            margin-bottom: 10px;

            position: relative;
            z-index: 2;
        }

        .user-name {

            font-size: 32px;

            font-weight: 800;

            line-height: 1.1;

            margin-bottom: 16px;

            position: relative;
            z-index: 2;
        }

        .barangay-badge {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            background:
                rgba(255, 255, 255, 0.12);

            border:
                1px solid rgba(255, 255, 255, 0.08);

            padding: 10px 16px;

            border-radius: 16px;

            font-size: 13px;

            font-weight: 700;

            position: relative;
            z-index: 2;
        }

        /* CARD */

        .card-box {

            background: white;

            border-radius: 26px;

            padding: 20px;

            margin-bottom: 18px;

            border: 1px solid var(--border);

            box-shadow: var(--shadow);
        }

        .section-title {

            font-size: 20px;

            font-weight: 800;

            color: var(--text);

            margin-bottom: 16px;
        }

        /* INPUT */

        .input {

            width: 100%;

            border:
                1px solid var(--border);

            background: #f8fafc;

            border-radius: 18px;

            padding: 15px 16px;

            font-size: 14px;

            outline: none;

            margin-bottom: 14px;

            transition: .2s;
        }

        .input:focus {

            border-color: #cbd5e1;

            background: white;
        }

        textarea.input {

            resize: none;

            min-height: 120px;
        }

        /* BUTTON */

        .submit-btn {

            width: 100%;

            border: none;

            background:
                linear-gradient(135deg,
                    var(--primary),
                    var(--secondary));

            color: white;

            padding: 15px;

            border-radius: 18px;

            font-size: 14px;

            font-weight: 700;

            transition: .25s;
        }

        .submit-btn:hover {

            opacity: .95;
        }

        /* HISTORY */

        .history-card {

            background: white;

            border-radius: 22px;

            padding: 18px;

            margin-bottom: 14px;

            border: 1px solid var(--border);

            box-shadow: var(--shadow);
        }

        .history-title {

            font-size: 16px;

            font-weight: 800;

            color: var(--text);

            margin-bottom: 8px;
        }

        .history-text {

            font-size: 13px;

            color: var(--muted);

            line-height: 1.6;

            margin-bottom: 10px;
        }

        .history-date {

            font-size: 11px;

            color: #94a3b8;

            font-weight: 700;
        }

        /* VIEW BOX */

        .view-box {

            background: #f8fafc;

            border:
                1px solid var(--border);

            border-radius: 18px;

            padding: 18px;

            margin-bottom: 14px;

            font-size: 14px;

            color: var(--text);
        }

        /* FLOATING NAV */

        .bottom-nav-wrapper {

            position: fixed;

            left: 50%;
            bottom: 18px;

            transform: translateX(-50%);

            width: 100%;
            max-width: 430px;

            padding: 0 18px;

            z-index: 9999;
        }

        .bottom-nav {

            background: rgba(255, 255, 255, 0.96);

            backdrop-filter: blur(20px);

            border-radius: 30px;

            height: 82px;

            border:
                1px solid rgba(255, 255, 255, 0.6);

            box-shadow:
                0 10px 30px rgba(15, 23, 42, 0.08);

            display: flex;

            justify-content: space-between;
            align-items: center;

            padding: 0 14px;
        }

        .nav-item {

            width: 58px;
            height: 58px;

            border-radius: 20px;

            display: flex;

            align-items: center;
            justify-content: center;

            text-decoration: none;

            color: #64748b;

            font-size: 22px;

            transition: .25s;

            position: relative;
        }

        .nav-item:hover {

            color: var(--primary);

            transform: translateY(-2px);
        }

        /* ACTIVE STYLE */

        .nav-item.active {

            width: auto;

            padding: 0 18px;

            gap: 10px;

            background:
                linear-gradient(135deg,
                    #071129,
                    #1b2940);

            color: white;

            display: flex;
        }

        .nav-item.active span {

            display: block;
        }

        .nav-item span {

            display: none;

            font-size: 14px;

            font-weight: 700;

            white-space: nowrap;
        }


        /* MOBILE */

        @media(max-width:430px) {

            .user-name {

                font-size: 28px;
            }

            .bottom-nav {

                height: 76px;
            }

            .nav-item {

                width: 52px;
                height: 52px;

                font-size: 20px;
            }

            .nav-item.active {

                padding: 0 16px;
            }

            .nav-item.active span {

                font-size: 13px;
            }

        }
    </style>

</head>

<body>

    <div class="mobile-container">

        <!-- TUQLAS AI -->

        <script
            src="https://www.tuqlas.com/chatbot.js"
            data-key="tq_live_5bdc2089f46dca847eaec98f4a351f173ac93645"
            data-api="https://www.tuqlas.com"
            defer>
        </script>

        <!-- MAIN CONTENT -->

        <div class="main-content">

            @yield('content')

        </div>

        <!-- FLOATING BOTTOM NAV -->

        <div class="bottom-nav-wrapper">

            <div class="bottom-nav">

                <!-- HOME -->

                <a href="/resident/dashboard"
                    class="nav-item {{ request()->is('resident/dashboard') ? 'active' : '' }}">

                    <i class="fa-solid fa-house"></i>

                    <span>
                        Home
                    </span>

                </a>

                <!-- COMPLAINTS -->

                <a href="/resident/complaints"
                    class="nav-item {{ request()->is('resident/complaints*') ? 'active' : '' }}">

                    <i class="fa-solid fa-triangle-exclamation"></i>

                    <span>
                        Complaints
                    </span>

                </a>

                <!-- REQUESTS -->

                <a href="/resident/documents"
                    class="nav-item {{ request()->is('resident/documents*') ? 'active' : '' }}">

                    <i class="fa-solid fa-file-lines"></i>

                    <span>
                        Requests
                    </span>

                </a>

                <!-- PROFILE -->

                <a href="/profile"
                    class="nav-item {{ request()->is('profile') ? 'active' : '' }}">

                    <i class="fa-solid fa-user"></i>

                    <span>
                        Profile
                    </span>

                </a>

            </div>

        </div>

    </div>

</body>

</html>