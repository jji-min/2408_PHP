import axios from "../../axios";
// import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        boardList: [],
        page: 0,
    }),
    mutations: {
        setBoardList(state, boardList) {
            state.boardList = boardList;
        },
        setPage(state, page) {
            state.page = page;
        },
        // state는 mutation을 통해서 바꿔야함
        // mutation을 꼭 쌍으로 만들어야함
    },
    actions: {
        /**
         * 게시글 획득
         * 
         * @param {*} context
         */
        getBoardListPagination(context) {
            const url = '/api/boards?page=' + context.getters['getNextPage'];
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.get(url, config)
            .then(response => {
                // console.log(response);
                context.commit('setBoardList', response.data.boardList.data);
                context.commit('setPage', response.data.boardList.current_page);
            })
            .catch(error => {
                console.error(error);
            });
        },
    },
    getters: {
        // state 값을 특정 연산을 통해서 값을 받아야할 때 사용
        getNextPage(state) {
            return state.page + 1;
        },
    }
}