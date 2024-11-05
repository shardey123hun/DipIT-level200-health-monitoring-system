const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const context = canvas.getContext('2d');
const heartRateDisplay = document.getElementById('heartRate');
const startButton = document.getElementById('startButton');
const sendLocationButton = document.getElementById('sendLocationButton');
const heartRateChartElement = document.getElementById('heartRateChart');
let front=false
let frameData = [];
let intervalId = null;
let map, userMarker;
let heartRateChart, heartRateData = [];

startButton.addEventListener('click', () => {
    if (!intervalId) {
        startMonitoring();
        startButton.textContent = "Stop Monitoring";
    } else {
        stopMonitoring();
        startButton.textContent = "Start Monitoring";
    }
});

sendLocationButton.addEventListener('click', sendLocation);

async function startMonitoring() {
    await startVideoStream();
    intervalId = setInterval(captureFrame, 100); // Capture frame every 100ms
    initializeChart();
}

function stopMonitoring() {
    clearInterval(intervalId);
    intervalId = null;
}

async function startVideoStream() {
    try {
        if(front==true){
            const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: "user" } });
            video.srcObject = stream;
        }else {
            const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } });
            video.srcObject = stream;
        }
    } catch (error) {
        console.error('Error accessing webcam:', error);
    }
}

function captureFrame() {
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    const frame = context.getImageData(0, 0, canvas.width, canvas.height).data;
    analyzeFrame(frame);
}

function analyzeFrame(frame) {
    const avgRed = getAverageRed(frame);
    frameData.push(avgRed);

    if (frameData.length > 300) { // Analyze the last 30 seconds (assuming 10 frames per second)
        frameData.shift(); // Remove the oldest frame data
        const heartRate = calculateHeartRate(frameData);
        heartRateDisplay.textContent = `Heart Rate: ${heartRate} bpm`;
        updateChart(heartRate);
    }
}

function getAverageRed(frame) {
    let sum = 0;
    let count = 0;

    for (let i = 0; i < frame.length; i += 4) {
        sum += frame[i]; // Red channel
        count++;
    }

    return sum / count;
}

function calculateHeartRate(data) {
    const windowSize = 5; // Size of the smoothing window
    const smoothedData = smoothData(data, windowSize);
    const threshold = Math.max(...smoothedData) * 0.6; // Dynamic threshold based on data

    const peaks = findPeaks(smoothedData, threshold);
    const peakIntervals = [];

    for (let i = 1; i < peaks.length; i++) {
        peakIntervals.push(peaks[i] - peaks[i - 1]);
    }

    const avgInterval = peakIntervals.reduce((sum, interval) => sum + interval, 0) / peakIntervals.length;
    const heartRate = 60000 / (avgInterval * 100); // Convert to beats per minute (bpm)
    return Math.round(heartRate);
}

function smoothData(data, windowSize) {
    const smoothed = [];
    for (let i = 0; i < data.length; i++) {
        let sum = 0;
        let count = 0;
        for (let j = i - Math.floor(windowSize / 2); j <= i + Math.floor(windowSize / 2); j++) {
            if (j >= 0 && j < data.length) {
                sum += data[j];
                count++;
            }
        }
        smoothed.push(sum / count);
    }
    return smoothed;
}

function findPeaks(data, threshold) {
    const peaks = [];
    for (let i = 1; i < data.length - 1; i++) {
        if (data[i] > data[i - 1] && data[i] > data[i + 1] && data[i] > threshold) {
            peaks.push(i);
        }
    }
    return peaks;
}

function sendLocation() {
    switchcamera()
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
    // Implement your logic to send the location to the admin (e.g., via an API call)
    console.log(`Sending location to admin: Latitude: ${latitude}, Longitude: ${longitude}`);
}

function initializeMap(latitude, longitude) {
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

function initializeChart() {
    const ctx = heartRateChartElement.getContext('2d');
    heartRateChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: Array(300).fill(''), // Initial empty labels
            datasets: [{
                label: 'Heart Rate',
                data: [],
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                fill: false
            }]
        },
        options: {
            animation: false,
            scales: {
                x: {
                    display: false
                },
                y: {
                    beginAtZero: true,
                    max: 200
                }
            }
        }
    });
}

function updateChart(heartRate) {
    heartRateData.push(heartRate);
    if (heartRateData.length > 300) {
        heartRateData.shift(); // Keep the last 300 data points
    }

    heartRateChart.data.labels = heartRateData.map((_, index) => index); // Update labels
    heartRateChart.data.datasets[0].data = heartRateData; // Update data
    heartRateChart.update();
}
 
function switchcamera () {
   if(front){
        front=false
    }else{
        front=true
    }
   startMonitoring()
}