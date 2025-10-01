// Leaflet Map
var map = L.map('map').setView([19.0760, 72.8777], 10); // Mumbai default
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '© OpenStreetMap'
}).addTo(map);

// Chart.js Temperature Dummy Data
const ctx = document.getElementById('tempChart').getContext('2d');
const tempChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
    datasets: [{
      label: 'Temperature (°C)',
      data: [28, 30, 32, 31, 29],
      borderColor: 'blue',
      backgroundColor: 'rgba(0,0,255,0.1)'
    }]
  },
  options: {
    responsive: true,
    scales: {
      y: {
        beginAtZero: false
      }
    }
  }
});

