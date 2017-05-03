/**
 * @author Arnold Koh <arnold@kohded.com>
 * Developed: 5/3/2017
 * File: product.js
 */

if ($('#claim-create')) {
  $('.product-autocomplete').autocomplete({
    autoSelectFirst: true,
    lookup(product, done) {
      $.ajax({
        data: { product },
        dataType: 'json',
        type: 'GET',
        url: '/autocomplete/product',
        success(products) {
          const result = {
            suggestions: products,
          };

          done(result);
        },
        error(error) {
          console.log(`Error: ${error}`);
        },
      });
    },
    lookupLimit: 60,
    onSelect(suggestion) {
      $('.product-style').val(suggestion.data);
    },
    maxHeight: 302,
  });
}
