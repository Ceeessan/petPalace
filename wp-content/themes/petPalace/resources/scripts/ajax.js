function loadMoreProducts() {
    loading = true;
    page++;
    var data = {
        action: 'load_more_products',
        nonce: ajax_variables.nonce,
        page: page
    };

    $.post(ajax_variables.ajaxUrl, data, function (response) {
        if (response.trim()) {
            $('.products').append(response); // Lägg till HTML-koden för produkterna i .products
            loading = false;
            updateResultCount(); // Uppdatera resultaträknaren efter att nya produkter har lagts till
            console.log('AJAX-anrop lyckades!'); // Loggar AJAX-anropet för att se om det har lyckats.

            // Kontrollera om alla produkter är laddade
            var currentCount = $('.products .product').length;
            if (currentCount >= totalProducts) {
                noMoreProducts = true;
                $('#load-more').hide();
                $('.custom-result-count').text('Alla ' + totalProducts + ' produkter är laddade');
            }
        } else {
            noMoreProducts = true;
            $('#load-more').hide();
            $('.custom-result-count').text('Alla ' + totalProducts + ' produkter är laddade');
        }
    });
}






function updateResultCount() {
    var currentCount = $('.products .product').length;
    var resultCountText = 'Visar ' + currentCount + ' av ' + totalProducts + ' produkter';
    $('.custom-result-count').text(resultCountText);
}







