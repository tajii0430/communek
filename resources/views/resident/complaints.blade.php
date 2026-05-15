@extends('layouts.resident')

@section('content')

<link rel="stylesheet"
    href="https://unpkg.com/leaflet/dist/leaflet.css" />

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<style>
    :root {
        --primary: #071129;
        --secondary: #102348;
        --accent: #2563eb;
        --accent-light: #eff6ff;
        --bg: #f1f5f9;
        --card: #ffffff;
        --text: #0f172a;
        --muted: #64748b;
        --border: #e2e8f0;
        --shadow:
            0 10px 35px rgba(15, 23, 42, 0.06);
    }

    body {
        background:
            linear-gradient(to bottom,
                #eef2ff,
                #f8fafc);
    }

    .page-header {
        background:
            linear-gradient(135deg,
                #020817 0%,
                #071129 45%,
                #1e3a8a 100%);
        padding: 42px 26px 110px;
        border-radius: 0 0 42px 42px;
        color: white;
        margin: -20px -20px 0;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        width: 320px;
        height: 320px;
        background:
            rgba(255, 255, 255, .05);
        border-radius: 50%;
        top: -120px;
        right: -120px;
    }

    .page-header::after {
        content: '';
        position: absolute;
        width: 180px;
        height: 180px;
        background:
            rgba(255, 255, 255, .04);
        border-radius: 50%;
        bottom: -60px;
        left: -60px;
    }

    .header-subtitle {
        font-size: 14px;
        font-weight: 600;
        opacity: .75;
        margin-bottom: 10px;
        letter-spacing: .5px;
    }

    .header-title {
        font-size: 48px;
        font-weight: 900;
        line-height: 1;
        margin: 0;
    }

    .content-wrapper {
        margin-top: -70px;
        position: relative;
        z-index: 10;
        padding-bottom: 120px;
    }

    .modern-card {
        background: var(--card);
        border-radius: 32px;
        padding: 26px;
        margin-bottom: 24px;
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
    }

    .section-title {
        font-size: 26px;
        font-weight: 900;
        color: var(--text);
        margin-bottom: 24px;
    }

    .input-group-modern {
        margin-bottom: 22px;
    }

    .input-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 10px;
    }

    .modern-input,
    .modern-textarea {
        width: 100%;
        border: 1px solid var(--border);
        background: #f8fafc;
        border-radius: 20px;
        padding: 16px 18px;
        font-size: 15px;
        outline: none;
        transition: .25s;
        color: var(--text);
    }

    .modern-input:focus,
    .modern-textarea:focus {
        border-color: var(--accent);
        background: white;
        box-shadow:
            0 0 0 5px rgba(37, 99, 235, .08);
    }

    .modern-textarea {
        min-height: 140px;
        resize: none;
    }

    .dropdown-trigger {
        width: 100%;
        background: #f8fafc;
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 17px 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        transition: .2s;
    }

    .dropdown-trigger:hover {
        border-color: var(--accent);
        background: white;
    }

    .dropdown-text {
        color: var(--text);
        font-size: 15px;
        font-weight: 700;
    }

    .dropdown-arrow {
        color: var(--muted);
        font-size: 14px;
    }

    .dropdown-menu-modern {
        display: none;
        margin-top: 14px;
        background: white;
        border-radius: 24px;
        border: 1px solid var(--border);
        padding: 18px;
        box-shadow: var(--shadow);
    }

    .dropdown-menu-modern.show {
        display: block;
    }

    .search-input {
        width: 100%;
        border: 1px solid var(--border);
        background: #f8fafc;
        border-radius: 16px;
        padding: 14px;
        font-size: 14px;
        margin-bottom: 16px;
        outline: none;
    }

    .category-list {
        max-height: 240px;
        overflow-y: auto;
        padding-right: 4px;
    }

    .category-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 4px;
        font-size: 14px;
        font-weight: 600;
        color: var(--text);
    }

    .category-item input {
        width: 18px;
        height: 18px;
        accent-color: var(--accent);
    }

    .upload-box {
        border: 2px dashed #cbd5e1;
        border-radius: 24px;
        padding: 26px;
        text-align: center;
        background: linear-gradient(to bottom,
                #f8fafc,
                #f1f5f9);
        transition: .25s;
    }

    .upload-box:hover {
        border-color: var(--accent);
        background: #f8fbff;
    }

    .upload-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background:
            linear-gradient(135deg,
                #071129,
                #1e3a8a);
        color: white;
        padding: 14px 24px;
        border-radius: 16px;
        font-size: 14px;
        font-weight: 800;
        cursor: pointer;
        margin-bottom: 14px;
        transition: .2s;
    }

    .upload-btn:hover {
        transform: translateY(-2px);
    }

    .file-name {
        font-size: 13px;
        color: var(--muted);
        font-weight: 600;
    }

    .map-wrapper {
        overflow: hidden;
        border-radius: 24px;
        border: 1px solid var(--border);
        margin-top: 10px;
    }

    #map {
        height: 320px;
        width: 100%;
    }

    .submit-btn {
        width: 100%;
        border: none;
        background:
            linear-gradient(135deg,
                #020817,
                #1d4ed8);
        color: white;
        border-radius: 20px;
        padding: 18px;
        font-size: 16px;
        font-weight: 800;
        transition: .25s;
        box-shadow:
            0 10px 25px rgba(37, 99, 235, .25);
    }

    .submit-btn:hover {
        transform: translateY(-3px);
    }

    .complaint-link {
        text-decoration: none;
    }

    .complaint-card {
        background:
            linear-gradient(to bottom,
                #ffffff,
                #f8fafc);
        border: 1px solid var(--border);
        border-radius: 26px;
        padding: 20px;
        margin-bottom: 18px;
        transition: .25s;
    }

    .complaint-card:hover {
        transform: translateY(-3px);
        box-shadow:
            0 12px 30px rgba(15, 23, 42, .06);
    }

    .complaint-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 12px;
    }

    .complaint-title {
        font-size: 16px;
        font-weight: 800;
        color: var(--text);
        line-height: 1.5;
    }

    .complaint-description {
        font-size: 14px;
        color: var(--muted);
        line-height: 1.7;
        margin-bottom: 16px;
    }

    .status-badge {
        padding: 9px 15px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
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

    .empty-state {
        text-align: center;
        color: var(--muted);
        font-size: 14px;
        padding: 25px;
        font-weight: 600;
    }

    @media(max-width:768px) {

        .page-header {
            padding: 34px 22px 90px;
        }

        .header-title {
            font-size: 42px;
        }

        .modern-card {
            padding: 22px;
            border-radius: 28px;
        }

        .section-title {
            font-size: 22px;
        }

        #map {
            height: 260px;
        }

    }
</style>

<div class="page-header">

    <div class="header-subtitle">
        Resident Portal
    </div>

    <h1 class="header-title">
        Complaints
    </h1>

</div>

<div class="content-wrapper">

    <!-- FILE COMPLAINT -->

    <div class="modern-card">

        <div class="section-title">
            File Complaint
        </div>

        <form
            method="POST"
            action="/resident/complaints/store"
            enctype="multipart/form-data">

            @csrf

            <div class="input-group-modern">

                <label class="input-label">
                    Resident Name
                </label>

                <input
                    type="text"
                    class="modern-input"
                    value="{{ Auth::guard('resident')->user()->name }}"
                    readonly>

            </div>

            <input
                type="hidden"
                name="barangay"
                value="{{ Auth::guard('resident')->user()->barangay }}">

            <!-- CATEGORY -->

            <div class="input-group-modern">

                <label class="input-label">
                    Complaint Categories
                </label>

                <div
                    class="dropdown-trigger"
                    id="dropdownButton">

                    <div
                        class="dropdown-text"
                        id="selectedCategories">

                        Select Categories

                    </div>

                    <div class="dropdown-arrow">
                        ▼
                    </div>

                </div>

                <div
                    class="dropdown-menu-modern"
                    id="dropdownMenu">

                    <input
                        type="text"
                        id="categorySearch"
                        class="search-input"
                        placeholder="Search categories...">

                    <div class="category-list">

                        @php

                        $categories = [

                        'Noise Complaint',
                        'Road Issue',
                        'Sanitation',
                        'Flooding',
                        'Illegal Parking',
                        'Street Light Issue',
                        'Garbage Collection',
                        'Water Problem',
                        'Electricity Problem',
                        'Public Disturbance',
                        'Drainage Issue',
                        'Animal Complaint',
                        'Construction Issue',
                        'Health Concern',
                        'Domestic Issue',
                        'Fire Hazard',
                        'Vandalism',
                        'Traffic Concern'

                        ];

                        @endphp

                        @foreach($categories as $category)

                        <label class="category-item">

                            <input
                                type="checkbox"
                                name="category[]"
                                value="{{ $category }}"
                                class="category-checkbox">

                            {{ $category }}

                        </label>

                        @endforeach

                    </div>

                </div>

            </div>

            <!-- DESCRIPTION -->

            <div class="input-group-modern">

                <label class="input-label">
                    Description
                </label>

                <textarea
                    class="modern-textarea"
                    name="description"
                    placeholder="Describe your complaint..."
                    required></textarea>

            </div>

            <!-- IMAGE -->

            <div class="input-group-modern">

                <label class="input-label">
                    Attach Image
                </label>

                <div class="upload-box">

                    <label
                        for="complaintImage"
                        class="upload-btn">

                        Upload Evidence

                    </label>

                    <div
                        class="file-name"
                        id="file-name">

                        No file selected

                    </div>

                    <input
                        type="file"
                        id="complaintImage"
                        name="image"
                        hidden
                        onchange="updateFileName(this)">

                </div>

            </div>

            <!-- MAP -->

            <div class="input-group-modern">

                <label class="input-label">
                    Pin Complaint Location
                </label>

                <div class="map-wrapper">

                    <div id="map"></div>

                </div>

            </div>

            <input
                type="hidden"
                name="latitude"
                id="latitude">

            <input
                type="hidden"
                name="longitude"
                id="longitude">

            <button
                type="submit"
                class="submit-btn">

                Submit Complaint

            </button>

        </form>

    </div>

    <!-- MY COMPLAINTS -->

    <div class="modern-card">

        <div class="section-title">
            My Complaints
        </div>

        @forelse($complaints as $complaint)

        <a
            href="/resident/complaints/view/{{ $complaint->id }}"
            class="complaint-link">

            <div class="complaint-card">

                <div class="complaint-top">

                    <div class="complaint-title">

                        {{ implode(', ', json_decode($complaint->category)) }}

                    </div>

                    <div class="status-badge {{ $complaint->status }}">

                        {{ $complaint->status }}

                    </div>

                </div>

                <div class="complaint-description">

                    {{ Str::limit($complaint->description, 140) }}

                </div>

            </div>

        </a>

        @empty

        <div class="empty-state">

            No complaints submitted yet.

        </div>

        @endforelse

    </div>

</div>

<script>
    function updateFileName(input) {

        const fileName =
            input.files.length > 0 ?
            input.files[0].name :
            'No file selected';

        document.getElementById('file-name')
            .innerText = fileName;
    }

    const dropdownButton =
        document.getElementById('dropdownButton');

    const dropdownMenu =
        document.getElementById('dropdownMenu');

    dropdownButton.addEventListener('click', () => {

        dropdownMenu.classList.toggle('show');

    });

    const categorySearch =
        document.getElementById('categorySearch');

    const categoryItems =
        document.querySelectorAll('.category-item');

    categorySearch.addEventListener('keyup', () => {

        let value =
            categorySearch.value.toLowerCase();

        categoryItems.forEach(item => {

            item.style.display =
                item.innerText.toLowerCase()
                .includes(value) ?
                'flex' :
                'none';

        });

    });

    const checkboxes =
        document.querySelectorAll('.category-checkbox');

    const selectedCategories =
        document.getElementById('selectedCategories');

    checkboxes.forEach(box => {

        box.addEventListener('change', () => {

            let selected = [];

            checkboxes.forEach(check => {

                if (check.checked) {

                    selected.push(check.value);

                }

            });

            selectedCategories.innerText =
                selected.length > 0 ?
                selected.join(', ') :
                'Select Categories';

        });

    });

    const map = L.map('map')
        .setView([18.0618, 120.5223], 13);

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }
    ).addTo(map);

    let marker;

    map.on('click', function(e) {

        if (marker) {

            map.removeLayer(marker);

        }

        marker = L.marker(e.latlng)
            .addTo(map);

        document.getElementById('latitude').value =
            e.latlng.lat;

        document.getElementById('longitude').value =
            e.latlng.lng;

    });
</script>

@endsection