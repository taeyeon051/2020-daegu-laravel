<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/선수제공파일/font-awesome/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/sub.css">
    <script src="/js/jquery-3.4.1.js"></script>
    <title>전주독서대전</title>
</head>

<body>
    <div id="container">
        <!-- 헤더 영역 -->
        <header>
            <div id="logo" class="d-flex js-center ai-center">
                <a href="/">
                    <img src="/선수제공파일/image/logo.png" alt="logo" title="logo" height="150">
                </a>
            </div>
            <nav class="bg-white">
                <ul id="menu">
                    <li>
                        <a href="#">전주독서대전</a>
                        <ul>
                            <li><a href="#">대전소개</a></li>
                            @if (session()->has('loginData'))
                            <li><a href="/logout" class="selected">로그아웃</a></li>
                            @else
                            <li><a href="/login" class="selected">회원가입 / 로그인</a></li>
                            @endif
                            <li><a href="/overview">행사개요</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/bookEditor">온라인 책만들기</a>
                    </li>
                    <li>
                        <a href="#">독자와의 만남</a>
                        <ul>
                            <li><a href="/meeting">예약하기</a></li>
                            <li><a href="/meeting/check">예약확인</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">관리자 페이지</a>
                        <ul>
                            <li><a href="/event/list">행사등록</a></li>
                            <li><a href="/meeting/check/admin">예약관리</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>

        @yield('content')

        <!-- 우측 메뉴 영역 -->
        <div id="rightMenu">
            <div class="blog d-flex flex-column js-center ai-center">
                <b>BlOG</b>
                <div class="arrow d-flex js-center ai-center">&#10095;</div>
            </div>
            <div class="rm_box d-flex js-center ai-center"><b>갤러리</b></div>
            <div class="rm_box d-flex js-center ai-center"><b>공지사항</b></div>
            <div class="rm_box d-flex js-center ai-center"><b>오시는길</b></div>
        </div>

        <!-- 푸터 영역 -->
        <footer>
            <img src="/선수제공파일/image/logo.png" alt="logo" title="logo" height="100">
            <div class="footer_txt">
                <p>(54819) 전주시 덕진구 솔내로 212(송천동2가 168-5) | 전화 : 063-281-6535 | 팩스 : 063-281-5286</p>
                <p>Copyright 2020 전주독서대전. All rights reserved.</p>
            </div>
            <div class="footer_icon d-flex js-between">
                <i class="fa fa-facebook"></i>
                <i class="fa fa-instagram"></i>
                <i class="fa fa-twitter"></i>
            </div>
        </footer>
    </div>

    @if(session()->has('flash_message'))
    <script>
        const msg = "{{session('flash_message')}}";
        alert(msg);
        if (document.querySelector("#capCheckBox")) document.querySelector("#capCheckBox").removeAttribute('checked');
    </script>
    @endif
</body>

</html>