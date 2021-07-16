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
                <li><a href="/meeting" class="selected">예약하기</a></li>
                <li><a href="/meeting/check">예약확인</a></li>
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
                <div class="calendar">
                    <div class="calendar_header w-100 d-flex js-center ai-center">
                        <a href="/meeting?year={{ date('Y', $prev) }}&month={{ date('m', $prev) }}">이전 달</a>
                        <div class="now_date">
                            <h2>{{ $year }}년 {{ $month }}월</h2>
                        </div>
                        <a href="/meeting?year={{ date('Y', $next) }}&month={{ date('m', $next) }}">다음 달</a>
                    </div>
                    <div class="calendar_body">
                        <div class="week">일</div>
                        <div class="week">월</div>
                        <div class="week">화</div>
                        <div class="week">수</div>
                        <div class="week">목</div>
                        <div class="week">금</div>
                        <div class="week">토</div>

                        @for ($i = 0; $i < date("w", $firstDay); $i++) 
                            <div class="day none"></div>
                        @endfor

                        @for ($i = date("d", $firstDay); $i <= date("d", $lastDay); $i++) 
                            <div class="day" data-date="{{ $year }}-{{ $month }}-{{ $i != 1 && $i < 10 ? '0' . $i : $i }}">
                                <span>{{ (int)$i }}</span>
                            </div>
                        @endfor

                        @for ($i = 0; $i < 6 - date("w", $lastDay); $i++) 
                            <div class="day none"></div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        <div class="subpage_content_right">
            <div class="w-100 h-100 d-flex flex-column js-center ai-center">
                <form action="/meeting" method="POST">
                    {!! csrf_field() !!}
                    <div class="additions">
                        <select name="writer" id="writerList" required>
                            <option>날짜를 선택하세요.</option>
                        </select>
                        <select name="time" id="time" required>
                            <option>작가를 선택하세요.</option>
                        </select>
                        <h3 class="d-flex js-center">추가사항</h3>
                        <input type="text" name="userId" value="{{ session('loginData')->userId }}" readonly>
                        <input type="text" name="name" value="{{ session('loginData')->userName }}" readonly>
                        <input type="text" name="student" value="{{ session('loginData')->student }}" readonly>
                        <input type="number" name="age" value="{{ session('loginData')->age }}" readonly>
                        <input type="text" name="gender" value="{{ session('loginData')->gender }}" readonly>
                        <textarea name="want" id="want" placeholder="작가에게 바라는 점" required></textarea>
                        <input type="text" name="date" id="date" hidden>
                        <input type="submit" value="예약신청">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    window.addEventListener("load", () => {
        let selDay;
        const dateInput = document.querySelector("#date");
        const days = document.querySelectorAll(".day:not(.none)");
        days.forEach(x => {
            x.addEventListener("click", e => {
                days.forEach(x => {
                    x.classList.forEach(c => {
                        if (c == "selected") x.classList.remove("selected");
                    });
                });
                e.target.classList.add("selected");
                selDay = e.target.dataset.date;
                dateInput.value = selDay;
                selectWriter();
            });
        });

        const meeting = <?= json_encode($meeting, JSON_UNESCAPED_UNICODE) ?>;
        const writer = document.querySelector("#writerList");
        const time = document.querySelector("#time");
        const week = ["일", "월", "화", "수", "목", "금", "토"];

        function selectWriter() {
            const selectDate = week[new Date(selDay).getDay()];
            const writerList = [];
            meeting.forEach(writer => {
                const writerDate = writer.meeting_week.substr(0, 1);
                if (selectDate == writerDate) writerList.push(writer);
            });

            writer.innerHTML = "";
            writer.innerHTML = `<option>날짜를 선택하세요.</option>`;
            writerList.forEach(w => {
                const option = document.createElement("option");
                option.value = w.writer_name;
                option.innerHTML = w.writer_name;
                writer.appendChild(option);
            });
        }

        writer.addEventListener("change", e => {
            selectTime(writer.value);
        });

        function selectTime(writer) {
            const w = meeting.find(f => f.writer_name == writer);
            const ableTime = w.meeting_time.split("~");
            time.innerHTML = "";
            time.innerHTML = `<option>작가를 선택하세요.</option>`;
            let startHour = ableTime[0].split(":")[0];
            let endHour = ableTime[1].split(":")[0];
            let startMin = ableTime[0].split(":")[1];
            let endMin = ableTime[1].split(":")[1];
            const option = document.createElement("option");
            option.value = startHour + ":" + startMin;
            option.innerHTML = startHour + ":" + startMin;
            time.appendChild(option);
            while (startHour < endHour) {
                startMin = startMin * 1 + 10;
                if (startMin >= 60) {
                    startMin = "00";
                    startHour = startHour * 1 + 1;
                }
                const option = document.createElement("option");
                option.value = startHour + ":" + startMin;
                option.innerHTML = startHour + ":" + startMin;
                time.appendChild(option);
            }
        }
    });
</script>

@endsection