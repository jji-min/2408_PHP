(() => {
    document.querySelectorAll('.my-btn-detail').forEach(node => {
        node.addEventListener('click', e => {
            const URL = '/boards/detail?b_id=' + e.target.value;
            
            axios.get(URL)
            .then(response => {
                const TITLE = document.querySelector('#modalTitle');
                const CONTENT = document.querySelector('#modalContent');
                const IMG = document.querySelector('#modalImg');
                const NAME = document.querySelector('#modalName');

                TITLE.textContent = response.data.b_title;
                CONTENT.textContent = response.data.b_content;
                IMG.setAttribute('src', response.data.b_img);
                NAME.textContent = response.data.u_name;
            })
            .catch(error => {
                console.log(error);
            });
        });
    });

    // svg태그는 value속성을 사용할 수 없음
    const BTN_INSERT = document.querySelector('#btnInsert');
    BTN_INSERT.addEventListener('click', () => {
        window.location = '/boards/insert?bc_type=' + document.querySelector('#inputBoardType').value;
    });
})();