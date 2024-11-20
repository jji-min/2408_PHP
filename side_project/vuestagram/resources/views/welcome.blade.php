<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- resources에 있는 경로를 잡기 위해 asset사용 --}}
    <title>VueStagram</title>
</head>
<body>
    <div id="app">
        {{-- mount에 적었던 #app이 이거 --}}
        <App-Component></App-Component>
    </div>
</body>
</html>