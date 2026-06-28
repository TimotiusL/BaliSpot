import { getSession } from "./auth";
import { getDestinations, saveDestinations } from "./storage";

const session = getSession();

if (!session || session.role !== "admin") {
    window.location.href = "/";
}

function logout() {
    localStorage.removeItem("balispot_session");
    window.location = "/";
}

let globalDatabase = getDestinations();

const CATEGORY_STYLE = {
    Wisata: { color: "#2563eb", icon: "fa-compass" },
    Kuliner: { color: "#d97706", icon: "fa-utensils" },
    Hotel: { color: "#059669", icon: "fa-bed" },
    Ibadah: { color: "#7c3aed", icon: "fa-place-of-worship" },
};

let densityMap, markersLayer;

function initDensityMap() {
    densityMap = L.map("densityMap", { attributionControl: false }).setView(
        [-8.55, 115.22],
        11,
    );
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 18,
    }).addTo(densityMap);
    markersLayer = L.layerGroup().addTo(densityMap);
}

function renderDensityMap() {
    const mapEl = document.getElementById("densityMap");
    const emptyEl = document.getElementById("densityMapEmpty");
    if (!mapEl) return;

    if (globalDatabase.length === 0) {
        mapEl.classList.add("hidden");
        emptyEl.classList.remove("hidden");
        return;
    }
    mapEl.classList.remove("hidden");
    emptyEl.classList.add("hidden");

    if (!densityMap) initDensityMap();
    markersLayer.clearLayers();

    globalDatabase.forEach((item) => {

        if (isNaN(item.lat) || isNaN(item.lng)) return;

        const style = CATEGORY_STYLE[item.category] || {
            color: "#475569",
            icon: "fa-location-dot",
        };

        const icon = L.divIcon({
            html: `<div style="background:${style.color}" class="w-8 h-8 rounded-full flex items-center justify-center shadow-md border-2 border-white">
                <i class="fa-solid ${style.icon} text-white text-xs"></i>
               </div>`,
            iconSize: [32, 32],
            iconAnchor: [16, 16],
        });

        L.marker([item.lat, item.lng], { icon })
            .bindPopup(`<b>${item.name}</b><br>${item.category} · ${item.price}`)
            .addTo(markersLayer);
    });

    setTimeout(() => densityMap.invalidateSize(), 100);
}

window.onload = function () {
    updateDashboardStats();
    renderDensityMap();
};

function switchMenu(menu) {
    const nav = document.getElementById("sidebar-nav");
    nav.querySelectorAll("button").forEach((btn) => {
        btn.className =
            "w-full flex items-center space-x-3 hover:bg-indigo-900 p-3 rounded-lg font-medium transition text-indigo-200 hover:text-white text-left";
    });

    document.getElementById(`btn-${menu}`).className =
        "w-full flex items-center space-x-3 bg-indigo-800 text-white p-3 rounded-lg font-medium transition text-left shadow-inner";

    const dashSec = document.getElementById("section-dashboard");
    const mgrSec = document.getElementById("section-manager");

    if (menu === "dashboard") {
        dashSec.classList.remove("hidden");
        mgrSec.classList.add("hidden");
        document.getElementById("page-title").innerText =
            "Ringkasan Sistem & Data";
        updateDashboardStats();
        renderDensityMap();
    } else {
        dashSec.classList.add("hidden");
        mgrSec.classList.remove("hidden");

        document.getElementById("page-title").innerText =
            `Manajemen Konten: ${menu}`;
        document.getElementById("form-title").innerText =
            `Tambah Data ${menu} Baru`;
        document.getElementById("table-title").innerText =
            `Database Record Master: ${menu}`;
        document.getElementById("current-menu-ctx").value = menu;

        renderTableData(menu);
    }
}

function updateDashboardStats() {
    const count = (cat) =>
        globalDatabase.filter((item) => item.category === cat).length;
    document.getElementById("stat-wisata").innerText = count("Wisata");
    document.getElementById("stat-kuliner").innerText = count("Kuliner");
    document.getElementById("stat-hotel").innerText = count("Hotel");
    document.getElementById("stat-ibadah").innerText = count("Ibadah");
}

function renderTableData(categoryFilter) {
    const tableBody = document.getElementById("tableBody");
    tableBody.innerHTML = "";

    const filteredData = globalDatabase.filter(
        (item) => item.category === categoryFilter,
    );
    document.getElementById("counter-badge").innerText =
        `${filteredData.length} Records Terbaca`;

    if (filteredData.length === 0) {
        tableBody.innerHTML = `<tr><td colspan="4" class="p-8 text-center text-gray-400 italic font-mono">Belum ada data di cluster ${categoryFilter}. Silakan input baru.</td></tr>`;
        return;
    }

    filteredData.forEach((item) => {
        let priceBadge = "";
        if (item.price === "Murah")
            priceBadge =
                '<span class="bg-green-100 text-green-700 px-2.5 py-0.5 rounded-full text-xs font-semibold">$ Murah</span>';
        else if (item.price === "Cukup")
            priceBadge =
                '<span class="bg-yellow-100 text-yellow-700 px-2.5 py-0.5 rounded-full text-xs font-semibold">$$ Cukup</span>';
        else
            priceBadge =
                '<span class="bg-red-100 text-red-700 px-2.5 py-0.5 rounded-full text-xs font-semibold">$$$ Mahal</span>';

        const row = document.createElement("tr");
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

const form = document.getElementById("destinationForm");
if (form) {
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const currentMenu = document.getElementById("current-menu-ctx").value;
        const nameInput = document.getElementById("name").value;
        const latInput = parseFloat(document.getElementById("lat").value);
        const lngInput = parseFloat(document.getElementById("lng").value);
        const priceInput = document.querySelector(
            'input[name="price"]:checked',
        ).value;

        const newPayload = {
            id: Date.now(),
            name: nameInput,
            category: currentMenu,
            lat: latInput,
            lng: lngInput,
            price: priceInput,
        };

        globalDatabase.push(newPayload);

        saveDestinations(globalDatabase);

        updateDashboardStats();
        renderTableData(currentMenu);
        renderDensityMap();

        document.getElementById("destinationForm").reset();
    });
}

function deleteData(id) {
    if (
        confirm(
            "Apakah Anda yakin ingin menghapus data ini dari Database Produksi?",
        )
    ) {
        const currentMenu = document.getElementById("current-menu-ctx").value;

        globalDatabase = globalDatabase.filter(item => item.id !== id);

        saveDestinations(globalDatabase);

        updateDashboardStats();
        renderTableData(currentMenu);
        renderDensityMap();
    }
}

window.switchMenu = switchMenu;
window.deleteData = deleteData;
window.logout = logout;
