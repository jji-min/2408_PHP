<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', '레이아웃')</title>
    {{-- 기본값 --}}
</head>
<body>
    @include('layout.header')

    @yield('main')
    {{-- 공통적으로 작성되어야 되는 html은 부모한테 적어주면 됨 --}}

    {{-- @section ~ @show : 자식 템플릿에 해당하는 section이 없으면 부모코드 실행, 문법 --}}
    @section('show')
    <h2>부모 show 입니다.</h2>
    <h3>많은 처리</h3>
    @show
    {{-- 자식한테 show가 없으면 부모의 show가 나옴 --}}

    @include('layout.footer')
</body>
</html>