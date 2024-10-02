let fileTag = document.querySelector("input[name=file]");
// input 태그(name이 file인) 가져옴

// 파일태그에 변화가 있을 때 실행될 함수 작성
fileTag.onchange = function() {
    let imgTag = document.querySelector("#poster_img");  // id가 poster_img

    // 파일 있는지 확인
    if(fileTag.files.length > 0) {
        // 파일을 선택한 경우
        // 미리보기 생성 == 이미지 태그 src에 데이터(파일태그에서 선택한 파일)를 넣어주면 됨

        let reader = new FileReader();

        // reader 읽어들이는 작업(onload)을 끝냈을 때 함수 실행, 읽어온 데이터를 함수의 파라미터로 줄 수 있음
        reader.onload = function(data) {
            console.log(data);
            imgTag.src = data.target.result;
        }

        reader.readAsDataURL(fileTag.files[0]);
    } else {
        // 파일 선택에서 취소 버튼을 누른 경우
        imgTag.src = "";
    }
}