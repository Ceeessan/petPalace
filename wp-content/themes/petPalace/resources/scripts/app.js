
//______________________________INNAN PRODUCT-CONTENT LISTING-PAGE

//För ikonerna katt|hund|gnagare|fågel
jQuery(document).ready(function ($) {
    $('.icon-animals').on('click', function () {
        var tag = $(this).data('tag');
        var url = ajax_variables.siteUrl + '/product-tag/' + tag;
        window.location.href = url;
    });
});



// filtrerings-ikonen
document.addEventListener('DOMContentLoaded', function () {
    const filterBtn = document.querySelector('.filter-icon-container');
    const filterPopup = document.getElementById('filter-popup');
    const closeFilterBtn = document.getElementById('close-filter-btn');
    const overlay = document.getElementById('overlay');

    const openFilter = function () {
        filterPopup.classList.add('show');
        overlay.classList.add('show');
    };

    const closeFilter = function () {
        filterPopup.classList.remove('show');
        overlay.classList.remove('show');
    };

    filterBtn.addEventListener('click', openFilter);
    closeFilterBtn.addEventListener('click', closeFilter);
    overlay.addEventListener('click', closeFilter);
});







//_____________________EFTER PRODUCT-CONTENT LISTING-PAGE

//Scroll för relaterade produkter
jQuery(document).ready(function ($) {
    $('.related-products ul.products').slick({
        slidesToShow: 4, // Visa minst 2 produkter 
        slidesToScroll: 1,
        arrows: true,
        dots: true,
        infinite: true,
        speed: 300,
        adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4, // Visa alla 4 produkter 
                    slidesToScroll: 4,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 2, // Visa 2 produkter 
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1, // Visa 1 produkt 
                    slidesToScroll: 1
                }
            }
        ]
    });
});


//_____________________________________ EFTER PRODUCT-CONTENT LISTING-PAGE