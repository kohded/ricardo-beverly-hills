/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

const home = Vue.component('home', require('./components/Home.vue'));

if (document.querySelector('#home')) {
  new Vue({
    components: {
      home
    },
    el: '#home'
  });
}

// Require any custom JS files
require('./claim.js');
require('./product.js');
require('./customer.js');
require('./repair-center.js');
require('./damage-code.js');