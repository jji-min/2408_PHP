const BTN_CALL = document.querySelector('#btn_call');
BTN_CALL.addEventListener('click', getList);

function getList() {
    const URL = document.querySelector('#url').value; // input의 value
    // console.log(URL);
    
    // GET
    axios.get(URL) // 요청을 보내고 받으면
    .then(response => { // 요청보낸게 다시 돌아올때까지 then은 실행안됨
        // console.log(response);
        response.data.forEach(item => {
            // console.log(item.download_url);
            const NEW = document.createElement('img');
            NEW.setAttribute('src', item.download_url);
            NEW.style.width = '200px';
            NEW.style.height = '200px';

            document.querySelector('.container').appendChild(NEW);
        });
    }) // 문제가 없으면 then의 처리, then(콜백함수)
    // 받아온 결과를 axios가 자동으로 객체로 response에 담아둠
    // URL의 규칙이 정해져 있음
    // 백엔드에서 정해진 URL의 규칙에 따라 분석하여 거기에 맞는 데이터를 전달함
    // 분석했을 때 없으면 에러남
    .catch(error => {
        console.log(error);
    }); // 문제가 있으면 catch의 처리
    // '.'으로 연결해나가는걸 chaining method라고 함
    // 작업이 성공하면 resolve, 실패하면 reject
}