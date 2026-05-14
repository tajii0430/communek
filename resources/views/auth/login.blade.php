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

          background: linear-gradient(rgba(3, 13, 50, 0.81), rgba(0, 0, 0, 0.86)),
          url('{{ asset("images/batac.jpg") }}');

          background-position: center;
          background-size: cover;
          background-repeat: no-repeat;

          filter: blur(10px);
          -webkit-filter: blur(10px);

          z-index: -1;
      }

      .login-wrapper {
          min-height: 100vh;
          display: flex;
          justify-content: center;
          align-items: center;
          padding: 30px 20px;
      }

      .login-card {
          width: 100%;
          max-width: 430px;
          background: white;
          border-radius: 40px;
          overflow: hidden;
          box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
      }

      /* HEADER */

      .login-header {
          background: linear-gradient(135deg, #071129, #1b2940);
          padding: 45px 30px;
          border-radius: 0 0 45px 45px;
          color: white;
      }

      .login-header h1 {
          font-size: 50px;
          font-weight: 800;
          line-height: 1;
          margin: 0;
      }

      .brand-subtitle {
          font-size: 14px;
          opacity: .85;
          margin-top: 8px;
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

      .login-body {
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

      .login-btn {
          width: 100%;
          border: none;
          background: #2563eb;
          color: white;
          padding: 18px;
          border-radius: 22px;
          font-size: 20px;
          font-weight: 700;
          margin-top: 15px;
          transition: .3s;
          cursor: pointer;
      }

      .login-btn:hover {
          background: #1d4ed8;
      }

      /* REMEMBER */

      .remember-wrapper {
          display: flex;
          align-items: center;
          margin-top: 10px;
      }

      .remember-wrapper input {
          width: 18px;
          height: 18px;
          accent-color: #2563eb;
      }

      .remember-wrapper span {
          margin-left: 10px;
          color: #475569;
          font-size: 15px;
      }

      /* FOOTER */

      .register-link {
          text-align: center;
          margin-top: 25px;
          font-size: 15px;
          color: #64748b;
      }

      .register-link a {
          color: #2563eb;
          font-weight: 700;
          text-decoration: none;
      }

      .success-message {
          background: #dcfce7;
          color: #166534;
          padding: 14px 18px;
          border-radius: 16px;
          margin-bottom: 20px;
          font-weight: 600;
          border: 1px solid #86efac;
      }

      @media(max-width:500px) {

          .login-header h1 {
              font-size: 42px;
          }

      }
  </style>

  <div class="login-wrapper">

      <div class="login-card">

          <!-- HEADER -->

          <div class="login-header">

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

              <h1>
                  CommuNek
              </h1>

              <div class="brand-subtitle">
                  City of Batac Smart Barangay System
              </div>

              <div class="brand-badge">
                  Resident Login
              </div>

          </div>

          <!-- BODY -->

          <div class="login-body">

              @if(session('success'))

              <div class="success-message">
                  {{ session('success') }}
              </div>

              @endif

              <form method="POST" action="{{ route('login') }}">

                  @csrf

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
                          placeholder="Enter username"
                          required
                          autofocus>

                      @error('username')

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

                  <!-- REMEMBER ME -->

                  <div class="remember-wrapper">

                      <input
                          id="remember_me"
                          type="checkbox"
                          name="remember">

                      <span>
                          Remember me
                      </span>

                  </div>

                  <!-- LOGIN BUTTON -->

                  <button type="submit" class="login-btn">

                      LOG IN

                  </button>

                  <!-- REGISTER LINK -->

                  <div class="register-link">

                      Don't have an account?

                      <a href="{{ route('register') }}">

                          Create Account

                      </a>

                  </div>

              </form>

          </div>

      </div>

  </div>