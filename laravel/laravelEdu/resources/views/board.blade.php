<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>보드</title>
</head>
<body>
    @include('layout.header')
    {{-- '.'으로 경로 구분 --}}

    <main>
        <p>메인메인</p>
    </main>
    
    @include('layout.footer', ['key1' => '홍길동'])
    {{-- b: 하면 자동완성됨, b는 blade --}}
    {{-- key를 지정해줘야하기 때문에 배열로 보내줘야함 --}}
</body>
</html>