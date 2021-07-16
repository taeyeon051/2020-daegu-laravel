const log = console.log;

class App {
    constructor() {
        this.bookList = [];
        // 초성 배열
        this.chosungArr = ["ㄱ", "ㄲ", "ㄴ", "ㄷ", "ㄸ", "ㄹ", "ㅁ", "ㅂ", "ㅃ", "ㅅ", "ㅆ", "ㅇ", "ㅈ", "ㅉ", "ㅊ", "ㅋ", "ㅌ", "ㅍ", "ㅎ"];

        this.init();
    }

    init() {
        fetch("./선수제공파일/B/book.json")
            .then(res => res.json())
            .then(data => {
                this.bookList = data;
                this.bookListRender(data);
            });

        this.addEvent();
    }

    addEvent() {
        const search = document.querySelector("#search_input");
        const searchBtn = document.querySelector("#searchBtn");
        search.addEventListener("input", e => {
            this.searchEvent(e.target.value);
        });
        searchBtn.addEventListener("click", () => {
            this.searchEvent(search.value);
        });

        setTimeout(() => {
            const bookList = document.querySelectorAll(".book_item");
            bookList.forEach(x => {
                x.addEventListener("click", e => {
                    const book = this.bookList.find(f => f.name == x.querySelector(".book_item_title").innerText);
                    const editor = new Editor(book);
                    editor.open();
                });
            });
        }, 500);
    }

    editorPopup(book) {
        if (!this.isEditorPopup) return;
        let editor = new Editor(book);
    }

    searchEvent(value) {
        let searchList = [];

        if (value.trim() == "") {
            this.bookListRender(this.bookList);
            return;
        }
        
        this.bookList.forEach(book => {
            let isSearch = false;
            let sCategory = "";
            let sWriter = "";
            let { category, name, writer, company, image } = book;

            for (let i = 0; i < value.length; i++) {
                if (this.chosungArr.includes(value[i])) {
                    if (this.getChosung(book.category).includes(value[i])) sCategory += value[i];
                    if (this.getChosung(book.writer).includes(value[i])) sWriter += value[i];
                } else {
                    if (book.category.includes(value[i])) sCategory += this.getChosung(value[i]);
                    if (book.writer.includes(value[i])) sWriter += this.getChosung(value[i]);
                }
            }

            if (this.getChosung(book.category).includes(sCategory) && sCategory.trim() != "" && value.length == sCategory.length) {
                // const idx = this.getChosung(category).indexOf(sCategory);
                // category = `${category.substring(0, idx)}<mark>${category.substring(idx, idx + value.length)}</mark>${category.substring(idx + value.length)}`;
                isSearch = true;
            }
            if (this.getChosung(book.writer).includes(sWriter) && sWriter.trim() != "" && value.length == sWriter.length) {
                // const idx = this.getChosung(writer).indexOf(sWriter);
                // writer = `${writer.substring(0, idx)}<mark>${writer.substring(idx, idx + value.length)}</mark>${writer.substring(idx + value.length)}`;
                isSearch = true;
            }

            if (isSearch) searchList.push( { category, name, writer, company, image} );
        });

        this.bookListRender(searchList);
    }

    bookListRender(bookList) {
        const listDom = document.querySelector(".online_book_list");
        listDom.innerHTML = "";
        bookList.forEach(item => {
            const div = document.createElement("div");
            div.classList.add("book_item", "d-flex", "js-between", "ai-center");
            div.innerHTML =
                `<img src="./선수제공파일/B/img/${item.image}" alt="book" title="book">
                <div class="book_item_text">
                    <p class="book_item_title">${item.name}</p>
                    <p><span>카테고리</span>${item.category}</p>
                    <p><span>작가</span>${item.writer}</p>
                    <p><span>출판사</span>${item.company}</p>
                </div>`;
            listDom.appendChild(div);
        });
    }

    getChosung(str) {
        let result = "";

        for (let i = 0; i < str.length; i++) {
            if (str[i] == " ") {
                result += " ";
                continue;
            }
            const tmp = str[i].charCodeAt() - 0xAC00;
            const jong = tmp % 28;
            const jung = ((tmp - jong) / 28) % 21;
            const cho = (((tmp - jong) / 28) - jung) / 21;
            if (this.chosungArr[cho] != undefined) result += this.chosungArr[cho];
            else result += str[i];
        }

        return result;
    }
}

window.addEventListener("load", () => {
    const app = new App();
});