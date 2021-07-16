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
                <li><a href="/event/list">행사등록</a></li>
                <li><a href="/meeting/check/admin" class="selected">예약관리</a></li>
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
                <div class="admin_page_search">
                    <div class="search">
                        <select name="category" id="category">
                            @if (isset($_GET['category']) && $_GET['category'] == "writer_name")
                            <option value="writer_name">작가이름</option>
                            <option value="user_name">예약자이름</option>
                            @else
                            <option value="user_name">예약자이름</option>
                            <option value="writer_name">작가이름</option>
                            @endif
                        </select>
                        <input type="text" id="search_input" placeholder="검색어를 입력해주세요" value="{{ isset($_GET['data']) ? $_GET['data'] : '' }}">
                        <button id="searchBtn"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <table class="admin_table">
                    <thead>
                        <tr>
                            <th>학생구분</th>
                            <th>예약자 이름</th>
                            <th>작가이름</th>
                            <th>예약날짜</th>
                            <th>예약시간</th>
                            <th>-</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($meeting) == 0)
                        <tr>
                            <td colspan="6">예약이 없습니다.</td>
                        </tr>
                        @endif
                        @foreach ($meeting as $mt)
                        <tr>
                            @foreach ($users as $user)
                            @if ($user->id == $mt->user_id)
                            <td>{{ $user->student }}</td>
                            <td>{{ $user->userName }}</td>
                            @endif
                            @endforeach
                            <td>{{ $mt->writer }}</td>
                            <td>{{ $mt->mdate }}</td>
                            <td>{{ substr($mt->mtime, 0, 5) }}</td>
                            <td><button data-id="{{ $mt->id }}" class="stateCheckBtn {{ $mt->state != 0 ? 'check' : '' }}">{{ $mt->state == 0 ? "대기중" : "예약완료" }}</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="graph_section">
                    <div class="graph">
                        <h3 class="d-flex js-center">작가별 현황</h3>
                        <div class="d-flex">
                            <div class="graph_left">
                                @foreach ($graphArr as $item)
                                    @if ($item['cnt'] > 0)
                                        <div class="graph_name">{{ $item['writer'] }}</div> 
                                    @endif
                                @endforeach
                            </div>
                            <div class="graph_right">
                                @php ($m = count($graphArr) > 0 ? max(array_column($graphArr, 'cnt')) : "")
                                @foreach ($graphArr as $item)
                                    @if ($item['cnt'] > 0)
                                        <div class="graph_item d-flex">
                                            <div class="graph_bar" style="width: calc(100% / <?= $m ?> * <?= $item['cnt'] ?>);"></div>
                                            <div class="graph_number">{{ $item['cnt'] }}</div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="graph">
                        <h3 class="d-flex js-center">학생구분별 현황</h3>
                        <div class="d-flex">
                            <div class="graph_left">
                                @foreach ($sArr as $item)
                                    @if ($item['cnt'] > 0)
                                        <div class="graph_name">{{ $item['st'] }}</div> 
                                    @endif
                                @endforeach
                            </div>
                            <div class="graph_right">
                                @php ($m = max(array_column($sArr, 'cnt')))
                                @foreach ($sArr as $item)
                                    @if ($item['cnt'] > 0)
                                        <div class="graph_item d-flex">
                                            <div class="graph_bar" style="width: calc(100% / <?= $m ?> * <?= $item['cnt'] ?>);"></div>
                                            <div class="graph_number">{{ $item['cnt'] }}</div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="subpage_content_right">
            <div class="subpage_poster_img">
                <img src="/선수제공파일/A/img/poster.jpg" alt="poster" title="poster">
            </div>
        </div>
    </div>
</section>

<script>
    window.addEventListener("load", () => {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const stateBtns = document.querySelectorAll(".stateCheckBtn");
        stateBtns.forEach(x => {
            x.addEventListener("click", () => {
                console.log(x.dataset.id);
                $.ajax({
                    url: `/stateUpdate/${x.dataset.id}`,
                    method: 'post',
                    data: {
                        'id': x.dataset.id
                    },
                    success: e => {
                        location.reload();
                    }
                });
            });
        });

        const searchBtn = document.querySelector("#searchBtn");
        searchBtn.addEventListener("click", () => search());
        window.addEventListener("keydown", e => {
            if (e.keyCode == 13) search();
        });

        function search() {
            const input = document.querySelector("#search_input");
            console.log(location.href.split("?")[0]);
            if (input.value.trim() == "") location.href = location.href.split("?")[0];
            const category = document.querySelector("#category");
            location.href = `/meeting/check/admin?category=${category.value}&data=${input.value}`;
        }
    });
</script>
@endsection