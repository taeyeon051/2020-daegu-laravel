@if (session()->has('loginData'))
<script>
    history.back();
</script>
@endif

@extends('master')

@section('content')
<!-- 비주얼 영역 -->
<section id="subpage_visual">
    <div class="subpage_visual w-100">
        <img src="/선수제공파일/A/img/23.PNG" alt="비주얼이미지1" title="비주얼이미지1">
    </div>
</section>

<!-- 로그인 영역 -->
<section id="subpage">
    <div class="subpage_title d-flex ai-center">
        <div class="oneDept d-flex ai-center text-white">
            <b>전주독서대전</b>
        </div>
        <div class="twoDept">
            <ul class="d-flex">
                <li><a href="#">대전소개</a></li>
                <li><a href="/login" class="selected">회원가입 / 로그인</a></li>
                <li><a href="/overview">행사개요</a></li>
            </ul>
        </div>
    </div>
    <div class="subpage_content d-flex">
        <div class="subpage_content_left">
            <div class="semicircle d-flex js-center ai-center">
                <h4 class="text-white">02</h4>
            </div>
            <div class="subpage_content_text">
                <h5>Jeonju Reading Festival 2020</h5>
                <h2>2020 전주독서대전</h2>
                <h2 class="d-flex js-center">로그인</h2>
                <form class="login_form" action="/login" method="POST">
                    {!! csrf_field() !!}
                    <div class="form_group">
                        <input type="text" name="id" id="userId" placeholder="아이디를 입력하세요." required>
                    </div>
                    <div class="form_group">
                        <input type="password" name="pwd" id="userPwd" placeholder="비밀번호를 입력하세요." required>
                    </div>
                    <div class="form_group">
                        <input type="submit" class="form_submit" value="로그인">
                    </div>
                    <div class="form_group">
                        <a href="/register">회원가입</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="subpage_content_right">
            <div class="subpage_poster_img">
                <img src="/선수제공파일/A/img/poster.jpg" alt="poster" title="poster">
            </div>
        </div>
    </div>
</section>
@endsection