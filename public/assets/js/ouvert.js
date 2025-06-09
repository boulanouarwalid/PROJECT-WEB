
// modale de confirmation de supresion d'une filiere :
document.addEventListener('DOMContentLoaded', function () {
    const Btndelet = document.querySelectorAll('.supresion');
    const ModaleSupresion = document.getElementById('deleteModal');
    const AnuleSUpresion = document.getElementById('anulersup');
    const deleteForm = document.getElementById('deleteForm');

    if (Btndelet && ModaleSupresion) {
        Btndelet.forEach((btn) => {
            btn.addEventListener('click', () => {
                ModaleSupresion.style.display = "flex";
            });
        });
    } else {
        console.log("Btndelet ou ModaleSupresion introuvable dans le DOM");
    }

    if (AnuleSUpresion) {
        AnuleSUpresion.addEventListener('click', () => {
            ModaleSupresion.style.display = "none";
        });
    }

    window.addEventListener('click', (e) => {
        if (e.target === ModaleSupresion) {
            ModaleSupresion.style.display = "none";
        }
    });
});

// code javascript pour spesialite --> service Admin

const btn_ouvert = document.getElementById('ouvert');
const btn_annuler = document.getElementById('anuleBtn');
const modale_ouvrir = document.getElementById('formModal');


btn_ouvert.addEventListener('click' , ()=>{
    modale_ouvrir.style.display = "flex" ;
});

btn_annuler.addEventListener('click' , ()=>{
    modale_ouvrir.style.display= "none" ;
})

window.addEventListener('click' , (e)=>{
    if(e.target == modale_ouvrir){
        modale_ouvrir.style.display ="none" ;
    }
})




