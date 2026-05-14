<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>CommuNek Super Admin</title>

    <!-- BOOTSTRAP -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- FONT AWESOME -->

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- GOOGLE FONT -->

    <link rel="preconnect"
        href="https://fonts.googleapis.com">

    <link rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
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
            z-index: 1000;
        }

        /* BRAND */

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

        /* MENU */

        .menu-label {
            font-size: 13px;
            font-weight: 700;
            color: #94a3b8;
            margin-bottom: 14px;
            padding-left: 14px;
            letter-spacing: .5px;
        }

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
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .welcome-avatar {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            background: #071129;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: 800;
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

        @media(max-width:768px) {

            .topbar h3 {
                font-size: 24px;
            }

            .content {
                padding: 20px;
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

                        <p>Super Admin Panel</p>

                    </div>

                </div>

                <!-- MENU -->

                <div class="menu-label">

                    MANAGEMENT

                </div>

                <div class="sidebar-menu">

                    <a href="/superadmin/dashboard"
                        class="nav-link {{ request()->is('superadmin/dashboard') ? 'active' : '' }}">

                        <i class="fas fa-chart-line"></i>

                        <span>Dashboard</span>

                    </a>

                    <a href="/superadmin/barangays"
                        class="nav-link {{ request()->is('superadmin/barangays') ? 'active' : '' }}">

                        <i class="fas fa-map-location-dot"></i>

                        <span>Barangays</span>

                    </a>

                    <a href="/superadmin/workers"
                        class="nav-link {{ request()->is('superadmin/workers') ? 'active' : '' }}">

                        <i class="fas fa-user-gear"></i>

                        <span>Barangay Workers</span>

                    </a>

                </div>

            </div>

            <!-- LOGOUT -->

            <form method="POST"
                action="{{ route('logout') }}">

                @csrf

                <button
                    type="submit"
                    class="logout-btn">

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
                        Super Administrator
                    </h3>

                    <p>
                        CommuNek Smart Barangay Information System
                    </p>

                </div>

                <div class="welcome-box">

                    <div class="welcome-avatar">

                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}

                    </div>

                    <div>

                        Welcome,
                        {{ Auth::user()->name ?? 'Super Admin' }}

                    </div>

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