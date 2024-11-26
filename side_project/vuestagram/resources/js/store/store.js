import { createStore } from 'vuex';
import user from './modules/user';
import board from './modules/board';
// javascript는 '.js' 생략 가능

export default createStore({
    modules: {
        user,
        board,
    },
});