@extends('layouts.app')

@section('content')

<style>
    .verification-wrapper {
        padding: 10px;
    }

    .verification-title {
        font-size: 52px;
        font-weight: 800;
        color: #071129;
        margin-bottom: 30px;
        letter-spacing: -1px;
    }

    .verification-card {
        background: white;
        border-radius: 28px;
        padding: 30px;
        border: 1px solid #dbe4f0;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .04);
        margin-bottom: 28px;
    }

    .section-title {
        font-size: 28px;
        font-weight: 800;
        color: #071129;
        margin-bottom: 24px;
    }

    .verification-table {
        width: 100%;
        border-collapse: collapse;
    }

    .verification-table thead tr {
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }

    .verification-table th {
        padding: 22px 24px;
        font-size: 15px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .verification-table td {
        padding: 24px;
        border-bottom: 1px solid #eef2f7;
        vertical-align: middle;
    }

    .resident-info {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .resident-avatar {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        background: linear-gradient(135deg, #071129, #1B2940);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
        font-weight: 700;
    }

    .resident-name {
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .resident-sub {
        font-size: 14px;
        color: #94a3b8;
    }

    .barangay-badge {
        background: #eff6ff;
        color: #2563eb;
        padding: 10px 18px;
        border-radius: 999px;
        font-size: 14px;
        font-weight: 700;
        display: inline-block;
    }

    .status-badge {
        padding: 10px 18px;
        border-radius: 999px;
        font-size: 14px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-approved {
        background: #dcfce7;
        color: #166534;
    }

    .status-rejected {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }

    .dot-pending {
        background: #f59e0b;
    }

    .dot-approved {
        background: #22c55e;
    }

    .dot-rejected {
        background: #ef4444;
    }

    .action-group {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .approve-btn,
    .reject-btn {
        border: none;
        text-decoration: none;
        padding: 12px 18px;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 700;
        transition: .25s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 105px;
    }

    .approve-btn {
        background: #22c55e;
        color: white;
    }

    .approve-btn:hover {
        background: #16a34a;
        color: white;
    }

    .reject-btn {
        background: #ef4444;
        color: white;
    }

    .reject-btn:hover {
        background: #dc2626;
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
    }

    .empty-state i {
        font-size: 60px;
        color: #cbd5e1;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: #334155;
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #94a3b8;
        margin: 0;
        font-size: 16px;
    }

    @media(max-width: 991px) {

        .verification-title {
            font-size: 38px;
        }

        .verification-card {
            overflow-x: auto;
        }

        .verification-table {
            min-width: 750px;
        }
    }
</style>

<div class="verification-wrapper">

    <!-- PAGE TITLE -->

    <h1 class="verification-title">
        Resident Verification
    </h1>

    <!-- PENDING RESIDENTS -->

    <div class="verification-card">

        <h2 class="section-title">
            Pending Residents
        </h2>

        <table class="verification-table">

            <thead>

                <tr>

                    <th align="left">
                        Name
                    </th>

                    <th align="left">
                        Barangay
                    </th>

                    <th align="left">
                        Status
                    </th>

                    <th align="center">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($residents as $resident)

                <tr>

                    <!-- NAME -->

                    <td>

                        <div class="resident-info">

                            <div class="resident-avatar">

                                {{ strtoupper(substr($resident->name,0,1)) }}

                            </div>

                            <div>

                                <div class="resident-name">

                                    {{ $resident->name }}

                                </div>

                                <div class="resident-sub">

                                    Pending Resident Account

                                </div>

                            </div>

                        </div>

                    </td>

                    <!-- BARANGAY -->

                    <td>

                        <span class="barangay-badge">

                            {{ $resident->barangay }}

                        </span>

                    </td>

                    <!-- STATUS -->

                    <td>

                        <span class="status-badge status-pending">

                            <span class="status-dot dot-pending"></span>

                            Pending

                        </span>

                    </td>

                    <!-- ACTION -->

                    <td align="center">

                        <div class="action-group justify-content-center">

                            <a href="{{ url('/barangay/resident/approve/'.$resident->id) }}"
                                class="approve-btn">

                                Approve

                            </a>

                            <a href="{{ url('/barangay/resident/reject/'.$resident->id) }}"
                                class="reject-btn">

                                Reject

                            </a>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4">

                        <div class="empty-state">

                            <i class="fas fa-user-check"></i>

                            <h3>
                                No Pending Residents
                            </h3>

                            <p>
                                All resident accounts are already verified.
                            </p>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- APPROVED + REJECTED -->

    <div class="row">

        <!-- APPROVED -->

        <div class="col-md-6">

            <div class="verification-card">

                <h2 class="section-title">
                    Approved Residents
                </h2>

                <table class="verification-table">

                    <thead>

                        <tr>

                            <th>Name</th>
                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($approvedResidents as $resident)

                        <tr>

                            <td>

                                <div class="resident-info">

                                    <div class="resident-avatar">

                                        {{ strtoupper(substr($resident->name,0,1)) }}

                                    </div>

                                    <div>

                                        <div class="resident-name">

                                            {{ $resident->name }}

                                        </div>

                                        <div class="resident-sub">

                                            {{ $resident->barangay }}

                                        </div>

                                    </div>

                                </div>

                            </td>

                            <td>

                                <span class="status-badge status-approved">

                                    <span class="status-dot dot-approved"></span>

                                    Approved

                                </span>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="2"
                                style="padding:30px;text-align:center;color:#94a3b8;">

                                No approved residents yet.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <!-- REJECTED -->

        <div class="col-md-6">

            <div class="verification-card">

                <h2 class="section-title">
                    Rejected Residents
                </h2>

                <table class="verification-table">

                    <thead>

                        <tr>

                            <th>Name</th>
                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($rejectedResidents as $resident)

                        <tr>

                            <td>

                                <div class="resident-info">

                                    <div class="resident-avatar">

                                        {{ strtoupper(substr($resident->name,0,1)) }}

                                    </div>

                                    <div>

                                        <div class="resident-name">

                                            {{ $resident->name }}

                                        </div>

                                        <div class="resident-sub">

                                            {{ $resident->barangay }}

                                        </div>

                                    </div>

                                </div>

                            </td>

                            <td>

                                <span class="status-badge status-rejected">

                                    <span class="status-dot dot-rejected"></span>

                                    Rejected

                                </span>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="2"
                                style="padding:30px;text-align:center;color:#94a3b8;">

                                No rejected residents yet.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

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