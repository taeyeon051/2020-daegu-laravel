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

<!-- 회원가입 영역 -->
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
                <h2 class="d-flex js-center">회원가입</h2>
                <form class="register_form" method="POST">
                    {{ csrf_field() }}
                    <div class="form_group">
                        <input type="email" name="id" placeholder="아이디를 입력하세요.">
                    </div>
                    <div class="form_group">
                        <input type="text" name="name" placeholder="이름을 입력하세요.">
                    </div>
                    <div class="form_group">
                        <input type="password" name="pwd" placeholder="비밀번호를 입력하세요.">
                    </div>
                    <div class="form_group">
                        <input type="password" name="pwdc" placeholder="비밀번호를 한 번 더 입력하세요.">
                    </div>
                    <div class="form_group">
                        <input type="number" name="age" id="age" placeholder="나이를 입력하세요.">
                    </div>
                    <div class="form_group_radio d-flex js-between">
                        <div class="gender d-flex js-evenly ai-center">
                            <div>
                                <input type="radio" name="gender" id="man" value="man">
                                <label for="man">남</label>
                            </div>
                            <div>
                                <input type="radio" name="gender" id="woman" value="woman">
                                <label for="woman">여</label>
                            </div>
                        </div>
                        <select name="student" id="student">
                            <option value="es">초등학생</option>
                            <option value="ms">중학생</option>
                            <option value="hs">고등학생</option>
                        </select>
                    </div>
                    <div class="form_group_captcha d-flex js-between ai-center">
                        <canvas id="captchaImage" width="200" height="60"></canvas>
                        <i class="fa fa-refresh"></i>
                        <div class="d-flex ai-center">
                            <div class="captchaCheckIcon">
                                <i class="fa fa-check danger"></i>
                            </div>
                            <input type="text" id="captcha">
                            <span id="captchaCheck" class="d-flex js-center ai-center">확인</span>
                            <input type="checkbox" name="capCheck" id="capCheckBox" hidden>
                        </div>
                    </div>
                    <div class="form_group">
                        <input type="submit" class="form_submit" value="회원가입">
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

<script src="/js/register.js"></script>

@endsection