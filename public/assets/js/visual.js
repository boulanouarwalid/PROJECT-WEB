var options = {
  series: [{
    name: 'series1',
    data: [31, 40, 28, 51, 42, 109, 100]
  }, {
    name: 'series2',
    data: [11, 32, 45, 32, 34, 52, 41]
  }],
  chart: {
    height: 350,
    type: 'area',
    zoom: { enabled: false },
    toolbar: { show: false },
    animations: {
      enabled: true,
      easing: 'easeinout',
      speed: 800,
      animateGradually: { enabled: true, delay: 150 },
      dynamicAnimation: { enabled: true, speed: 350 }
    }
  },
  colors: ['#1E90FF', '#4F959D'], // bleu et tomate
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'smooth',
    width: 3,
    dashArray: [0, 4],  // La deuxième série en ligne pointillée
  },
  fill: {
    type: 'gradient',
    gradient: {
      shadeIntensity: 1,
      opacityFrom: 0.4,
      opacityTo: 0,
      stops: [0, 90, 100]
    }
  },
  markers: {
    size: 5,
    colors: ['#1E90FF', '#4F959D'],
    strokeColors: '#fff',
    strokeWidth: 2,
    hover: { size: 7 }
  },
  xaxis: {
    type: 'datetime',
    categories: [
      "2018-09-19T00:00:00.000Z",
      "2018-09-19T01:30:00.000Z",
      "2018-09-19T02:30:00.000Z",
      "2018-09-19T03:30:00.000Z",
      "2018-09-19T04:30:00.000Z",
      "2018-09-19T05:30:00.000Z",
      "2018-09-19T06:30:00.000Z"
    ],
    labels: {
      style: {
        colors: '#555',
        fontSize: '12px'
      }
    },
    axisBorder: { show: true, color: '#ccc' },
    axisTicks: { show: true, color: '#ccc' }
  },
  yaxis: {
    labels: {
      style: {
        colors: '#555',
        fontSize: '12px'
      }
    }
  },
  legend: {
    show: true,
    position: 'top',
    horizontalAlign: 'right',
    labels: { colors: '#555' },
    markers: {
      width: 12,
      height: 12,
      radius: 12
    }
  },
  tooltip: {
    x: { format: 'dd/MM/yy HH:mm' },
    theme: 'dark',
    marker: { show: true }
  }
};

var chart = new ApexCharts(document.querySelector("#graphe"), options);
chart.render();



// creation d'une autre graphe pour raporting :

var options = {
  series: [{
    name: 'filier',
    data: [31, 40, 28, 51, 42, 109, 100]
  }, {
    name: 'Ensinemant',
    data: [11, 32, 45, 32, 34, 52, 41]
  }],
  chart: {
    height: 350,
    type: 'area',
    background: '#f9fbfc',  // fond clair du chart
    dropShadow: {
      enabled: true,
      color: '#aaa',
      top: 5,
      left: 0,
      blur: 5,
      opacity: 0.1
    },
    toolbar: { show: false }
  },
  colors: ['#007bff', '#5459AC'],  // bleu et orange
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'smooth',
    width: [3, 4],
    dashArray: [0, 6]  // série2 en ligne pointillée
  },
  fill: {
    type: 'gradient',
    gradient: {
      shadeIntensity: 1,
      opacityFrom: 0.4,
      opacityTo: 0.1,
      stops: [0, 90, 100],
      colorStops: [
        { offset: 0, color: '#007bff', opacity: 0.4 },
        { offset: 100, color: '#007bff', opacity: 0 }
      ]
    }
  },
  xaxis: {
    type: 'datetime',
    categories: [
      "2018-09-19T00:00:00.000Z",
      "2018-09-19T01:30:00.000Z",
      "2018-09-19T02:30:00.000Z",
      "2018-09-19T03:30:00.000Z",
      "2018-09-19T04:30:00.000Z",
      "2018-09-19T05:30:00.000Z",
      "2018-09-19T06:30:00.000Z"
    ],
    axisBorder: { show: true, color: '#ccc' },
    axisTicks: { show: true, color: '#ccc' },
    labels: {
      style: { colors: '#666', fontSize: '12px' }
    }
  },
  tooltip: {
    x: {
      format: 'dd/MM/yy HH:mm'
    },
    theme: 'dark'
  },
  grid: {
    borderColor: '#e7e7e7',
    row: { colors: ['#f3f6f9', 'transparent'], opacity: 0.5 }
  },
  legend: {
    position: 'top',
    horizontalAlign: 'right',
    labels: { colors: '#555' }
  }
};

var chart = new ApexCharts(document.querySelector("#grapheR"), options);
chart.render();


// code javascript pour ouverture de file pour uploder une fichies :


  // Récupération des éléments
  const openModalBtn = document.getElementById('openModalBtn');
  const closeModalBtn = document.getElementById('closeModalBtn');
  const modal = document.getElementById('addFileModal');

  // Fonction pour ouvrir le modal
  openModalBtn.addEventListener('click', () => {
    modal.style.display = 'block';
  });

  // Fonction pour fermer le modal
  closeModalBtn.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  // Fermer le modal si l'utilisateur clique en dehors du contenu
  window.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });


