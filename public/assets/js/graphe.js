//2eme graphe dans le dashbord administration :

const datastR = window.stresp ;
  var options = {
    series: [datastR.statiResp*20],
    chart: {
      height: 350,
      type: 'radialBar',
    },
    plotOptions: {
      radialBar: {
        hollow: {
          size: '70%',
        }
      },
    },
    labels: ['Charge Adminstration '],
    colors: ['#001253'], // Spécification de la couleur de la barre radiale
  };

  var chart = new ApexCharts(document.querySelector(".grapheee"), options);
  chart.render();




  var options = {
    series: [{
        name: "Desktops",
        data: [10, 23, 22, 52, 62, 88, 90, 100, 115]
      },
      {
        name: "Mobile",
        data: [20, 23, 30, 35, 40, 45, 50, 35, ], // Données pour la deuxième courbe
        color: '#48A6A7' // Couleur verte
      }
    ],
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
      text: 'Activation du logiciel',
      align: 'left'
    },
    grid: {
      row: {
        colors: ['#f3f3f3', 'transparent'], // Prend un tableau qui se répétera sur les colonnes
        opacity: 0.5
      },
    },
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
    }
  };

  var chart = new ApexCharts(document.querySelector("#graphe"), options);
  chart.render();
