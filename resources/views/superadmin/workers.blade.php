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
        width: 240px;
        height: 240px;
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

    .form-control,
    .form-select {
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 14px 18px;
        font-size: 15px;
        background: #f8fafc;
        transition: .2s;
        box-shadow: none !important;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #2563eb;
        background: white;
    }

    .create-btn {
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

    .create-btn:hover {
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

    /* AVATAR */

    .worker-info {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .worker-avatar {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        background: #dbeafe;
        color: #2563eb;
        font-weight: 800;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .worker-name {
        font-weight: 700;
        margin-bottom: 2px;
    }

    .worker-username {
        font-size: 13px;
        color: #64748b;
    }

    /* BADGE */

    .barangay-badge {
        background: #dcfce7;
        color: #15803d;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        display: inline-block;
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
            Barangay Workers
        </h1>

        <p>
            Create and manage barangay worker accounts.
        </p>

    </div>

    <div class="row g-4">

        <!-- ADD WORKER -->

        <div class="col-lg-4">

            <div class="content-card">

                <div class="card-title">
                    Add Worker
                </div>

                <form
                    method="POST"
                    action="/superadmin/workers/store">

                    @csrf

                    <!-- FULL NAME -->

                    <div class="mb-3">

                        <label class="form-label">
                            Full Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="Enter full name"
                            required>

                    </div>

                    <!-- USERNAME -->

                    <div class="mb-3">

                        <label class="form-label">
                            Username
                        </label>

                        <input
                            type="text"
                            name="username"
                            class="form-control"
                            placeholder="Enter username"
                            required>

                    </div>

                    <!-- EMAIL -->

                    <div class="mb-3">

                        <label class="form-label">
                            Email Address
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Enter email"
                            required>

                    </div>

                    <!-- PASSWORD -->

                    <div class="mb-3">

                        <label class="form-label">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Enter password"
                            required>

                    </div>

                    <!-- BARANGAY -->

                    <div class="mb-4">

                        <label class="form-label">
                            Assigned Barangay
                        </label>

                        <select
                            name="barangay"
                            class="form-select"
                            required>

                            <option value="">
                                Select Barangay
                            </option>

                            @foreach($barangays as $barangay)

                            <option value="{{ $barangay->barangay_name }}">

                                {{ $barangay->barangay_name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- BUTTON -->

                    <button
                        type="submit"
                        class="create-btn">

                        Create Worker

                    </button>

                </form>

            </div>

        </div>

        <!-- WORKERS TABLE -->

        <div class="col-lg-8">

            <div class="content-card">

                <div class="card-title">
                    Barangay Workers
                </div>

                <div class="table-wrapper">

                    <table class="custom-table">

                        <thead>

                            <tr>

                                <th>ID</th>

                                <th>Worker</th>

                                <th>Email</th>

                                <th>Barangay</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($workers as $worker)

                            <tr>

                                <td>
                                    #{{ $worker->id }}
                                </td>

                                <td>

                                    <div class="worker-info">

                                        <div class="worker-avatar">

                                            {{ strtoupper(substr($worker->name, 0, 1)) }}

                                        </div>

                                        <div>

                                            <div class="worker-name">

                                                {{ $worker->name }}

                                            </div>

                                            <div class="worker-username">

                                                {{ '@'.$worker->username }}

                                            </div>

                                        </div>

                                    </div>

                                </td>

                                <td>
                                    {{ $worker->email }}
                                </td>

                                <td>

                                    <span class="barangay-badge">

                                        {{ $worker->barangay }}

                                    </span>

                                </td>

                                <td>

                                    <a
                                        href="/superadmin/workers/delete/{{ $worker->id }}"
                                        class="delete-btn">

                                        Delete

                                    </a>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="5">

                                    <div class="empty-state">

                                        No workers found.

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