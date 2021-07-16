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
    <div class="subpage_content eventPage d-flex">
        <div class="subpage_content_left">
            <div class="semicircle d-flex js-center ai-center">
                <h4 class="text-white">01</h4>
            </div>
            <div class="subpage_content_text">
                <h5>Jeonju Reading Festival 2020</h5>
                <h2>2020 전주독서대전</h2>
                <h2 class="event_table_title">행사목록</h2>
                <table class="event_table">
                    <thead>
                        <tr>
                            <th>순번</th>
                            <th>책사진</th>
                            <th>책제목</th>
                            <th>작가이름</th>
                            <th>독자대상</th>
                            <th>도서발매일</th>
                            <th>가능요일</th>
                            <th>가능시간</th>
                            <th>수정</th>
                            <th>삭제</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($meeting) == 0)
                            <tr>
                                <td colspan="7">행사가 없습니다.</td>
                            </tr>
                        @else
                            @foreach ($meeting as $mt)
                                <tr>
                                    <td>{{ $mt->id }}</td>
                                    <td><img src="{{ '/images/' . $mt->book_image }}" alt="book_image" title="book_image"></td>
                                    <td>{{ $mt->book_name }}</td>
                                    <td>{{ $mt->writer_name }}</td>
                                    <td>{{ $mt->target }}</td>
                                    <td>{{ $mt->create_date }}</td>
                                    <td>{{ $mt->meeting_week }}</td>
                                    <td>{{ $mt->meeting_time }}</td>
                                    <td><button data-id="{{ $mt->id }}" class="updateBtn">수정</button></td>
                                    <td><button data-id="{{ $mt->id }}" class="deleteBtn">삭제</button></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="add">
                    <a href="/event/register" id="addEvent">행사 추가</a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    window.addEventListener("load", () => {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        const updateBtn = document.querySelectorAll(".updateBtn");
        updateBtn.forEach(x => {
            x.addEventListener("click", e => {
                const id = x.dataset.id;
                location.href = `/event/update?id=${id}`;
            });
        });

        const deleteBtn = document.querySelectorAll(".deleteBtn");
        deleteBtn.forEach(x => {
            x.addEventListener("click", () => {
                if (!confirm("정말 삭제하시겠습니까?")) return;
                const id = x.dataset.id;
                $.ajax({
                    url: `/event/delete/${id}`,
                    type: 'DELETE',
                    success: rs => {
                        alert(rs.msg);
                        location.href = '/event/list';
                    }
                });
            });
        });
    });
</script>
@endsection