import { createStore } from "vuex";
import board from './modules/board.js';
export default createStore({
    modules: {
        board,
    },
    // 모듈을 계속 추가해주면 됨
});
// 객체를 만들어서 내보내겠다