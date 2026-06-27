import { logout } from "./auth";

const logoutBtn = document.getElementById("logoutBtn");

if (logoutBtn) {
    logoutBtn.addEventListener("click", () => {
        logout();
        window.location.href = "/";
    });
}
