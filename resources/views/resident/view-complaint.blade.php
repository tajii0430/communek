@extends('layouts.resident')

@section('content')

<style>
    :root {
        --primary: #071129;
        --secondary: #102348;
        --accent: #2563eb;
        --bg: #f1f5f9;
        --card: #ffffff;
        --text: #0f172a;
        --muted: #64748b;
        --border: #e2e8f0;
    }

    body {
        background: var(--bg);
    }

    .details-page {
        padding-bottom: 120px;
    }

    /* HEADER */

    .top-header {
        position: relative;
        overflow: hidden;
        background:
            linear-gradient(135deg,
                #071129 0%,
                #102348 55%,
                #1b2940 100%);
        padding: 38px 26px 90px;
        border-radius: 0 0 38px 38px;
        color: white;
        margin: -20px -20px 0;
    }

    .top-header::before {
        content: '';
        position: absolute;
        width: 240px;
        height: 240px;
        background: rgba(255, 255, 255, .05);
        border-radius: 50%;
        top: -120px;
        right: -80px;
    }

    .welcome-text {
        font-size: 14px;
        font-weight: 500;
        opacity: .8;
        margin-bottom: 10px;
        position: relative;
        z-index: 2;
    }

    .resident-name {
        font-size: 42px;
        font-weight: 800;
        line-height: 1;
        position: relative;
        z-index: 2;
    }

    /* CARD */

    .content-wrapper {
        margin-top: -55px;
        position: relative;
        z-index: 10;
    }

    .details-card {
        background: white;
        border-radius: 30px;
        padding: 24px;
        border: 1px solid var(--border);
        box-shadow: 0 12px 30px rgba(15, 23, 42, .05);
    }

    .detail-group {
        margin-bottom: 24px;
    }

    .detail-group:last-child {
        margin-bottom: 0;
    }

    .section-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--muted);
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .detail-box {
        background: #f8fafc;
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 18px;
        font-size: 15px;
        line-height: 1.7;
        color: var(--text);
    }

    .detail-textarea {
        width: 100%;
        border: 1px solid var(--border);
        background: #f8fafc;
        border-radius: 20px;
        padding: 18px;
        font-size: 15px;
        line-height: 1.7;
        color: var(--text);
        resize: none;
        outline: none;
    }

    .detail-textarea[readonly] {
        background: #f8fafc;
    }

    /* STATUS */

    .status-wrapper {
        display: flex;
        align-items: center;
    }

    .status-badge {
        padding: 10px 18px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .pending {
        background: #fef3c7;
        color: #92400e;
    }

    .ongoing {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .resolved {
        background: #dcfce7;
        color: #166534;
    }

    /* IMAGE */

    .complaint-image {
        width: 100%;
        border-radius: 24px;
        margin-top: 6px;
        border: 1px solid var(--border);
        object-fit: cover;
    }

    /* MOBILE */

    @media(max-width:768px) {

        .top-header {
            padding: 34px 22px 85px;
        }

        .resident-name {
            font-size: 36px;
        }

        .details-card {
            padding: 20px;
            border-radius: 26px;
        }

    }
</style>

<div class="details-page">

    <!-- HEADER -->

    <div class="top-header">

        <div class="welcome-text">
            Resident Portal
        </div>

        <div class="resident-name">
            Complaint Details
        </div>

    </div>

    <!-- CONTENT -->

    <div class="content-wrapper">

        <div class="details-card">

            <!-- CATEGORY -->

            <div class="detail-group">

                <div class="section-title">
                    Categories
                </div>

                <div class="detail-box">

                    {{ implode(', ', json_decode($complaint->category)) }}

                </div>

            </div>

            <!-- DESCRIPTION -->

            <div class="detail-group">

                <div class="section-title">
                    Description
                </div>

                <textarea
                    class="detail-textarea"
                    rows="5"
                    readonly>{{ $complaint->description }}</textarea>

            </div>

            <!-- STATUS -->

            <div class="detail-group">

                <div class="section-title">
                    Status
                </div>

                <div class="status-wrapper">

                    <div class="status-badge {{ $complaint->status }}">

                        {{ strtoupper($complaint->status) }}

                    </div>

                </div>

            </div>

            <!-- NOTES -->

            <div class="detail-group">

                <div class="section-title">
                    Barangay Notes
                </div>

                <textarea
                    class="detail-textarea"
                    rows="5"
                    readonly>{{ $complaint->notes ?: 'No notes available yet.' }}</textarea>

            </div>

            <!-- IMAGE -->

            @if($complaint->image)

            <div class="detail-group">

                <div class="section-title">
                    Attached Image
                </div>

                <img
                    src="{{ asset($complaint->image) }}"
                    class="complaint-image">

            </div>

            @endif

        </div>

    </div>

</div>

@endsection