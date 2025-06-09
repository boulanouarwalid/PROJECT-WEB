
// premier diagramme pour service deparetement Admin statistique :

const data_envoyerBackend  = window.chartdata;

var options = {
    series: [data_envoyerBackend.informatique*10, data_envoyerBackend.physique*10, 13],
    chart: {
    width: 380,
    type: 'pie',
  },
  labels: ['infromatique', 'physique', 'Administration'],
  responsive: [{
    breakpoint: 480,
    options: {
      chart: {
        width: 200
      },
      legend: {
        position: 'bottom'
      }
    }
  }]
  };

  var chart = new ApexCharts(document.querySelector(".chart-placeholder"), options);
  chart.render();


// dexiemme diagramme pour statistique :

var options = {
    series: [{
      name: "Desktops",
      data: [10, 41, 35, 51, data_envoyerBackend.totalProf*15]
  }],
    chart: {
    height: 350,
    type: 'line',
    zoom: {
      enabled: false
    }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'straight'
  },
  title: {

    align: 'left'
  },
  grid: {
    row: {
      colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
      opacity: 0.5
    },
  },
  xaxis: {
    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
  }
  };

  var chart = new ApexCharts(document.querySelector(".charte-placeholder"), options);
  chart.render();


