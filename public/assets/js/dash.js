
let mov = document.getElementById('mov');
let liste = document.getElementById('lis');


mov.addEventListener('click' , ()=>{
    liste.classList.toggle('active');
})


// code javascript pour afiochage les messages de supresion

let deleteButtons = document.querySelectorAll('.delete-btn');


deleteButtons.forEach(button => {
    button.addEventListener('click', () => {

        let conDel = button.closest('td').querySelector('.con_del');
        let overlay = document.getElementById('over');

        conDel.classList.add('open');
        overlay.style.display = "block";
    });
});

let cancelButtons = document.querySelectorAll('.anuler');
cancelButtons.forEach(button => {
    button.addEventListener('click', () => {

        let conDel = button.closest('td').querySelector('.con_del');
        let overlay = document.getElementById('over');

        conDel.classList.remove('open');
        overlay.style.display = "none";
    });
});





//code  Reponsabilite javascript --> afichage formulaire de modefication :

let buttonmod = document.querySelectorAll('.btnp');
let contenetMode = document.getElementById('editModal');
let closevar = document.getElementById('close');
buttonmod.forEach((boton)=>{
    boton.addEventListener('click' , ()=>{
        contenetMode.style.display = "flex" ;
    })
})


window.addEventListener('click' , (e)=>{
    if(e.target == contenetMode){
        contenetMode.style.display = "none";
    }
})


// code javascript pour afichage message de supression pour responsabilite

let boton_supresion = document.querySelectorAll('.btnd');
let contentSupresion = document.getElementById('box_conf');
let overlay = document.getElementById('over');
let button_anuuler = document.getElementById('anullersupresion');

boton_supresion.forEach((button)=>{
    button.addEventListener('click' , ()=>{
        contentSupresion.style.display ="block";
        overlay.style.display = "block";
    })
})








// code javascript pour diagramme ajouter :







//dexieme graphe



/*var options = {
    series: [49, 30, 21],
    chart: {
      type: 'donut',
    },
    colors: ['#0D92F4', '#BF3131', '#fff'],  // Spécification des couleurs pour chaque segment
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

  var chart = new ApexCharts(document.querySelector("#grapheee"), options);
  chart.render();*/










  button_anuuler.addEventListener('click' , ()=>{
    contentSupresion.style.display = "none";
    overlay.style.display = "none" ;
})
