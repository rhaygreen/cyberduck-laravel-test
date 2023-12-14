import './bootstrap';
import { createApp} from 'vue';
import Vueform from '@vueform/vueform'
import vueformConfig from './../../vueform.config'
import coffeeSalesWrapper from './components/coffeeSalesWrapper.vue';


const app = createApp({});
app.use(Vueform, vueformConfig);

app.component('coffeeSalesWrapper', coffeeSalesWrapper);

app.mount("#app");
