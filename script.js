document.addEventListener("DOMContentLoaded", function () {
    var checkbox = document.getElementById("menu");
    var navbar = document.querySelector(".navbar");

    function toggleNavbar() {
        navbar.style.display = checkbox.checked ? "block" : "none";
    }

    checkbox.addEventListener("change", toggleNavbar);

    // Manejar cambios en el tamaño de la ventana
    window.addEventListener("resize", function () {
        // Ocultar el menú si la ventana es lo suficientemente grande
        if (window.innerWidth > 768) {
            checkbox.checked = false;
            toggleNavbar();
        }
    });
});



var swiper1 = new Swiper(".mySwiper-1", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev", 
    },
});

var swiper2 = new Swiper(".mySwiper-2", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev", 
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        520: {
            slidesPerView: 2,
        },
        950: {
            slidesPerView: 3,
        },
    },
});

let tabInputs = document.querySelectorAll(".tabInput");

tabInputs.forEach(function (input) {
    input.addEventListener('change', function () {
        let id = input.getAttribute('aria-value-max'); 
        let thisSwiper = document.getElementById('swiper' + id);
        thisSwiper.swiper.update();
    });
});

function mostrarVistaPrevia(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById("vistaPrevia").src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
    }
}
