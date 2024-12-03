import axios from '../../axios';
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
    },
    actions: {
        /**
         * 게시글 획득
         */
        boardListPagination(context) {
            context.commit('setControllFlg', false);
            context.dispatch(
                'user/chkTokenAndContinueProcess'
                ,() => {
                    const url = '/api/boards?page=' + context.getters['getNextPage'];
                    const config = {
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                        }
                    }
        
                    axios.get(url, config)
                    .then(response => {
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
                    });
                }
            ,{root: true});
        },

        /**
         * 게시글 상세 정보
         */
        showBoard(context, id) {
            context.dispatch(
                'user/chkTokenAndContinueProcess'
                ,() => {
                    const url = 'api/boards/' + id;
                    const config = {
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                        }
                    }

                    axios.get(url, config)
                    .then(response => {
                        context.commit('board/setBoardDetail', response.data.board, {root: true});
                    })
                    .catch(error => {
                        console.error(error);
                    });
                }
            ,{root: true});
        },

        /**
         * 게시글 작성
         */
        storeBoard(context, data) {
            context.dispatch(
                'user/chkTokenAndContinueProcess'
                ,() => {
                    context.commit('setControllFlg', false);

                    const url = '/api/boards';
                    const config = {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                        }
                    };
                    const formData = new FormData();
                    formData.append('content', data.content);
                    formData.append('img', data.file);

                    axios.post(url, formData, config)
                    .then(response => {
                        context.commit('setBoardListUnshift', response.data.board);

                        context.commit('user/setUserInfoBoardsCount', null, {root: true});

                        router.replace('/boards');
                    })
                    .catch(error => {
                        console.error(error);
                    })
                    .finally(() => {
                        context.commit('setControllFlg', true);
                    });
                }
            ,{root: true});
        },

        /**
         * 게시글 삭제
         */
        destroyBoard(context, id) {
            context.dispatch(
                'user/chkTokenAndContinueProcess'
                ,() => {
                    const url = '/api/boards/' + id;
                    // console.log(url);
                    const config = {
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                        }
                    };

                    axios.delete(url, config)
                    .then(response => {
                        alert('삭제 완료');
                        window.location.reload();
                    })
                    .catch(error => {
                        console.error(error);
                    });
                }
            ,{root: true});
        },
    },
    getters: {
        getNextPage(state) {
            return state.page + 1;
        }
    }
}