@extends('layouts.resident')

@section('content')

<style>
    .header {
        background: linear-gradient(135deg, #0f172a, #1e293b);
        padding: 30px 25px;
        border-radius: 0 0 35px 35px;
        color: white;
        margin: -20px -20px 25px;
    }

    .header p {
        opacity: .8;
        margin-bottom: 10px;
        font-size: 18px;
    }

    .header h1 {
        font-size: 42px;
        font-weight: 800;
        line-height: 1;
    }

    .back-btn {
        display: inline-block;
        margin-bottom: 20px;
        text-decoration: none;
        background: #0f172a;
        color: white;
        padding: 12px 22px;
        border-radius: 16px;
        font-size: 16px;
        font-weight: 700;
        transition: .3s;
    }

    .back-btn:hover {
        background: #1e293b;
        color: white;
    }

    .card {
        background: white;
        border-radius: 30px;
        padding: 24px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .05);
        margin-bottom: 25px;
    }

    .section-title {
        font-size: 20px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 12px;
    }

    .view-box {
        background: #edf1f5;
        border-radius: 22px;
        padding: 20px;
        font-size: 20px;
        margin-bottom: 25px;
        color: #0f172a;
    }

    .status-box {
        padding: 18px;
        border-radius: 20px;
        font-size: 20px;
        font-weight: 800;
        text-align: center;
        margin-bottom: 20px;
    }

    .status-box.pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-box.approved {
        background: #dcfce7;
        color: #166534;
    }

    .status-box.rejected {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-box.ready_for_pickup {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .notice-box {
        background: #ecfdf5;
        border: 2px solid #10b981;
        border-radius: 24px;
        padding: 24px;
        margin-top: 15px;
    }

    .notice-title {
        font-size: 26px;
        font-weight: 800;
        color: #047857;
        margin-bottom: 15px;
    }

    .notice-box p {
        font-size: 18px;
        color: #065f46;
        line-height: 1.6;
        margin-bottom: 10px;
    }
</style>

<div class="header">

    <p>
        Resident Portal
    </p>

    <h1>
        Request Details
    </h1>

</div>

<a href="/resident/documents"
    class="back-btn">

    ← Back

</a>

<div class="card">

    <div class="section-title">
        Document Type
    </div>

    <div class="view-box">

        {{ $requestItem->document_type }}

    </div>

    <div class="section-title">
        Purpose
    </div>

    <div class="view-box">

        {{ $requestItem->purpose }}

    </div>

    <div class="section-title">
        Status
    </div>

    <div class="status-box {{ $requestItem->status }}">

        {{ strtoupper($requestItem->status) }}

    </div>

    @if(
    $requestItem->status == 'approved' ||
    $requestItem->status == 'ready_for_pickup'
    )

    <div class="notice-box">

        <div class="notice-title">

            READY TO CLAIM

        </div>

        <p>

            Your requested document is now ready for pickup.

        </p>

        <p>

            Please prepare
            <strong>₱20 pesos</strong>
            upon claiming your document at the barangay hall.

        </p>

    </div>

    @endif

</div>

@endsection