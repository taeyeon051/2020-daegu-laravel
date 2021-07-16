@extends('master')

@section('content')
<!-- 비주얼 영역 -->
<section id="subpage_visual">
    <div class="subpage_visual w-100">
        <img src="/선수제공파일/A/img/23.PNG" alt="비주얼이미지1" title="비주얼이미지1">
    </div>
</section>

<!-- 행사등록 영역 -->
<section id="subpage">
    <div class="subpage_title d-flex ai-center">
        <div class="oneDept d-flex ai-center text-white">
            <b>관리자 페이지</b>
        </div>
        <div class="twoDept">
            <ul class="d-flex">
                <li><a href="/event/list" class="selected">행사등록</a></li>
                <li><a href="/meeting/check/admin">예약관리</a></li>
            </ul>
        </div>
    </div>
    <div class="subpage_content d-flex">
        <div class="subpage_content_left">
            <div class="semicircle d-flex js-center ai-center">
                <h4 class="text-white">01</h4>
            </div>
            <div class="subpage_content_text">
                <h5>Jeonju Reading Festival 2020</h5>
                <h2>2020 전주독서대전</h2>
                <h2 class="event_table_title d-flex js-center">행사등록</h2>
                <form class="event_register" action="/event/register" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="input_group">
                        <label for="book_name">책제목</label>
                        <input type="text" name="book_name" id="book_name" required>
                    </div>
                    <div class="input_group">
                        <label>책사진</label>
                        <div class="book_image"></div>
                        <input type="file" name="book_image" id="book_image" hidden accept="image/*" required>
                        <label for="book_image" class="book_image_choose">파일 선택</label>
                    </div>
                    <div class="input_group">
                        <label for="writer_name">작가이름</label>
                        <input type="text" name="writer_name" id="writer_name" required>
                    </div>
                    <div class="input_group">
                        <label for="target">독자대상</label>
                        <select name="target" id="target" required>
                            <option value="es">초등학생</option>
                            <option value="ms">중학생</option>
                            <option value="hs">고등학생</option>
                        </select>
                    </div>
                    <div class="input_group">
                        <label for="create_date">도서 발매일</label>
                        <input type="date" name="create_date" id="create_date" required>
                    </div>
                    <div class="input_group">
                        <label for="week">만남 가능한 요일</label>
                        <select name="week" id="week" required>
                            <option value="일요일">일요일</option>
                            <option value="월요일">월요일</option>
                            <option value="화요일">화요일</option>
                            <option value="수요일">수요일</option>
                            <option value="목요일">목요일</option>
                            <option value="금요일">금요일</option>
                            <option value="토요일">토요일</option>
                        </select>
                    </div>
                    <div class="input_group">
                        <label for="start_time">시작시간</label>
                        <input type="time" name="start_time" id="start_time" required>
                    </div>
                    <div class="input_group">
                        <label for="end_time">종료시간</label>
                        <input type="time" name="end_time" id="end_time" required>
                    </div>
                    <div class="input_group d-flex js-end">
                        <button>행사추가</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="subpage_content_right">
            <div class="subpage_image_view"></div>
        </div>
    </div>
</section>

<script>
    window.addEventListener("load", () => {
        const imgName = document.querySelector(".book_image");
        const imgTarget = document.querySelector("#book_image");
        imgTarget.addEventListener("change", e => {
            const imgView = document.querySelector(".subpage_image_view");
            imgName.innerHTML = e.target.files[0].name;

            if (!e.target.files[0].type.match(/image\//)) return;

            const reader = new FileReader();
            reader.onload = e => {
                const src = e.target.result;
                imgView.innerHTML = `<img src="${src}" alt="book_image" title="book_image">`;
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>
@endsection