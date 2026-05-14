@extends('layouts.app')

@section('content')

<style>
    .announcement-page {
        padding: 35px;
    }

    .announcement-card {
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
        margin-top: 10px;
        color: #64748b;
        font-size: 17px;
    }

    .announcement-count {
        background: #eef2ff;
        color: #2563eb;
        padding: 14px 22px;
        border-radius: 16px;
        font-size: 16px;
        font-weight: 700;
    }

    /* FORM */

    .form-wrapper {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        padding: 28px;
        margin-bottom: 35px;
    }

    .form-title {
        font-size: 24px;
        font-weight: 800;
        color: #071129;
        margin-bottom: 22px;
    }

    .custom-input,
    .custom-textarea {
        width: 100%;
        border: 1px solid #dbe4f0;
        background: white;
        border-radius: 18px;
        padding: 18px 20px;
        font-size: 16px;
        color: #334155;
        outline: none;
        transition: .25s;
    }

    .custom-input:focus,
    .custom-textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, .08);
    }

    .custom-textarea {
        resize: none;
        min-height: 180px;
    }

    .post-btn {
        margin-top: 18px;
        background: #071129;
        color: white;
        border: none;
        padding: 14px 24px;
        border-radius: 16px;
        font-size: 15px;
        font-weight: 700;
        transition: .25s;
    }

    .post-btn:hover {
        background: #1B2940;
        transform: translateY(-1px);
    }

    /* ANNOUNCEMENTS */

    .announcement-list {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .announcement-item {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        padding: 28px;
        transition: .25s;
    }

    .announcement-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, .05);
    }

    .announcement-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 15px;
    }

    .announcement-title {
        font-size: 28px;
        font-weight: 800;
        color: #071129;
        margin: 0;
        line-height: 1.2;
    }

    .announcement-badge {
        background: #eef2ff;
        color: #2563eb;
        padding: 10px 16px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }

    .announcement-content {
        font-size: 16px;
        line-height: 1.8;
        color: #475569;
        margin-bottom: 20px;
    }

    .announcement-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    .posted-time {
        color: #94a3b8;
        font-size: 14px;
        font-weight: 600;
    }

    .announcement-actions {
        display: flex;
        gap: 10px;
    }

    .announcement-actions form {
        margin: 0;
    }

    .action-btn {
        border: none;
        border-radius: 12px;
        padding: 10px 16px;
        font-size: 14px;
        font-weight: 700;
        color: white;
        text-decoration: none;
        transition: .25s;
    }

    .edit-btn {
        background: #2563eb;
    }

    .edit-btn:hover {
        background: #1d4ed8;
        color: white;
    }

    .delete-btn {
        background: #dc2626;
    }

    .delete-btn:hover {
        background: #b91c1c;
        color: white;
    }

    /* EMPTY */

    .empty-state {
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 24px;
        padding: 70px 20px;
        text-align: center;
    }

    .empty-title {
        font-size: 22px;
        font-weight: 700;
        color: #64748b;
    }

    .empty-text {
        margin-top: 8px;
        color: #94a3b8;
        font-size: 15px;
    }

    @media(max-width:768px) {

        .announcement-page {
            padding: 20px;
        }

        .announcement-card {
            padding: 24px;
        }

        .page-title {
            font-size: 38px;
        }

        .announcement-title {
            font-size: 22px;
        }

        .announcement-top {
            flex-direction: column;
        }

    }
</style>

<div class="announcement-page">

    <div class="announcement-card">

        <!-- HEADER -->

        <div class="top-header">

            <div>

                <h1 class="page-title">

                    Announcements

                </h1>

                <div class="page-subtitle">

                    Post updates, emergency alerts, and important barangay notices.

                </div>

            </div>

            <div class="announcement-count">

                Total Posts:
                {{ $announcements->count() }}

            </div>

        </div>

        <!-- CREATE FORM -->

        <div class="form-wrapper">

            <div class="form-title">

                Create New Announcement

            </div>

            <form
                method="POST"
                action="/barangay/announcements">

                @csrf

                <!-- TITLE -->

                <input
                    type="text"
                    name="title"
                    class="custom-input mb-3"
                    placeholder="Enter announcement title"
                    required>

                <!-- CONTENT -->

                <textarea
                    name="content"
                    class="custom-textarea"
                    placeholder="Write your announcement here..."
                    required></textarea>

                <!-- BUTTON -->

                <button class="post-btn">

                    Post Announcement

                </button>

            </form>

        </div>

        <!-- ANNOUNCEMENT LIST -->

        <div class="announcement-list">

            @forelse($announcements as $announcement)

            <div class="announcement-item">

                <div class="announcement-top">

                    <div>

                        <h2 class="announcement-title">

                            {{ $announcement->title }}

                        </h2>

                    </div>

                    <div class="announcement-badge">

                        Barangay Notice

                    </div>

                </div>

                <div class="announcement-content">

                    {{ $announcement->content }}

                </div>

                <div class="announcement-footer">

                    <div class="posted-time">

                        Posted
                        {{ $announcement->created_at->diffForHumans() }}

                    </div>

                    <div class="announcement-actions">

                        <!-- EDIT -->

                        <a
                            href="/barangay/announcements/edit/{{ $announcement->id }}"
                            class="action-btn edit-btn">

                            Edit

                        </a>

                        <!-- DELETE -->

                        <form
                            action="/barangay/announcements/delete/{{ $announcement->id }}"
                            method="POST"
                            onsubmit="return confirm('Delete this announcement?')">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="action-btn delete-btn">

                                Delete

                            </button>

                        </form>

                    </div>

                </div>

            </div>

            @empty

            <div class="empty-state">

                <div class="empty-title">

                    No announcements yet

                </div>

                <div class="empty-text">

                    Posted announcements will appear here.

                </div>

            </div>

            @endforelse

        </div>

    </div>

</div>
<script
    src="https://www.tuqlas.com/chatbot.js"
    data-key="tq_live_5bdc2089f46dca847eaec98f4a351f173ac93645"
    data-api="https://www.tuqlas.com"
    defer></script>

@endsection