<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BaliTour - Pemandu Wisata Pintar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans text-gray-800 max-w-md mx-auto min-h-screen flex flex-col shadow-2xl relative bg-white">

    <header class="bg-indigo-600 text-white p-5 rounded-b-3xl shadow-md sticky top-0 z-50">
        <div class="flex justify-between items-center mb-3">
            <h1 class="text-xl font-bold tracking-wide flex items-center">
                <i class="fa-solid fa-map-location-dot mr-2 text-emerald-400"></i>BaliTour Companion
            </h1>
            <button onclick="getGPSLocation()" class="bg-indigo-500 hover:bg-indigo-700 p-2 rounded-full transition text-xs flex items-center space-x-1">
                <i class="fa-solid fa-location-crosshairs animate-pulse text-emerald-400"></i>
                <span class="font-mono text-[10px]">Sync GPS</span>
            </button>
        </div>
        
        <div class="bg-indigo-700/50 p-3 rounded-xl text-xs flex items-center space-x-3 border border-indigo-500/30">
            <i class="fa-solid fa-street-view text-lg text-emerald-300"></i>
            <div>
                <p class="text-indigo-200 font-medium">Koordinat GPS Anda:</p>
                <p id="gps-status" class="font-mono text-white">Mendeteksi lokasi... (Pastikan GPS Aktif)</p>
            </div>
        </div>
    </header>

    <main class="p-4 flex-1 space-y-5 pb-24">
        
        <div class="space-y-2">
            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Filter Budget Wisata</label>
            <div class="grid grid-cols-3 gap-2">
                <button onclick="setBudgetFilter('Murah')" id="btn-b-Murah" class="filter-budget-btn border border-gray-200 bg-white py-2 rounded-xl text-sm font-semibold text-gray-600 shadow-sm transition">
                    $ Murah
                </button>
                <button onclick="setBudgetFilter('Cukup')" id="btn-b-Cukup" class="filter-budget-btn border border-gray-200 bg-white py-2 rounded-xl text-sm font-semibold text-gray-600 shadow-sm transition">
                    $$ Cukup
                </button>
                <button onclick="setBudgetFilter('Mahal')" id="btn-b-Mahal" class="filter-budget-btn border border-gray-200 bg-white py-2 rounded-xl text-sm font-semibold text-gray-600 shadow-sm transition">
                    $$$ Mahal
                </button>
            </div>
        </div>

        <div class="space-y-3">
            <div class="flex justify-between items-center">
                <h3 id="list-title" class="text-md font-bold text-gray-800 flex items-center">
                    <i class="fa-solid fa-wand-magic-sparkles text-indigo-500 mr-2"></i>Destinasi Terdekat Anda
                </h3>
                <span class="text-xs text-gray-400 font-medium" id="total-found">0 ditemukan</span>
            </div>

            <div id="places-container" class="space-y-3">
                <div class="p-6 text-center text-gray-400 font-medium text-sm">
                    <i class="fa-solid fa-circle-notch animate-spin text-2xl text-indigo-600 mb-2"></i>
                    <p>Menghitung koordinat terdekat dari posisi Anda...</p>
                </div>
            </div>
        </div>
    </main>

    <nav class="fixed bottom-0 left-0 right-0 max-w-md mx-auto bg-white border-t border-gray-100 grid grid-cols-4 py-2.5 px-2 shadow-[0_-4px_10px_rgba(0,0,0,0.05)] z-50">
        <button onclick="switchCategory('Wisata')" id="nav-Wisata" class="nav-item flex flex-col items-center space-y-1 text-indigo-600">
            <i class="fa-solid fa-compass text-lg"></i><span class="text-[10px] font-bold">Wisata</span>
        </button>
        <button onclick="switchCategory('Kuliner')" id="nav-Kuliner" class="nav-item flex flex-col items-center space-y-1 text-gray-400 hover:text-indigo-600">
            <i class="fa-solid fa-bowl-food text-lg"></i><span class="text-[10px] font-medium">Kuliner</span>
        </button>
        <button onclick="switchCategory('Hotel')" id="nav-Hotel" class="nav-item flex flex-col items-center space-y-1 text-gray-400 hover:text-indigo-600">
            <i class="fa-solid fa-bed text-lg"></i><span class="text-[10px] font-medium">Akomodasi</span>
        </button>
        <button onclick="switchCategory('Ibadah')" id="nav-Ibadah" class="nav-item flex flex-col items-center space-y-1 text-gray-400 hover:text-indigo-600">
            <i class="fa-solid fa-place-of-worship text-lg"></i><span class="text-[10px] font-medium">Ibadah</span>
        </button>
    </nav>

    <script>
        // DATA MASTER DESTINASI BALI (Sama dengan isi database dashboard)
        const destinationsDatabase = [
            { id: 1, name: "Pura Uluwatu", category: "Wisata", lat: -8.8291, lng: 115.0849, price: "Murah", desc: "Pertunjukan Tari Kecak di atas tebing laut." },
            { id: 2, name: "Beach Club Atlas Canggu", category: "Wisata", lat: -8.6592, lng: 115.1301, price: "Mahal", desc: "Beach club terbesar di dunia dengan kolam mewah." },
            { id: 3, name: "Warung Nasi Ayam Ibu Mangku", category: "Kuliner", lat: -8.4921, lng: 115.2512, price: "Murah", desc: "Kuliner ayam suwir khas Ubud legendaris." },
            { id: 4, name: "Locavore Restaurant Ubud", category: "Kuliner", lat: -8.5067, lng: 115.2624, price: "Mahal", desc: "Fine dining mewah berbahan organik lokal Bali." },
            { id: 5, name: "Ayana Resort & Spa Bali", category: "Hotel", lat: -8.7662, lng: 115.1489, price: "Mahal", desc: "Resort mewah tebing dengan pemandangan Rock Bar." },
            { id: 6, name: "Indah Homestay Kuta", category: "Hotel", lat: -8.7224, lng: 115.1714, price: "Murah", desc: "Penginapan bersih, cocok untuk para backpacker." },
            { id: 7, name: "Masjid Agung As-Su'ada Denpasar", category: "Ibadah", lat: -8.6573, lng: 115.2124, price: "Murah", desc: "Masjid ramah musafir di pusat kota Denpasar." },
            { id: 8, name: "Pura Besakih Grand Temple", category: "Ibadah", lat: -8.3739, lng: 115.4517, price: "Murah", desc: "Ibunya seluruh pura Hindu di lereng Gunung Agung." }
        ];

        // STATE UTAMA APLIKASI USER
        let userLatitude = -8.7172; // Default koordinat simulasi awal (Pantai Kuta)
        let userLongitude = 115.1686;
        let activeCategory = 'Wisata';
        let activeBudgetFilter = null;

        window.onload = function() {
            getGPSLocation(); // Langsung minta GPS saat aplikasi dibuka
        };

        // 1. FUNGSI OTOMATIS GPS DEVICE USER
        function getGPSLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        userLatitude = position.coords.latitude;
                        userLongitude = position.coords.longitude;
                        
                        document.getElementById('gps-status').innerHTML = 
                            `<span class="text-emerald-400 font-bold">Terdeteksi Akurat:</span> ${userLatitude.toFixed(4)}, ${userLongitude.toFixed(4)}`;
                        
                        processAndDisplayDestinations();
                    },
                    (error) => {
                        console.warn("GPS ditolak/gagal. Menggunakan mode simulasi lokasi (Kuta Bali).");
                        document.getElementById('gps-status').innerHTML = 
                            `<span class="text-yellow-400 font-bold">Simulasi Lokasi (Kuta):</span> ${userLatitude}, ${userLongitude}`;
                        processAndDisplayDestinations();
                    }
                );
            } else {
                alert("Browser HP Anda tidak mendukung sensor GPS Geolocation.");
            }
        }

        // 2. RUMUS HAVERSINE (Menghitung Jarak Garis Lengkung Bumi dalam KM)
        function calculateHaversineDistance(lat1, lon1, lat2, lon2) {
            const R = 6371; // Jari-jari bumi dalam Kilometer
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = 
                Math.sin(dLat/2) * Math.sin(dLat/2) +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * Math.sin(dLon/2) * Math.sin(dLon/2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
            return R * c; // Hasil akhir Jarak Jauh (KM)
        }

        // 3. FILTER, SORTING BERDASARKAN JARAK TERDEKAT, DAN TAMPILKAN
        function processAndDisplayDestinations() {
            const container = document.getElementById('places-container');
            container.innerHTML = ""; // Bersihkan list lamanya

            // Olah data: Hitung jarak dari posisi GPS user ke seluruh tempat
            let processedList = destinationsDatabase.map(place => {
                let distance = calculateHaversineDistance(userLatitude, userLongitude, place.lat, place.lng);
                return { ...place, distance: distance };
            });

            // Jalankan filter kategori menu bawah & budget filter atas
            processedList = processedList.filter(place => place.category === activeCategory);
            if (activeBudgetFilter) {
                processedList = processedList.filter(place => place.price === activeBudgetFilter);
            }

            // SORTING UTAMA: Urutkan dari yang nilainya terkecil (Paling Dekat) ke besar
            processedList.sort((a, b) => a.distance - b.distance);

            document.getElementById('total-found').innerText = `${processedList.length} ditemukan`;

            if(processedList.length === 0) {
                container.innerHTML = `
                    <div class="p-8 text-center text-gray-400 bg-white border rounded-2xl">
                        <i class="fa-solid fa-folder-open text-3xl mb-2 text-gray-300"></i>
                        <p class="text-sm">Maaf, kategori budget ini belum tersedia untuk area terdekat Anda.</p>
                    </div>`;
                return;
            }

            // Tampilkan data ke layar HP
            processedList.forEach(place => {
                let badgeColor = place.price === 'Murah' ? 'bg-green-50 text-green-700' : place.price === 'Cukup' ? 'bg-yellow-50 text-yellow-700' : 'bg-red-50 text-red-700';
                let currencySymbol = place.price === 'Murah' ? '$' : place.price === 'Cukup' ? '$$' : '$$$';

                const card = document.createElement('div');
                card.className = "bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex items-start justify-between space-x-3 hover:border-indigo-200 transition";
                card.innerHTML = `
                    <div class="flex-1">
                        <div class="flex items-center space-x-2 mb-1">
                            <span class="text-xs font-bold px-2 py-0.5 rounded-md ${badgeColor}">${currencySymbol} ${place.price}</span>
                            <span class="text-xs font-mono text-indigo-600 bg-indigo-50 px-1.5 py-0.5 rounded font-bold"><i class="fa-solid fa-location-dot mr-1"></i>${place.distance.toFixed(1)} KM</span>
                        </div>
                        <h4 class="font-bold text-gray-800 text-base">${place.name}</h4>
                        <p class="text-xs text-gray-500 mt-1 line-clamp-2">${place.desc}</p>
                    </div>
                    <a href="https://www.google.com/maps/search/?api=1&query=${place.lat},${place.lng}" target="_blank" class="bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white p-3 rounded-xl transition flex flex-col items-center self-center justify-center">
                        <i class="fa-solid fa-diamond-turn-right text-base"></i>
                        <span class="text-[9px] font-bold mt-1">Rute</span>
                    </a>
                `;
                container.appendChild(card);
            });
        }

        // INTERAKSI: Ganti Kategori Menu Bawah
        function switchCategory(category) {
            activeCategory = category;
            
            // Atur gaya desain tombol nav aktif
            document.querySelectorAll('.nav-item').forEach(btn => {
                btn.className = "nav-item flex flex-col items-center space-y-1 text-gray-400 hover:text-indigo-600";
                btn.querySelector('span').className = "text-[10px] font-medium";
            });
            const activeNav = document.getElementById(`nav-${category}`);
            activeNav.className = "nav-item flex flex-col items-center space-y-1 text-indigo-600";
            activeNav.querySelector('span').className = "text-[10px] font-bold";

            document.getElementById('list-title').innerHTML = `<i class="fa-solid fa-wand-magic-sparkles text-indigo-500 mr-2"></i>${category} Terdekat Anda`;
            processAndDisplayDestinations();
        }

        // INTERAKSI: Ganti Filter Kategori Biaya Atas
        function setBudgetFilter(budget) {
            if (activeBudgetFilter === budget) {
                activeBudgetFilter = null; // Uncheck jika diklik lagi
                document.getElementById(`btn-b-${budget}`).className = "border border-gray-200 bg-white py-2 rounded-xl text-sm font-semibold text-gray-600 shadow-sm transition";
            } else {
                // Reset semua tombol budget
                document.querySelectorAll('.filter-budget-btn').forEach(btn => {
                    btn.className = "filter-budget-btn border border-gray-200 bg-white py-2 rounded-xl text-sm font-semibold text-gray-600 shadow-sm transition";
                });
                activeBudgetFilter = budget;
                // Aktifkan tombol terpilih
                let activeStyle = budget === 'Murah' ? 'bg-green-600 text-white border-green-600' : budget === 'Cukup' ? 'bg-yellow-500 text-white border-yellow-500' : 'bg-red-600 text-white border-red-600';
                document.getElementById(`btn-b-${budget}`).className = `${activeStyle} py-2 rounded-xl text-sm font-bold shadow-md transition`;
            }
            processAndDisplayDestinations();
        }
    </script>
</body>
</html>