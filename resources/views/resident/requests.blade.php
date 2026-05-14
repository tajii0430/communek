@extends('layouts.resident')

@section('content')

<style>
    :root {
        --primary: #071129;
        --secondary: #102348;
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

    .requests-page {
        padding-bottom: 120px;
    }

    /* HEADER */

    .page-header {
        position: relative;
        overflow: hidden;
        background:
            linear-gradient(135deg,
                #071129 0%,
                #102348 55%,
                #1b2940 100%);
        padding: 38px 26px 90px;
        border-radius: 0 0 38px 38px;
        color: white;
        margin: -20px -20px 0;
    }

    .page-header::before {
        content: '';
        position: absolute;
        width: 240px;
        height: 240px;
        background: rgba(255, 255, 255, .05);
        border-radius: 50%;
        top: -120px;
        right: -80px;
    }

    .header-subtitle {
        font-size: 14px;
        font-weight: 500;
        opacity: .8;
        margin-bottom: 10px;
        position: relative;
        z-index: 2;
    }

    .header-title {
        font-size: 44px;
        font-weight: 800;
        line-height: 1;
        position: relative;
        z-index: 2;
    }

    /* CONTENT */

    .content-wrapper {
        margin-top: -55px;
        position: relative;
        z-index: 10;
    }

    .modern-card {
        background: white;
        border-radius: 30px;
        padding: 24px;
        margin-bottom: 22px;
        border: 1px solid var(--border);
        box-shadow: 0 12px 30px rgba(15, 23, 42, .05);
    }

    .section-title {
        font-size: 24px;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 22px;
    }

    /* FORM */

    .input-group-modern {
        margin-bottom: 18px;
    }

    .input-label {
        font-size: 14px;
        font-weight: 700;
        color: var(--muted);
        margin-bottom: 10px;
        display: block;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .modern-input,
    .modern-select,
    .modern-textarea {
        width: 100%;
        border: 1px solid var(--border);
        background: #f8fafc;
        border-radius: 18px;
        padding: 16px 18px;
        font-size: 15px;
        color: var(--text);
        outline: none;
        transition: .2s;
    }

    .modern-input:focus,
    .modern-select:focus,
    .modern-textarea:focus {
        border-color: #2563eb;
        background: white;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, .08);
    }

    .modern-textarea {
        min-height: 120px;
        resize: none;
    }

    .submit-btn {
        width: 100%;
        border: none;
        background:
            linear-gradient(135deg,
                #071129 0%,
                #102348 100%);
        color: white;
        border-radius: 18px;
        padding: 17px;
        font-size: 16px;
        font-weight: 700;
        transition: .2s;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
    }

    /* REQUEST LIST */

    .request-link {
        text-decoration: none;
    }

    .request-card {
        background: #f8fafc;
        border: 1px solid var(--border);
        border-radius: 24px;
        padding: 20px;
        margin-bottom: 16px;
        transition: .2s;
    }

    .request-card:hover {
        transform: translateY(-2px);
        border-color: #cbd5e1;
    }

    .request-card:last-child {
        margin-bottom: 0;
    }

    .request-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 12px;
    }

    .request-title {
        font-size: 17px;
        font-weight: 700;
        color: var(--text);
        line-height: 1.5;
    }

    .request-purpose {
        font-size: 14px;
        color: var(--muted);
        line-height: 1.7;
        margin-bottom: 14px;
    }

    .request-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .request-date {
        font-size: 12px;
        color: #94a3b8;
        font-weight: 600;
    }

    /* STATUS */

    .status-badge {
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .pending {
        background: #fef3c7;
        color: #92400e;
    }

    .approved {
        background: #dcfce7;
        color: #166534;
    }

    .rejected {
        background: #fee2e2;
        color: #991b1b;
    }

    /* EMPTY */

    .empty-state {
        text-align: center;
        color: var(--muted);
        font-size: 14px;
        padding: 20px;
    }

    /* MOBILE */

    @media(max-width:768px) {

        .page-header {
            padding: 34px 22px 85px;
        }

        .header-title {
            font-size: 38px;
        }

        .modern-card {
            padding: 20px;
            border-radius: 26px;
        }

        .section-title {
            font-size: 22px;
        }

        .request-top {
            flex-direction: column;
            gap: 10px;
        }

    }
</style>

<div class="requests-page">

    <!-- HEADER -->

    <div class="page-header">

        <div class="header-subtitle">
            Resident Portal
        </div>

        <div class="header-title">
            Document Requests
        </div>

    </div>

    <!-- CONTENT -->

    <div class="content-wrapper">

        <!-- REQUEST FORM -->

        <div class="modern-card">

            <div class="section-title">
                Request Document
            </div>

            <form
                method="POST"
                action="/resident/requests/store">

                @csrf

                <!-- NAME -->

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

                <!-- DOCUMENT -->

                <div class="input-group-modern">

                    <label class="input-label">
                        Document Type
                    </label>

                    <select
                        class="modern-select"
                        name="document_type"
                        required>

                        <option value="">
                            Choose document
                        </option>

                        <option>
                            Barangay Clearance
                        </option>

                        <option>
                            Certificate of Residency
                        </option>

                        <option>
                            Indigency Certificate
                        </option>

                        <option>
                            Business Clearance
                        </option>

                    </select>

                </div>

                <!-- PURPOSE -->

                <div class="input-group-modern">

                    <label class="input-label">
                        Purpose
                    </label>

                    <textarea
                        class="modern-textarea"
                        name="purpose"
                        placeholder="Enter purpose..."
                        required></textarea>

                </div>

                <button
                    type="submit"
                    class="submit-btn">

                    Submit Request

                </button>

            </form>

        </div>

        <!-- REQUEST HISTORY -->

        <div class="modern-card">

            <div class="section-title">
                My Requests
            </div>

            @forelse($requests as $request)

            <a
                href="/resident/requests/view/{{ $request->id }}"
                class="request-link">

                <div class="request-card">

                    <div class="request-top">

                        <div class="request-title">

                            {{ $request->document_type }}

                        </div>

                        <div class="status-badge {{ $request->status }}">

                            {{ $request->status }}

                        </div>

                    </div>

                    <div class="request-purpose">

                        {{ $request->purpose }}

                    </div>

                    <div class="request-footer">

                        <div class="request-date">

                            {{ $request->created_at->format('F d, Y') }}

                        </div>

                    </div>

                </div>

            </a>

            @empty

            <div class="empty-state">

                No document requests yet.

            </div>

            @endforelse

        </div>

    </div>

</div>

@endsection