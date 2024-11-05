
function sendLocation() {
    console.log("location")
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => {
            const { latitude, longitude } = position.coords;
            sendToAdmin(latitude, longitude);
            initializeMap(latitude, longitude);
        }, error => {
            console.error('Error getting location:', error);
        });
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function sendToAdmin(latitude, longitude) {
    let xhttp= new XMLHttpRequest()
    xhttp.open('POST', 'connections/emergency.php?latitude='+latitude+'&&longitude='+longitude, true)
    xhttp.send()
    xhttp.onreadystatechange=function (){
        if(this.readyState==4 && this.status==200){
            console.log(this.response)
        }
    }
    // Implement your logic to send the location to the admin (e.g., via an API call)
    console.log(`Sending location to admin: Latitude: ${latitude}, Longitude: ${longitude}`);
}
const sendLocationButton = document.getElementById('sendLocationButton');
sendLocationButton.addEventListener('click', sendLocation);
