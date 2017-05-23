/**
 * @author Arnold Koh <arnold@kohded.com>
 * Developed: 5/3/2017
 * File: claim.js
 */

if ($('#claim-create') || $('#claim-edit')) {
  /**
   * Customer email autocomplete.
   */
  $('.customer-email-autocomplete').autocomplete({
    autoSelectFirst: true,
    lookup(email, done) {
      $.ajax({
        data: { email },
        dataType: 'json',
        type: 'GET',
        url: '/autocomplete/customer-email',
        success(emails) {
          const result = {
            suggestions: emails,
          };

          done(result);
        },
        error(error) {
          console.log(`Error: ${error}`);
        },
      });
    },
    lookupLimit: 6,
    onSelect(email) {
      // Run only in claim edit page.
      if ($('#claim-edit').length) {
        $.ajax({
          data: { email: email.value },
          dataType: 'json',
          type: 'GET',
          url: '/autocomplete/customer-latest-claim-id',
          success(claimId) {
            // Redirect to claim edit by claim id.
            window.location.href = `/claim/edit/${claimId}`;
          },
          error(error) {
            console.log(`Error: ${error}`);
          },
        });
      }
    },
    triggerSelectOnValidInput: false,
  });

  /**
   * Damage code autocomplete.
   */
  $('.damage-code-autocomplete').autocomplete({
    autoSelectFirst: true,
    lookup(dc, done) {
      $.ajax({
        data: { dc },
        dataType: 'json',
        type: 'GET',
        url: '/autocomplete/damage-code',
        success(damageCodes) {
          const result = {
            suggestions: damageCodes,
          };

          done(result);
        },
        error(error) {
          console.log(`Error: ${error}`);
        },
      });
    },
    lookupLimit: 6,
    onSelect(suggestion) {
      $('.damage-code-id').val(suggestion.data);
    },
  });

  /**
   * Product autocomplete.
   */
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

  /**
   * Repair center autocomplete.
   */
  $('.repair-center-autocomplete').autocomplete({
    autoSelectFirst: true,
    lookup(rc, done) {
      $.ajax({
        data: { rc },
        dataType: 'json',
        type: 'GET',
        url: '/autocomplete/repair-center',
        success(repairCenters) {
          const result = {
            suggestions: repairCenters,
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
      $('.repair-center-id').val(suggestion.data);
      checkIfCustomerOrder();
    },
    maxHeight: 302,
  });
}

// If Customer Order then display courtesy / charge option
function checkIfCustomerOrder() {
  var courtesyOrCharge = $('#courtesy_or_charge')
  if($('.repair-center-autocomplete').val() === "Customer Order - Customer Order") {
    courtesyOrCharge.removeClass("hidden");
  } else {
    courtesyOrCharge.addClass("hidden");
  }
}
