@extends('layouts.superadmin')

@section('content')

<style>
    body {
        background: #f4f7fb;
        font-family: 'Inter', sans-serif;
    }

    .page-wrapper {
        padding: 10px;
    }

    /* HEADER */

    .page-header {
        background: linear-gradient(135deg,
                #071129 0%,
                #102348 55%,
                #1b2940 100%);
        border-radius: 32px;
        padding: 34px;
        color: white;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 18px 40px rgba(7, 17, 41, .15);
    }

    .page-header::before {
        content: '';
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .05);
        top: -120px;
        right: -70px;
    }

    .page-header h1 {
        font-size: 38px;
        font-weight: 800;
        margin-bottom: 8px;
        position: relative;
        z-index: 2;
    }

    .page-header p {
        opacity: .8;
        margin: 0;
        font-size: 15px;
        position: relative;
        z-index: 2;
    }

    /* CARD */

    .content-card {
        background: white;
        border-radius: 30px;
        padding: 30px;
        border: 1px solid #edf2f7;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .05);
        height: 100%;
    }

    .card-title {
        font-size: 24px;
        font-weight: 800;
        color: #071129;
        margin-bottom: 25px;
    }

    /* FORM */

    .form-label {
        font-size: 14px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 8px;
    }

    .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 14px 18px;
        font-size: 15px;
        background: #f8fafc;
        transition: .2s;
        box-shadow: none !important;
    }

    .form-control:focus {
        border-color: #2563eb;
        background: white;
    }

    .save-btn {
        width: 100%;
        border: none;
        border-radius: 18px;
        padding: 15px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: white;
        font-size: 15px;
        font-weight: 700;
        transition: .25s;
    }

    .save-btn:hover {
        transform: translateY(-2px);
    }

    /* TABLE */

    .table-wrapper {
        overflow-x: auto;
    }

    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 14px;
    }

    .custom-table thead th {
        background: transparent;
        border: none;
        color: #64748b;
        font-size: 13px;
        font-weight: 700;
        padding: 0 18px 10px;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .custom-table tbody tr {
        background: #f8fafc;
        transition: .2s;
    }

    .custom-table tbody tr:hover {
        transform: scale(1.01);
        background: #f1f5f9;
    }

    .custom-table tbody td {
        padding: 18px;
        border: none;
        font-size: 15px;
        color: #0f172a;
        vertical-align: middle;
    }

    .custom-table tbody tr td:first-child {
        border-top-left-radius: 18px;
        border-bottom-left-radius: 18px;
    }

    .custom-table tbody tr td:last-child {
        border-top-right-radius: 18px;
        border-bottom-right-radius: 18px;
    }

    /* BADGE */

    .barangay-badge {
        background: #dbeafe;
        color: #2563eb;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
    }

    /* DELETE BUTTON */

    .delete-btn {
        border: none;
        background: #fee2e2;
        color: #dc2626;
        padding: 10px 16px;
        border-radius: 14px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: .2s;
        display: inline-block;
    }

    .delete-btn:hover {
        background: #fecaca;
    }

    /* EMPTY */

    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: #94a3b8;
        font-size: 15px;
        font-weight: 500;
    }

    /* MOBILE */

    @media(max-width:768px) {

        .page-header {
            padding: 28px;
            border-radius: 26px;
        }

        .page-header h1 {
            font-size: 30px;
        }

        .content-card {
            padding: 24px;
            margin-bottom: 20px;
        }

    }
</style>

<div class="page-wrapper">

    <!-- HEADER -->

    <div class="page-header">

        <h1>
            Barangay Management
        </h1>

        <p>
            Add and manage barangays across the system.
        </p>

    </div>

    <div class="row g-4">

        <!-- ADD BARANGAY -->

        <div class="col-lg-4">

            <div class="content-card">

                <div class="card-title">
                    Add Barangay
                </div>

                <form
                    method="POST"
                    action="/superadmin/barangays/store">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">
                            Barangay Name
                        </label>

                        <input
                            type="text"
                            name="barangay_name"
                            class="form-control"
                            placeholder="Enter barangay name"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            City
                        </label>

                        <input
                            type="text"
                            name="city"
                            class="form-control"
                            placeholder="Enter city"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Province
                        </label>

                        <input
                            type="text"
                            name="province"
                            class="form-control"
                            placeholder="Enter province"
                            required>

                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            Region
                        </label>

                        <input
                            type="text"
                            name="region"
                            class="form-control"
                            placeholder="Enter region"
                            required>

                    </div>

                    <button
                        type="submit"
                        class="save-btn">

                        Save Barangay

                    </button>

                </form>

            </div>

        </div>

        <!-- BARANGAY LIST -->

        <div class="col-lg-8">

            <div class="content-card">

                <div class="card-title">
                    Barangay List
                </div>

                <div class="table-wrapper">

                    <table class="custom-table">

                        <thead>

                            <tr>

                                <th>ID</th>

                                <th>Barangay</th>

                                <th>City</th>

                                <th>Province</th>

                                <th>Region</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($barangays as $barangay)

                            <tr>

                                <td>
                                    #{{ $barangay->id }}
                                </td>

                                <td>

                                    <span class="barangay-badge">

                                        {{ $barangay->barangay_name }}

                                    </span>

                                </td>

                                <td>
                                    {{ $barangay->city }}
                                </td>

                                <td>
                                    {{ $barangay->province }}
                                </td>

                                <td>
                                    {{ $barangay->region }}
                                </td>

                                <td>

                                    <a
                                        href="/superadmin/barangays/delete/{{ $barangay->id }}"
                                        class="delete-btn">

                                        Delete

                                    </a>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="6">

                                    <div class="empty-state">

                                        No barangays found.

                                    </div>

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection