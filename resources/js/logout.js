import { logout } from "./auth";

const logoutBtn = document.getElementById("logoutBtn");

if (logoutBtn) {
    logoutBtn.addEventListener("click", () => {
        logout();
        
        setTimeout(() => {
            localStorage.clear();
            
            window.location.href = "/";
        }, 100);
    });
}