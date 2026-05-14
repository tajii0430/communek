@extends('layouts.app')

@section('content')

<style>
    .details-container {
        padding: 35px;
    }

    .details-card {
        background: white;
        border-radius: 32px;
        padding: 40px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .04);
    }

    /* HEADER */

    .top-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 35px;
        flex-wrap: wrap;
        gap: 20px;
    }

    .page-title {
        font-size: 52px;
        font-weight: 800;
        color: #071129;
        margin: 0;
        line-height: 1;
    }

    .page-subtitle {
        color: #64748b;
        font-size: 17px;
        margin-top: 10px;
    }

    .resident-badge {
        background: #eef2ff;
        color: #2563eb;
        padding: 14px 22px;
        border-radius: 16px;
        font-size: 15px;
        font-weight: 700;
    }

    /* MAIN LAYOUT */

    .resident-wrapper {
        display: flex;
        gap: 35px;
        align-items: stretch;
        flex-wrap: wrap;
    }

    /* PROFILE */

    .profile-section {
        width: 320px;
    }

    .profile-card {
        background: linear-gradient(135deg, #071129, #1B2940);
        border-radius: 28px;
        padding: 28px;
        height: 100%;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .profile-image {
        width: 100%;
        height: 320px;
        object-fit: cover;
        border-radius: 24px;
        border: 4px solid rgba(255, 255, 255, .15);
    }

    .no-image {
        width: 100%;
        height: 320px;
        border-radius: 24px;
        background: rgba(255, 255, 255, .08);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 100px;
        font-weight: 800;
        color: white;
        border: 4px solid rgba(255, 255, 255, .12);
    }

    .resident-name {
        margin-top: 22px;
        font-size: 28px;
        font-weight: 800;
        line-height: 1.2;
    }

    .resident-id {
        margin-top: 10px;
        font-size: 15px;
        opacity: .8;
        letter-spacing: .5px;
    }

    /* INFO SECTION */

    .info-section {
        flex: 1;
        min-width: 300px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px;
    }

    .info-box {
        background: #f8fafc;
        border-radius: 22px;
        padding: 24px;
        border: 1px solid #e2e8f0;
        transition: .25s;
    }

    .info-box:hover {
        background: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, .04);
    }

    .label {
        color: #64748b;
        font-size: 15px;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .value {
        color: #071129;
        font-size: 24px;
        font-weight: 800;
        line-height: 1.3;
        word-break: break-word;
    }

    .value.small {
        font-size: 19px;
    }

    /* BACK BUTTON */

    .bottom-actions {
        margin-top: 35px;
        display: flex;
        justify-content: flex-end;
    }

    .back-btn {
        background: #071129;
        color: white;
        border: none;
        text-decoration: none;
        padding: 15px 24px;
        border-radius: 18px;
        font-size: 15px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: .25s;
    }

    .back-btn:hover {
        background: #1B2940;
        color: white;
        transform: translateY(-2px);
    }

    /* RESPONSIVE */

    @media(max-width:1100px) {

        .resident-wrapper {
            flex-direction: column;
        }

        .profile-section {
            width: 100%;
        }

        .profile-image,
        .no-image {
            height: 350px;
        }

    }

    @media(max-width:768px) {

        .details-container {
            padding: 20px;
        }

        .details-card {
            padding: 25px;
        }

        .page-title {
            font-size: 40px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .value {
            font-size: 20px;
        }

    }
</style>

<div class="details-container">

    <div class="details-card">

        <!-- HEADER -->

        <div class="top-section">

            <div>

                <h1 class="page-title">
                    Resident Details
                </h1>

                <div class="page-subtitle">
                    View complete resident information and profile details.
                </div>

            </div>

            <div class="resident-badge">

                {{ $resident->barangay }}

            </div>

        </div>

        <!-- CONTENT -->

        <div class="resident-wrapper">

            <!-- PROFILE -->

            <div class="profile-section">

                <div class="profile-card">

                    @if($resident->profile_photo)

                    <img
                        src="{{ asset('storage/' . $resident->profile_photo) }}"
                        class="profile-image">

                    @else

                    <div class="no-image">

                        {{ strtoupper(substr($resident->full_name,0,1)) }}

                    </div>

                    @endif

                    <div class="resident-name">

                        {{ $resident->full_name }}

                    </div>

                    <div class="resident-id">

                        Resident ID:
                        {{ $resident->resident_id_number ?? 'NO-ID' }}

                    </div>

                </div>

            </div>

            <!-- INFORMATION -->

            <div class="info-section">

                <div class="info-grid">

                    <div class="info-box">

                        <div class="label">
                            Contact Number
                        </div>

                        <div class="value small">

                            {{ $resident->contact_number ?? 'N/A' }}

                        </div>

                    </div>

                    <div class="info-box">

                        <div class="label">
                            Gender
                        </div>

                        <div class="value">

                            {{ $resident->gender ?? 'N/A' }}

                        </div>

                    </div>

                    <div class="info-box">

                        <div class="label">
                            Age
                        </div>

                        <div class="value">

                            {{ $resident->age ?? 'N/A' }}

                        </div>

                    </div>

                    <div class="info-box">

                        <div class="label">
                            Civil Status
                        </div>

                        <div class="value">

                            {{ $resident->civil_status ?? 'N/A' }}

                        </div>

                    </div>

                    <div class="info-box">

                        <div class="label">
                            Address / Sitio
                        </div>

                        <div class="value small">

                            {{ $resident->address ?? 'N/A' }}

                        </div>

                    </div>

                    <div class="info-box">

                        <div class="label">
                            Barangay
                        </div>

                        <div class="value">

                            {{ $resident->barangay ?? 'N/A' }}

                        </div>

                    </div>

                </div>

                <!-- BUTTON -->

                <div class="bottom-actions">

                    <a
                        href="/barangay/residents"
                        class="back-btn">

                        <i class="fas fa-arrow-left"></i>

                        Back to Residents

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>
<script
    src="https://www.tuqlas.com/chatbot.js"
    data-key="tq_live_5bdc2089f46dca847eaec98f4a351f173ac93645"
    data-api="https://www.tuqlas.com"
    defer></script>

@endsection