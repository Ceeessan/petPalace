// alert("Hello world");


//För ikonerna katt|hund|gnagare|fågel
jQuery(document).ready(function ($) {
    $('.icon-animals').on('click', function () {
        var tag = $(this).data('tag');
        var url = ajax_variables.siteUrl + '/product-tag/' + tag;
        window.location.href = url;
    });
});

//Scroll för relaterade produkter
document.addEventListener('DOMContentLoaded', function () {
    var relatedProductsContainer = document.querySelector('.related-products ul.products');

    if (relatedProductsContainer) {
        relatedProductsContainer.style.scrollBehavior = 'smooth';
    }
});

