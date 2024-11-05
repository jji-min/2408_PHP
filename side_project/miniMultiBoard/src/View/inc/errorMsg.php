<div id="errorMsg" class="form-text text-danger">
    <?php
    echo implode('<br>', $this->arrErrorMsg);
    // implode : 배열을 문자열로 변환
    // 아직 Controller 영역 안이라서 $this 사용 가능
    ?>
</div>