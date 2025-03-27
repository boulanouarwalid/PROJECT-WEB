document.addEventListener("DOMContentLoaded", function () {
  console.log("Script loaded"); // Check if the script is running
});


document.getElementById('sidebarToggle').addEventListener('click', function() {
  const sidebar = document.getElementById('sidebar');
  sidebar.classList.toggle('collapsed');
  
  // Save state in localStorage
  const isCollapsed = sidebar.classList.contains('collapsed');
  localStorage.setItem('sidebarCollapsed', isCollapsed);
});

// Initialize from localStorage
document.addEventListener('DOMContentLoaded', function() {
  const sidebar = document.getElementById('sidebar');
  if (localStorage.getItem('sidebarCollapsed') === 'true') {
    sidebar.classList.add('collapsed');
  }
});

// Initialize Bootstrap tooltips for collapsed menu items
var tooltipTriggerList = [].slice.call(document.querySelectorAll('.sidebar.collapsed .nav-link'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl, {
    placement: 'right',
    title: tooltipTriggerEl.querySelector('.menu-text').textContent
  });
});




document.addEventListener("DOMContentLoaded", function () {
  const themeSwitch = document.getElementById("theme-switch");
  const body = document.body;
  const moonIcon = themeSwitch.querySelector(".bi-moon-fill");
  const sunIcon = themeSwitch.querySelector(".bi-sun-fill");

  // Load saved mode from localStorage
  if (localStorage.getItem("darkMode") === "enabled") {
      body.classList.add("dark");
      sunIcon.classList.remove("d-none");
      moonIcon.classList.add("d-none");
  }

  // Toggle Dark Mode
  themeSwitch.addEventListener("click", function () {
      body.classList.toggle("dark");

      if (body.classList.contains("dark")) {
          localStorage.setItem("darkMode", "enabled");
          sunIcon.classList.remove("d-none");
          moonIcon.classList.add("d-none");
      } else {
          localStorage.setItem("darkMode", "disabled");
          sunIcon.classList.add("d-none");
          moonIcon.classList.remove("d-none");
      }
  });
});

            // Définir les niveaux disponibles par spécialité
            const niveauxParSpecialite = {
              informatique: ["L1", "L2", "L3", "M1", "M2"],
              mathematiques: ["L1", "L2", "L3"],
              physique: ["L1", "L2", "L3", "M1"],
              chimie: ["L2", "L3", "M1", "M2"]
          };
          
          document.addEventListener('DOMContentLoaded', function() {
              const specialiteSelect = document.getElementById('specialite');
              const niveauxContainer = document.getElementById('niveaux-container');
          
              // Gérer le changement de spécialité
              specialiteSelect.addEventListener('change', function() {
                  const specialite = this.value;
                  niveauxContainer.innerHTML = '';
                  
                  if (specialite && niveauxParSpecialite[specialite]) {
                      const row = document.createElement('div');
                      row.className = 'row g-2';
                      
                      niveauxParSpecialite[specialite].forEach(niveau => {
                          const col = document.createElement('div');
                          col.className = 'col-md-4';
                          
                          const div = document.createElement('div');
                          div.className = 'form-check';
                          
                          const input = document.createElement('input');
                          input.className = 'form-check-input';
                          input.type = 'checkbox';
                          input.id = `niveau-${niveau}`;
                          input.name = 'niveaux';
                          input.value = niveau;
                          
                          const label = document.createElement('label');
                          label.className = 'form-check-label';
                          label.htmlFor = `niveau-${niveau}`;
                          label.textContent = niveau;
                          
                          div.appendChild(input);
                          div.appendChild(label);
                          col.appendChild(div);
                          row.appendChild(col);
                      });
                      
                      niveauxContainer.appendChild(row);
                  } else {
                      niveauxContainer.innerHTML = '<p class="text-muted mb-0">Veuillez d\'abord sélectionner une spécialité</p>';
                  }
              });
          
              // Gérer la soumission du formulaire
              document.getElementById('vacataireForm').addEventListener('submit', function(e) {
                  e.preventDefault();
                  
                  // Collecter les données du formulaire
                  const selectedNiveaux = Array.from(document.querySelectorAll('#niveaux-container input:checked'))
                      .map(checkbox => checkbox.value);
                  
                  const formData = {
                      nom: document.getElementById('nom').value,
                      prenom: document.getElementById('prenom').value,
                      email: document.getElementById('email').value,
                      telephone: document.getElementById('telephone').value,
                      specialite: specialiteSelect.value,
                      niveaux: selectedNiveaux,
                      sendCredentials: document.getElementById('sendCredentials').checked
                  };
                  
                  console.log('Données à envoyer:', formData);
                  // Ici vous ajouteriez l'appel AJAX à votre API backend
                  
                  // Afficher un message de succès (temporaire)
                  alert('Vacataire enregistré avec succès!');
                  this.reset();
                  niveauxContainer.innerHTML = '<p class="text-muted mb-0">Veuillez d\'abord sélectionner une spécialité</p>';
              });
          });