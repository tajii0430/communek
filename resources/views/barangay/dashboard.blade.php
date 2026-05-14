@extends('layouts.app')

@section('content')

<style>
    .dashboard-card {
        background: #ffffff;
        border-radius: 22px;
        padding: 28px;
        border: 1px solid #dbe4f0;
        transition: .3s;
        height: 100%;
    }

    .dashboard-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, .04);
    }

    .dashboard-card h5 {
        color: #64748b;
        font-size: 17px;
        margin-bottom: 12px;
        font-weight: 600;
    }

    .dashboard-card h2 {
        font-size: 48px;
        font-weight: 800;
        color: #1B2940;
        margin: 0;
    }

    /* QUICK BUTTONS */

    .quick-btn {
        border: none;
        border-radius: 18px;
        padding: 16px;
        font-size: 16px;
        font-weight: 700;
        text-decoration: none;
        transition: .25s;
        text-align: center;
        display: block;
    }

    .quick-btn:hover {
        transform: translateY(-2px);
    }

    .btn-verification {
        background: #071129;
        color: white;
    }

    .btn-verification:hover {
        background: #1B2940;
        color: white;
    }

    .btn-complaints {
        background: #2563eb;
        color: white;
    }

    .btn-complaints:hover {
        background: #1d4ed8;
        color: white;
    }

    .btn-requests {
        background: #0f766e;
        color: white;
    }

    .btn-requests:hover {
        background: #115e59;
        color: white;
    }

    /* ANNOUNCEMENT HERO */

    .announcement-hero {
        background: linear-gradient(135deg, #071129, #1B2940);
        border-radius: 28px;
        padding: 40px;
        color: white;
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .announcement-hero h2 {
        font-size: 34px;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 18px;
        color: white;
    }

    .announcement-hero p {
        font-size: 16px;
        line-height: 1.7;
        opacity: .88;
        max-width: 95%;
    }

    .announcement-hero .btn {
        margin-top: 25px;
        border-radius: 50px;
        padding: 14px 32px;
        font-weight: 700;
        font-size: 17px;
    }

    .announcement-icon {
        position: absolute;
        right: 30px;
        bottom: 20px;
        font-size: 80px;
        opacity: .08;
    }

    /* REAL ANNOUNCEMENTS */

    .announcement-list {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .announcement-item {
        border-radius: 22px;
        padding: 22px;
        color: white;
        position: relative;
        overflow: hidden;
        min-height: 155px;
    }

    .announcement-item:nth-child(1) {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
    }

    .announcement-item:nth-child(2) {
        background: linear-gradient(135deg, #0f766e, #115e59);
    }

    .announcement-item:nth-child(3) {
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
    }

    .announcement-item h4 {
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 14px;
    }

    .announcement-item p {
        font-size: 16px;
        opacity: .9;
        margin-bottom: 20px;
    }

    .announcement-item small {
        opacity: .75;
        font-size: 14px;
    }

    .announcement-item i {
        position: absolute;
        right: 22px;
        bottom: 20px;
        font-size: 45px;
        opacity: .15;
    }

    /* WEATHER */

    .weather-card {
        background: #1B2940 !important;
        border: none !important;
        color: white;
        border-radius: 28px;
        padding: 24px 30px;
    }

    .weather-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .weather-title {
        font-size: 32px;
        font-weight: 800;
        color: white;
        margin-bottom: 5px;
    }

    .weather-sub {
        color: rgba(255, 255, 255, .7);
        margin: 0;
    }

    .weather-icon {
        font-size: 55px;
        color: white;
    }

    .weather-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 25px;
        flex-wrap: wrap;
    }

    .weather-left h1 {
        font-size: 75px;
        font-weight: 800;
        color: white;
        margin: 0;
    }

    .weather-left h2 {
        color: white;
        font-size: 28px;
        margin-top: 5px;
    }

    .weather-left p {
        color: rgba(255, 255, 255, .75);
        margin-top: 8px;
        text-transform: capitalize;
    }

    .weather-stats {
        display: flex;
        gap: 40px;
    }

    .weather-stat h5 {
        color: rgba(255, 255, 255, .7);
        margin-bottom: 8px;
        font-size: 15px;
    }

    .weather-stat h3 {
        color: white;
        font-size: 32px;
        font-weight: 700;
    }

    /* SCROLLABLE ANNOUNCEMENTS */

    .announcement-scroll {
        height: 470px;
        overflow-y: auto;
        padding-right: 8px;

        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    /* CUSTOM SCROLLBAR */

    .announcement-scroll::-webkit-scrollbar {
        width: 8px;
    }

    .announcement-scroll::-webkit-scrollbar-track {
        background: transparent;
    }

    .announcement-scroll::-webkit-scrollbar-thumb {
        background: rgba(27, 41, 64, .25);
        border-radius: 20px;
    }

    .announcement-scroll::-webkit-scrollbar-thumb:hover {
        background: rgba(27, 41, 64, .45);
    }
</style>

<!-- STATS -->

<div class="row g-4">

    <div class="col-md-3">
        <div class="dashboard-card">
            <h5>Total Residents</h5>
            <h2>{{ $totalResidents ?? 0 }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card">
            <h5>Pending Verification</h5>
            <h2>{{ $pendingResidents ?? 0 }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card">
            <h5>Complaints</h5>
            <h2>{{ $totalComplaints ?? 0 }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card">
            <h5>Requests</h5>
            <h2>{{ $totalRequests ?? 0 }}</h2>
        </div>
    </div>

</div>

<!-- QUICK ACTIONS + ANNOUNCEMENTS -->

<div class="row mt-4 g-4">

    <!-- QUICK ACTIONS -->

    <div class="col-md-4">

        <div class="dashboard-card">

            <h3 class="fw-bold mb-4">

                Quick Actions

            </h3>

            <div class="d-grid gap-3">

                <a href="/barangay/resident-verification"
                    class="quick-btn btn-verification">

                    Resident Verification

                </a>

                <a href="/barangay/complaints"
                    class="quick-btn btn-complaints">

                    Manage Complaints

                </a>

                <a href="/barangay/requests"
                    class="quick-btn btn-requests">

                    Document Requests

                </a>

            </div>

        </div>

    </div>

    <!-- ANNOUNCEMENT HERO -->

    <div class="col-md-4">

        <div class="announcement-hero">

            <h2>

                Barangay Announcement

            </h2>

            <p>

                Click here to post barangay announcements,
                emergency alerts, community activities,
                and important notices for residents.
            </p>

            <a href="/barangay/announcements"
                class="btn btn-light">

                Post Announcements

            </a>

            <i class="fas fa-bullhorn announcement-icon"></i>

        </div>

    </div>

    <!-- REAL ANNOUNCEMENTS -->

    <!-- REAL ANNOUNCEMENTS -->

    <div class="col-md-4">

        <div class="announcement-scroll">

            @forelse($announcements->take(10) as $announcement)

            <div class="announcement-item">

                <h4>

                    {{ $announcement->title }}

                </h4>

                <p>

                    {{ Str::limit($announcement->content, 70) }}

                </p>

                <small>

                    Posted
                    {{ $announcement->created_at->diffForHumans() }}

                </small>

                <i class="fas fa-bell"></i>

            </div>

            @empty

            <div class="announcement-item">

                <h4>

                    No Announcements

                </h4>

                <p>

                    No barangay announcements available yet.

                </p>

            </div>

            @endforelse

        </div>

    </div>

</div>

<!-- WEATHER -->

<div class="row mt-4">

    <div class="col-12">

        <div class="dashboard-card weather-card">

            <div class="weather-top">

                <div>

                    <h3 class="weather-title">

                        Barangay {{ Auth::user()->barangay }}

                    </h3>

                    <p class="weather-sub">

                        Real-time weather forecast

                    </p>

                </div>

                <i class="fas fa-cloud-sun weather-icon"></i>

            </div>

            <div class="weather-content">

                <div class="weather-left">

                    <h1 id="temperature">

                        --°C

                    </h1>

                    <h2 id="weatherMain">

                        Loading...

                    </h2>

                    <p id="weatherDesc">

                        Please wait

                    </p>

                </div>

                <div class="weather-stats">

                    <div class="weather-stat">

                        <h5>

                            Humidity

                        </h5>

                        <h3 id="humidity">

                            --

                        </h3>

                    </div>

                    <div class="weather-stat">

                        <h5>

                            Wind

                        </h5>

                        <h3 id="wind">

                            --

                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Add before </body> in your Blade layout --}}
    <script
        src="https://www.tuqlas.com/chatbot.js"
        data-key="tq_live_5bdc2089f46dca847eaec98f4a351f173ac93645"
        data-api="https://www.tuqlas.com"
        defer></script>
</div>

<!-- WEATHER API -->

<script>
    async function loadWeather() {

        const apiKey = "efe59fae82cd2e9c03fe41f33ebf0b1e";

        const city = "Batac";

        const url =
            `https://api.openweathermap.org/data/2.5/weather?q=${city},PH&units=metric&appid=${apiKey}`;

        try {

            const response = await fetch(url);

            const data = await response.json();

            document.getElementById("temperature").innerHTML =
                Math.round(data.main.temp) + "°C";

            document.getElementById("weatherMain").innerHTML =
                data.weather[0].main;

            document.getElementById("weatherDesc").innerHTML =
                data.weather[0].description;

            document.getElementById("humidity").innerHTML =
                data.main.humidity + "%";

            document.getElementById("wind").innerHTML =
                data.wind.speed + " km/h";

        } catch (error) {

            console.log(error);

            document.getElementById("weatherMain").innerHTML =
                "Weather unavailable";

        }

    }

    loadWeather();
</script>



@endsection