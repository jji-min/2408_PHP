// import axios from 'axios';
import axios from "../../axios";
import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        // accessToken: localStorage.getItem('accessToken') ? localStorage.getItem('accessToken') : '',
        // 보통은 토큰 자체를 저장하지 않고, accessToken이 있는지 없는지 true, false만 가지고 있음
        authFlg: localStorage.getItem('accessToken') ? true : false,
        userInfo: localStorage.getItem('userInfo') ? JSON.parse(localStorage.getItem('userInfo')) : {},
        // parse()는 deserializing
    }),
    mutations: {
        // setAccessToken(state, accessToken) {
        //     // 첫번째 파라미터는 state로 고정
        //     state.accessToken = accessToken;
        //     localStorage.setItem('accessToken', accessToken);
        // },
        setAuthFlg(state, flg) {
            state.authFlg = flg;
        },
        setUserInfo(state, userInfo) {
            state.userInfo = userInfo;
        },
    },
    actions: {
        // --------------
        // 인증관련
        // --------------
        /**
         * 로그인 처리
         * 
         * @param {*} context
         * @param {*} userInfo
         */
        login(context, userInfo) {
            // context는 고정
            // 두번째는 전달해줄 값, 보통 객체
            // context는 store 전체 의미
            const url = '/api/login';
            const data = JSON.stringify(userInfo);
            // 객체를 json 형태로 serializing -> 문자열로 나옴
            // const config = {
            //     headers: {
            //         'Content-Type': 'application/json'
            //     }
            //     // 기존의 content-type을 json으로 바꿈
            // }

            // axios.post(url, data, config)
            axios.post(url, data)
            .then(response => {
                // console.log(response);
                // 토큰 저장
                // context.commit('setAccessToken', response.data.accessToken);
                // context는 store에 접근하기 위함

                localStorage.setItem('accessToken', response.data.accessToken);
                localStorage.setItem('refreshToken', response.data.refreshToken);
                localStorage.setItem('userInfo', JSON.stringify(response.data.data));
                context.commit('setAuthFlg', true);
                context.commit('setUserInfo', response.data.data);

                // 보드 리스트로 이동
                router.replace('/boards');

            })
            .catch(error => {
                let errorMsgList = [];
                const errorData = error.response.data;

                // console.log(error.response);
                if(error.response.status === 422) {
                    // 유효성 체크 에러
                    if(errorData.data.account) {
                        errorMsgList.push(errorData.data.account[0]);
                    }
                    if(errorData.data.password) {
                        errorMsgList.push(errorData.data.password[0]);
                    }
                } else if(error.response.status === 401) {
                    // 비밀번호 오류
                    errorMsgList.push(errorData.msg);
                    // errorMsgList.push('비밀번호가 틀렸습니다.');
                    // 프론트와 백앤드가 분리된 상태이기 때문에 백앤드에서 보내준 메세지를 꼭 띄울 필요는 없음
                    // 다음과 같이 수정 가능
                } else {
                    errorMsgList.push('예기치 못한 오류 발생');
                }

                alert(errorMsgList.join('\n'));
                // join -> php explode와 같은 기능
            });
        },
        /**
         * 로그아웃 처리
         * 
         * @param {*} context
         */
        logout(context) {
            const url = '/api/logout';
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                    // 되도록 노출되지 않도록
                    // 파라미터가 아닌 헤더에 담음
                }
            };

            axios.post(url, null, config)
            .then(response => {
                alert('로그아웃 완료');
            })
            .catch(error => {
                alert('문제가 발생하여 로그아웃 처리');
            })
            .finally(() => {
                localStorage.clear();// 로컬스토리지 비우기
    
                // state 초기화
                context.commit('setAuthFlg', false);
                context.commit('setUserInfo', {});
    
                router.replace('/login');
            });
        },
    },
    getters: {

    }
}