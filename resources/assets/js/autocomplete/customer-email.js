/**
 * @author Arnold Koh <arnold@kohded.com>
 * Developed: 5/2/2017
 * File: customer-email.js
 */

if ($('#claim-create')) {
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
  });
}
