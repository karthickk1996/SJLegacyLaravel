import Vue from 'vue';
import Vuelidate from 'vuelidate'
import ToggleButton from 'vue-js-toggle-button'
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import Notifications from 'vue-notification'

Vue.component('WillForm', require('./components/WillFormComponent').default);
Vue.component('EditWillForm', require('./components/EditWillComponent').default);
Vue.component('TinyEditor', require('./components/TinyEditor').default);
Vue.component('PaymentForm', require('./components/PaymentComponent').default);
Vue.component('WillPayment', require('./components/WillPayment').default);
Vue.component('DatePicker',DatePicker)
Vue.use(Vuelidate);
Vue.use(ToggleButton)
Vue.use(Notifications);
new Vue({
    el: '#app',
});
