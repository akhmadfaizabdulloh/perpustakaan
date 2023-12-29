const hamburger = document.querySelector('#hamburger');
const navMenu = document.querySelector('#default-sidebar');

    hamburger.addEventListener('click', function () {
      hamburger.classList.toggle('hamburger-active');
      navMenu.classList.toggle('-translate-x-full');
    });

    // Menyembunyikan sidebar saat mengklik di luar sidebar
    document.addEventListener('click', function (event) {
        const isClickInsideSidebar = navMenu.contains(event.target);
        const isClickOnHamburger = hamburger.contains(event.target);
  
        if (!isClickInsideSidebar && !isClickOnHamburger) {
          hamburger.classList.remove('hamburger-active');
          navMenu.classList.add('-translate-x-full');
        }
      });