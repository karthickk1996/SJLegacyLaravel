import Vue from 'vue';
import Vuelidate from 'vuelidate'
import ToggleButton from 'vue-js-toggle-button'
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import 'vue-select/dist/vue-select.css';
import Notifications from 'vue-notification'
import WillFormComponent from "./components/WillFormComponent.vue";
import TinyEditor from "./components/TinyEditor.vue";
import PaymentComponent from "./components/PaymentComponent.vue";
import WillPayment from "./components/WillPayment.vue";
import EditWill from "./components/EditWill";
import vSelect from 'vue-select'
import RelationshipSelector from "./components/RelationshipSelector";


Vue.component('WillForm', WillFormComponent);
Vue.component('EditWillForm', EditWill);
Vue.component('TinyEditor', TinyEditor);
Vue.component('PaymentForm', PaymentComponent);
Vue.component('WillPayment', WillPayment);
Vue.component('DatePicker', DatePicker)
Vue.component('v-select', vSelect)
Vue.component('RelationshipSelector', RelationshipSelector)
Vue.use(Vuelidate);
Vue.use(ToggleButton)
Vue.use(Notifications);
new Vue({
    el: '#app',
});
