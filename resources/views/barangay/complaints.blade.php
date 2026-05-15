@extends('layouts.barangay')

@php
use Illuminate\Support\Str;

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
'Drug Related',
'Curfew Violation',
'Fire Incident',
'Theft',
'Vandalism'

];
@endphp

@section('content')

<link rel="stylesheet"
    href="https://unpkg.com/leaflet/dist/leaflet.css" />

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<style>
    .complaints-container {
        padding: 35px;
    }

    .complaints-card {
        background: white;
        border-radius: 32px;
        padding: 35px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .04);
    }

    /* HEADER */

    .top-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 35px;
        flex-wrap: wrap;
        gap: 20px;
    }

    .top-header h1 {
        font-size: 52px;
        font-weight: 800;
        color: #071129;
        margin: 0;
        line-height: 1;
    }

    .top-header p {
        color: #64748b;
        font-size: 17px;
        margin-top: 10px;
    }

    .complaint-count {
        background: #eef2ff;
        color: #2563eb;
        padding: 14px 22px;
        border-radius: 16px;
        font-size: 15px;
        font-weight: 700;
    }

    /* FILTERS */

    .filter-wrapper {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: 35px;
    }

    .filter-input,
    .filter-select {
        height: 58px;
        border-radius: 18px;
        border: 1px solid #dbe4f0;
        background: #f8fafc;
        padding: 0 18px;
        font-size: 15px;
        color: #334155;
        min-width: 200px;
        outline: none;
        transition: .25s;
    }

    .filter-input:focus,
    .filter-select:focus {
        border-color: #2563eb;
        background: white;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, .08);
    }

    .filter-btn {
        height: 58px;
        padding: 0 30px;
        border: none;
        border-radius: 18px;
        background: #071129;
        color: white;
        font-size: 15px;
        font-weight: 700;
        transition: .25s;
        cursor: pointer;
    }

    .filter-btn:hover {
        background: #1B2940;
    }

    /* CATEGORY DROPDOWN */

    .category-wrapper {
        position: relative;
    }

    .category-btn {
        height: 58px;
        min-width: 260px;
        background: #071129;
        color: white;
        border: none;
        border-radius: 18px;
        padding: 0 20px;
        font-size: 15px;
        font-weight: 700;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
    }

    .category-dropdown {
        position: absolute;
        top: 105%;
        left: 0;
        width: 100%;
        background: white;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 15px 30px rgba(0, 0, 0, .08);
        padding: 15px;
        display: none;
        z-index: 999;
        max-height: 320px;
        overflow-y: auto;
    }

    .category-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px;
        border-radius: 12px;
        transition: .2s;
        cursor: pointer;
        font-size: 15px;
        color: #334155;
    }

    .category-item:hover {
        background: #f8fafc;
    }

    /* TABLE */

    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead tr {
        background: #f8fafc;
    }

    th {
        padding: 22px;
        font-size: 15px;
        font-weight: 700;
        color: #475569;
        text-align: left;
    }

    td {
        padding: 22px;
        border-bottom: 1px solid #e2e8f0;
        font-size: 15px;
        color: #334155;
        vertical-align: middle;
    }

    tbody tr {
        transition: .2s;
    }

    tbody tr:hover {
        background: #f8fafc;
    }

    .complaint-id {
        font-weight: 800;
        color: #071129;
    }

    .complainant-name {
        font-weight: 700;
        color: #071129;
        font-size: 16px;
    }

    .category-badge {
        background: #eef2ff;
        color: #2563eb;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        display: inline-block;
        margin: 3px;
    }

    .status-badge {
        padding: 9px 15px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        display: inline-block;
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

    .location-link {
        color: #2563eb;
        font-weight: 700;
        text-decoration: none;
    }

    .location-link:hover {
        text-decoration: underline;
    }

    .view-btn {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        background: #071129;
        color: white;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: .25s;
        font-size: 18px;
    }

    .view-btn:hover {
        background: #1B2940;
        color: white;
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 70px 20px;
        color: #94a3b8;
        font-size: 18px;
        font-weight: 600;
    }

    @media(max-width:768px) {

        .complaints-container {
            padding: 20px;
        }

        .complaints-card {
            padding: 25px;
        }

        .top-header h1 {
            font-size: 38px;
        }

    }
</style>

<div class="complaints-container">

    <div class="complaints-card">

        <!-- HEADER -->

        <div class="top-header">

            <div>

                <h1>
                    Complaints
                </h1>

                <p>
                    Monitor, filter, and manage submitted barangay complaints.
                </p>

            </div>

            <div class="complaint-count">

                Total Complaints:
                {{ $complaints->count() }}

            </div>

        </div>

        <!-- FILTERS -->

        <form method="GET"
            action="/barangay/complaints"
            class="filter-wrapper">

            <!-- CATEGORY -->

            <div class="category-wrapper">

                <button
                    type="button"
                    class="category-btn"
                    id="categoryDropdownBtn">

                    Select Categories

                    <span>▼</span>

                </button>

                <div
                    class="category-dropdown"
                    id="categoryDropdown">

                    @foreach($categories as $category)

                    <label class="category-item">

                        <input
                            type="checkbox"
                            name="categories[]"
                            value="{{ $category }}"

                            @if(
                            request()->has('categories') &&
                        in_array($category, request('categories'))
                        )
                        checked
                        @endif>

                        {{ $category }}

                    </label>

                    @endforeach

                </div>

            </div>

            <!-- STATUS -->

            <select
                name="status"
                class="filter-select">

                <option value="all">

                    All Status

                </option>

                <option
                    value="pending"
                    {{ request('status') == 'pending' ? 'selected' : '' }}>

                    Pending

                </option>

                <option
                    value="ongoing"
                    {{ request('status') == 'ongoing' ? 'selected' : '' }}>

                    Ongoing

                </option>

                <option
                    value="resolved"
                    {{ request('status') == 'resolved' ? 'selected' : '' }}>

                    Resolved

                </option>

            </select>

            <!-- DATE -->

            <input
                type="date"
                name="date"
                class="filter-input"
                value="{{ request('date') }}">

            <!-- BUTTON -->

            <button class="filter-btn">

                Filter Complaints

            </button>

        </form>

        <!-- TABLE -->

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Resident</th>
                        <th>Categories</th>
                        <th>Status</th>
                        <th>Location</th>
                        <th style="text-align:center;">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($complaints as $complaint)

                    <tr>

                        <!-- ID -->

                        <td>

                            <span class="complaint-id">

                                #{{ $complaint->id }}

                            </span>

                        </td>

                        <!-- NAME -->

                        <td>

                            <div class="complainant-name">

                                {{ $complaint->complainant_name }}

                            </div>

                        </td>

                        <!-- CATEGORY -->

                        <td>

                            @foreach(json_decode($complaint->category, true) as $cat)

                            <span class="category-badge">

                                {{ $cat }}

                            </span>

                            @endforeach

                        </td>

                        <!-- STATUS -->

                        <td>

                            <span class="status-badge 
                                {{ $complaint->status }}">

                                {{ ucfirst($complaint->status) }}

                            </span>

                        </td>

                        <!-- LOCATION -->

                        <td>

                            @if($complaint->latitude && $complaint->longitude)

                            <a
                                href="https://maps.google.com/?q={{ $complaint->latitude }},{{ $complaint->longitude }}"
                                target="_blank"
                                class="location-link">

                                View Location

                            </a>

                            @else

                            N/A

                            @endif

                        </td>

                        <!-- ACTION -->

                        <td style="text-align:center;">

                            <a
                                href="{{ url('/barangay/complaints/view/'.$complaint->id) }}"
                                class="view-btn">

                                <i class="fas fa-eye"></i>

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6">

                            <div class="empty-state">

                                No complaints found.

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<script>
    const dropdownBtn =
        document.getElementById('categoryDropdownBtn');

    const dropdown =
        document.getElementById('categoryDropdown');

    dropdownBtn.addEventListener('click', function() {

        dropdown.style.display =
            dropdown.style.display === 'block' ?
            'none' :
            'block';

    });

    document.addEventListener('click', function(e) {

        if (
            !dropdown.contains(e.target) &&
            !dropdownBtn.contains(e.target)
        ) {

            dropdown.style.display = 'none';

        }

    });
</script>
<script
    src="https://www.tuqlas.com/chatbot.js"
    data-key="tq_live_5bdc2089f46dca847eaec98f4a351f173ac93645"
    data-api="https://www.tuqlas.com"
    defer></script>
@endsection