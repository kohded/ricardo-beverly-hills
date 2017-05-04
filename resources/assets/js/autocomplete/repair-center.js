/**
 * @author Arnold Koh <arnold@kohded.com>
 * Developed: 5/3/2017
 * File: repair-center.js
 */

if ($('#claim-create')) {
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
    lookupLimit: 6,
    onSelect(suggestion) {
      $('.repair-center-id').val(suggestion.data);
    },
  });
}
