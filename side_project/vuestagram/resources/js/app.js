require('./bootstrap');

import { createApp } from 'vue';
import router from './router';
import store from './store/store';
import AppComponent from '../views/components/AppComponent.vue';

createApp({
    components: {
        AppComponent,
    }
})
.use(store)
.use(router)
.mount('#app');
// id가 app인 곳에 올리겠다는 의미