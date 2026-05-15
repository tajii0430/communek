@extends('layouts.resident')

@section('content')

<style>
    .custom-file-upload {
        background: #eef1f5;
        border-radius: 25px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: 15px;
        margin-bottom: 25px;
    }

    .upload-btn {
        background: #0f2d74;
        color: white;
        padding: 14px 22px;
        border-radius: 14px;
        font-weight: 40;
        cursor: pointer;
        transition: 0.3s;
        font-size: 16px;
    }

    .upload-btn:hover {
        background: #081d4d;
    }

    #profile-file-name {
        color: #555;
        font-size: 19px;
        word-break: break-word;
    }
</style>

<div class="topbar">

    <div class="welcome-text">
        Update Resident Profile
    </div>

    <div class="user-name">
        Edit Information
    </div>

</div>

<div class="card-box">

    <form
        method="POST"
        action="/resident/profile/update"
        enctype="multipart/form-data">

        @csrf

        <div class="custom-file-upload">

            <img
                id="profile-preview"
                src="{{ $resident->profile_photo ? $resident->profile_photo : 'https://via.placeholder.com/90' }}"
                alt="Profile Preview"
                style="
            width:90px;
            height:90px;
            border-radius:50%;
            object-fit:cover;
            border:3px solid #dbe3ec;
        ">

            <div>

                <label for="profilePhoto" class="upload-btn">
                    Upload Photo
                </label>

                <div id="profile-file-name"
                    style="margin-top:10px;">
                    No file selected
                </div>

            </div>

            <input
                type="file"
                id="profilePhoto"
                name="profile_photo"
                accept="image/*"
                hidden
                onchange="updateProfilePreview(this)">

        </div>

        <input
            type="text"
            class="input"
            value="{{ Auth::guard('resident')->user()->name }}"
            readonly>

        <input
            type="email"
            class="input"
            value="{{ Auth::guard('resident')->user()->email }}"
            readonly>

        <input
            type="text"
            name="contact_number"
            class="input"
            placeholder="Contact Number"
            value="{{ $resident->contact_number }}">

        <select
            name="gender"
            class="input">

            <option value="">
                Select Gender
            </option>

            <option value="Male"
                {{ $resident->gender == 'Male' ? 'selected' : '' }}>
                Male
            </option>

            <option value="Female"
                {{ $resident->gender == 'Female' ? 'selected' : '' }}>
                Female
            </option>

        </select>

        <input
            type="date"
            name="birthdate"
            class="input"
            value="{{ $resident->birthdate }}">

        <select
            name="civil_status"
            class="input">

            <option value="">
                Select Civil Status
            </option>

            <option value="Single"
                {{ $resident->civil_status == 'Single' ? 'selected' : '' }}>
                Single
            </option>

            <option value="Married"
                {{ $resident->civil_status == 'Married' ? 'selected' : '' }}>
                Married
            </option>

            <option value="Widowed"
                {{ $resident->civil_status == 'Widowed' ? 'selected' : '' }}>
                Widowed
            </option>

            <option value="Separated"
                {{ $resident->civil_status == 'Separated' ? 'selected' : '' }}>
                Separated
            </option>

        </select>

        <input
            type="text"
            name="address"
            class="input"
            placeholder="Sitio"
            value="{{ $resident->address }}">

        <input
            type="text"
            class="input"
            value="{{ Auth::guard('resident')->user()->barangay }}"
            readonly>

        <button
            type="submit"
            class="submit-btn">

            Save Changes

        </button>

    </form>

</div>

<script>
    function updateProfilePreview(input) {

        const fileName =
            input.files.length > 0 ?
            input.files[0].name :
            'No file selected';

        document.getElementById('profile-file-name')
            .innerText = fileName;

        if (input.files && input.files[0]) {

            const reader = new FileReader();

            reader.onload = function(e) {

                document.getElementById('profile-preview')
                    .src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection