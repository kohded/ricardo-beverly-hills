/**
 * @author Arnold Koh <arnold@kohded.com>
 * Developed: 5/3/2017
 * File: damage-code.js
 */

if ($('#claim-create')) {
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
}
