@extends('layout.layout')

@section('title', '작성 페이지')

@section('bodyClassVh', 'vh-100')

@section('main')
<main class="d-flex justify-content-center align-items-center h-75">
    <form style="width: 300px;" action="{{ route('boards.store') }}" method="post">
        @csrf
        {{-- 에러메세지 출력 --}}
        @if($errors->any()) 
        {{-- 에러메세지가 있는지 없는지 체크, 있으면 true, 없으면 false --}}
        <div id="errorMsg" class="form-text text-danger">
            @foreach($errors->all() as $errorMsg)
            {{-- $errors에 담겨있는 에러메세지를 배열로 가져옴 --}}
            <span>{{ $errorMsg }}</span>
            <br>
            @endforeach
        </div>
        @endif

        <div class="mb-3">
            <label for="b_title" class="form-label">제목</label>
            <input type="text" class="form-control" id="b_title" name="b_title">
        </div>
        <div class="mb-3">
            <label for="b_content" class="form-label">내용</label>
            <input type="text" class="form-control" id="b_content" name="b_content">
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">이미지</label>
            <input type="file" name="file">
        </div>
        <button type="submit" class="btn btn-dark w-100 mb-3">작성</button>
        <a href="/boards" class="btn btn-secondary w-100">취소</a>

    </form>
</main>
@endsection