import Vue from 'vue';
import Vuelidate from 'vuelidate'
import ToggleButton from 'vue-js-toggle-button'


Vue.component('WillForm', require('./components/WillFormComponent').default);
Vue.use(Vuelidate);
Vue.use(ToggleButton)

new Vue({
    el: '#app',
});
