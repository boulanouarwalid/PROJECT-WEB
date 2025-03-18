const profileButton = document.getElementById('profileButton'); // Replace with your button ID
const dropdown = document.getElementById('dropdown');

profileButton.addEventListener('click', (e) => {
  e.preventDefault(); // Prevent default link behavior
  dropdown.classList.toggle('openmenu'); // Toggle dropdown visibility
});

// Close dropdown when clicking outside
document.addEventListener('click', (e) => {
  if (!profileButton.contains(e.target) && !dropdown.contains(e.target)) {
    dropdown.classList.remove('openmenu');
  }
});