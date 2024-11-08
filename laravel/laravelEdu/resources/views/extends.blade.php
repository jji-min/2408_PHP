{{-- 상속 --}}
{{-- 자식 --}}
{{-- 상속받아서 부모꺼를 사용할 수 있음 --}}
{{-- 템플릿을 이용해서 모듈화함 --}}
@extends('layout.layout')

{{-- @section : 부모템플릿에 해당하는 yield에 삽입 --}}
@section('title', '자식자식')
{{-- yield와 section은 세트 --}}
{{-- 자식쪽에서 section을 지정하지 않으면, 부모쪽에서 기본값을 넣음 --}}
{{-- blade이지만 기본적으로 html이기 때문에 ';' 안 찍어도됨 --}}

@section('main')
<main>
    <h2>자신의 메인 영역</h2>
</main>
@endsection
{{-- 여러개 코드를 작성할 때는 @section과 @endsecton을 이용하면 됨 --}}

@section('show', '자식자식 show')

<hr>
{{-- @if : 조건문 --}}
@if($data[0]['gender'] === 'F')
    <span>여자</span>
@elseif($data[0]['gender'] === 'M')
    <span>남자</span>
@else
    <span>알수없음</span>
@endif
{{-- section으로 묶지 않아서 조건문이 먼저 실행되서 젤 위에 출력됨 --}}
<hr>

{{-- 반복문 --}}
{{-- @for ~ @endfor : for 반복문 --}}
@for($i = 0; $i < 5; $i++)
    <span>{{ $i }}</span>
@endfor
<hr>

{{-- 구구단 --}}
{{-- @for($i = 2; $i <= 9; $i++)
    <h3>{{ $i }}단</h3>
    @for($z = 1; $z <= 9; $z++)
        <span>{{ $i.' X '.$z.' = '.($i * $z) }}</span>
        <br>
    @endfor
@endfor --}}

{{-- @foreach ~ @endforeach : foreach 반복문 --}}
@foreach($data as $item)
    {{-- @if($loop->odd)
        <div style="color: red;">
            <span>{{ $item['name'] }}</span>
            <span>{{ $item['gender'] }}</span>
            <span>남은 루프 횟수 : {{ $loop->remaining }}</span>
            foreach문은 $loop 자동으로 생성
        </div>
    @else
        <div>
            <span>{{ $item['name'] }}</span>
            <span>{{ $item['gender'] }}</span>
            <span>남은 루프 횟수 : {{ $loop->remaining }}</span>
        </div>
    @endif --}}
    <div style="{{ $loop->odd ? 'color: pink;' : '' }}">
        <span>{{ $item['name'] }}</span>
        <span>{{ $item['gender'] }}</span>
        {{-- <span>남은 루프 횟수 : {{ $loop->remaining }}</span> --}}
        {{-- foreach문은 $loop 자동으로 생성 --}}
    </div>
@endforeach

{{-- @forelse ~ @empty ~ @endforelse :
    루프를 할 데이터의 길이가 1이상이면 @forelse의 처리,
    배열의 길이가 0이면 @empty의 처리를 합니다.
--}}
@forelse($data2 as $item)
    <div>{{ $item['name'] }}</div>
@empty
    <span>데이터 없음</span>
@endforelse
{{-- data2가 빈배열이라서 데이터 없음 출력됨 --}}