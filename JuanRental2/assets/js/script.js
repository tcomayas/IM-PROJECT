// navbar
let menu = document.querySelector(".menu-icon");
let navbar = document.querySelector(".navbar");

menu.onclick = () => {
    navbar.classList.toggle("open-menu");
    menu.classList.toggle("move");
};

window.onscroll = () => {
    navbar.classList.remove("open-menu");
    menu.classList.remove("move");
};

//navbar background
window.addEventListener('scroll', function() {
  const header = document.querySelector('header');
  if (window.scrollY > 0) {
      header.classList.add('header-active');
  } else {
      header.classList.remove('header-active');
  }
});


// login form
const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const btnPopup = document.querySelector('.btnLogin-popup');
const iconClose = document.querySelector('.icon-close');

registerLink.addEventListener('click', () => {
    wrapper.classList.add('active');
});

loginLink.addEventListener('click', () => {
    wrapper.classList.remove('active');
});

btnPopup.addEventListener('click', () => {
    wrapper.classList.add('active-popup');
});

iconClose.addEventListener('click', () => {
    wrapper.classList.remove('active-popup');
});

// flexing cards
document.addEventListener("DOMContentLoaded", function() {
  const panels = document.querySelectorAll(".panel");

  panels.forEach(panel => {
    panel.addEventListener("click", function() {
      if (!this.classList.contains("active")) {
        // Deactivate all other active panels
        panels.forEach(panel => {
          panel.classList.remove("active");
        });
        // Activate the clicked panel
        this.classList.add("active");
      }
    });
  });
});
  
// Check if the page is being refreshed
if (performance.navigation.type === 1) {
  setTimeout(function() {
    window.location.href = "loader.php";
  });
} else {
  
}