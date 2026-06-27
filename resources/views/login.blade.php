<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BaliSpot - Login</title>
    @vite(['resources/css/app.css', 'resources/js/login.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body class="min-h-screen bg-gradient-to-br from-cyan-900 via-blue-900 to-emerald-700">

    <div class="min-h-screen flex flex-col lg:flex-row">

        <div class="hidden lg:flex w-1/2 items-center justify-center p-16">
            <div class="text-white">
                <h1 class="text-6xl font-black mb-5">
                    BaliSpot
                </h1>
                <h2 class="text-2xl font-semibold mb-5">
                    Smart Tourism Companion
                </h2>
                <p class="text-white/80 leading-8 text-lg max-w-lg">
                    Temukan destinasi wisata, hotel, kuliner, dan rumah ibadah
                    terbaik di Bali hanya dalam satu aplikasi.
                </p>
            </div>
        </div>

        <div class="lg:hidden text-center pt-10 pb-2 px-6">
            <h1 class="text-white text-2xl font-extrabold tracking-wide flex items-center justify-center gap-2">
                <i class="fa-solid fa-map-location-dot text-emerald-300"></i> BaliSpot
            </h1>
            <p class="text-white/60 text-xs mt-1">Smart Tourism Companion</p>
        </div>

        <div class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8 py-6 lg:py-8">

            <div
                class="backdrop-blur-xl bg-white/15 border border-white/20 rounded-3xl shadow-2xl w-full max-w-md p-6 sm:p-8">

                <div class="text-center mb-6 sm:mb-8">
                    <div
                        class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-white flex items-center justify-center mx-auto mb-4 sm:mb-5">
                        <i class="fa-solid fa-location-dot text-3xl sm:text-4xl text-emerald-600"></i>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-white">
                        Welcome Back
                    </h2>
                    <p class="text-white/70 mt-2">
                        Login to BaliSpot
                    </p>
                </div>

                <form id="loginForm" class="space-y-5" autocomplete="off">

                    <div>
                        <label class="text-white text-sm">
                            Username
                        </label>
                        <input id="username" type="text" autocomplete="off"
                            class="mt-2 w-full rounded-xl bg-white/20 border border-white/20 p-3 text-white placeholder-white/50 focus:outline-none"
                            placeholder="Enter username">
                    </div>

                    <div>
                        <label class="text-white text-sm">
                            Password
                        </label>
                        <input id="password" type="password" autocomplete="new-password"
                            class="mt-2 w-full rounded-xl bg-white/20 border border-white/20 p-3 text-white placeholder-white/50 focus:outline-none"
                            placeholder="Enter password">
                    </div>

                    <button
                        class="w-full bg-emerald-500 hover:bg-emerald-600 transition rounded-xl py-3 font-bold text-white">
                        Login
                    </button>

                    <p id="loginMessage" class="hidden mt-3 rounded-lg p-3 text-sm text-center"> </p>
                </form>

                <div class="text-center mt-6">
                    <span class="text-white/70">
                        Don't have an account?
                    </span>
                    <a href="/register" class="text-emerald-300 font-semibold">
                        Register
                    </a>
                </div>

            </div>

        </div>

    </div>

</body>

</html>