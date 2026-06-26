import { ADMIN, getUsers, saveSession, getSession } from "./auth";

const form = document.getElementById("loginForm");

// Hanya jalankan jika memang berada di halaman login
if (form) {

    const session = getSession();

    if (session) {
        window.location.href = session.role === "admin" ? "/admin" : "/home";
    }

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        const username = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value.trim();

        if (username === ADMIN.username && password === ADMIN.password) {

            saveSession({
                role: "admin",
                username: "admin"
            });

            window.location.href = "/admin";
            return;
        }

        const user = getUsers().find(u =>
            u.username === username &&
            u.password === password
        );

        if (user) {

            saveSession({
                role: "user",
                username: user.username,
                name: user.name
            });

            window.location.href = "/home";

        } else {

            alert("Username atau password salah!");

        }

    });
}