@extends('layouts.resident')

@section('content')

<div class="topbar">

    <div class="welcome-text">
        Resident Profile
    </div>

    <div class="user-name">
        {{ Auth::guard('resident')->user()->name }}
    </div>

</div>

<div class="card-box text-center">

    @if($resident && $resident->profile_photo)

    <img
        src="{{ asset('storage/' . $resident->profile_photo) }}?v={{ time() }}"
        class="rounded-circle mb-3"
        width="120"
        height="120"
        style="
        object-fit: cover;
        border-radius: 50%;
    ">

    @else

    <img
        src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('resident')->user()->name) }}"
        class="rounded-circle mb-3"
        width="120"
        height="120">

    @endif

    <h3 class="profile-name">
        {{ Auth::guard('resident')->user()->name }}
    </h3>

    <p class="profile-email">
        {{ Auth::guard('resident')->user()->email }}
    </p>

</div>

<div class="card-box">

    <div class="section-title">
        Resident Information
    </div>

    <div class="view-box">

        <strong>Contact Number:</strong><br>

        {{ $resident->contact_number ?? 'N/A' }}

    </div>

    <div class="view-box">

        <strong>Age:</strong><br>

        {{ $resident->age ?? 'N/A' }}

    </div>

    <div class="view-box">

        <strong>Gender:</strong><br>

        {{ $resident->gender ?? 'N/A' }}

    </div>

    <div class="view-box">

        <strong>Birthdate:</strong><br>

        {{ $resident->birthdate ?? 'N/A' }}

    </div>

    <div class="view-box">

        <strong>Civil Status:</strong><br>

        {{ $resident->civil_status ?? 'N/A' }}

    </div>

    <div class="view-box">

        <strong>Sitio:</strong><br>

        {{ $resident->address ?? 'N/A' }}

    </div>

    <div class="view-box">

        <strong>Barangay:</strong><br>

        {{ $resident->barangay ?? 'N/A' }}

    </div>

    <a
        href="/resident/profile/edit"
        class="submit-btn text-decoration-none text-center d-block">

        Update Profile

    </a>

</div>

<div class="card-box text-center">

    <div class="section-title">
        Resident ID
    </div>

    <p class="resident-text">
        Generate downloadable Resident ID with QR Code
    </p>

    <a
        href="/resident/id/download"
        class="submit-btn"
        style="
        display:block;
        text-align:center;
        text-decoration:none;
    ">

        Download Resident ID PDF

    </a>


</div>

<div class="logout-btn">

    <form
        method="POST"
        action="{{ route('logout') }}">

        @csrf

        <button type="submit">

            Logout

        </button>

    </form>

</div>

<style>
    .profile-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 15px;
    }

    .profile-name {
        font-size: 28px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 5px;
    }

    .profile-email {
        color: #64748b;
        margin-bottom: 20px;
    }

    .resident-text {
        color: #64748b;
        margin-bottom: 20px;
    }

    .logout-btn {
        margin-bottom: 20px;
    }

    .logout-btn button {
        width: 100%;
        border: none;
        background: #ef4444;
        color: white;
        padding: 18px;
        border-radius: 22px;
        font-size: 18px;
        font-weight: 700;
    }
</style>

@endsection