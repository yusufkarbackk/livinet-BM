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

                            <div class="card-body p-5 text-start">
                                <x-validation-errors class="mb-4" />

                                @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf

                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                    <div class="block">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" required placeholder="Enter your email">
                                    </div>

                                    <div class="mt-4">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" required placeholder="Enter your email">
                                    </div>

                                    <div class="mt-4">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" required placeholder="Enter your email">
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-lg px-5" type="submit">Reset Password</button>
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