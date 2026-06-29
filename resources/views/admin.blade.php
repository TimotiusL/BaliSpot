<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BaliSpot Admin</title>
    @vite(['resources/css/app.css', 'resources/js/admin.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap"
        rel="stylesheet">
    <style>
        .active-menu {
            @apply bg-indigo-800 text-white;
        }

        .leaflet-container,
        .leaflet-pane,
        .leaflet-control-container {
            z-index: 1 !important;
        }

        .font-display {
            font-family: 'Fraunces', serif;
        }

        .font-body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .font-data {
            font-family: 'Space Mono', monospace;
        }

        .sidebar-topo {
            background-image:
                repeating-radial-gradient(circle at 15% 20%, rgba(255, 255, 255, 0.05) 0px, transparent 2px, transparent 18px, rgba(255, 255, 255, 0.05) 20px),
                repeating-radial-gradient(circle at 85% 80%, rgba(16, 185, 129, 0.06) 0px, transparent 2px, transparent 22px, rgba(16, 185, 129, 0.06) 24px);
        }

        #tableBody tr {
            transition: background-color .15s ease;
        }

        #tableBody tr:hover {
            background-color: #EEF2FF;
        }
    </style>
</head>

<body class="font-body bg-[#F4F2ED] text-stone-800">

    <div class="flex h-screen overflow-hidden">

        <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-30 hidden md:hidden"></div>

        <div id="sidebar"
            class="sidebar-topo w-64 bg-indigo-950 text-white flex flex-col justify-between fixed md:static inset-y-0 left-0 z-40 shadow-xl transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
            <div class="p-5">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="font-display text-2xl font-semibold tracking-wide flex items-center">
                            <span class="bg-white/10 p-1.5 rounded-lg mr-2.5">
                                <i class="fa-solid fa-map-location-dot text-emerald-400"></i>
                            </span>BaliSpot
                        </h1>
                    </div>
                    <button id="sidebarCloseBtn" class="md:hidden text-indigo-300 hover:text-white text-xl">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <nav class="space-y-1.5" id="sidebar-nav">
                    <button onclick="switchMenu('dashboard')" id="btn-dashboard"
                        class="w-full flex items-center space-x-3 bg-indigo-800 p-3 rounded-xl font-medium transition text-left">
                        <span class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-chart-pie text-indigo-300 text-xs"></i>
                        </span><span>Ringkasan Data</span>
                    </button>
                    <button onclick="switchMenu('Wisata')" id="btn-Wisata"
                        class="w-full flex items-center space-x-3 hover:bg-indigo-900 p-3 rounded-xl font-medium transition text-indigo-200 hover:text-white text-left">
                        <span class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-compass text-blue-400 text-xs"></i>
                        </span><span>Tempat Wisata</span>
                    </button>
                    <button onclick="switchMenu('Kuliner')" id="btn-Kuliner"
                        class="w-full flex items-center space-x-3 hover:bg-indigo-900 p-3 rounded-xl font-medium transition text-indigo-200 hover:text-white text-left">
                        <span class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-utensils text-amber-400 text-xs"></i>
                        </span><span>Tempat Makan</span>
                    </button>
                    <button onclick="switchMenu('Hotel')" id="btn-Hotel"
                        class="w-full flex items-center space-x-3 hover:bg-indigo-900 p-3 rounded-xl font-medium transition text-indigo-200 hover:text-white text-left">
                        <span class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-bed text-emerald-400 text-xs"></i>
                        </span><span>Akomodasi / Hotel</span>
                    </button>
                    <button onclick="switchMenu('Ibadah')" id="btn-Ibadah"
                        class="w-full flex items-center space-x-3 hover:bg-indigo-900 p-3 rounded-xl font-medium transition text-indigo-200 hover:text-white text-left">
                        <span class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-place-of-worship text-purple-400 text-xs"></i>
                        </span><span>Rumah Ibadah</span>
                    </button>
                </nav>
            </div>
            <div class="p-5 border-t border-indigo-900/70 bg-indigo-950/80 relative z-10">
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <div
                            class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center font-bold text-indigo-950">
                            AD</div>
                        <span
                            class="absolute -bottom-0.5 -right-0.5 w-3 h-3 rounded-full bg-emerald-400 border-2 border-indigo-950"></span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Admin BaliSpot</p>
                        <p class="text-[11px] text-indigo-400">Online</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 flex flex-col overflow-y-auto">
            <header
                class="bg-white/90 backdrop-blur-md shadow-sm px-6 py-4 flex justify-between items-center sticky top-0 z-20 border-b border-stone-100">
                <div class="flex items-center space-x-4">
                    <button id="sidebarToggleBtn" class="md:hidden text-gray-600"><i
                            class="fa-solid fa-bars text-xl"></i></button>
                    <div>
                        <h2 id="page-title" class="font-display text-xl font-semibold text-stone-800">Ringkasan Sistem &
                            Data</h2>
                        <p class="text-xs text-stone-400 mt-0.5 hidden sm:block">Kelola destinasi BaliSpot dari sini</p>
                    </div>
                </div>
                <button id="logoutBtn" onclick="logout()"
                    class="bg-rose-50 hover:bg-rose-500 text-rose-600 hover:text-white px-4 py-2.5 rounded-xl font-semibold transition flex items-center text-sm">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i>
                    <span class="hidden sm:inline">Logout</span>
                </button>
            </header>

            <main class="p-6 space-y-6">

                <div id="section-dashboard" class="space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="group bg-white p-6 rounded-2xl shadow-sm border border-stone-100 flex items-center justify-between cursor-pointer hover:shadow-lg hover:-translate-y-0.5 transition-all"
                            onclick="switchMenu('Wisata')">
                            <div>
                                <p class="text-xs text-stone-400 font-semibold uppercase tracking-wide">Total Wisata</p>
                                <h3 id="stat-wisata" class="font-data text-3xl font-bold text-stone-800 mt-1.5">0</h3>
                            </div>
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 text-white rounded-2xl flex items-center justify-center text-xl shadow-md group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-compass"></i>
                            </div>
                        </div>
                        <div class="group bg-white p-6 rounded-2xl shadow-sm border border-stone-100 flex items-center justify-between cursor-pointer hover:shadow-lg hover:-translate-y-0.5 transition-all"
                            onclick="switchMenu('Kuliner')">
                            <div>
                                <p class="text-xs text-stone-400 font-semibold uppercase tracking-wide">Total Kuliner
                                </p>
                                <h3 id="stat-kuliner" class="font-data text-3xl font-bold text-stone-800 mt-1.5">0</h3>
                            </div>
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-amber-400 to-orange-500 text-white rounded-2xl flex items-center justify-center text-xl shadow-md group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-bowl-food"></i>
                            </div>
                        </div>
                        <div class="group bg-white p-6 rounded-2xl shadow-sm border border-stone-100 flex items-center justify-between cursor-pointer hover:shadow-lg hover:-translate-y-0.5 transition-all"
                            onclick="switchMenu('Hotel')">
                            <div>
                                <p class="text-xs text-stone-400 font-semibold uppercase tracking-wide">Total Hotel</p>
                                <h3 id="stat-hotel" class="font-data text-3xl font-bold text-stone-800 mt-1.5">0</h3>
                            </div>
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-emerald-400 to-teal-600 text-white rounded-2xl flex items-center justify-center text-xl shadow-md group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-bed"></i>
                            </div>
                        </div>
                        <div class="group bg-white p-6 rounded-2xl shadow-sm border border-stone-100 flex items-center justify-between cursor-pointer hover:shadow-lg hover:-translate-y-0.5 transition-all"
                            onclick="switchMenu('Ibadah')">
                            <div>
                                <p class="text-xs text-stone-400 font-semibold uppercase tracking-wide">Rumah Ibadah</p>
                                <h3 id="stat-ibadah" class="font-data text-3xl font-bold text-stone-800 mt-1.5">0</h3>
                            </div>
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 text-white rounded-2xl flex items-center justify-center text-xl shadow-md group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-place-of-worship"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100">

                        <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                            <h3 class="font-display text-lg font-semibold text-stone-800">
                                Peta Kepadatan Destinasi Terdaftar
                            </h3>

                            <div class="flex items-center gap-2 text-xs">
                                <span
                                    class="flex items-center gap-1.5 bg-blue-50 text-blue-700 px-2.5 py-1 rounded-full font-semibold">
                                    <span class="w-2 h-2 rounded-full bg-blue-600"></span>Wisata
                                </span>
                                <span
                                    class="flex items-center gap-1.5 bg-amber-50 text-amber-700 px-2.5 py-1 rounded-full font-semibold">
                                    <span class="w-2 h-2 rounded-full bg-amber-600"></span>Kuliner
                                </span>
                                <span
                                    class="flex items-center gap-1.5 bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-full font-semibold">
                                    <span class="w-2 h-2 rounded-full bg-emerald-600"></span>Hotel
                                </span>
                                <span
                                    class="flex items-center gap-1.5 bg-purple-50 text-purple-700 px-2.5 py-1 rounded-full font-semibold">
                                    <span class="w-2 h-2 rounded-full bg-purple-600"></span>Ibadah
                                </span>
                            </div>
                        </div>

                        <p class="text-sm text-stone-400 mb-4">
                            Visualisasi koordinat GPS seluruh destinasi yang terdaftar (cluster Denpasar, Badung,
                            Gianyar).
                        </p>

                        <div id="densityMap"
                            class="w-full h-[420px] rounded-2xl border border-stone-200 overflow-hidden"></div>

                        <div id="densityMapEmpty"
                            class="hidden w-full h-[420px] rounded-2xl border border-stone-200 bg-stone-50 flex flex-col items-center justify-center text-center px-4">
                            <i class="fa-solid fa-map-location-dot text-4xl text-stone-300 mb-3"></i>
                            <p class="text-sm text-stone-500">Belum ada destinasi terdaftar.</p>
                            <p class="text-xs text-stone-400 mt-1">Tambahkan data melalui menu di sidebar.</p>
                        </div>
                    </div>
                </div>

                <div id="section-manager" class="hidden grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 h-fit sticky top-24">
                        <h3 id="form-title" class="font-display text-lg font-semibold text-stone-800 mb-4">Tambah Data
                        </h3>
                        <form id="destinationForm" class="space-y-4">
                            <input type="hidden" id="current-menu-ctx" value="">
                            <div>
                                <label class="block text-sm font-medium text-stone-700 mb-1">Nama Lokasi /
                                    Tempat</label>
                                <input type="text" id="name" required
                                    class="w-full border border-stone-300 rounded-xl p-2.5 focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm"
                                    placeholder="Contoh: Pura Tanah Lot">
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-sm font-medium text-stone-700 mb-1">Latitude (GPS)</label>
                                    <input type="number" step="any" id="lat" required
                                        class="w-full border border-stone-300 rounded-xl p-2.5 focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm"
                                        placeholder="-8.6212">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-stone-700 mb-1">Longitude (GPS)</label>
                                    <input type="number" step="any" id="lng" required
                                        class="w-full border border-stone-300 rounded-xl p-2.5 focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm"
                                        placeholder="115.0868">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-stone-700 mb-1">Klasifikasi Kelas
                                    Biaya</label>
                                <div class="grid grid-cols-3 gap-2">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="price" value="Murah" checked class="peer sr-only">
                                        <div
                                            class="peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:border-indigo-600 peer-checked:shadow-md border-2 border-stone-200 rounded-xl p-2.5 text-center text-xs font-semibold text-stone-600 transition-all hover:border-indigo-300">
                                            $ Murah
                                        </div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="price" value="Cukup" class="peer sr-only">
                                        <div
                                            class="peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:border-indigo-600 peer-checked:shadow-md border-2 border-stone-200 rounded-xl p-2.5 text-center text-xs font-semibold text-stone-600 transition-all hover:border-indigo-300">
                                            $$ Cukup
                                        </div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="price" value="Mahal" class="peer sr-only">
                                        <div
                                            class="peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:border-indigo-600 peer-checked:shadow-md border-2 border-stone-200 rounded-xl p-2.5 text-center text-xs font-semibold text-stone-600 transition-all hover:border-indigo-300">
                                            $$$ Mahal
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <button type="submit"
                                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium p-3 rounded-xl transition shadow-md flex items-center justify-center space-x-2">
                                <i class="fa-solid fa-cloud-arrow-up"></i><span>Push ke Database</span>
                            </button>
                        </form>
                    </div>

                    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-stone-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 id="table-title" class="font-display text-lg font-semibold text-stone-800">Daftar Item
                            </h3>
                            <span id="counter-badge"
                                class="bg-indigo-100 text-indigo-800 text-xs font-bold px-2.5 py-1 rounded-full">0
                                Records</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr
                                        class="border-b border-stone-200 text-stone-400 text-xs font-semibold uppercase bg-stone-50">
                                        <th class="p-3">Nama Lokasi</th>
                                        <th class="p-3">Koordinat Geo-GPS</th>
                                        <th class="p-3">Level Biaya</th>
                                        <th class="p-3 text-center">Aksi DB</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody" class="text-stone-600 text-sm divide-y divide-stone-100"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        (function () {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const toggleBtn = document.getElementById('sidebarToggleBtn');
            const closeBtn = document.getElementById('sidebarCloseBtn');

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }

            toggleBtn?.addEventListener('click', () => {
                sidebar.classList.contains('-translate-x-full') ? openSidebar() : closeSidebar();
            });
            closeBtn?.addEventListener('click', closeSidebar);
            overlay?.addEventListener('click', closeSidebar);

            document.querySelectorAll('#sidebar-nav button').forEach((btn) => {
                btn.addEventListener('click', () => {
                    if (window.innerWidth < 768) closeSidebar();
                });
            });
        })();
    </script>
</body>

</html>