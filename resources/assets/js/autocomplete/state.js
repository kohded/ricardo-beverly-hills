/**
 * @author Arnold Koh <arnold@kohded.com>
 * Developed: 5/2/2017
 * File: state.js
 */

if ($('#repair-center-create') || $('#repair-center-edit') ||
  $('#customer-create') || $('#customer-edit') || $('#claim-create')) {
  const states = [
    { value: 'AK', data: '' },
    { value: 'AL', data: '' },
    { value: 'AR', data: '' },
    { value: 'AZ', data: '' },
    { value: 'CA', data: '' },
    { value: 'CO', data: '' },
    { value: 'CT', data: '' },
    { value: 'DE', data: '' },
    { value: 'FL', data: '' },
    { value: 'GA', data: '' },
    { value: 'HI', data: '' },
    { value: 'IA', data: '' },
    { value: 'ID', data: '' },
    { value: 'IL', data: '' },
    { value: 'IN', data: '' },
    { value: 'KS', data: '' },
    { value: 'KY', data: '' },
    { value: 'LA', data: '' },
    { value: 'MA', data: '' },
    { value: 'MD', data: '' },
    { value: 'ME', data: '' },
    { value: 'MI', data: '' },
    { value: 'MN', data: '' },
    { value: 'MO', data: '' },
    { value: 'MS', data: '' },
    { value: 'MT', data: '' },
    { value: 'NC', data: '' },
    { value: 'ND', data: '' },
    { value: 'NE', data: '' },
    { value: 'NH', data: '' },
    { value: 'NJ', data: '' },
    { value: 'NM', data: '' },
    { value: 'NV', data: '' },
    { value: 'NY', data: '' },
    { value: 'OH', data: '' },
    { value: 'OK', data: '' },
    { value: 'OR', data: '' },
    { value: 'PA', data: '' },
    { value: 'RI', data: '' },
    { value: 'SC', data: '' },
    { value: 'SD', data: '' },
    { value: 'TN', data: '' },
    { value: 'TX', data: '' },
    { value: 'UT', data: '' },
    { value: 'VA', data: '' },
    { value: 'VT', data: '' },
    { value: 'WA', data: '' },
    { value: 'WI', data: '' },
    { value: 'WV', data: '' },
    { value: 'WY', data: '' },
  ];

  $('.state-autocomplete').autocomplete({
    autoSelectFirst: true,
    lookup: states,
    lookupLimit: 6,
  });
}
