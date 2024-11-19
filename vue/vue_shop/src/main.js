import { createApp } from 'vue'
import App from './App.vue'
import store from './store/store.js' // Vuex 저장소 import
// create로 만든 객체 담음

createApp(App)
.use(store) // Vuex 저장소 사용
.mount('#app')
