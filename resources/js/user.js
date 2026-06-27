import { getSession } from "./auth";

const session = getSession();

if (!session || session.role !== "user") {
    window.location.href = "/";
}

const baliSpotData = [
    { id: 1, name: "Pura Uluwatu", category: "Wisata", lat: -8.8291, lng: 115.0849, price: "Murah", desc: "Pertunjukan Tari Kecak di atas tebing laut." },
    { id: 2, name: "Beach Club Atlas Canggu", category: "Wisata", lat: -8.6592, lng: 115.1301, price: "Mahal", desc: "Beach club terbesar di dunia dengan kolam mewah." },
    { id: 3, name: "Warung Nasi Ayam Ibu Mangku", category: "Kuliner", lat: -8.4921, lng: 115.2512, price: "Murah", desc: "Kuliner ayam suwir khas Ubud legendaris." },
    { id: 4, name: "Locavore Restaurant Ubud", category: "Kuliner", lat: -8.5067, lng: 115.2624, price: "Mahal", desc: "Fine dining mewah berbahan organik lokal Bali." },
    { id: 5, name: "Ayana Resort & Spa Bali", category: "Hotel", lat: -8.7662, lng: 115.1489, price: "Mahal", desc: "Resort mewah tebing dengan pemandangan Rock Bar." },
    { id: 6, name: "Indah Homestay Kuta", category: "Hotel", lat: -8.7224, lng: 115.1714, price: "Murah", desc: "Penginapan bersih, cocok untuk para backpacker." },
    { id: 7, name: "Masjid Agung As-Su'ada Denpasar", category: "Ibadah", lat: -8.6573, lng: 115.2124, price: "Murah", desc: "Masjid ramah musafir di pusat kota Denpasar." },
    { id: 8, name: "Pura Besakih Grand Temple", category: "Ibadah", lat: -8.3739, lng: 115.4517, price: "Murah", desc: "Ibunya seluruh pura Hindu di lereng Gunung Agung." }
];

let userLatitude = -8.7172; 
let userLongitude = 115.1686;
let activeCategory = 'Wisata';
let activeBudgetFilter = null;

window.onload = function () {
    getGPSLocation(); 
};

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

function calculateHaversineDistance(lat1, lon1, lat2, lon2) {
    const R = 6371; 
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLon = (lon2 - lon1) * Math.PI / 180;
    const a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * Math.sin(dLon / 2) * Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return R * c; 
}

function processAndDisplayDestinations() {
    const container = document.getElementById('places-container');
    container.innerHTML = ""; 

    let processedList = baliSpotData.map(place => {
        let distance = calculateHaversineDistance(userLatitude, userLongitude, place.lat, place.lng);
        return { ...place, distance: distance };
    });

    processedList = processedList.filter(place => place.category === activeCategory);
    if (activeBudgetFilter) {
        processedList = processedList.filter(place => place.price === activeBudgetFilter);
    }

    processedList.sort((a, b) => a.distance - b.distance);

    document.getElementById('total-found').innerText = `${processedList.length} ditemukan`;

    if (processedList.length === 0) {
        container.innerHTML = `
                    <div class="p-8 text-center text-gray-400 bg-white border rounded-2xl">
                        <i class="fa-solid fa-folder-open text-3xl mb-2 text-gray-300"></i>
                        <p class="text-sm">Maaf, kategori budget ini belum tersedia untuk area terdekat Anda.</p>
                    </div>`;
        return;
    }

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

function switchCategory(category) {
    activeCategory = category;
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

function setBudgetFilter(budget) {
    if (activeBudgetFilter === budget) {
        activeBudgetFilter = null; 
        document.getElementById(`btn-b-${budget}`).className = "border border-gray-200 bg-white py-2 rounded-xl text-sm font-semibold text-gray-600 shadow-sm transition";
    } else {
        document.querySelectorAll('.filter-budget-btn').forEach(btn => {
            btn.className = "filter-budget-btn border border-gray-200 bg-white py-2 rounded-xl text-sm font-semibold text-gray-600 shadow-sm transition";
        });
        activeBudgetFilter = budget;
        let activeStyle = budget === 'Murah' ? 'bg-green-600 text-white border-green-600' : budget === 'Cukup' ? 'bg-yellow-500 text-white border-yellow-500' : 'bg-red-600 text-white border-red-600';
        document.getElementById(`btn-b-${budget}`).className = `${activeStyle} py-2 rounded-xl text-sm font-bold shadow-md transition`;
    }
    processAndDisplayDestinations();
}

window.getGPSLocation = getGPSLocation;
window.switchCategory = switchCategory;
window.setBudgetFilter = setBudgetFilter;