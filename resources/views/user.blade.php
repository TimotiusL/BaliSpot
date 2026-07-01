<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BaliSpot - Smart Tourism Companion</title>
    @vite(['resources/css/app.css', 'resources/js/user.js', 'resources/js/logout.js'])
    <link rel="manifest" href="{{ asset('build/manifest.webmanifest') }}">
    <meta name="theme-color" content="#4338ca">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;1,9..144,500&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap"
        rel="stylesheet">
    <style>
        .font-display {
            font-family: 'Fraunces', serif;
        }

        .font-body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .font-data {
            font-family: 'Space Mono', monospace;
        }
    </style>
</head>

<body class="font-body bg-[#FBF6EE] text-stone-800 min-h-screen flex flex-col">

    <header
        class="relative overflow-hidden bg-gradient-to-br from-indigo-900 via-indigo-700 to-orange-500 text-white p-5 md:p-7 rounded-b-[2.5rem] shadow-xl sticky top-0 z-50">

        <div class="absolute -top-16 -left-10 w-48 h-48 bg-orange-400/30 rounded-full blur-3xl pointer-events-none">
        </div>
        <div class="absolute -bottom-10 right-6 w-36 h-36 bg-emerald-400/20 rounded-full blur-2xl pointer-events-none">
        </div>
        <svg class="absolute -right-8 -top-8 w-52 h-52 opacity-[0.08] pointer-events-none" viewBox="0 0 100 100"
            fill="none" stroke="white" stroke-width="1">
            <circle cx="50" cy="50" r="44"></circle>
            <circle cx="50" cy="50" r="2" fill="white"></circle>
            <line x1="50" y1="6" x2="50" y2="94"></line>
            <line x1="6" y1="50" x2="94" y2="50"></line>
            <path d="M50 10 L56 50 L50 90 L44 50 Z" fill="white" opacity="0.5"></path>
        </svg>

        <div class="max-w-5xl mx-auto relative z-10">
            <div class="flex justify-between items-start gap-3 mb-4">
                <div>
                    <h1
                        class="font-display text-2xl md:text-3xl font-semibold tracking-tight flex items-center gap-2.5">
                        <span class="bg-white/15 backdrop-blur p-2 rounded-xl">
                            <i class="fa-solid fa-map-location-dot text-emerald-300"></i>
                        </span>
                        BaliSpot
                    </h1>
                    <p class="text-indigo-100/80 text-[11px] md:text-xs font-medium mt-1 ml-0.5">Jelajah Bali, sesuai
                        arah & budgetmu</p>
                </div>

                <div class="flex items-center gap-2">
                    <button onclick="getGPSLocation()"
                        class="bg-white/10 hover:bg-white/20 backdrop-blur border border-white/20 p-2.5 rounded-full transition text-xs flex items-center space-x-1.5 shadow-sm">
                        <i class="fa-solid fa-location-crosshairs animate-pulse text-emerald-300"></i>
                        <span class="font-data text-[10px] hidden sm:inline">Sync GPS</span>
                    </button>
                    <button id="logoutBtn"
                        class="bg-white/10 hover:bg-rose-500 backdrop-blur border border-white/20 text-white p-2.5 sm:px-4 sm:py-2.5 rounded-full font-semibold transition text-xs flex items-center gap-1.5 shadow-sm">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="hidden sm:inline">Logout</span>
                    </button>
                </div>
            </div>

            <div
                class="bg-white/10 backdrop-blur-md p-3.5 rounded-2xl text-xs flex items-center space-x-3 border border-white/15">
                <div class="relative w-11 h-11 flex items-center justify-center flex-shrink-0">
                    <span class="absolute inset-0 rounded-full bg-emerald-400/30 animate-ping"></span>
                    <span class="relative w-9 h-9 rounded-full bg-emerald-400/20 flex items-center justify-center">
                        <i class="fa-solid fa-street-view text-emerald-300"></i>
                    </span>
                </div>
                <div>
                    <p class="text-indigo-200 font-semibold uppercase tracking-wide text-[10px]">Lokasi Anda Saat Ini
                    </p>
                    <p id="gps-status" class="font-data text-white text-sm mt-0.5">Mendeteksi lokasi... (Pastikan GPS
                        Aktif)</p>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1 w-full max-w-5xl mx-auto p-4 md:p-8 space-y-6 pb-28">

        <div class="space-y-2.5">
            <label class="text-xs font-bold text-stone-400 uppercase tracking-wider flex items-center gap-1.5">
                <i class="fa-solid fa-coins text-amber-500"></i>Filter Budget Wisata
            </label>
            <div class="grid grid-cols-3 gap-2 md:max-w-md">
                <button onclick="setBudgetFilter('Murah')" id="btn-b-Murah"
                    class="filter-budget-btn border border-gray-200 bg-white py-2 rounded-xl text-sm font-semibold text-gray-600 shadow-sm transition flex items-center justify-center gap-1.5 hover:shadow-md hover:-translate-y-0.5 active:scale-95">
                    $ Murah
                </button>
                <button onclick="setBudgetFilter('Cukup')" id="btn-b-Cukup"
                    class="filter-budget-btn border border-gray-200 bg-white py-2 rounded-xl text-sm font-semibold text-gray-600 shadow-sm transition flex items-center justify-center gap-1.5 hover:shadow-md hover:-translate-y-0.5 active:scale-95">
                    $$ Cukup
                </button>
                <button onclick="setBudgetFilter('Mahal')" id="btn-b-Mahal"
                    class="filter-budget-btn border border-gray-200 bg-white py-2 rounded-xl text-sm font-semibold text-gray-600 shadow-sm transition flex items-center justify-center gap-1.5 hover:shadow-md hover:-translate-y-0.5 active:scale-95">
                    $$$ Mahal
                </button>
            </div>
        </div>

        <div class="space-y-3">
            <div class="flex justify-between items-center">
                <h3 id="list-title" class="font-display text-lg font-semibold text-stone-800 flex items-center">
                    <i class="fa-solid fa-wand-magic-sparkles text-indigo-500 mr-2"></i>Rekomendasi Untuk Anda
                </h3>
                <span class="text-xs text-stone-400 font-data font-medium" id="total-found">0 ditemukan</span>
            </div>

            <div id="places-container" class="space-y-3 md:space-y-0 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-4">
                <div class="py-14 text-center text-stone-400 font-medium text-sm md:col-span-2 lg:col-span-3">
                    <i class="fa-solid fa-compass animate-spin text-3xl text-indigo-500 mb-3"></i>
                    <p>Mencari destinasi terbaik di sekitar Anda...</p>
                    <p class="font-data text-[11px] text-stone-300 mt-1">menghitung jarak via GPS</p>
                </div>
            </div>
        </div>
    </main>

    <nav
        class="fixed bottom-3 left-3 right-3 md:left-1/2 md:right-auto md:-translate-x-1/2 md:w-full md:max-w-md bg-white/90 backdrop-blur-lg border border-stone-100 shadow-[0_8px_30px_rgba(0,0,0,0.12)] rounded-3xl z-50">
        <div class="grid grid-cols-4 py-2 px-2">
            <button onclick="switchCategory('Wisata')" id="nav-Wisata"
                class="nav-item flex flex-col items-center space-y-1 text-indigo-600 py-1.5 rounded-2xl transition-all hover:bg-indigo-50">
                <i class="fa-solid fa-umbrella-beach"></i><span class="text-[10px] font-bold">Wisata</span>
            </button>
            <button onclick="switchCategory('Kuliner')" id="nav-Kuliner"
                class="nav-item flex flex-col items-center space-y-1 text-gray-400 hover:text-indigo-600 py-1.5 rounded-2xl transition-all hover:bg-indigo-50">
                <i class="fa-solid fa-utensils"></i><span class="text-[10px] font-medium">Kuliner</span>
            </button>
            <button onclick="switchCategory('Hotel')" id="nav-Hotel"
                class="nav-item flex flex-col items-center space-y-1 text-gray-400 hover:text-indigo-600 py-1.5 rounded-2xl transition-all hover:bg-indigo-50">
                <i class="fa-solid fa-hotel"></i><span class="text-[10px] font-medium">Akomodasi</span>
            </button>
            <button onclick="switchCategory('Ibadah')" id="nav-Ibadah"
                class="nav-item flex flex-col items-center space-y-1 text-gray-400 hover:text-indigo-600 py-1.5 rounded-2xl transition-all hover:bg-indigo-50">
                <i class="fa-solid fa-place-of-worship"></i><span class="text-[10px] font-medium">Ibadah</span>
            </button>
        </div>
    </nav>
</body>

</html>