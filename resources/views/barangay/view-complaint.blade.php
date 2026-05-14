@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet">

<style>
    .complaint-page {
        padding: 35px;
    }

    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
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

    .back-btn {
        background: #071129;
        color: white;
        padding: 14px 22px;
        border-radius: 16px;
        text-decoration: none;
        font-weight: 700;
        font-size: 15px;
        transition: .25s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .back-btn:hover {
        background: #1B2940;
        color: white;
        transform: translateY(-1px);
    }

    /* CARD */

    .custom-card {
        background: white;
        border-radius: 30px;
        padding: 30px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .04);
        height: 100%;
    }

    .card-title {
        font-size: 34px;
        font-weight: 800;
        color: #071129;
        margin-bottom: 30px;
    }

    /* INFO SECTION */

    .info-group {
        margin-bottom: 28px;
    }

    .info-label {
        font-size: 15px;
        font-weight: 700;
        color: #64748b;
        margin-bottom: 10px;
    }

    .info-value {
        font-size: 19px;
        font-weight: 700;
        color: #071129;
        line-height: 1.6;
    }

    /* CATEGORY */

    .category-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .category-badge {
        background: #eef2ff;
        color: #2563eb;
        padding: 10px 16px;
        border-radius: 999px;
        font-size: 14px;
        font-weight: 700;
    }

    /* STATUS */

    .status-badge {
        display: inline-block;
        padding: 10px 18px;
        border-radius: 999px;
        font-size: 14px;
        font-weight: 700;
    }

    .pending {
        background: #fef3c7;
        color: #d97706;
    }

    .ongoing {
        background: #dbeafe;
        color: #2563eb;
    }

    .resolved {
        background: #dcfce7;
        color: #16a34a;
    }

    /* NOTES */

    .notes-box {
        width: 100%;
        border-radius: 20px;
        border: 1px solid #dbe4f0;
        background: #f8fafc;
        padding: 18px;
        font-size: 15px;
        outline: none;
        resize: none;
        transition: .25s;
    }

    .notes-box:focus {
        background: white;
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, .08);
    }

    /* BUTTONS */

    .primary-btn {
        border: none;
        background: #071129;
        color: white;
        padding: 14px 22px;
        border-radius: 16px;
        font-weight: 700;
        font-size: 15px;
        transition: .25s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .primary-btn:hover {
        background: #1B2940;
        color: white;
        transform: translateY(-1px);
    }

    .ongoing-btn {
        background: #2563eb;
    }

    .ongoing-btn:hover {
        background: #1d4ed8;
    }

    .resolved-btn {
        background: #16a34a;
    }

    .resolved-btn:hover {
        background: #15803d;
    }

    /* IMAGE */

    .image-preview {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 24px;
        border: 1px solid #e2e8f0;
    }

    .no-image {
        width: 100%;
        height: 250px;
        border-radius: 24px;
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 18px;
        font-weight: 600;
    }

    /* MAP */

    .map-frame {
        width: 100%;
        height: 350px;
        border: none;
        border-radius: 24px;
        overflow: hidden;
    }

    @media(max-width:768px) {

        .complaint-page {
            padding: 20px;
        }

        .page-title {
            font-size: 38px;
        }

        .custom-card {
            padding: 24px;
        }

    }
</style>

<div class="complaint-page">

    <!-- TOP -->

    <div class="top-bar">

        <h1 class="page-title">

            Complaint Details

        </h1>

        <a
            href="/barangay/complaints"
            class="back-btn">

            ← Back

        </a>

    </div>

    <div class="row g-4">

        <!-- LEFT SIDE -->

        <div class="col-lg-6">

            <div class="custom-card">

                <h2 class="card-title">

                    Complaint Information

                </h2>

                <!-- COMPLAINANT -->

                <div class="info-group">

                    <div class="info-label">

                        Complainant

                    </div>

                    <div class="info-value">

                        {{ $complaint->complainant_name }}

                    </div>

                </div>

                <!-- CATEGORY -->

                <div class="info-group">

                    <div class="info-label">

                        Categories

                    </div>

                    <div class="category-wrapper">

                        @php

                        $cats = json_decode(
                        $complaint->category,
                        true
                        );

                        if (!$cats) {

                        $cats = [
                        $complaint->category
                        ];
                        }

                        @endphp

                        @foreach($cats as $cat)

                        <span class="category-badge">

                            {{ $cat }}

                        </span>

                        @endforeach

                    </div>

                </div>

                <!-- DESCRIPTION -->

                <div class="info-group">

                    <div class="info-label">

                        Description

                    </div>

                    <div class="info-value"
                        style="
                            font-size:17px;
                            font-weight:600;
                            color:#475569;
                        ">

                        {{ $complaint->description }}

                    </div>

                </div>

                <!-- STATUS -->

                <div class="info-group">

                    <div class="info-label">

                        Complaint Status

                    </div>

                    <div>

                        @if($complaint->status == 'pending')

                        <span class="status-badge pending">

                            Pending

                        </span>

                        @elseif($complaint->status == 'ongoing')

                        <span class="status-badge ongoing">

                            Ongoing

                        </span>

                        @elseif($complaint->status == 'resolved')

                        <span class="status-badge resolved">

                            Resolved

                        </span>

                        @else

                        <span class="status-badge">

                            {{ ucfirst($complaint->status) }}

                        </span>

                        @endif

                    </div>

                </div>

                <!-- NOTES -->

                <form
                    method="POST"
                    action="/barangay/complaints/note/{{ $complaint->id }}"
                    class="mt-4">

                    @csrf

                    <div class="info-label mb-3">

                        Progress Notes

                    </div>

                    <textarea
                        name="notes"
                        rows="5"
                        class="notes-box"
                        placeholder="Add progress notes...">{{ $complaint->notes }}</textarea>

                    <button class="primary-btn mt-3">

                        Save Notes

                    </button>

                </form>

                <!-- ACTIONS -->

                <div class="mt-5">

                    <div class="info-label mb-3">

                        Complaint Actions

                    </div>

                    <div class="d-flex flex-wrap gap-3">

                        @if($complaint->status != 'ongoing')

                        <a
                            href="/barangay/complaints/ongoing/{{ $complaint->id }}"
                            class="primary-btn ongoing-btn">

                            Mark Ongoing

                        </a>

                        @endif

                        @if($complaint->status != 'resolved')

                        <a
                            href="/barangay/complaints/resolve/{{ $complaint->id }}"
                            class="primary-btn resolved-btn">

                            Mark Resolved

                        </a>

                        @endif

                    </div>

                </div>

            </div>

        </div>

        <!-- RIGHT SIDE -->

        <div class="col-lg-6">

            <div class="custom-card">

                <h2 class="card-title">

                    Evidence & Location

                </h2>

                <!-- IMAGE -->

                <div class="info-group">

                    <div class="info-label">

                        Attached Image

                    </div>

                    @if($complaint->image)

                    <img
                        src="{{ asset($complaint->image) }}"
                        class="image-preview mb-3">

                    <button
                        class="primary-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#imageModal">

                        View Full Image

                    </button>

                    @else

                    <div class="no-image">

                        No image uploaded

                    </div>

                    @endif

                </div>

                <!-- MAP -->

                <div class="info-group mt-5">

                    <div class="info-label mb-3">

                        Complaint Location

                    </div>

                    @if($complaint->latitude && $complaint->longitude)

                    <iframe
                        class="map-frame"
                        loading="lazy"
                        allowfullscreen
                        src="https://maps.google.com/maps?q={{ $complaint->latitude }},{{ $complaint->longitude }}&z=15&output=embed">

                    </iframe>

                    @else

                    <div class="no-image"
                        style="
                            height:350px;
                        ">

                        No location pinned

                    </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

<!-- IMAGE MODAL -->

@if($complaint->image)

<div class="modal fade"
    id="imageModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content border-0 rounded-5">

            <div class="modal-header border-0 px-4 pt-4">

                <h5 class="fw-bold">

                    Complaint Image

                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">

                </button>

            </div>

            <div class="modal-body text-center p-4 pt-0">

                <img
                    src="{{ asset($complaint->image) }}"
                    alt="Complaint Image"
                    class="img-fluid rounded-4 shadow-sm">

            </div>

        </div>

    </div>

</div>

@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script
    src="https://www.tuqlas.com/chatbot.js"
    data-key="tq_live_5bdc2089f46dca847eaec98f4a351f173ac93645"
    data-api="https://www.tuqlas.com"
    defer></script>

@endsection