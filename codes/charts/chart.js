document.addEventListener('DOMContentLoaded', function() {
  let  analytics=localStorage.getItem("analytics")
  analytics=JSON.parse(analytics)
   
    // Health Status Chart
    const healthStatusCtx = document.getElementById('healthStatusChart').getContext('2d');
    const healthStatusChart = new Chart(healthStatusCtx, {
        type: 'pie',
        data: {
            labels: ['Healthy', 'Unhealthy'],
            datasets: [{
                label: 'Patient Health Status',
                data: [analytics[0].healthy, analytics[0].unhealthy], // Example data
                backgroundColor: ['#4caf50', '#f44336'],
                borderColor: ['#388e3c', '#d32f2f'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                        }
                    }
                }
            }
        }
    });

    // Gender Distribution Chart
    const genderCtx = document.getElementById('genderChart').getContext('2d');
    const genderChart = new Chart(genderCtx, {
        type: 'bar',
        data: {
            labels: ['Male', 'Female'],
            datasets: [{
                label: 'Number of Patients',
                data: [analytics[1].no_of_male, analytics[1].no_of_female], // Example data
                backgroundColor: ['#2196f3', '#e91e63'],
                borderColor: ['#1976d2', '#c2185b'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});

