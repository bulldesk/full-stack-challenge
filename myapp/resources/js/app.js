require('./bootstrap');

Vue = require('vue');

Vue.component('csv-headers', require('./../js/components/CSVHeaders').default);
Vue.component('upload-form', require('./../js/components/UploadForm').default);

// import example from './../js/components/example';
// // FileHeadersTable = require('./../js/components/FileHeadersTable');

// window.exc = example;

// const app = new Vue({
//     el: '#app',
//     components: {
//         example
//     }
// });

// const app = new Vue({
//     el: '#app'
// });
