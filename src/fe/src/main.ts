import './assets/main.css'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import PrimeVue from 'primevue/config';
import {flycomThemePreset} from "@/config/flycomThemePreset";
import ToastService from 'primevue/toastservice';

const app = createApp(App);

app.use(createPinia());
app.use(router);
app.use(PrimeVue, {
  theme: {
    preset: flycomThemePreset
  }
});
app.use(ToastService);

app.mount('#app')