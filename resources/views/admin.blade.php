<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BaliSpot Admin</title>
    @vite(['resources/css/app.css', 'resources/js/admin.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>
    <style>
        .active-menu {
            @apply bg-indigo-800 text-white;
        }
        .leaflet-container,
        .leaflet-pane,
        .leaflet-control-container {
            z-index: 1 !important;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">

    <div class="flex h-screen overflow-hidden">

        <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-30 hidden md:hidden"></div>

        <div id="sidebar"
            class="w-64 bg-indigo-950 text-white flex flex-col justify-between fixed md:static inset-y-0 left-0 z-40 shadow-xl transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
            <div class="p-5">
                <div class="flex items-center justify-between mb-8">
                    <h1 class="text-2xl font-bold tracking-wider flex items-center">
                        <i class="fa-solid fa-map-location-dot mr-3 text-emerald-400"></i>BaliSpot
                    </h1>
                    <button id="sidebarCloseBtn" class="md:hidden text-indigo-300 hover:text-white text-xl">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <nav class="space-y-1" id="sidebar-nav">
                    <button onclick="switchMenu('dashboard')" id="btn-dashboard"
                        class="w-full flex items-center space-x-3 bg-indigo-800 p-3 rounded-lg font-medium transition text-left">
                        <i class="fa-solid fa-chart-pie w-5 text-indigo-300"></i><span>Ringkasan Data</span>
                    </button>
                    <button onclick="switchMenu('Wisata')" id="btn-Wisata"
                        class="w-full flex items-center space-x-3 hover:bg-indigo-900 p-3 rounded-lg font-medium transition text-indigo-200 hover:text-white text-left">
                        <i class="fa-solid fa-compass w-5 text-blue-400"></i><span>Tempat Wisata</span>
                    </button>
                    <button onclick="switchMenu('Kuliner')" id="btn-Kuliner"
                        class="w-full flex items-center space-x-3 hover:bg-indigo-900 p-3 rounded-lg font-medium transition text-indigo-200 hover:text-white text-left">
                        <i class="fa-solid fa-utensils w-5 text-amber-400"></i><span>Restoran & Cafe</span>
                    </button>
                    <button onclick="switchMenu('Hotel')" id="btn-Hotel"
                        class="w-full flex items-center space-x-3 hover:bg-indigo-900 p-3 rounded-lg font-medium transition text-indigo-200 hover:text-white text-left">
                        <i class="fa-solid fa-bed w-5 text-emerald-400"></i><span>Akomodasi / Hotel</span>
                    </button>
                    <button onclick="switchMenu('Ibadah')" id="btn-Ibadah"
                        class="w-full flex items-center space-x-3 hover:bg-indigo-900 p-3 rounded-lg font-medium transition text-indigo-200 hover:text-white text-left">
                        <i class="fa-solid fa-place-of-worship w-5 text-purple-400"></i><span>Rumah Ibadah</span>
                    </button>
                </nav>
            </div>
            <div class="p-5 border-t border-indigo-900 bg-indigo-950">
                <div class="flex items-center space-x-3">
                    <div
                        class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center font-bold text-indigo-950">
                        AD</div>
                    <div>
                        <p class="text-sm font-semibold">Admin BaliSpot</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 flex flex-col overflow-y-auto">
            <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center sticky top-0 z-20">
                <div class="flex items-center space-x-4">
                    <button id="sidebarToggleBtn" class="md:hidden text-gray-600"><i
                            class="fa-solid fa-bars text-xl"></i></button>
                    <h2 id="page-title" class="text-xl font-bold text-gray-800">Ringkasan Sistem & Data</h2>
                </div>
                <button id="logoutBtn" onclick="logout()"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-semibold transition flex items-center text-sm">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i>
                    <span class="hidden sm:inline">Logout</span>
                </button>
            </header>

            <main class="p-6 space-y-6">

                <div id="section-dashboard" class="space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between cursor-pointer"
                            onclick="switchMenu('Wisata')">
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Total Wisata</p>
                                <h3 id="stat-wisata" class="text-2xl font-bold text-gray-800 mt-1">0</h3>
                            </div>
                            <div
                                class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-xl">
                                <i class="fa-solid fa-compass"></i>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between cursor-pointer"
                            onclick="switchMenu('Kuliner')">
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Total Kuliner</p>
                                <h3 id="stat-kuliner" class="text-2xl font-bold text-gray-800 mt-1">0</h3>
                            </div>
                            <div
                                class="w-12 h-12 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center text-xl">
                                <i class="fa-solid fa-bowl-food"></i>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between cursor-pointer"
                            onclick="switchMenu('Hotel')">
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Total Hotel</p>
                                <h3 id="stat-hotel" class="text-2xl font-bold text-gray-800 mt-1">0</h3>
                            </div>
                            <div
                                class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center text-xl">
                                <i class="fa-solid fa-bed"></i>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between cursor-pointer"
                            onclick="switchMenu('Ibadah')">
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Rumah Ibadah</p>
                                <h3 id="stat-ibadah" class="text-2xl font-bold text-gray-800 mt-1">0</h3>
                            </div>
                            <div
                                class="w-12 h-12 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center text-xl">
                                <i class="fa-solid fa-place-of-worship"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">

                        <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                            <h3 class="text-lg font-semibold text-gray-800">
                                Peta Kepadatan Destinasi Terdaftar
                            </h3>

                            <div class="flex items-center gap-3 text-xs text-gray-500">
                                <span class="flex items-center gap-1">
                                    <span class="w-2.5 h-2.5 rounded-full bg-blue-600"></span>
                                    Wisata
                                </span>

                                <span class="flex items-center gap-1">
                                    <span class="w-2.5 h-2.5 rounded-full bg-amber-600"></span>
                                    Kuliner
                                </span>

                                <span class="flex items-center gap-1">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span>
                                    Hotel
                                </span>

                                <span class="flex items-center gap-1">
                                    <span class="w-2.5 h-2.5 rounded-full bg-purple-600"></span>
                                    Ibadah
                                </span>
                            </div>
                        </div>

                        <p class="text-sm text-gray-400 mb-4">
                            Visualisasi koordinat GPS seluruh destinasi yang terdaftar
                            (cluster Denpasar, Badung, Gianyar).
                        </p>

                        <!-- Map -->
                        <div id="densityMap" class="w-full h-[420px] rounded-xl border border-gray-200 overflow-hidden">
                        </div>

                        <!-- Empty State -->
                        <div id="densityMapEmpty"
                            class="hidden w-full h-[420px] rounded-xl border border-gray-200 bg-gray-50 flex flex-col items-center justify-center text-center px-4">

                            <i class="fa-solid fa-map-location-dot text-4xl text-gray-300 mb-3"></i>

                            <p class="text-sm text-gray-500">
                                Belum ada destinasi terdaftar.
                            </p>

                            <p class="text-xs text-gray-400 mt-1">
                                Tambahkan data melalui menu di sidebar.
                            </p>

                        </div>

                    </div>
                </div>

                <div id="section-manager" class="hidden grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 h-fit sticky top-24">
                        <h3 id="form-title" class="text-lg font-semibold text-gray-800 mb-4">Tambah Data</h3>
                        <form id="destinationForm" class="space-y-4">
                            <input type="hidden" id="current-menu-ctx" value="">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lokasi / Tempat</label>
                                <input type="text" id="name" required
                                    class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm"
                                    placeholder="Contoh: Pura Tanah Lot">
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Latitude (GPS)</label>
                                    <input type="number" step="any" id="lat" required
                                        class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm"
                                        placeholder="-8.6212">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Longitude (GPS)</label>
                                    <input type="number" step="any" id="lng" required
                                        class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm"
                                        placeholder="115.0868">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Klasifikasi Kelas
                                    Biaya</label>
                                <div class="grid grid-cols-3 gap-2">
                                    <label
                                        class="flex items-center justify-center border border-gray-200 rounded-lg p-2.5 cursor-pointer hover:bg-gray-50 text-sm font-medium">
                                        <input type="radio" name="price" value="Murah" checked
                                            class="mr-2 text-indigo-600 focus:ring-indigo-500"> $ Murah
                                    </label>
                                    <label
                                        class="flex items-center justify-center border border-gray-200 rounded-lg p-2.5 cursor-pointer hover:bg-gray-50 text-sm font-medium">
                                        <input type="radio" name="price" value="Cukup"
                                            class="mr-2 text-indigo-600 focus:ring-indigo-500"> $$ Cukup
                                    </label>
                                    <label
                                        class="flex items-center justify-center border border-gray-200 rounded-lg p-2.5 cursor-pointer hover:bg-gray-50 text-sm font-medium">
                                        <input type="radio" name="price" value="Mahal"
                                            class="mr-2 text-indigo-600 focus:ring-indigo-500"> $$$ Mahal
                                    </label>
                                </div>
                            </div>
                            <button type="submit"
                                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium p-2.5 rounded-lg transition shadow-md flex items-center justify-center space-x-2">
                                <i class="fa-solid fa-cloud-arrow-up"></i><span>Push ke Database</span>
                            </button>
                        </form>
                    </div>

                    <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 id="table-title" class="text-lg font-semibold text-gray-800">Daftar Item</h3>
                            <span id="counter-badge"
                                class="bg-indigo-100 text-indigo-800 text-xs font-bold px-2.5 py-1 rounded-full">0
                                Records</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr
                                        class="border-b border-gray-200 text-gray-400 text-xs font-semibold uppercase bg-gray-50">
                                        <th class="p-3">Nama Lokasi</th>
                                        <th class="p-3">Koordinat Geo-GPS</th>
                                        <th class="p-3">Level Biaya</th>
                                        <th class="p-3 text-center">Aksi DB</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody" class="text-gray-600 text-sm divide-y divide-gray-100">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        (function() {
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