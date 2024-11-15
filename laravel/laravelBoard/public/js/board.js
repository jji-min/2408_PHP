(() => {
    document.querySelectorAll('.my-btn-detail').forEach(node => {
        node.addEventListener('click', e => {
            const url = '/boards/' + e.target.value;

            axios.get(url)
            .then(response => {
                const modalTitle = document.querySelector('#modalTitle');
                const modalContent = document.querySelector('#modalContent');
                const modalCreatedAt = document.querySelector('#modalCreatedAt');
                const modalImg = document.querySelector('#modalImg');
                const modalDeleteParent = document.querySelector('#modalDeleteParent');
                
                modalTitle.textContent = response.data.b_title;
                modalContent.textContent = response.data.b_content;
                modalCreatedAt.textContent = response.data.created_at;
                modalImg.setAttribute('src', response.data.b_img);

                modalDeleteParent.textContent = ''; // 초기화를 하지 않으면 한번 삭제 버튼이 생성되면 계속 생김, 초기화해야함
                if(response.data.delete_flg) {
                    const newButton = document.createElement('button');
                    newButton.setAttribute('type', 'button');
                    newButton.setAttribute('class', 'btn btn-warning');
                    newButton.textContent = '삭제';
                    newButton.setAttribute('onclick', `boardDestroy(${e.target.value})`);
                    newButton.setAttribute('data-bs-dismiss', 'modal');

                    modalDeleteParent.appendChild(newButton);
                }
            })
            .catch(error => {
                console.error(error);
            });
        });
    })
})();

function redirectInsert($type) {
    window.location = '/boards/create?bc_type=' + $type;
}

function boardDestroy($id) {
    const url = '/boards/' + $id;

    axios.delete(url) // 여기서 백엔드로 요청보냄
    .then(response => {
        if(response.data.success) { // success가 true면 삭제
            const deleteNode = document.querySelector('#card' + $id);
            deleteNode.remove(); // 화면(프론트)에서 지울 수 있음
        } else {
            alert('삭제 실패');
        }
    })
    .catch(error => {
        console.log(error);
        alert('에러 발생');
    });
}