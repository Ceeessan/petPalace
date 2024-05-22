


//För ikonerna katt|hund|gnagare|fågel
jQuery(document).ready(function ($) {
    $('.icon-animals').on('click', function () {
        var tag = $(this).data('tag');
        var url = ajax_variables.siteUrl + '/product-tag/' + tag;
        window.location.href = url;
    });
});

//Filtrerings-funktion 
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

    // Stäng popup-rutan om användaren klickar på overlay
    overlay.addEventListener('click', closeFilter);
});


//Scroll för relaterade produkter
jQuery(document).ready(function ($) {
    $('.related-products ul.products').slick({
        slidesToShow: 4, // Visa minst 2 produkter på större skärmar
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
                    slidesToShow: 4, // Visa alla 4 produkter på skärmar som är större än 1024px
                    slidesToScroll: 4,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 2, // Visa 2 produkter på skärmar som är större än 600px men mindre än 1024px
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1, // Visa 1 produkt på mindre skärmar än 600px
                    slidesToScroll: 1
                }
            }
        ]
    });
});

