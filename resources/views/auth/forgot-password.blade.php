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
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <img src="{{ asset('images/livinet-logo.png') }}" class="card-img-top" alt="...">
                        <div class="card border-success text-black mt-5" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-left">
                                <x-validation-errors class="mb-4" />

                                <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to set a new one.') }}
                                </div>

                                @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                                    {{ session('status') }}
                                </div>
                                @endif

                                <x-validation-errors class="mb-4" />

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" required placeholder="Enter your email">
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-md px-5" type="submit">Send Email Password Reset Link</button>
                                    </div>

                                </form>
                                <div class="flex items-center justify-end mt-4">
                                    <a href="/">
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-danger btn-md px-5" type="submit">Cancel</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-guest-layout>

</body>

</html>