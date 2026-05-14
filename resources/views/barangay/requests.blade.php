@extends('layouts.app')

@section('content')

<style>
    .requests-page {
        padding: 35px;
    }

    .requests-card {
        background: white;
        border-radius: 30px;
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

    .page-title {
        font-size: 50px;
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

    .request-count {
        background: #eef2ff;
        color: #2563eb;
        padding: 14px 22px;
        border-radius: 16px;
        font-size: 16px;
        font-weight: 700;
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
        text-align: left;
        font-size: 16px;
        font-weight: 700;
        color: #475569;
        border-bottom: 1px solid #e2e8f0;
    }

    td {
        padding: 24px 22px;
        border-bottom: 1px solid #e2e8f0;
        vertical-align: middle;
        font-size: 15px;
        color: #334155;
    }

    tbody tr {
        transition: .2s;
    }

    tbody tr:hover {
        background: #f8fafc;
    }

    /* RESIDENT */

    .resident-name {
        font-size: 17px;
        font-weight: 700;
        color: #071129;
    }

    .resident-id {
        margin-top: 5px;
        font-size: 14px;
        color: #64748b;
    }

    /* DOCUMENT */

    .document-badge {
        background: #eef2ff;
        color: #2563eb;
        padding: 10px 15px;
        border-radius: 999px;
        font-size: 14px;
        font-weight: 700;
        display: inline-block;
    }

    /* STATUS */

    .status-badge {
        padding: 9px 16px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        display: inline-block;
        text-transform: capitalize;
    }

    .approved {
        background: #dcfce7;
        color: #16a34a;
    }

    .pending {
        background: #fef3c7;
        color: #d97706;
    }

    .rejected {
        background: #fee2e2;
        color: #dc2626;
    }

    /* ACTIONS */

    .action-group {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .action-btn {
        border: none;
        padding: 10px 16px;
        border-radius: 12px;
        color: white;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        transition: .25s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .action-btn:hover {
        color: white;
        transform: translateY(-1px);
    }

    .approve-btn {
        background: #16a34a;
    }

    .approve-btn:hover {
        background: #15803d;
    }

    .reject-btn {
        background: #dc2626;
    }

    .reject-btn:hover {
        background: #b91c1c;
    }

    .pdf-btn {
        background: #2563eb;
    }

    .pdf-btn:hover {
        background: #1d4ed8;
    }

    /* EMPTY */

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: #94a3b8;
        font-size: 18px;
        font-weight: 600;
    }

    @media(max-width:768px) {

        .requests-page {
            padding: 20px;
        }

        .page-title {
            font-size: 38px;
        }

        .requests-card {
            padding: 24px;
        }

        td,
        th {
            padding: 18px 14px;
        }

    }
</style>

<div class="requests-page">

    <div class="requests-card">

        <!-- HEADER -->

        <div class="top-header">

            <div>

                <h1 class="page-title">

                    Document Requests

                </h1>

                <div class="page-subtitle">

                    Manage resident document requests and approvals.

                </div>

            </div>

            <div class="request-count">

                Total Requests:
                {{ $requests->count() }}

            </div>

        </div>

        <!-- TABLE -->

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th style="width:6%;">
                            ID
                        </th>

                        <th style="width:22%;">
                            Resident
                        </th>

                        <th style="width:22%;">
                            Document Type
                        </th>

                        <th style="width:25%;">
                            Purpose
                        </th>

                        <th style="width:10%;">
                            Status
                        </th>

                        <th style="width:15%;">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($requests as $request)

                    <tr>

                        <!-- ID -->

                        <td>

                            <span style="
                                font-weight:700;
                                color:#071129;
                            ">

                                #{{ $request->id }}

                            </span>

                        </td>

                        <!-- RESIDENT -->

                        <td>

                            <div class="resident-name">

                                {{ $request->resident_name }}

                            </div>

                            <div class="resident-id">

                                Resident Request

                            </div>

                        </td>

                        <!-- DOCUMENT -->

                        <td>

                            <span class="document-badge">

                                {{ $request->document_type }}

                            </span>

                        </td>

                        <!-- PURPOSE -->

                        <td>

                            <span style="
                                color:#475569;
                                line-height:1.7;
                                font-weight:500;
                            ">

                                {{ $request->purpose }}

                            </span>

                        </td>

                        <!-- STATUS -->

                        <td>

                            <span class="status-badge
                                @if($request->status == 'approved')
                                    approved
                                @elseif($request->status == 'rejected')
                                    rejected
                                @else
                                    pending
                                @endif
                            ">

                                {{ $request->status }}

                            </span>

                        </td>

                        <!-- ACTION -->

                        <td>

                            <div class="action-group">

                                <a
                                    href="/barangay/requests/approve/{{ $request->id }}"
                                    class="action-btn approve-btn">

                                    Approve

                                </a>

                                <a
                                    href="/barangay/requests/reject/{{ $request->id }}"
                                    class="action-btn reject-btn">

                                    Reject

                                </a>

                                <a
                                    href="/barangay/requests/pdf/{{ $request->id }}"
                                    class="action-btn pdf-btn">

                                    PDF

                                </a>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6">

                            <div class="empty-state">

                                No document requests found.

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