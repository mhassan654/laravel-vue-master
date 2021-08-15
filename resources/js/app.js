require('./bootstrap');
window.Vue = require('vue').default;
import router from './router';
import store from './store';
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
Vue.use(ViewUI);

import Common from './components/common';
import jsonToHtml from './components/jsonToHtml';
Vue.mixin(Common);
Vue.mixin(jsonToHtml);

// import Editor from 'vue-editor-js';

// import Editor from 'vue-editor-js/src/index';
// Vue.use(Editor)


import Vue from 'vue';
import VueCompositionApi from '@vue/composition-api';

Vue.use(VueCompositionApi)
Vue.component('mainapp', require('./components/mainapp.vue').default)

const app = new Vue({
    el: '#app',
    router,
    store
});