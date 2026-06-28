import defaultDestinations from "./data";

export function getDestinations() {

    let data = JSON.parse(
        localStorage.getItem("balispot_destinations")
    );

    if (!data) {

        localStorage.setItem(
            "balispot_destinations",
            JSON.stringify(defaultDestinations)
        );

        return defaultDestinations;
    }

    return data;
}

export function saveDestinations(data) {

    localStorage.setItem(
        "balispot_destinations",
        JSON.stringify(data)
    );

}