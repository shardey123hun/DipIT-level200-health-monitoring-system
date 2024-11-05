function initializeMap(latitude, longitude) {
    let map, userMarker;
    latitude=Number(latitude)
    longitude=Number(longitude)
    console.log(latitude)
    if (!map) {
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: latitude, lng: longitude },
            zoom: 15
        });
        userMarker = new google.maps.Marker({
            position: { lat: latitude, lng: longitude },
            map: map,
            title: "User's Location"
        });
    } else {
        userMarker.setPosition({ lat: latitude, lng: longitude });
        map.setCenter({ lat: latitude, lng: longitude });
    }
}