@extends('master')

@section('content')
<!-- 비주얼 영역 -->
<section id="subpage_visual">
    <div class="subpage_visual w-100">
        <img src="/선수제공파일/A/img/23.PNG" alt="비주얼이미지1" title="비주얼이미지1">
    </div>
</section>

<!-- 행사개요 영역 -->
<section id="subpage">
    <div class="subpage_title d-flex ai-center">
        <div class="oneDept d-flex ai-center text-white">
            <b>전주독서대전</b>
        </div>
        <div class="twoDept">
            <ul class="d-flex">
                <li><a href="#">대전소개</a></li>
                @if (session()->has('loginData'))
                <li><a href="/logout">로그아웃</a></li>
                @else
                <li><a href="/login">회원가입 / 로그인</a></li>
                @endif
                <li><a href="/overview" class="selected">행사개요</a></li>
            </ul>
        </div>
    </div>
    <div class="subpage_content d-flex">
        <div class="subpage_content_left">
            <div class="semicircle d-flex js-center ai-center">
                <h4 class="text-white">03</h4>
            </div>
            <div class="subpage_content_text">
                <h5>Jeonju Reading Festival 2020</h5>
                <h2>2020 전주독서대전</h2>
                <p>- 기간 : 2020. 9. 18.(금) ~ 9. 20.(일) / 3일간</p>
                <p>- 장소 : 국립무형유산원</p>
                <p>- 슬로건 : 책 읽는 도시 글 쓰는 전주</p>
                <p>- 주제 : ‘다독 다독, 당신을 듣겠습니다'</p>
                <p>- 참여단체 : 100여개(출판사, 지역서점, 작은도서관, 독서동아리 등 독서관련 기관 및 단체)</p>
                <p>- 주최 : 전주시</p>
                <p>- 후원 : 문화체육관광부(한국출판문화산업진흥원)</p>
                <p>- 협력기관 : 한국서점조합, 한국작은도서관협회, 전주교육지원청, 전라북도문인협회, 전주문화재단, 전주한벽문화관, 향교 전주한벽문화관, 완판본문화관, 최명희문학관,
                    전주전통문화연수원, 전주공·사립작은도서관협회, 전주서점조합, 전주시문화의집연합회, 전주시지역아동센터협회, 전주작은책방연합회, 전주독서동아리연합회, 모악출판사</p>
                <p>- 목적 : 책으로 내일을 여는 전주<br>
                    모든 시민이 책으로 함께하는, 「책 읽는 도시 전주」 정책 구현을 위한 사회적 독서 가치 실현</p>
                <p>- 목표 : 도서관 기반 전주다운 책 축제 구축<br>
                    책과 사람을 연결하는 새로운 상상의 문화적 매개 역할<br>
                    지적 호기심과 모험심을 자극하여 감성을 자극하는 책 축제
                    전주형 독서공동체와 지역 콘텐츠를 담을 수 있는 지속 가능한 축제</p>
                <p>- 방향 : 시민 중심 독서 가치 발견을 위한 역량 강화
                    매년 시대정신을 반영한 주제 발굴과 실험적인 콘텐츠 개발
                    남녀노소 모든 세대를 아우를 수 있는 독서공동체 가치 실현
                    전주지역 독서활동가들의 무대가 될 수 있는 장 마련
                    가족이 함께하는 일상의 독서 문화 확산에 기여</p>
                <p>- 유형 : 전주시 독서생태계와 독서공동체를 기반한 시민 참여형 책 축제</p>
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