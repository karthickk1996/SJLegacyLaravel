import Vue from 'vue';
import Vuelidate from 'vuelidate'
import ToggleButton from 'vue-js-toggle-button'
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';


Vue.component('WillForm', require('./components/WillFormComponent').default);
Vue.component('DatePicker',DatePicker)
Vue.use(Vuelidate);
Vue.use(ToggleButton)

new Vue({
    el: '#app',
});
