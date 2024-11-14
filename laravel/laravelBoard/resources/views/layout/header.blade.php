<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">미니보드</a>
            @auth
            {{-- 로그인이 했을 때만 보임 --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        게시판
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">자유 게시판</a></li>
                            <li><a class="dropdown-item" href="#">질문 게시판</a></li>
                        </ul>
                    </li>
                </ul>
                <a href="{{ route('logout') }}" class="navbar-nav nav-link text-light" role="button">로그아웃</a>
            </div>
            @endauth
            @guest
            {{-- 로그인 안됬을 때 보임 --}}
            {{-- <a href="{{ route('goRegist') }}" class="navbar-nav nav-link text-light" role="button">회원가입</a> --}}
            <a href="{{ route('get.registration') }}" class="navbar-nav nav-link text-light" role="button">회원가입</a>
            @endguest
        </div>
    </nav>
</header>