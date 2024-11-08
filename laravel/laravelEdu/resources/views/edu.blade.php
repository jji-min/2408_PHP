<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <!-- html 주석 -->
    <h1>이거는 보입니다.</h1>
    {{-- <h1>주석 처리되서 이거는 안보입니다.</h1> --}}
    <p>{{ $data['name'] }}</p>
    <p>{{ $data['content'] }}</p>
    {{-- 공격 예방도 가능 --}}
    <p><?php echo htmlspecialchars($data['content']); ?></p>
    {{-- 퓨어 php도 다음과 같이 공격 예방 가능함 --}}
</body>
</html>