<style>
    body {
        background: #eef2f7;
        font-family: Arial, Helvetica, sans-serif;
    }

    body::before {
        content: "";
        position: fixed;
        top: -20px;
        left: -20px;
        width: calc(100% + 40px);
        height: calc(100% + 40px);

        background:
            linear-gradient(rgba(3, 13, 50, 0.81), rgba(0, 0, 0, 0.86)),
            url('images/batac.jpg');

        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;

        filter: blur(10px);
        -webkit-filter: blur(10px);

        z-index: -1;

    }

    .register-wrapper {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px 20px;
    }

    .register-card {
        width: 100%;
        max-width: 430px;
        background: white;
        border-radius: 40px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
    }

    /* HEADER */

    .register-header {
        background: linear-gradient(135deg, #071129, #1b2940);
        padding: 45px 30px;
        border-radius: 0 0 45px 45px;
        color: white;
    }

    .register-header p {
        font-size: 18px;
        opacity: .85;
        margin-bottom: 10px;
    }

    .register-header h1 {
        font-size: 48px;
        font-weight: 800;
        line-height: 1;
        margin: 0;
    }

    .brand-badge {
        display: inline-block;
        margin-top: 18px;
        background: rgba(255, 255, 255, .15);
        padding: 10px 20px;
        border-radius: 20px;
        font-size: 15px;
        font-weight: 700;
    }

    /* FORM */

    .register-body {
        padding: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-size: 17px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 10px;
    }

    .form-input {
        width: 100%;
        border: none;
        background: #eef2f7;
        border-radius: 22px;
        padding: 18px;
        font-size: 16px;
        outline: none;
    }

    .form-input:focus {
        border: 2px solid #2563eb;
        background: white;
    }

    .error-text {
        color: #dc2626;
        font-size: 14px;
        margin-top: 8px;
    }

    /* BUTTON */

    .register-btn {
        width: 100%;
        border: none;
        background: #2563eb;
        color: white;
        padding: 18px;
        border-radius: 22px;
        font-size: 20px;
        font-weight: 700;
        margin-top: 10px;
        transition: .3s;
    }

    .register-btn:hover {
        background: #1d4ed8;
    }


    /* FOOTER */

    .login-link {
        text-align: center;
        margin-top: 25px;
        font-size: 15px;
        color: #64748b;
    }

    .login-link a {
        color: #2563eb;
        font-weight: 700;
        text-decoration: none;
    }

    @media(max-width:500px) {

        .register-header h1 {
            font-size: 42px;
        }

    }
</style>


<div class="register-wrapper">


    <div class="register-card">

        <!-- HEADER -->



        <div class="register-header">

            <div style="
    display:flex;
    justify-content:left;
    align-items:center;
    gap:15px;
    margin-bottom:25px;
">

                <!-- CITY OF BATAC LOGO -->

                <img src="{{ asset('images/batac-logo.png') }}"
                    alt="City of Batac Logo"
                    style="
            width:70px;
            height:70px;
            object-fit:contain;
        ">

                <!-- COMMUNEK LOGO -->

                <img src="{{ asset('images/logo-white.jpg') }}"
                    alt="CommuNek Logo"
                    style="
            width:75px;
            height:75px;
            object-fit:contain;
        ">

            </div>


            <h1 style="
                font-size:50px;
                font-weight:800;
                line-height:1;
                margin:0; ">
                CommuNek
            </h1>

            <p1 style=" font-size: 14px; opacity: .85; margin-bottom: 10px;">
                City of Batac Smart Barangay System
            </p1>

            <div class="brand-badge">
                Resident Registration
            </div>

        </div>

        <!-- FORM -->

        <div class="register-body">

            <form method="POST" action="/register">

                @csrf

                <!-- NAME -->

                <div class="form-group">

                    <label class="form-label">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="form-input"
                        placeholder="Enter full name"
                        required
                        autofocus>

                    @error('name')

                    <div class="error-text">
                        {{ $message }}
                    </div>

                    @enderror

                </div>

                <!-- EMAIL -->

                <div class="form-group">

                    <label class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-input"
                        placeholder="Enter email"
                        required>

                    @error('email')

                    <div class="error-text">
                        {{ $message }}
                    </div>

                    @enderror

                </div>

                <!-- USERNAME -->

                <div class="form-group">

                    <label class="form-label">
                        Username
                    </label>

                    <input
                        type="text"
                        name="username"
                        value="{{ old('username') }}"
                        class="form-input"
                        placeholder="Choose username"
                        required>

                    @error('username')

                    <div class="error-text">
                        {{ $message }}
                    </div>

                    @enderror

                </div>

                <!-- BARANGAY -->

                <div class="form-group">

                    <label class="form-label">
                        Barangay
                    </label>

                    <select
                        name="barangay"
                        class="form-input"
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

                    @error('barangay')

                    <div class="error-text">
                        {{ $message }}
                    </div>

                    @enderror

                </div>

                <!-- PASSWORD -->

                <div class="form-group">

                    <label class="form-label">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-input"
                        placeholder="Enter password"
                        required>

                    @error('password')

                    <div class="error-text">
                        {{ $message }}
                    </div>

                    @enderror

                </div>

                <!-- CONFIRM PASSWORD -->

                <div class="form-group">

                    <label class="form-label">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-input"
                        placeholder="Confirm password"
                        required>

                </div>

                <!-- BUTTON -->

                <button type="submit" class="register-btn">

                    Create Account

                </button>

                <!-- LOGIN LINK -->

                <div class="login-link">

                    Already registered?

                    <a href="{{ route('login') }}">

                        Login Here

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>