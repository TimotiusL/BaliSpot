<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BaliSpot - Smart Tourism Companion</title>
    @vite(['resources/css/app.css', 'resources/js/user.js', 'resources/js/logout.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-slate-50 font-sans text-gray-800 min-h-screen flex flex-col">

    <header class="bg-indigo-600 text-white p-5 md:p-6 rounded-b-3xl shadow-md sticky top-0 z-50">
        <div class="max-w-5xl mx-auto">
            <div class="flex justify-between items-center mb-3">
                <h1 class="text-xl md:text-2xl font-bold tracking-wide flex items-center">
                    <i class="fa-solid fa-map-location-dot mr-2 text-emerald-400"></i>BaliSpot
                </h1>
                <button onclick="getGPSLocation()"
                    class="bg-indigo-500 hover:bg-indigo-700 p-2 rounded-full transition text-xs flex items-center space-x-1">
                    <i class="fa-solid fa-location-crosshairs animate-pulse text-emerald-400"></i>
                    <span class="font-mono text-[10px]">Sync GPS</span>
                </button>
            </div>

            <div
                class="bg-indigo-700/50 p-3 rounded-xl text-xs flex items-center space-x-3 border border-indigo-500/30">
                <i class="fa-solid fa-street-view text-lg text-emerald-300"></i>
                <div>
                    <p class="text-indigo-200 font-medium">Lokasi Anda Saat Ini</p>
                    <p id="gps-status" class="font-mono text-white">Mendeteksi lokasi... (Pastikan GPS Aktif)</p>
                </div>
            </div>
        </div>

        <div class="absolute top-5 right-5 md:top-6 md:right-8">
            <button id="logoutBtn"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-semibold transition">
                <i class="fa-solid fa-right-from-bracket mr-2"></i>
                Logout
            </button>
        </div>

    </header>

    <main class="flex-1 w-full max-w-5xl mx-auto p-4 md:p-8 space-y-5 pb-24">

        <div class="space-y-2">
            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Filter Budget Wisata</label>
            <div class="grid grid-cols-3 gap-2 md:max-w-md">
                <button onclick="setBudgetFilter('Murah')" id="btn-b-Murah"
                    class="filter-budget-btn border border-gray-200 bg-white py-2 rounded-xl text-sm font-semibold text-gray-600 shadow-sm transition">
                    $ Murah
                </button>
                <button onclick="setBudgetFilter('Cukup')" id="btn-b-Cukup"
                    class="filter-budget-btn border border-gray-200 bg-white py-2 rounded-xl text-sm font-semibold text-gray-600 shadow-sm transition">
                    $$ Cukup
                </button>
                <button onclick="setBudgetFilter('Mahal')" id="btn-b-Mahal"
                    class="filter-budget-btn border border-gray-200 bg-white py-2 rounded-xl text-sm font-semibold text-gray-600 shadow-sm transition">
                    $$$ Mahal
                </button>
            </div>
        </div>

        <div class="space-y-3">
            <div class="flex justify-between items-center">
                <h3 id="list-title" class="text-md font-bold text-gray-800 flex items-center">
                    <i class="fa-solid fa-wand-magic-sparkles text-indigo-500 mr-2"></i>Rekomendasi Untuk Anda
                </h3>
                <span class="text-xs text-gray-400 font-medium" id="total-found">0 ditemukan</span>
            </div>

            <div id="places-container" class="space-y-3 md:space-y-0 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-4">
                <div class="p-6 text-center text-gray-400 font-medium text-sm md:col-span-2 lg:col-span-3">
                    <i class="fa-solid fa-circle-notch animate-spin text-2xl text-indigo-600 mb-2"></i>
                    <p>Mencari destinasi terbaik di sekitar Anda...</p>
                </div>
            </div>
        </div>
    </main>

    <nav
        class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-100 shadow-[0_-4px_10px_rgba(0,0,0,0.05)] z-50">
        <div class="max-w-5xl mx-auto grid grid-cols-4 py-2.5 px-2">
            <button onclick="switchCategory('Wisata')" id="nav-Wisata"
                class="nav-item flex flex-col items-center space-y-1 text-indigo-600">
                <i class="fa-solid fa-umbrella-beach"></i><span class="text-[10px] font-bold">Wisata</span>
            </button>
            <button onclick="switchCategory('Kuliner')" id="nav-Kuliner"
                class="nav-item flex flex-col items-center space-y-1 text-gray-400 hover:text-indigo-600">
                <i class="fa-solid fa-utensils"></i><span class="text-[10px] font-medium">Kuliner</span>
            </button>
            <button onclick="switchCategory('Hotel')" id="nav-Hotel"
                class="nav-item flex flex-col items-center space-y-1 text-gray-400 hover:text-indigo-600">
                <i class="fa-solid fa-hotel"></i><span class="text-[10px] font-medium">Akomodasi</span>
            </button>
            <button onclick="switchCategory('Ibadah')" id="nav-Ibadah"
                class="nav-item flex flex-col items-center space-y-1 text-gray-400 hover:text-indigo-600">
                <i class="fa-solid fa-place-of-worship"></i><span class="text-[10px] font-medium">Ibadah</span>
            </button>
        </div>
    </nav>
</body>

</html>