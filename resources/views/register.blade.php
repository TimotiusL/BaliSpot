<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BaliSpot - Register</title>
    @vite(['resources/css/app.css','resources/js/register.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body class="min-h-screen bg-gradient-to-br from-cyan-900 via-blue-900 to-emerald-700">

    <div class="min-h-screen flex">

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

        <div class="flex-1 flex items-center justify-center p-8">

            <div class="backdrop-blur-xl bg-white/15 border border-white/20 rounded-3xl shadow-2xl w-full max-w-md p-8">

                <div class="text-center mb-8">

                    <div class="w-20 h-20 rounded-full bg-white flex items-center justify-center mx-auto mb-5">

                        <i class="fa-solid fa-location-dot text-4xl text-emerald-600"></i>

                    </div>

                    <h2 class="text-3xl font-bold text-white">

                        Create Account

                    </h2>

                    <p class="text-white/70 mt-2">

                        Register to BaliSpot

                    </p>

                </div>

                <form id="registerForm" class="space-y-5">

                    <div>
                        <label class="text-white text-sm">
                            Name
                        </label>

                        <input id="name" name="name" type="text" autocomplete="name" required
                            class="mt-2 w-full rounded-xl bg-white/20 border border-white/20 p-3 text-white placeholder-white/50 focus:outline-none"
                            placeholder="Enter your name">
                    </div>

                    <div>
                        <label class="text-white text-sm">
                            Email
                        </label>

                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="mt-2 w-full rounded-xl bg-white/20 border border-white/20 p-3 text-white placeholder-white/50 focus:outline-none"
                            placeholder="Enter your email">
                    </div>

                    <div>
                        <label class="text-white text-sm">
                            Username
                        </label>

                        <input id="username" name="username" type="text" autocomplete="username" required
                            class="mt-2 w-full rounded-xl bg-white/20 border border-white/20 p-3 text-white placeholder-white/50 focus:outline-none"
                            placeholder="Enter your username">
                    </div>

                    <div>
                        <label class="text-white text-sm">
                            Password
                        </label>

                        <input id="password" name="password" type="password" autocomplete="new-password" required
                            class="mt-2 w-full rounded-xl bg-white/20 border border-white/20 p-3 text-white placeholder-white/50 focus:outline-none"
                            placeholder="Enter your password">
                    </div>

                    <div>
                        <label class="text-white text-sm">
                            Confirm Password
                        </label>

                        <input id="confirmPassword" name="confirmPassword" type="password" autocomplete="new-password"
                            required
                            class="mt-2 w-full rounded-xl bg-white/20 border border-white/20 p-3 text-white placeholder-white/50 focus:outline-none"
                            placeholder="Confirm your password">
                    </div>

                    <button
                        class="w-full bg-emerald-500 hover:bg-emerald-600 transition rounded-xl py-3 font-bold text-white">

                        Register

                    </button>

                    <p id="registerMessage"
                        class="hidden mt-3 rounded-lg p-3 text-sm text-center">
                    </p>

                </form>

                <div class="text-center mt-6">

                    <span class="text-white/70">

                        Already have an account?

                    </span>

                    <a href="/" class="text-emerald-300 font-semibold">

                        Login

                    </a>

                </div>

            </div>

        </div>

    </div>

</body>

</html>