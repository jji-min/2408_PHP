<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>home</title>
</head>
<body>
    <h1>HOME</h1>

    <form action="/home" method="post">
        @csrf
        {{-- 라라벨이 자동으로 csrf token 만들고 검증해줌 --}}
        <button type="submit">POST</button>
    </form>
    <hr>
    <form action="/home" method="post">
        {{-- 원래 method는 get이랑 post만 있음 --}}
        @csrf
        @method('PUT')
        {{-- <input type="hidden" name="_method" value="delete"> --}}
        <button type="submit">PUT</button>
    </form>
    <hr>
    <form action="/home" method="post">
        @csrf
        @method('DELETE')
        <button type="submit">DELETE</button>
    </form>
    <hr>
    <form action="/home" method="post">
        @csrf
        @method('PATCH')
        <button type="submit">PATCH</button>
    </form>
</body>
</html>