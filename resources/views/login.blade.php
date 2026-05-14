<!DOCTYPE html>
<html>

<head>

    <title>Barangay System Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container">

        <div class="row justify-content-center align-items-center vh-100">

            <div class="col-md-4">

                <div class="card shadow border-0 rounded-4">

                    <div class="card-body p-5">

                        <h2 class="text-center mb-4">
                            Barangay System
                        </h2>

                        @if(session('error'))

                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>

                        @endif

                        <form method="POST" action="/login">

                            @csrf

                            <div class="mb-3">

                                <label>Username</label>

                                <input type="text"
                                    name="username"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label>Password</label>

                                <input type="password"
                                    name="password"
                                    class="form-control"
                                    required>

                            </div>

                            <button type="submit"
                                class="btn btn-primary w-100">

                                Login

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>