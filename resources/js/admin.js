import { getSession } from "./auth";

const session = getSession();

if (!session || session.role !== "admin") {

    window.location.href = "/";

}


function logout() {

    localStorage.removeItem("balispot_session");

    window.location = "/";

}


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

window.onload = function () {
    updateDashboardStats();
};

function switchMenu(menu) {
    const nav = document.getElementById('sidebar-nav');
    nav.querySelectorAll('button').forEach(btn => {
        btn.className = "w-full flex items-center space-x-3 hover:bg-indigo-900 p-3 rounded-lg font-medium transition text-indigo-200 hover:text-white text-left";
    });

    document.getElementById(`btn-${menu}`).className = "w-full flex items-center space-x-3 bg-indigo-800 text-white p-3 rounded-lg font-medium transition text-left shadow-inner";

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

        document.getElementById('page-title').innerText = `Manajemen Konten: ${menu}`;
        document.getElementById('form-title').innerText = `Tambah Data ${menu} Baru`;
        document.getElementById('table-title').innerText = `Database Record Master: ${menu}`;
        document.getElementById('current-menu-ctx').value = menu;

        renderTableData(menu);
    }
}

function updateDashboardStats() {
    const count = (cat) => globalDatabase.filter(item => item.category === cat).length;
    document.getElementById('stat-wisata').innerText = count('Wisata');
    document.getElementById('stat-kuliner').innerText = count('Kuliner');
    document.getElementById('stat-hotel').innerText = count('Hotel');
    document.getElementById('stat-ibadah').innerText = count('Ibadah');
}

function renderTableData(categoryFilter) {
    const tableBody = document.getElementById('tableBody');
    tableBody.innerHTML = "";

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

document.getElementById('destinationForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const currentMenu = document.getElementById('current-menu-ctx').value;
    const nameInput = document.getElementById('name').value;
    const latInput = parseFloat(document.getElementById('lat').value);
    const lngInput = parseFloat(document.getElementById('lng').value);
    const priceInput = document.querySelector('input[name="price"]:checked').value;

    const newPayload = {
        id: Date.now(),
        name: nameInput,
        category: currentMenu,
        lat: latInput,
        lng: lngInput,
        price: priceInput
    };

    globalDatabase.push(newPayload);
    renderTableData(currentMenu);
    document.getElementById('destinationForm').reset();
});

function deleteData(id) {
    if (confirm("Apakah Anda yakin ingin menghapus data ini dari Database Produksi?")) {
        const currentMenu = document.getElementById('current-menu-ctx').value;

        globalDatabase = globalDatabase.filter(item => item.id !== id);

        renderTableData(currentMenu);
    }
}