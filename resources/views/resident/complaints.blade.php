@extends('layouts.resident')

@section('content')

<link rel="stylesheet"
    href="https://unpkg.com/leaflet/dist/leaflet.css" />

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<style>
    :root {
        --primary: #0f172a;
        --secondary: #1e293b;
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

    .page-header {
        background:
            linear-gradient(135deg,
                #071129 0%,
                #102348 55%,
                #1b2940 100%);
        padding: 38px 26px 90px;
        border-radius: 0 0 38px 38px;
        color: white;
        margin: -20px -20px 0;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        width: 240px;
        height: 240px;
        background: rgba(255, 255, 255, .05);
        border-radius: 50%;
        top: -100px;
        right: -70px;
    }

    .header-subtitle {
        font-size: 14px;
        font-weight: 500;
        opacity: .8;
        margin-bottom: 8px;
    }

    .header-title {
        font-size: 48px;
        font-weight: 800;
        line-height: 1;
        margin: 0;
    }

    .content-wrapper {
        margin-top: -55px;
        padding-bottom: 120px;
    }

    .modern-card {
        background: white;
        border-radius: 28px;
        padding: 24px;
        margin-bottom: 22px;
        border: 1px solid var(--border);
        box-shadow: 0 10px 30px rgba(15, 23, 42, .05);
    }

    .section-title {
        font-size: 24px;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 22px;
    }

    .input-group-modern {
        margin-bottom: 18px;
    }

    .input-label {
        font-size: 14px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 10px;
        display: block;
    }

    .modern-input,
    .modern-textarea {
        width: 100%;
        border: 1px solid var(--border);
        background: #f8fafc;
        border-radius: 18px;
        padding: 16px 18px;
        font-size: 15px;
        outline: none;
        transition: .2s;
        color: var(--text);
    }

    .modern-input:focus,
    .modern-textarea:focus {
        border-color: #2563eb;
        background: white;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, .08);
    }

    .modern-textarea {
        min-height: 130px;
        resize: none;
    }

    .dropdown-trigger {
        width: 100%;
        background: #f8fafc;
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 16px 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        transition: .2s;
    }

    .dropdown-trigger:hover {
        border-color: #cbd5e1;
    }

    .dropdown-text {
        color: var(--text);
        font-size: 15px;
        font-weight: 600;
    }

    .dropdown-arrow {
        font-size: 14px;
        color: var(--muted);
    }

    .dropdown-menu-modern {
        display: none;
        margin-top: 12px;
        background: white;
        border-radius: 20px;
        border: 1px solid var(--border);
        padding: 16px;
    }

    .dropdown-menu-modern.show {
        display: block;
    }

    .search-input {
        width: 100%;
        border: 1px solid var(--border);
        background: #f8fafc;
        border-radius: 14px;
        padding: 14px;
        font-size: 14px;
        margin-bottom: 15px;
        outline: none;
    }

    .category-list {
        max-height: 220px;
        overflow-y: auto;
    }

    .category-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 4px;
        font-size: 14px;
        color: var(--text);
    }

    .category-item input {
        width: 18px;
        height: 18px;
        accent-color: #2563eb;
    }

    .upload-box {
        border: 2px dashed #cbd5e1;
        border-radius: 20px;
        padding: 22px;
        text-align: center;
        background: #f8fafc;
        transition: .2s;
    }

    .upload-box:hover {
        border-color: #2563eb;
        background: #f8fbff;
    }

    .upload-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 22px;
        background: var(--primary);
        color: white;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        margin-bottom: 12px;
    }

    .file-name {
        font-size: 13px;
        color: var(--muted);
    }

    .map-wrapper {
        overflow: hidden;
        border-radius: 22px;
        border: 1px solid var(--border);
        margin-top: 10px;
    }

    #map {
        height: 280px;
        width: 100%;
    }

    .submit-btn {
        width: 100%;
        border: none;
        background: linear-gradient(135deg, #071129, #1e293b);
        color: white;
        border-radius: 18px;
        padding: 17px;
        font-size: 16px;
        font-weight: 700;
        margin-top: 12px;
        transition: .2s;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
    }

    .complaint-link {
        text-decoration: none;
    }

    .complaint-card {
        background: #f8fafc;
        border: 1px solid var(--border);
        border-radius: 22px;
        padding: 18px;
        margin-bottom: 16px;
        transition: .2s;
    }

    .complaint-card:hover {
        transform: translateY(-2px);
        border-color: #cbd5e1;
    }

    .complaint-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 12px;
    }

    .complaint-title {
        font-size: 16px;
        font-weight: 700;
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
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
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
        padding: 20px;
    }

    @media(max-width:768px) {

        .page-header {
            padding: 34px 22px 85px;
        }

        .header-title {
            font-size: 42px;
        }

        .modern-card {
            padding: 20px;
        }

        .section-title {
            font-size: 22px;
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

                        Choose File

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

                    {{ $complaint->description }}

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