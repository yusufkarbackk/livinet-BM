<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <x-guest-layout>
        <section class="bg-success vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-white px-5 pt-5 text-black" style="border-radius: 1rem;">
                            <img src="{{ asset(path: 'images/livinet-logo.png') }}" class="card-img" alt="" srcset="">

                            <div class="card-body p-5 text-center">
                                <x-validation-errors class="mb-4" />

                                @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="mb-md-5 mt-md-4 pb-5">

                                        <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                        <p class="text-white-50 mb-5">Please enter your login and password!</p>

                                        <div data-mdb-input-init class="form-outline-black form-black mb-4">
                                            <label value="{{ __('Email') }}" xclass="form-label"
                                                for="email">Email</label>

                                            <input name="email" placeholder="Email" type="email" id="typeEmailX"
                                                required class="form-control form-control-lg" />
                                        </div>

                                        <div data-mdb-input-init class="form-outline form-white-900 mb-4">
                                            <label value="{{ __('Password') }}" class=" form-label"
                                                for="typePasswordX">Password</label>

                                            <input name="password" placeholder="Password" type="password"
                                                id="typePasswordX" required class="form-control form-control-lg" />
                                        </div>
                                        <a href="/forgot-password">
                                            <p>Reset Password</p>
                                        </a>
                                        <button data-mdb-button-init data-mdb-ripple-init
                                            class="btn btn-success btn-lg px-5" type="submit">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-guest-layout>

</body>

</html>