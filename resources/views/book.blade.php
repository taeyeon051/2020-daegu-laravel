@extends('master')

@section('content')
<!-- 비주얼 영역 -->
<section id="subpage_visual">
    <div class="subpage_visual w-100">
        <img src="/선수제공파일/A/img/23.PNG" alt="비주얼이미지1" title="비주얼이미지1">
    </div>
</section>

<!-- 행사개요 영역 -->
<section id="online_book">
    <div class="subpage_title d-flex ai-center">
        <div class="oneDept d-flex ai-center text-white">
            <b>온라인 책만들기</b>
        </div>
        <div class="twoDept">
            <ul class="d-flex">
                <li><a href="#" class="selected">도서목록</a></li>
            </ul>
        </div>
    </div>
    <div class="online_book_content">
        <div id="totalPage">Total 6건 1페이지</div>
        <div class="online_book_list"></div>
        <div class="search">
            <input type="text" id="search_input" placeholder="검색어를 입력해주세요">
            <button id="searchBtn"><i class="fa fa-search"></i></button>
        </div>
    </div>
</section>
<script src="/js/jquery-3.4.1.js"></script>
<script src="/js/book/Tool.js"></script>
<script src="/js/book/Circle.js"></script>
<script src="/js/book/Eraser.js"></script>
<script src="/js/book/Line.js"></script>
<script src="/js/book/Rect.js"></script>
<script src="/js/book/Select.js"></script>
<script src="/js/book/Text.js"></script>
<script src="/js/book/Triangle.js"></script>
<script src="/js/book/Page.js"></script>
<script src="/js/book/Editor.js"></script>
<script src="/js/app.js"></script>
@endsection