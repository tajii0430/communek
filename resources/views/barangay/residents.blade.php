@extends('layouts.app')

@section('content')

<style>
    .page-container {
        padding: 35px;
    }

    .main-card {
        background: white;
        border-radius: 28px;
        padding: 35px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, .04);
        border: 1px solid #e2e8f0;
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
        font-size: 48px;
        font-weight: 800;
        color: #071129;
        margin: 0;
    }

    .top-header p {
        margin: 8px 0 0;
        color: #64748b;
        font-size: 17px;
    }

    .resident-count {
        background: #eef2ff;
        color: #2563eb;
        padding: 14px 22px;
        border-radius: 16px;
        font-size: 16px;
        font-weight: 700;
    }

    /* FILTERS */

    .filter-form {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
        margin-bottom: 35px;
    }

    .filter-input,
    .filter-select {
        height: 58px;
        border-radius: 16px;
        border: 1px solid #dbe4f0;
        background: #f8fafc;
        padding: 0 18px;
        font-size: 15px;
        color: #334155;
        outline: none;
        transition: .25s;
    }

    .filter-input {
        min-width: 220px;
    }

    .filter-select {
        min-width: 170px;
    }

    .filter-input:focus,
    .filter-select:focus {
        border-color: #2563eb;
        background: white;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, .08);
    }

    .filter-btn {
        height: 58px;
        border: none;
        padding: 0 28px;
        border-radius: 16px;
        background: #2563eb;
        color: white;
        font-weight: 700;
        transition: .25s;
        cursor: pointer;
    }

    .filter-btn:hover {
        background: #1d4ed8;
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
        font-size: 16px;
        font-weight: 700;
        color: #475569;
        text-align: left;
    }

    td {
        padding: 24px 22px;
        border-bottom: 1px solid #e2e8f0;
        font-size: 16px;
        color: #334155;
        vertical-align: middle;
    }

    tbody tr {
        transition: .2s;
    }

    tbody tr:hover {
        background: #f8fafc;
    }

    .resident-name {
        font-weight: 700;
        color: #0f172a;
        font-size: 17px;
    }

    .resident-info {
        color: #64748b;
        font-size: 15px;
        font-weight: 500;
    }

    .sitio-badge {
        background: #eef2ff;
        color: #1d4ed8;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 14px;
        font-weight: 700;
        display: inline-block;
    }

    .view-btn {
        background: #071129;
        color: white;
        padding: 11px 20px;
        border-radius: 12px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        transition: .25s;
        display: inline-block;
    }

    .view-btn:hover {
        background: #1B2940;
        color: white;
        transform: translateY(-1px);
    }

    /* EMPTY */

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #94a3b8;
        font-size: 18px;
    }
</style>

<div class="page-container">

    <div class="main-card">

        <!-- HEADER -->

        <div class="top-header">

            <div>

                <h1>
                    Residents
                </h1>

                <p>
                    Manage and monitor registered barangay residents.
                </p>

            </div>

            <div class="resident-count">

                Total Residents:
                {{ $residents->count() }}

            </div>

        </div>

        <!-- FILTERS -->

        <form method="GET" class="filter-form">

            <!-- SEARCH -->

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search resident..."
                class="filter-input">

            <!-- GENDER -->

            <select
                name="gender"
                class="filter-select">

                <option value="">
                    All Gender
                </option>

                <option
                    value="Male"
                    {{ request('gender') == 'Male' ? 'selected' : '' }}>

                    Male

                </option>

                <option
                    value="Female"
                    {{ request('gender') == 'Female' ? 'selected' : '' }}>

                    Female

                </option>

            </select>

            <!-- AGE -->

            <input
                type="number"
                name="age"
                value="{{ request('age') }}"
                placeholder="Age"
                class="filter-input"
                style="min-width:120px; width:120px;">

            <!-- SITIO -->

            <input
                type="text"
                name="sitio"
                value="{{ request('sitio') }}"
                placeholder="Filter Sitio"
                class="filter-input">

            <!-- BUTTON -->

            <button
                type="submit"
                class="filter-btn">

                Filter

            </button>

        </form>

        <!-- TABLE -->

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th style="
            width:35%;
        ">
                            Resident Information
                        </th>

                        <th style="
            width:20%;
        ">
                            Contact Number
                        </th>

                        <th style="
            width:20%;
        ">
                            Sitio
                        </th>

                        <th style="
            width:25%;
            text-align:center;
        ">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($residents as $resident)

                    <tr>

                        <!-- RESIDENT INFO -->

                        <td>

                            <div style="
                display:flex;
                flex-direction:column;
                gap:6px;
            ">

                                <!-- RESIDENT ID -->
                                <!-- RESIDENT ID -->

                                <span style="
    font-size:28px;
    font-weight:800;
    color:#071129;
    line-height:1;
">

                                    {{ $resident->resident_id_number ?? 'NO-ID' }}

                                </span>

                                <!-- FULL NAME -->

                                <span style="
                    font-size:18px;
                    color:#64748b;
                    font-weight:600;
                ">

                                    {{ $resident->full_name }}

                                </span>

                            </div>

                        </td>

                        <!-- CONTACT -->

                        <td>

                            <span style="
                font-size:18px;
                color:#475569;
                font-weight:600;
            ">

                                {{ $resident->contact_number ?? 'N/A' }}

                            </span>

                        </td>

                        <!-- SITIO -->

                        <td>

                            <span style="
                background:#eef2ff;
                color:#2563eb;
                padding:10px 18px;
                border-radius:999px;
                font-size:15px;
                font-weight:700;
                display:inline-block;
            ">

                                {{ $resident->address ?? 'N/A' }}

                            </span>

                        </td>

                        <!-- ACTION -->

                        <td style="
            text-align:center;
        ">
                            <a
                                href="/barangay/resident/{{ $resident->id }}"
                                style="
        background:#071129;
        color:white;
        width:56px;
        height:56px;
        border-radius:16px;
        text-decoration:none;
        font-size:18px;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        transition:.25s;
    "

                                onmouseover="
        this.style.background='#1B2940';
        this.style.transform='translateY(-2px)';
    "

                                onmouseout="
        this.style.background='#071129';
        this.style.transform='translateY(0)';
    ">

                                <i class='fas fa-eye'></i>

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="4">

                            <div style="
                text-align:center;
                padding:70px 20px;
                color:#94a3b8;
                font-size:20px;
                font-weight:600;
            ">

                                No residents found.

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<script
    src="https://www.tuqlas.com/chatbot.js"
    data-key="tq_live_5bdc2089f46dca847eaec98f4a351f173ac93645"
    data-api="https://www.tuqlas.com"
    defer></script>
@endsection