import axios from "../../axios";
import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        boardList: [],
        page: 0,
        boardDetail: null,
        controllFlg: true,
        lastPageFlg: false,
    }),
    mutations: {
        setBoardList(state, boardList) {
            state.boardList = state.boardList.concat(boardList);
        },
        setPage(state, page) {
            state.page = page;
        },
        setBoardDetail(state, board) {
            state.boardDetail = board;
        },
        setBoardListUnshift(state, board) {
            state.boardList.unshift(board);
        },
        setControllFlg(state, flg) {
            state.controllFlg = flg;
        },
        setLastPageFlg(state, flg) {
            state.lastPageFlg = flg;
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
        boardListPagination(context) {
            // 디바운싱 처리 시작
            if(context.state.controllFlg && !context.state.lastPageFlg) {
                context.commit('setControllFlg', false); // 초기값이 true이기 때문에 false로 바꿔줌
    
                const url = '/api/boards?page=' + context.getters['getNextPage'];
                const config = {
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                    }
                }
    
                axios.get(url, config)
                .then(response => {
                    console.log('리스트 획득', response.data.boardList);
                    context.commit('setBoardList', response.data.boardList.data);
                    context.commit('setPage', response.data.boardList.current_page);
                    if(response.data.boardList.current_page >= response.data.boardList.last_page) {
                        context.commit('setLastPageFlg', true);
                    }
                })
                .catch(error => {
                    console.error(error);
                })
                .finally(() => {
                    context.commit('setControllFlg', true);
                    // flg를 true로 바꾸는 건 axios 내부에서 해줘야함
                    // 바깥에 있으면 axios가 비동기이기 때문에 제대로 동작안함
                });
            }
        },

        /**
         * 게시글 상세 정보 획득
         * 
         * @param {*} context
         * @param {int} id
         */
        showBoard(context, id) {
            const url = '/api/boards/' + id;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.get(url, config)
            .then(response => {
                // console.log(response);
                context.commit('setBoardDetail', response.data.board);
            })
            .catch(error => {
                console.error(error);
            });
        },

        /**
         * 게시글 작성
         */
        storeBoard(context, data) {
            
            if(context.state.controllFlg) {
                context.commit('setControllFlg', false);

                const url = '/api/boards';
                const config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                        // token안에 idt로 pk를 가지고 있음
                    }
                };
                const formData = new FormData();
                formData.append('content', data.content);
                formData.append('file', data.file);
    
                axios.post(url, formData, config)
                .then(response => {
                    context.commit('setBoardListUnshift', response.data.board);

                    // 다른 모듈 접근
                    context.commit('user/setUserInfoBoardsCount', null, {root: true});
                    // 세번째 파라미터를 root: true하면 최상위에 붙음, store에 붙음
    
                    router.replace('/boards');
                })
                .catch(error => {
                    console.error(error);
                })
                .finally(() => {
                    context.commit('setControllFlg', true);
                });
            }
        },
    },
    getters: {
        // state 값을 특정 연산을 통해서 값을 받아야할 때 사용
        getNextPage(state) {
            return state.page + 1;
        },
    }
}