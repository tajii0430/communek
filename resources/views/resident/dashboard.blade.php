@extends('layouts.resident')

@section('content')

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

<style>
    body {
        background: #f4f7fb;
        font-family: 'Inter', sans-serif;
    }

    .resident-dashboard {
        padding: 18px;
        padding-bottom: 120px;
    }

    /* HEADER */

    .dashboard-header {
        position: relative;
        overflow: hidden;
        background:
            linear-gradient(135deg,
                #071129 0%,
                #102348 55%,
                #1b2940 100%);
        border-radius: 34px;
        padding: 32px 24px;
        color: white;
        margin-bottom: 22px;
        box-shadow: 0 18px 40px rgba(7, 17, 41, .18);
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        width: 220px;
        height: 220px;
        background: rgba(255, 255, 255, .05);
        border-radius: 50%;
        top: -110px;
        right: -90px;
    }

    .dashboard-header::after {
        content: '';
        position: absolute;
        width: 160px;
        height: 160px;
        background: rgba(255, 255, 255, .04);
        border-radius: 50%;
        bottom: -70px;
        left: -40px;
    }

    .welcome-text {
        font-size: 15px;
        font-weight: 600;
        opacity: .8;
        margin-bottom: 10px;
        position: relative;
        z-index: 2;
    }

    .resident-name {
        font-size: 42px;
        font-weight: 900;
        line-height: 1.05;
        margin-bottom: 16px;
        word-break: break-word;
        position: relative;
        z-index: 2;
    }

    .barangay-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.10);
        border: 1px solid rgba(255, 255, 255, .08);
        backdrop-filter: blur(10px);
        padding: 12px 18px;
        border-radius: 18px;
        font-size: 13px;
        font-weight: 700;
        position: relative;
        z-index: 2;
    }

    /* STATS */

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: white;
        border-radius: 24px;
        padding: 18px;
        border: 1px solid #edf2f7;
        box-shadow: 0 10px 28px rgba(15, 23, 42, .05);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        font-size: 18px;
    }

    .blue-bg {
        background: #dbeafe;
        color: #2563eb;
    }

    .yellow-bg {
        background: #fef3c7;
        color: #d97706;
    }

    .green-bg {
        background: #dcfce7;
        color: #16a34a;
    }

    .stat-number {
        font-size: 28px;
        font-weight: 900;
        color: #071129;
        line-height: 1;
        margin-bottom: 6px;
    }

    .stat-label {
        font-size: 12px;
        color: #64748b;
        font-weight: 700;
        line-height: 1.5;
    }

    /* QUICK SERVICES */

    .section-title {
        font-size: 20px;
        font-weight: 900;
        color: #071129;
        margin-bottom: 14px;
    }

    .quick-services {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
        margin-bottom: 22px;
    }

    .service-card {
        background: white;
        border-radius: 28px;
        padding: 22px 18px;
        text-decoration: none;
        border: 1px solid #edf2f7;
        box-shadow: 0 10px 28px rgba(15, 23, 42, .05);
        transition: .25s;
    }

    .service-card:hover {
        transform: translateY(-4px);
    }

    .service-icon {
        width: 58px;
        height: 58px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
        font-size: 20px;
    }

    .documents-icon {
        background: #dbeafe;
        color: #2563eb;
    }

    .complaints-icon {
        background: #fee2e2;
        color: #dc2626;
    }

    .service-card h2 {
        font-size: 18px;
        font-weight: 900;
        color: #071129;
        margin-bottom: 6px;
    }

    .service-card p {
        font-size: 12px;
        color: #64748b;
        line-height: 1.6;
        margin: 0;
    }

    /* BOX */

    .dashboard-box {
        background: white;
        border-radius: 28px;
        padding: 20px;
        border: 1px solid #edf2f7;
        box-shadow: 0 10px 28px rgba(15, 23, 42, .05);
        margin-bottom: 20px;
    }

    .box-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .box-title {
        font-size: 20px;
        font-weight: 900;
        color: #071129;
        margin: 0;
    }

    .see-all {
        font-size: 12px;
        color: #2563eb;
        text-decoration: none;
        font-weight: 700;
    }

    /* ANNOUNCEMENTS */

    .announcement-item {
        background: #f8fafc;
        border: 1px solid #edf2f7;
        border-radius: 20px;
        padding: 18px;
        margin-bottom: 14px;
    }

    .announcement-item:last-child {
        margin-bottom: 0;
    }

    .announcement-item h3 {
        font-size: 16px;
        font-weight: 800;
        color: #071129;
        margin-bottom: 8px;
    }

    .announcement-item p {
        font-size: 13px;
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 12px;
    }

    .announcement-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .announcement-date {
        font-size: 11px;
        color: #94a3b8;
        font-weight: 700;
    }

    .announcement-tag {
        background: #dbeafe;
        color: #2563eb;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 800;
    }

    /* NOTIFICATIONS */

    .notification-card {
        display: flex;
        gap: 14px;
        align-items: flex-start;
        background: #f8fafc;
        border: 1px solid #edf2f7;
        border-radius: 20px;
        padding: 16px;
        margin-bottom: 12px;
    }

    .notification-icon {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .notification-card h4 {
        font-size: 14px;
        font-weight: 800;
        color: #071129;
        margin-bottom: 4px;
    }

    .notification-card p {
        font-size: 12px;
        color: #64748b;
        line-height: 1.5;
        margin: 0;
    }

    /* WEATHER */

    .weather-card {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        border-radius: 24px;
        padding: 22px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .weather-card::before {
        content: '';
        position: absolute;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, .08);
        border-radius: 50%;
        top: -70px;
        right: -50px;
    }

    .weather-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .weather-location {
        font-size: 20px;
        font-weight: 900;
        margin-bottom: 5px;
    }

    .weather-condition {
        font-size: 13px;
        opacity: .9;
    }

    .weather-temp {
        font-size: 38px;
        font-weight: 900;
    }

    /* EMPTY */

    .empty-text {
        text-align: center;
        color: #94a3b8;
        font-size: 13px;
        padding: 16px;
    }

    /* MOBILE */

    @media(max-width:768px) {

        .resident-dashboard {
            padding: 14px;
            padding-bottom: 120px;
        }

        .resident-name {
            font-size: 36px;
        }

        .stats-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            overflow-x: auto;
        }

        .stat-card {
            min-width: 110px;
        }

        .quick-services {
            gap: 12px;
        }

        .service-card h2 {
            font-size: 16px;
        }

        .service-card p {
            font-size: 11px;
        }

        .weather-top {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

    }
</style>

<div class="resident-dashboard">

    <!-- HEADER -->

    <div class="dashboard-header">

        <div class="welcome-text">
            Welcome Back
        </div>

        <div class="resident-name">
            {{ auth('resident')->user()->name }}
        </div>

        <div class="barangay-badge">

            <i class="fa-solid fa-location-dot"></i>

            Barangay {{ auth('resident')->user()->barangay }}

        </div>

    </div>

    <!-- STATS -->

    <div class="stats-grid">

        <div class="stat-card">

            <div class="stat-icon blue-bg">

                <i class="fa-solid fa-file-lines"></i>

            </div>

            <div class="stat-number">
                3
            </div>

            <div class="stat-label">
                Document Requests
            </div>

        </div>

        <div class="stat-card">

            <div class="stat-icon yellow-bg">

                <i class="fa-solid fa-triangle-exclamation"></i>

            </div>

            <div class="stat-number">
                1
            </div>

            <div class="stat-label">
                Active Complaints
            </div>

        </div>

        <div class="stat-card">

            <div class="stat-icon green-bg">

                <i class="fa-solid fa-bell"></i>

            </div>

            <div class="stat-number">
                {{ $announcements->count() }}
            </div>

            <div class="stat-label">
                Announcements
            </div>

        </div>

    </div>

    <!-- QUICK SERVICES -->

    <div class="section-title">
        Quick Services
    </div>

    <div class="quick-services">

        <!-- DOCUMENTS -->

        <a href="/resident/documents"
            class="service-card">

            <div class="service-icon documents-icon">

                <i class="fa-solid fa-file-lines"></i>

            </div>

            <h2>
                Documents
            </h2>

            <p>
                Request barangay certificates and clearances.
            </p>

        </a>

        <!-- COMPLAINTS -->

        <a href="/resident/complaints"
            class="service-card">

            <div class="service-icon complaints-icon">

                <i class="fa-solid fa-triangle-exclamation"></i>

            </div>

            <h2>
                Complaints
            </h2>

            <p>
                Submit concerns and monitor complaint status.
            </p>

        </a>

    </div>

    <!-- ANNOUNCEMENTS -->

    <div class="dashboard-box">

        <div class="box-header">

            <div class="box-title">
                Recent Announcements
            </div>

            <a href="#"
                class="see-all">

                View All

            </a>

        </div>

        @forelse($announcements as $announcement)

        <div class="announcement-item">

            <h3>
                {{ $announcement->title }}
            </h3>

            <p>
                {{ $announcement->content }}
            </p>

            <div class="announcement-footer">

                <div class="announcement-date">

                    {{ $announcement->created_at->format('F d, Y') }}

                </div>

                <div class="announcement-tag">

                    Barangay Notice

                </div>

            </div>

        </div>

        @empty

        <div class="empty-text">

            No announcements available.

        </div>

        @endforelse

    </div>

    <!-- NOTIFICATIONS -->

    <div class="dashboard-box">

        <div class="box-header">

            <div class="box-title">
                Notifications
            </div>

        </div>

        <div class="notification-card">

            <div class="notification-icon blue-bg">

                <i class="fa-solid fa-file-lines"></i>

            </div>

            <div>

                <h4>
                    Document Request
                </h4>

                <p>
                    Your barangay clearance request is currently processing.
                </p>

            </div>

        </div>

        <div class="notification-card">

            <div class="notification-icon yellow-bg">

                <i class="fa-solid fa-triangle-exclamation"></i>

            </div>

            <div>

                <h4>
                    Complaint Update
                </h4>

                <p>
                    Your complaint is under review by the barangay office.
                </p>

            </div>

        </div>

        <div class="notification-card">

            <div class="notification-icon green-bg">

                <i class="fa-solid fa-bell"></i>

            </div>

            <div>

                <h4>
                    Community Notice
                </h4>

                <p>
                    Stay updated with recent barangay announcements.
                </p>

            </div>

        </div>

    </div>

    <!-- WEATHER -->

    <div class="dashboard-box">

        <div class="box-header">

            <div class="box-title">
                Weather Update
            </div>

        </div>

        <div class="weather-card">

            <div class="weather-top">

                <div>

                    <div
                        class="weather-location"
                        id="weather-location">

                        {{ auth('resident')->user()->barangay }} Weather

                    </div>

                    <div
                        class="weather-condition"
                        id="weather-condition">

                        Loading weather...

                    </div>

                </div>

                <div
                    class="weather-temp"
                    id="weather-temp">

                    --

                </div>

            </div>

        </div>

    </div>

</div>

<script>
    const apiKey = "efe59fae82cd2e9c03fe41f33ebf0b1e";

    async function loadWeather() {

        try {

            const response = await fetch(
                `https://api.openweathermap.org/data/2.5/weather?q=Batac,PH&units=metric&appid=${apiKey}`
            );

            const data = await response.json();

            if (data.cod != 200) {

                document.getElementById("weather-condition").innerHTML =
                    data.message;

                return;
            }

            document.getElementById("weather-temp").innerHTML =
                Math.round(data.main.temp) + "°C";

            document.getElementById("weather-condition").innerHTML =
                data.weather[0].description;

        } catch (error) {

            document.getElementById("weather-condition").innerHTML =
                "Unable to load weather";

        }

    }

    loadWeather();
</script>

@endsection