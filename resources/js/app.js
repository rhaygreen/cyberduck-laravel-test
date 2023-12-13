import './bootstrap';
import { createApp } from 'vue';
import Vueform from '@vueform/vueform'
import vueformConfig from './../../vueform.config'
import newCoffeeSale from './components/newCoffeeSale.vue';
import existingCoffeeSales from './components/existingCoffeeSales.vue';

const app = createApp({});
app.use(Vueform, vueformConfig)

app.component('newCoffeeSale', newCoffeeSale);
app.component('existingCoffeeSales', existingCoffeeSales);

app.mount("#app");
