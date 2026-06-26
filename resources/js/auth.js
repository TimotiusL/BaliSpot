const ADMIN = {
    username: "admin",
    password: "admin123"
};

export function getUsers() {
    return JSON.parse(localStorage.getItem("balispot_users")) || [];
}

export function saveUsers(users) {
    localStorage.setItem("balispot_users", JSON.stringify(users));
}

export function getSession() {
    return JSON.parse(localStorage.getItem("balispot_session"));
}

export function saveSession(session) {
    localStorage.setItem("balispot_session", JSON.stringify(session));
}

export function logout() {
    localStorage.removeItem("balispot_session");
}



export { ADMIN };