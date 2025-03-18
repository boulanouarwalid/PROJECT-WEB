const allSideMenu = document.querySelectorAll("#sidebar .side-menubar.top li a");

allSideMenu.forEach(item=> {

    const li = item.parentElement;

    item.addEventListener('click', function () {
        allSideMenu.forEach(i=> {
            i.parentElement.classList.remove('active');
        })
    }
)
});

//toggle sidebar

const menuBar = document.querySelector("nav .bx.bx-menu");
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
    sidebar.classList.toggle('hide');
});

const searchButton = document.querySelector("nav form .form-input button");
const searchButtonIcon = document.querySelector(" nav form .form-input button .bx");
const searchForm = document.querySelector(" nav form");

searchButton.addEventListener('click', function (e) {
    if(window.innerWidth < 576) {
        e.preventDefault();
        searchForm.classList.toggle('show');
        if(searchForm.classList.contains('show')) {
            searchButtonIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchButtonIcon.classList.replace('bx-x', 'bx-search');
        }
    }
})

if(window.innerWidth < 768) {
    sidebar.classList.add('hide');
} else if (window.innerWidth > 576) {
    searchButtonIcon.classList.replace('bx-x', 'bx-search');
    searchForm.classList.remove('show');
}

window.addEventListener('resize', function () {
    if(this.innerWidth > 576) {
        searchButtonIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
})


let darkmode = localStorage.getItem('darkmode');
const themeSwitch = document.getElementById('theme-switch');

const enableDarkMode = () => {
  document.body.classList.add('dark'); 
  localStorage.setItem('darkmode', 'active');
};

const disableDarkMode = () => {
  document.body.classList.remove('dark'); 
  localStorage.setItem('darkmode', null);
};

if (darkmode === 'active') {
  enableDarkMode();
}

themeSwitch.addEventListener('click', () => {
  darkmode = localStorage.getItem('darkmode');
  darkmode !== 'active' ? enableDarkMode() : disableDarkMode();
});


let dropMenu = document.querySelector(".menu-drop");

function toggleMenu(event) {
  event.preventDefault(); // Prevent default link behavior
  dropMenu.classList.toggle("open-menu");
}