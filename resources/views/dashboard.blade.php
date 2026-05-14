@extends('layouts.app')

@section('content')

<style>
    body {
        background: #f4f7fb;
        font-family: 'Inter', sans-serif;
    }

    .dashboard-wrapper {
        padding: 10px;
    }

    /* HEADER */

    .dashboard-header {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg,
                #071129 0%,
                #102348 55%,
                #1b2940 100%);
        border-radius: 34px;
        padding: 38px;
        color: white;
        margin-bottom: 28px;
        box-shadow: 0 18px 40px rgba(7, 17, 41, .15);
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        width: 240px;
        height: 240px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .05);
        top: -120px;
        right: -80px;
    }

    .dashboard-header::after {
        content: '';
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .04);
        bottom: -80px;
        left: -50px;
    }

    .dashboard-subtitle {
        font-size: 16px;
        opacity: .8;
        margin-bottom: 12px;
        position: relative;
        z-index: 2;
    }

    .dashboard-title {
        font-size: 48px;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 12px;
        position: relative;
        z-index: 2;
    }

    .dashboard-description {
        font-size: 16px;
        opacity: .85;
        max-width: 600px;
        position: relative;
        z-index: 2;
    }

    /* STATS */

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 22px;
        margin-bottom: 28px;
    }

    .stat-card {
        background: white;
        border-radius: 30px;
        padding: 28px;
        position: relative;
        overflow: hidden;
        border: 1px solid #edf2f7;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .05);
        transition: .25s;
    }

    .stat-card:hover {
        transform: translateY(-4px);
    }

    .stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
    }

    .stat-icon {
        width: 62px;
        height: 62px;
        border-radius: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: 700;
    }

    .blue-bg {
        background: #dbeafe;
        color: #2563eb;
    }

    .green-bg {
        background: #dcfce7;
        color: #16a34a;
    }

    .orange-bg {
        background: #ffedd5;
        color: #ea580c;
    }

    .red-bg {
        background: #fee2e2;
        color: #dc2626;
    }

    .stat-label {
        color: #64748b;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .stat-number {
        font-size: 52px;
        font-weight: 900;
        color: #071129;
        line-height: 1;
    }

    /* ACTIVITY */

    .activity-card {
        background: white;
        border-radius: 34px;
        padding: 32px;
        border: 1px solid #edf2f7;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .05);
    }

    .activity-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
    }

    .activity-title {
        font-size: 28px;
        font-weight: 800;
        color: #071129;
        margin: 0;
    }

    .activity-badge {
        background: #dbeafe;
        color: #2563eb;
        padding: 8px 16px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
    }

    .activity-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 0;
        border-bottom: 1px solid #edf2f7;
    }

    .activity-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .activity-left {
        display: flex;
        gap: 16px;
        align-items: center;
    }

    .activity-icon {
        width: 50px;
        height: 50px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 700;
    }

    .activity-info h4 {
        margin: 0;
        font-size: 17px;
        font-weight: 700;
        color: #071129;
    }

    .activity-info p {
        margin: 4px 0 0;
        font-size: 14px;
        color: #64748b;
    }

    .status-pill {
        padding: 8px 15px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
    }

    .success {
        background: #dcfce7;
        color: #166534;
    }

    .pending {
        background: #fef3c7;
        color: #92400e;
    }

    .active {
        background: #dbeafe;
        color: #1d4ed8;
    }

    @media(max-width:768px) {

        .dashboard-header {
            padding: 28px;
            border-radius: 28px;
        }

        .dashboard-title {
            font-size: 38px;
        }

        .activity-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .activity-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 14px;
        }

    }
</style>

<div class="dashboard-wrapper">

    <!-- HEADER -->

    <div class="dashboard-header">

        <div class="dashboard-subtitle">
            Smart Barangay Information System
        </div>

        <div class="dashboard-title">
            Super Admin Dashboard
        </div>

        <div class="dashboard-description">
            Monitor barangays, residents, complaints,
            and requests across the entire system.
        </div>

    </div>

    <!-- STATS -->

    <div class="stats-grid">

        <!-- RESIDENTS -->

        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon blue-bg">
                    👥
                </div>

            </div>

            <div class="stat-label">
                Total Residents
            </div>

            <div class="stat-number">
                {{ $totalResidents }}
            </div>

        </div>

        <!-- BARANGAYS -->

        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon green-bg">
                    🏘️
                </div>

            </div>

            <div class="stat-label">
                Barangays
            </div>

            <div class="stat-number">
                {{ $totalBarangays }}
            </div>

        </div>

        <!-- REQUESTS -->

        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon orange-bg">
                    📄
                </div>

            </div>

            <div class="stat-label">
                Pending Requests
            </div>

            <div class="stat-number">
                {{ $pendingRequests }}
            </div>

        </div>

        <!-- COMPLAINTS -->

        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon red-bg">
                    ⚠
                </div>

            </div>

            <div class="stat-label">
                Complaints
            </div>

            <div class="stat-number">
                {{ $totalComplaints }}
            </div>

        </div>

    </div>

    <!-- ACTIVITY -->

    <div class="activity-card">

        <div class="activity-header">

            <h2 class="activity-title">
                Recent System Activity
            </h2>

            <div class="activity-badge">
                Live Monitoring
            </div>

        </div>

        <div class="activity-item">

            <div class="activity-left">

                <div class="activity-icon blue-bg">
                    👤
                </div>

                <div class="activity-info">

                    <h4>
                        New resident registered
                    </h4>

                    <p>
                        System received a new resident registration.
                    </p>

                </div>

            </div>

            <div class="status-pill success">
                Success
            </div>

        </div>

        <div class="activity-item">

            <div class="activity-left">

                <div class="activity-icon green-bg">
                    🏢
                </div>

                <div class="activity-info">

                    <h4>
                        Barangay worker created
                    </h4>

                    <p>
                        A new barangay worker account was added.
                    </p>

                </div>

            </div>

            <div class="status-pill active">
                Active
            </div>

        </div>

        <div class="activity-item">

            <div class="activity-left">

                <div class="activity-icon orange-bg">
                    📢
                </div>

                <div class="activity-info">

                    <h4>
                        Complaint submitted
                    </h4>

                    <p>
                        A new complaint was submitted by a resident.
                    </p>

                </div>

            </div>

            <div class="status-pill pending">
                Pending
            </div>

        </div>

    </div>

</div>

@endsection