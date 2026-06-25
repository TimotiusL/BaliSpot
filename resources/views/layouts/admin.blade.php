<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BaliSpot Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .active-menu {
            @apply bg-indigo-800 text-white;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">

    <div class="flex h-screen overflow-hidden">
        <div class="w-64 bg-indigo-950 text-white flex flex-col justify-between hidden md:flex z-10 shadow-xl">
            <div class="p-5">
                <h1 class="text-2xl font-bold tracking-wider mb-8 flex items-center">
                    <i class="fa-solid fa-map-location-dot mr-3 text-emerald-400"></i>BaliSpot <span
                        class="text-xs bg-emerald-500 text-black px-1.5 py-0.5 rounded ml-2 font-mono">v1.0</span>
                </h1>
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
                        <p class="text-xs text-emerald-400 flex items-center"><span
                                class="w-2 h-2 bg-emerald-400 rounded-full mr-1.5 animate-pulse"></span>Database
                            Connected</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 flex flex-col overflow-y-auto">
            <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center sticky top-0 z-20">
                <div class="flex items-center space-x-4">
                    <button class="md:hidden text-gray-600"><i class="fa-solid fa-bars text-xl"></i></button>
                    <h2 id="page-title" class="text-xl font-bold text-gray-800">Ringkasan Sistem & Data</h2>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-gray-100 px-3 py-1.5 rounded-lg text-xs font-mono text-gray-600 shadow-sm">
                        <i class="fa-solid fa-database text-emerald-500 mr-1.5"></i>Prototype Mode
                    </div>
                    <span class="text-sm text-gray-500 font-medium">Juni 2026</span>
                </div>
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
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Peta Kepadatan Destinasi Terdaftar</h3>
                        <p class="text-sm text-gray-400 mb-4">Simulasi koordinat geografis cluster pariwisata Bali
                            (Denpasar, Badung, Gianyar).</p>
                        <div
                            class="bg-slate-900 h-64 rounded-xl flex items-center justify-center text-gray-500 relative overflow-hidden border border-slate-800">
                            <div
                                class="absolute inset-0 bg-[radial-gradient(#334155_1px,transparent_1px)] [background-size:16px_16px] opacity-40">
                            </div>
                            <div class="text-center z-10">
                                <i class="fa-solid fa-map-marked-alt text-4xl text-indigo-400 mb-2 animate-bounce"></i>
                                <p class="text-sm text-gray-300 font-mono">GPS Map Node System Operational</p>
                                <p class="text-xs text-gray-500 mt-1">Ready to link with Leaflet.js or Google Maps SDK
                                </p>
                            </div>
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
    <!-- ===========================
     Javascript Prototype
=========================== -->
    <script>
        // MOCK DATABASE / DATA STORE (Sebelum disambungkan ke Real API PostgreSQL/Firebase Anda)
        let globalDatabase = [
            { id: 1, name: "Pura Uluwatu", category: "Wisata", lat: -8.8291, lng: 115.0849, price: "Murah" },
            { id: 2, name: "Beach Club Atlas Canggu", category: "Wisata", lat: -8.6592, lng: 115.1301, price: "Mahal" },
            { id: 3, name: "Warung Nasi Ayam Kedewatan Ibu Mangku", category: "Kuliner", lat: -8.4921, lng: 115.2512, price: "Murah" },
            { id: 4, name: "Locavore Restaurant Ubud", category: "Kuliner", lat: -8.5067, lng: 115.2624, price: "Mahal" },
            { id: 5, name: "Ayana Resort & Spa Bali", category: "Hotel", lat: -8.7662, lng: 115.1489, price: "Mahal" },
            { id: 6, name: "Indah Homestay Kuta", category: "Hotel", lat: -8.7224, lng: 115.1714, price: "Murah" },
            { id: 7, name: "Masjid Agung As-Su'ada Denpasar", category: "Ibadah", lat: -8.6573, lng: 115.2124, price: "Murah" },
            { id: 8, name: "Pura Besakih Grand Temple", category: "Ibadah", lat: -8.3739, lng: 115.4517, price: "Murah" }
        ];

        // RUN AT STARTUP
        window.onload = function () {
            updateDashboardStats();
        };

        // NAVIGATION SYSTEM
        function switchMenu(menu) {
            // Reset active styles on Sidebar
            const nav = document.getElementById('sidebar-nav');
            nav.querySelectorAll('button').forEach(btn => {
                btn.className = "w-full flex items-center space-x-3 hover:bg-indigo-900 p-3 rounded-lg font-medium transition text-indigo-200 hover:text-white text-left";
            });

            // Set current active button
            document.getElementById(`btn-${menu}`).className = "w-full flex items-center space-x-3 bg-indigo-800 text-white p-3 rounded-lg font-medium transition text-left shadow-inner";

            // Component Sections DOM Layout
            const dashSec = document.getElementById('section-dashboard');
            const mgrSec = document.getElementById('section-manager');

            if (menu === 'dashboard') {
                dashSec.classList.remove('hidden');
                mgrSec.classList.add('hidden');
                document.getElementById('page-title').innerText = "Ringkasan Sistem & Data";
                updateDashboardStats();
            } else {
                dashSec.classList.add('hidden');
                mgrSec.classList.remove('hidden');

                // Set text contexts dynamically based on active menu
                document.getElementById('page-title').innerText = `Manajemen Konten: ${menu}`;
                document.getElementById('form-title').innerText = `Tambah Data ${menu} Baru`;
                document.getElementById('table-title').innerText = `Database Record Master: ${menu}`;
                document.getElementById('current-menu-ctx').value = menu;

                renderTableData(menu);
            }
        }

        // DATABASE VALUE COUNTER REFRESH
        function updateDashboardStats() {
            const count = (cat) => globalDatabase.filter(item => item.category === cat).length;
            document.getElementById('stat-wisata').innerText = count('Wisata');
            document.getElementById('stat-kuliner').innerText = count('Kuliner');
            document.getElementById('stat-hotel').innerText = count('Hotel');
            document.getElementById('stat-ibadah').innerText = count('Ibadah');
        }

        // RENDER DATA TABLE DYNAMICALLY
        function renderTableData(categoryFilter) {
            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = ""; // Clear

            // Filter data from our Data Store
            const filteredData = globalDatabase.filter(item => item.category === categoryFilter);
            document.getElementById('counter-badge').innerText = `${filteredData.length} Records Terbaca`;

            if (filteredData.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="4" class="p-8 text-center text-gray-400 italic font-mono">Belum ada data di cluster ${categoryFilter}. Silakan input baru.</td></tr>`;
                return;
            }

            filteredData.forEach(item => {
                let priceBadge = '';
                if (item.price === 'Murah') priceBadge = '<span class="bg-green-100 text-green-700 px-2.5 py-0.5 rounded-full text-xs font-semibold">$ Murah</span>';
                else if (item.price === 'Cukup') priceBadge = '<span class="bg-yellow-100 text-yellow-700 px-2.5 py-0.5 rounded-full text-xs font-semibold">$$ Cukup</span>';
                else priceBadge = '<span class="bg-red-100 text-red-700 px-2.5 py-0.5 rounded-full text-xs font-semibold">$$$ Mahal</span>';

                const row = document.createElement('tr');
                row.className = "hover:bg-slate-50 transition";
                row.innerHTML = `
                    <td class="p-3 font-semibold text-gray-800">${item.name}</td>
                    <td class="p-3 font-mono text-xs text-gray-500">${item.lat.toFixed(4)}, ${item.lng.toFixed(4)}</td>
                    <td class="p-3">${priceBadge}</td>
                    <td class="p-3 text-center">
                        <button class="bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white w-8 h-8 rounded-lg transition" onclick="deleteData(${item.id})">
                            <i class="fa-solid fa-trash-can text-xs"></i>
                        </button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        // WRITE / PUSH DATA ACTION SIMULATION
        document.getElementById('destinationForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const currentMenu = document.getElementById('current-menu-ctx').value;
            const nameInput = document.getElementById('name').value;
            const latInput = parseFloat(document.getElementById('lat').value);
            const lngInput = parseFloat(document.getElementById('lng').value);
            const priceInput = document.querySelector('input[name="price"]:checked').value;

            // Arsitektur Object payload sebelum dipush ke database API
            const newPayload = {
                id: Date.now(), // Generate ID unik sementara
                name: nameInput,
                category: currentMenu,
                lat: latInput,
                lng: lngInput,
                price: priceInput
            };

            /* =============================================================
               JIKA DATABASE ANDA SUDAH ADA, HUBUNGKAN DI SINI:
               =============================================================
               fetch('https://api.wisatabali.com/destinasi', {
                   method: 'POST',
                   headers: { 'Content-Type': 'application/json' },
                   body: JSON.stringify(newPayload)
               }).then(res => res.json()).then(() => { reload... })
            */

            globalDatabase.push(newPayload); // Masukkan ke data lokal browser
            renderTableData(currentMenu);     // Refresh tabel saat itu juga
            document.getElementById('destinationForm').reset(); // Reset form input
        });

        // DELETE DATA ACTION SIMULATION
        function deleteData(id) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini dari Database Produksi?")) {
                const currentMenu = document.getElementById('current-menu-ctx').value;

                // Simulasi delete API
                globalDatabase = globalDatabase.filter(item => item.id !== id);

                renderTableData(currentMenu);
            }
        }
    </script>
</body>

</html>