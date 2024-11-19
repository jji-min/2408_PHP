export default {
    namespaced: true, // 모듈화 된 스토어의 네임스페이스 활성화, 어디에 있는 메소드인지 지정, 모조껀 true, (예를 들면,'board/addCnt')
    state: () => ({
        // 데이터가 저장되는 영역
        // 우리가 사용해야하는 모든 데이터가 다 들어감
        // 키: 값
        count: 0,
        products: [
            {productName: '바지', productPrice: 38000, productContent: '매우 아름다운 바지'},
            {productName: '티셔츠', productPrice: 25000, productContent: '매우 아름다운 티셔츠'},
            {productName: '양말', productPrice: 39999, productContent: '매우 비싼 양말'},
            {productName: '모자', productPrice: 100000, productContent: '매우 비싼 모자'},
        ],
        detailProduct: {productName: '', productPrice: 0, productContent: ''},
    }),
    mutations: {
        // state의 데이터를 수정할 수 있는 함수들을 정의하는 영역
        // state의 무언가 변경하려면 무조껀 mutations를 통해서 가능
        addCount(state) {
            state.count++;
        },
        setDetailProduct(state, item) {
            state.detailProduct = item;
        },
    },
    actions: {
        // 비동기성 비지니스 로직 함수를 정의하는 영역
    },
    getters: {
        // 추가처리를 하여 state의 데이터를 획득하기 위한 함수들을 정의하는 영역
    },
}