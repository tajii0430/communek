<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CommuNek Barangay System</title>

    <!-- BOOTSTRAP -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FONT AWESOME -->

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            overflow-x: hidden;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */

        .sidebar {
            width: 280px;
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
            padding: 24px 18px;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* LOGO */

        .sidebar-top {
            width: 100%;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 10px 12px 28px;
            border-bottom: 1px solid #edf2f7;
            margin-bottom: 28px;
        }

        .brand img {
            width: 52px;
            height: 52px;
            object-fit: contain;
            border-radius: 14px;
            background: #071129;
            padding: 6px;
        }

        .brand-text h2 {
            font-size: 24px;
            font-weight: 800;
            margin: 0;
            color: #071129;
        }

        .brand-text p {
            margin: 4px 0 0;
            font-size: 13px;
            color: #64748b;
        }

        /* MENU TITLE */

        .menu-label {
            font-size: 13px;
            font-weight: 700;
            color: #94a3b8;
            margin-bottom: 14px;
            padding-left: 14px;
            letter-spacing: .5px;
        }

        /* NAVIGATION */

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 15px 16px;
            border-radius: 16px;
            text-decoration: none;
            color: #475569;
            transition: .25s;
            font-size: 16px;
            font-weight: 600;
        }

        .nav-link i {
            width: 22px;
            font-size: 18px;
        }

        .nav-link:hover {
            background: #f1f5f9;
            color: #071129;
        }

        .nav-link.active {
            background: #071129;
            color: white;
            box-shadow: 0 8px 20px rgba(7, 17, 41, .15);
        }

        /* LOGOUT */

        .logout-btn {
            width: 100%;
            border: none;
            background: #f1f5f9;
            color: #0f172a;
            padding: 16px;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 700;
            transition: .25s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .logout-btn:hover {
            background: #ef4444;
            color: white;
        }

        /* MAIN */

        .main {
            margin-left: 280px;
            width: calc(100% - 280px);
            padding: 28px;
        }

        /* TOPBAR */

        .topbar {
            background: white;
            border-radius: 22px;
            padding: 24px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 26px;
            border: 1px solid #e2e8f0;
        }

        .topbar h3 {
            margin: 0;
            font-size: 32px;
            font-weight: 800;
            color: #0f172a;
        }

        .topbar p {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 15px;
        }

        .welcome-box {
            background: #f8fafc;
            padding: 14px 18px;
            border-radius: 16px;
            font-size: 15px;
            color: #334155;
            font-weight: 600;
        }

        /* CONTENT */

        .content {
            background: white;
            border-radius: 22px;
            padding: 30px;
            min-height: calc(100vh - 170px);
            border: 1px solid #e2e8f0;
        }

        /* RESPONSIVE */

        @media(max-width:900px) {

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                border-right: none;
            }

            .layout {
                flex-direction: column;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

        }
    </style>

</head>

<body>

    <div class="layout">

        <!-- SIDEBAR -->

        <div class="sidebar">

            <div class="sidebar-top">

                <!-- BRAND -->

                <div class="brand">

                    <img src="{{ asset('images/logo-white.jpg') }}"
                        alt="CommuNek Logo">

                    <div class="brand-text">

                        <h2>CommuNek</h2>

                        <p>Barangay Worker Panel</p>

                    </div>

                </div>

                <!-- MENU -->

                <div class="menu-label">

                    MENU

                </div>

                <div class="sidebar-menu">

                    <a href="/barangay/dashboard"
                        class="nav-link {{ request()->is('barangay/dashboard') ? 'active' : '' }}">

                        <i class="fas fa-house"></i>

                        <span>Dashboard</span>

                    </a>

                    <a href="/barangay/resident-verification"
                        class="nav-link {{ request()->is('barangay/resident-verification') ? 'active' : '' }}">

                        <i class="fas fa-user-check"></i>

                        <span>Resident Verification</span>

                    </a>

                    <a href="/barangay/residents"
                        class="nav-link {{ request()->is('barangay/residents') ? 'active' : '' }}">

                        <i class="fas fa-users"></i>

                        <span>Residents</span>

                    </a>

                    <a href="/barangay/complaints"
                        class="nav-link {{ request()->is('barangay/complaints') ? 'active' : '' }}">

                        <i class="fas fa-triangle-exclamation"></i>

                        <span>Complaints</span>

                    </a>

                    <a href="/barangay/requests"
                        class="nav-link {{ request()->is('barangay/requests') ? 'active' : '' }}">

                        <i class="fas fa-file-lines"></i>

                        <span>Requests</span>

                    </a>

                    <a href="/barangay/announcements"
                        class="nav-link {{ request()->is('barangay/announcements') ? 'active' : '' }}">

                        <i class="fas fa-bullhorn"></i>

                        <span>Announcements</span>

                    </a>

                </div>

            </div>

            <!-- LOGOUT -->

            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button type="submit" class="logout-btn">

                    <i class="fas fa-right-from-bracket"></i>

                    Logout

                </button>

            </form>

        </div>

        <!-- MAIN -->

        <div class="main">

            <!-- TOPBAR -->

            <div class="topbar">

                <div>

                    <h3>
                        {{ Auth::user()->barangay }}
                    </h3>

                    <p>
                        City of Batac Smart Barangay System
                    </p>

                </div>

                <div class="welcome-box">

                    Welcome,
                    {{ Auth::user()->name ?? 'Barangay Worker' }}

                </div>

            </div>

            <!-- CONTENT -->

            <div class="content">

                @yield('content')

            </div>

        </div>

    </div>



</body>

</html>