@extends('master')

@section('content')
<!-- 비주얼 영역 -->
<section id="subpage_visual">
    <div class="subpage_visual w-100">
        <img src="/선수제공파일/A/img/23.PNG" alt="비주얼이미지1" title="비주얼이미지1">
    </div>
</section>

<!-- 예약하기 영역 -->
<section id="subpage">
    <div class="subpage_title d-flex ai-center">
        <div class="oneDept d-flex ai-center text-white">
            <b>독자와의 만남</b>
        </div>
        <div class="twoDept">
            <ul class="d-flex">
                <li><a href="/meeting">예약하기</a></li>
                <li><a href="/meeting/check" class="selected">예약확인</a></li>
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
                <h2 class="d-flex js-center">예약확인</h2>
                <table class="meeting_check_table">
                    <thead>
                        <tr>
                            <th>순번</th>
                            <th>예약날짜</th>
                            <th>예약시간</th>
                            <th>작가이름</th>
                            <th>예약상태</th>
                            <th>상세보기</th>
                            <th>삭제</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($meeting) == 0)
                            <tr>
                                <td colspan="7">예약이 없습니다.</td>
                            </tr>
                        @else
                            @foreach ($meeting as $mt)
                                <tr>
                                    <td>{{ $mt->id }}</td>
                                    <td>{{ $mt->mdate }}</td>
                                    <td>{{ substr($mt->mtime, 0, 5) }}</td>
                                    <td>{{ $mt->writer }}</td>
                                    <td>{{ $mt->state == "0" ? "대기중" : "예약완료" }}</td>
                                    <td><button data-id="{{ $mt->id }}" id="viewBtn">상세보기</button></td>
                                    <td><button data-id="{{ $mt->id }}" id="deleteBtn">삭제</button></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="subpage_content_right">

        </div>
    </div>
</section>

<script>
    window.addEventListener("load", () => {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        const meeting = <?= $meeting ?>;
        const user = <?= session('loginData') ?>;
        const viewBtn = document.querySelectorAll("#viewBtn");
        const deleteBtn = document.querySelectorAll("#deleteBtn");
        viewBtn.forEach(x => {
            x.addEventListener("click", () => {
                const view = document.querySelector(".subpage_content_right");
                view.innerHTML = "";
                const div = document.createElement("div");
                div.classList.add("w-100", "h-100", "d-flex", "js-center", "ai-center");
                const mt = meeting.find(f => f.id == x.dataset.id);
                console.log(mt);
                div.innerHTML = 
                    `<table class="view_table">
                        <tr>
                            <th>이름</th>
                            <td>${user.userName}</td>
                        </tr>
                        <tr>
                            <th>나이</th>
                            <td>${user.age}</td>
                        </tr>
                        <tr>
                            <th>성별</th>
                            <td>${user.gender}</td>
                        </tr>
                        <tr>
                            <th>학생구분</th>
                            <td>${user.student}</td>
                        </tr>
                        <tr>
                            <th>작가에게 바라는 점</th>
                            <td>${mt.content}</td>
                        </tr>
                        <tr>
                            <th>예약날짜</th>
                            <td>${mt.mdate}</td>
                        </tr>
                        <tr>
                            <th>예약시간</th>
                            <td>${mt.mtime.substr(0, 5)}</td>
                        </tr>
                        <tr>
                            <th>작가이름</th>
                            <td>${mt.writer}</td>
                        </tr>
                        <tr>
                            <th>예약상태</th>
                            <td>${mt.state == 0 ? "대기중" : "예약완료"}</td>
                        </tr>
                    </table>`;
                view.appendChild(div);
            });
        });

        deleteBtn.forEach(x => {
            x.addEventListener("click", () => {
                if (!confirm("정말 삭제하시겠습니까?")) return;
                const id = x.dataset.id;
                $.ajax({
                    url: `/meeting/delete/${id}`,
                    type: 'DELETE',
                    success: rs => {
                        alert(rs.msg);
                        location.href = '/meeting/check';
                    }
                });
            });
        });
    });
</script>
@endsection