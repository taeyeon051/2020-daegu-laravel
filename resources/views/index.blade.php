@extends('master')

@section('content')
<!-- 비주얼 영역 -->
<section id="visual">
            <input type="radio" id="move-1-2" name="move" hidden>
            <input type="radio" id="move-1-3" name="move" hidden>
            <input type="radio" id="move-2-1" name="move" hidden>
            <input type="radio" id="move-2-3" name="move" hidden>
            <input type="radio" id="move-3-1" name="move" hidden checked>
            <input type="radio" id="move-3-2" name="move" hidden>
            <input type="radio" id="move-1-2-copy" name="move" hidden>
            <input type="radio" id="move-1-3-copy" name="move" hidden>
            <input type="radio" id="move-2-1-copy" name="move" hidden>
            <input type="radio" id="move-2-3-copy" name="move" hidden>
            <input type="radio" id="move-3-1-copy" name="move" hidden>
            <input type="radio" id="move-3-2-copy" name="move" hidden>
            <div class="visualText">
                <p>2020 전주독서대전</p>
                <p>" 책 읽는 도시 글 쓰는 전주 "</p>
                <p>2020. 9. 18.(금) ~ 9. 20.(일)</p>
            </div>
            <div class="slide_img">
                <div class="vs_slide_images d-flex">
                    <img src="/선수제공파일/A/img/23.PNG" alt="비주얼이미지1" title="비주얼이미지1">
                    <img src="/선수제공파일/A/img/book-3480216_1920.jpg" alt="비주얼이미지2" title="비주얼이미지2">
                    <img src="/선수제공파일/A/img/2653034C572594B52E.jpg" alt="비주얼이미지3" title="비주얼이미지3">
                </div>
                <div class="vs_slide_arrows h-100 text-white d-flex js-center ai-center">
                    <div class="vs_slide_arrow">
                        <label for="move-1-3" class="scene-1"></label>
                        <label for="move-1-3-copy" class="scene-1-copy"></label>
                        <label for="move-2-1" class="scene-2"></label>
                        <label for="move-2-1-copy" class="scene-2-copy"></label>
                        <label for="move-3-2" class="scene-3"></label>
                        <label for="move-3-2-copy" class="scene-3-copy"></label>
                    </div>
                    <span class="vs_arrow_bar"></span>
                    <div class="vs_slide_arrow">
                        <label for="move-1-2" class="scene-1"></label>
                        <label for="move-1-2-copy" class="scene-1-copy"></label>
                        <label for="move-2-3" class="scene-2"></label>
                        <label for="move-2-3-copy" class="scene-2-copy"></label>
                        <label for="move-3-1" class="scene-3"></label>
                        <label for="move-3-1-copy" class="scene-3-copy"></label>
                    </div>
                </div>
                <div class="vs_slide_controls">
                    <div class="control">
                        <img src="/선수제공파일/A/img/23.PNG" alt="비주얼이미지1" title="비주얼이미지1">
                        <label for="" class="scene-1"></label>
                        <label for="" class="scene-1-copy"></label>
                        <label for="move-2-1" class="scene-2"></label>
                        <label for="move-2-1-copy" class="scene-2-copy"></label>
                        <label for="move-3-1" class="scene-3"></label>
                        <label for="move-3-1-copy" class="scene-3-copy"></label>
                    </div>
                    <div class="control">
                        <img src="/선수제공파일/A/img/book-3480216_1920.jpg" alt="비주얼이미지2" title="비주얼이미지2">
                        <label for="move-1-2" class="scene-1"></label>
                        <label for="move-1-2-copy" class="scene-1-copy"></label>
                        <label for="" class="scene-2"></label>
                        <label for="" class="scene-2-copy"></label>
                        <label for="move-3-2" class="scene-3"></label>
                        <label for="move-3-2-copy" class="scene-3-copy"></label>
                    </div>
                    <div class="control">
                        <img src="/선수제공파일/A/img/2653034C572594B52E.jpg" alt="비주얼이미지3" title="비주얼이미지3">
                        <label for="move-1-3" class="scene-1"></label>
                        <label for="move-1-3-copy" class="scene-1-copy"></label>
                        <label for="move-2-3" class="scene-2"></label>
                        <label for="move-2-3-copy" class="scene-2-copy"></label>
                        <label for="" class="scene-3"></label>
                        <label for="" class="scene-3-copy"></label>
                    </div>
                </div>
            </div>
            
            <!-- 독서대전소개 영역 -->
            <div id="introduce" class="d-flex flex-column js-center ai-center text-white">
                <div id="introduce_plus_btn">+</div>
                <span><b>독서대전 소개</b></span>
                <span><b>‘다독 다독, 당신을 듣겠습니다'</b></span>
                <div id="introduce_plus" class="d-flex flex-column js-between">
                    <p>전주독서대전 올해의 주제는 ‘다독 다독, 당신을 듣겠습니다’입니다. </p>
                    <p>독서의 끝은 자신의 고유한 세계와 감정을 직접 글로 쓰는 것이고 이것은 또 다른 책 읽기의 기쁨으로 이어집니다. </p>
                    <p>읽기와 쓰기는 한 몸처럼 연결되어 있습니다. </p>
                    <p>전주의 여러 도서관에서 상설로 다양한 글쓰기 프로그램(시쓰기, 서평쓰기, 글쓰기 등)을 진행하는 것은 독서의 본질을 꿰뚫는 좋은 기획입니다. </p>
                    <p>전주독서대전은 독서공동체들이 자발적으로 참여하는 시민 주도형 책 축제라는 특성을 갖고 있습니다.</p>
                    <p>도서관과 독서 공동체들이 중심이 되어서 독서생태계를 가꾸어 가는 것은 단 며칠의 축제 행사에 그칠 수는 없습니다. </p>
                    <p>일상을 책과 함께 할 수 있도록 집 앞의 도서관을 더 많이 확충하고 책을 읽는 즐거움을 나누는 다양한 문화마당을 펼쳐나가겠습니다.</p>
                </div>
            </div>
</section>

<!-- 행사 영역 -->
<section id="event" class="d-flex">
            <div class="event_box event_first">
                <a href="#" class="event_plus">더보기</a>
                <img src="/선수제공파일/A/img/13.png" alt="행사이미지1" title="행사이미지1">
                <div class="event_txt_box">
                    <h3>개막행사</h3>
                    <p>- 책으로 떠나는 백이십 년의 시간여행 조선 말 책을 읽어주던 전기수와 전주 부윤일행, 2020년 전주한벽루에 나타나다. 현대판 전기수인 북튜버와 조선 전기수의 입심 대결.
                        판소리와 랩, 흥겨운 연주가 함께 합니다.</p>
                </div>
            </div>
            <div class="event_box event_second">
                <a href="#" class="event_plus">더보기</a>
                <img src="/선수제공파일/A/img/초청작가/2.jpg" alt="행사이미지2" title="행사이미지2">
                <div class="event_txt_box">
                    <h3>책에게 말 걸기</h3>
                    <p>- 국 문학을 대표하는 중견 소설가. 전북 고창 출생. 소설집 '타인에게 말 걸기', '행복한 사람은 시계를 보지 않는다' '다른 모든 눈송이와 아주 비슷하게 생긴 단 하나의
                        눈송이' 장편소설 '새의 선물', '마지막 춤은 나와 함께', '그것은 꿈이었을까' '마이너리그', '비밀과 거짓말', '소년을 위로해줘', '태연한 인생'</p>
                </div>
            </div>
            <div class="event_box event_third">
                <a href="#" class="event_plus">더보기</a>
                <img src="/선수제공파일/A/img/8.jpg" alt="행사이미지3" title="행사이미지3">
                <div class="event_txt_box">
                    <h3>그 책_작가를 만나다</h3>
                    <p>- 어떻게 슬픔은 빛이 되는가 '정혜윤의 읽기와 쓰기'</p>
                    <p>- 독서에세이 '침대와 책'을 시작으로 '삶을 바꾸는 책 읽기', '마술라디오' 등 책과 사람에 관한 이야기를 썼다.</p>
                </div>
            </div>
            <div class="event_title d-flex flex-column js-between">
                <h2>2020 전주 독서대전</h2>
                <h2>행사 소개</h2>
            </div>
</section>

<!-- 초청작가 영역 -->
<section id="writer" class="d-flex flex-column ai-center">
            <input type="checkbox" id="modal_1" class="modal" hidden>
            <input type="checkbox" id="modal_2" class="modal" hidden>
            <input type="checkbox" id="modal_3" class="modal" hidden>
            <input type="checkbox" id="modal_4" class="modal" hidden>
            <div class="section_title d-flex js-center ai-center">
                <h3 class="text-white">초청 작가</h3>
            </div>
            <div class="section_bottom_arrow"></div>
            <button class="writer_plus_btn">더보기</button>
            <div class="writer_content">
                <p>전주에서는 매일이 책 축제이지만, 생일잔치처럼 작가와 독자가 즐겁게 만나는 특별한 마당도 펼쳐놓았습니다.</p>
                <p>책을 사랑하는 이들이 정겹게 만나는 아름다운 독서축제에 살아있는 이야기의 주인공이신 여러분들을 초대합니다.</p>
            </div>
            <div class="writer_cards d-flex js-evenly ai-center">
                <div class="writer_card">
                    <label for="modal_1">
                        <img src="/선수제공파일/A/img/초청작가/1.jpg" alt="작가1" title="작가1">
                    </label>
                </div>
                <div class="writer_card">
                    <label for="modal_2">
                        <img src="/선수제공파일/A/img/초청작가/2.jpg" alt="작가2" title="작가2">
                    </label>
                </div>
                <div class="writer_card">
                    <label for="modal_3">
                        <img src="/선수제공파일/A/img/초청작가/3.jpg" alt="작가3" title="작가3">
                    </label>
                </div>
                <div class="writer_card">
                    <label for="modal_4">
                        <img src="/선수제공파일/A/img/초청작가/4.jpg" alt="작가4" title="작가4">
                    </label>
                </div>
            </div>
            <div class="modal_img">
                <label for="modal_1"></label>
                <label for="modal_2"></label>
                <label for="modal_3"></label>
                <label for="modal_4"></label>
                <img src="/선수제공파일/A/img/초청작가/1.jpg" alt="이미지1">
                <img src="/선수제공파일/A/img/초청작가/2.jpg" alt="이미지2">
                <img src="/선수제공파일/A/img/초청작가/3.jpg" alt="이미지3">
                <img src="/선수제공파일/A/img/초청작가/4.jpg" alt="이미지4">
            </div>
</section>

<!-- 강연목록 영역 -->
<section id="lectureList" class="d-flex flex-column ai-center">
            <input type="radio" name="lecture" id="circle_1" hidden>
            <input type="radio" name="lecture" id="circle_2" hidden>
            <input type="radio" name="lecture" id="circle_3" hidden>
            <input type="radio" name="lecture" id="circle_4" hidden checked>
            <div class="section_title d-flex js-center ai-center">
                <h3 class="text-white">강연목록</h3>
            </div>
            <div class="section_bottom_arrow"></div>
            <div class="lecture_circle">
                <div class="circle_item">
                    <h3>작가_독자를 만나다</h3>
                    <p>일시 : '20. 9. 19.(토) 10:00</p>
                    <p>초청작가 : 장석주&박연준(작가)<br></p>
                    <p>주제 : 작가 부부의 '읽는 생활, 쓰는 삶</p>
                </div>
                <div class="circle_item">
                    <h3>전주를 읽어드립니다.</h3>
                    <p>기간 : '20. 9. 18.(금) ~ 9. 20.(일)</p>
                    <p>강연자 : 정진욱(영화), 장명수(음식),<br>이재운(역사)</p>
                    <p>주제 : 전주를 읽어드립니다</p>
                </div>
                <div class="circle_item">
                    <h3>전주 올해의 책_작가</h3>
                    <p>일시 : '20. 9. 19.(토) 13:00</p>
                    <p>초청작가 : 강양구(작가)</p>
                    <p>주제 : 인류는 바이러스를 이길 수 있을까?</p>
                </div>
                <div class="circle_item">
                    <h3>여는 이야기</h3>
                    <p>일시 : '20. 9. 18.(금) 19:00</p>
                    <p>초청작가 : 최재천(작가)</p>
                    <p>주제 : 인류의 미래와 생태적 전환</p>
                </div>
                <div class="circle_cover">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <div class="circle_center d-flex js-center ai-center">
                    <i class="fa fa-book"></i>
                    <label for="circle_1"></label>
                    <label for="circle_2"></label>
                    <label for="circle_3"></label>
                    <label for="circle_4"></label>
                </div>
            </div>
</section>
@endsection