@extends('layouts.superadmin')

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
        margin-bottom: 30px;
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
        margin-bottom: 10px;
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
        max-width: 650px;
        position: relative;
        z-index: 2;
    }

    /* STATS GRID */

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 24px;
    }

    .bento-card {
        background: white;
        border-radius: 30px;
        padding: 34px;
        position: relative;
        overflow: hidden;
        transition: .25s ease;
        border: 1px solid #edf2f7;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .05);
    }

    .bento-card:hover {
        transform: translateY(-6px);
    }

    .bento-card h5 {
        color: #64748b;
        font-size: 17px;
        margin-bottom: 16px;
        font-weight: 600;
    }

    .bento-card h1 {
        font-size: 60px;
        font-weight: 900;
        margin: 0;
        color: #071129;
        line-height: 1;
    }

    .icon-box {
        position: absolute;
        right: 28px;
        top: 28px;
        width: 68px;
        height: 68px;
        border-radius: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
    }

    .blue {
        background: #dbeafe;
        color: #2563eb;
    }

    .green {
        background: #dcfce7;
        color: #16a34a;
    }

    .purple {
        background: #ede9fe;
        color: #7c3aed;
    }

    .live-text {
        margin-top: 14px;
        font-size: 14px;
        color: #94a3b8;
        font-weight: 500;
    }

    @media(max-width:768px) {

        .dashboard-header {
            padding: 28px;
            border-radius: 28px;
        }

        .dashboard-title {
            font-size: 38px;
        }

        .bento-card h1 {
            font-size: 48px;
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
            Monitor barangays, workers, and residents
            across the entire system in real time.
        </div>

    </div>

    <!-- STATS -->

    <div class="stats-grid">

        <!-- TOTAL RESIDENTS -->

        <div class="bento-card">

            <div class="icon-box blue">
                👥
            </div>

            <h5>
                Total Residents
            </h5>

            <h1 id="totalResidents">
                {{ $totalResidents ?? 0 }}
            </h1>

            <div class="live-text">
                Live system data
            </div>

        </div>

        <!-- TOTAL BARANGAYS -->

        <div class="bento-card">

            <div class="icon-box green">
                🏘️
            </div>

            <h5>
                Total Barangays
            </h5>

            <h1 id="totalBarangays">
                {{ $totalBarangays ?? 0 }}
            </h1>

            <div class="live-text">
                Live system data
            </div>

        </div>

        <!-- TOTAL WORKERS -->

        <div class="bento-card">

            <div class="icon-box purple">
                🧑‍💼
            </div>

            <h5>
                Total Workers
            </h5>

            <h1 id="totalWorkers">
                {{ $totalWorkers ?? 0 }}
            </h1>

            <div class="live-text">
                Live system data
            </div>

        </div>

    </div>

</div>

<script>
    // AUTO REFRESH COUNTS EVERY 5 SECONDS

    setInterval(() => {

        fetch('/superadmin/dashboard/data')

            .then(response => response.json())

            .then(data => {

                document.getElementById('totalResidents')
                    .innerText = data.totalResidents;

                document.getElementById('totalBarangays')
                    .innerText = data.totalBarangays;

                document.getElementById('totalWorkers')
                    .innerText = data.totalWorkers;

            });

    }, 5000);
</script>

@endsection