// alert("Hello world");


//För ikonerna katt|hund|gnagare|fågel
jQuery(document).ready(function ($) {
    $('.icon-animals').on('click', function () {
        var tag = $(this).data('tag');
        var url = ajax_variables.siteUrl + '/product-tag/' + tag;
        window.location.href = url;
    });
});


document.addEventListener('DOMContentLoaded', function () {
    var searchForm = document.getElementById('product-search-form');

    searchForm.addEventListener('submit', function (event) {
        var searchInput = document.getElementById('s');
        // Töm sökfältet
        searchInput.value = '';
    });
});
