class Editor {
    constructor(book) {
        this.popup = this.getLayout();
        this.workspace = this.popup.find(".editor_body");
        this.book = book;

        this.canvas = document.createElement("canvas");
        this.canvas.classList.add("editor_canvas");
        this.canvas.width = 1000;
        this.canvas.height = 550;
        $(this.canvas).css({ left: '0', top: '0' });

        this.pages = [];
        this.index = 0;

        this.tools = {
            line: new Line(this),
            rect: new Rect(this),
            triangle: new Triangle(this),
            circle: new Circle(this),
            text: new Text(this),
            select: new Select(this),
            eraser: new Eraser(this),
        };

        this.selected = null;

        this.init().then(() => {
            this.addEvent();
        });
    }

    get lineColor() {
        return $("#line_color").val();
    }

    get fillColor() {
        return $("#bgc_color").val();
    }

    get fontSize() {
        return $("#font_size").val();
    }

    get lineWidth() {
        return $("#line_border").val();
    }

    get width() {
        return this.workspace.width();
    }

    get height() {
        return this.workspace.height();
    }

    get page() {
        return this.pages[this.index];
    }

    get tool() {
        return this.tools[this.selected];
    }

    async init() {
        // 첫 번째 페이지
        let imagePage = new Page(this);
        const coverUrl = "/선수제공파일/B/img/" + this.book.image;
        let image = await new Promise(res => {
            let img = new Image();
            img.src = coverUrl;
            img.onload = () => res(img);
        });

        const img = document.createElement("img");
        img.height = image.height > 545 ? 545 : image.height;
        img.width = img.height * image.width / image.height;
        const x = this.width / 2 - img.width / 2;
        const y = this.height / 2 - img.height / 2;
        img.src = image.src;
        imagePage.addItem(img, x, y);
        this.pages.push(imagePage);

        // 두 번째 페이지
        let introPage = new Page(this);
        let introUrl = "/선수제공파일/B/img/intro.jpg";
        const introImg = document.createElement("img");
        introImg.width = 700;
        introImg.height = 550;
        introImg.src = introUrl;
        introPage.addItem(introImg, 100, 0);
        this.pages.push(introPage);

        // 세 번째 페이지
        let videoPage = new Page(this);
        videoPage.addVideo("/선수제공파일/B/movie/ex.mp4", 0, 0);

        this.pages.push(videoPage);
    }

    update() {
        if (!this.page) return;
        this.workspace.html(this.page.outerHTML);
        this.workspace[0].append(this.canvas);
        this.popup[2].querySelector(".nowPage").innerHTML = `페이지 : ${this.index + 1} / ${this.pages.length}`;
    }

    open() {
        if (document.querySelector("#editor")) document.querySelector("#editor").remove();
        document.querySelector("body").append(this.popup[2]);
    }

    close() {
        document.querySelector("#editor").remove();
    }

    addEvent() {
        $("[data-role].editor_btn").on("click", e => {
            this.selected = e.currentTarget.dataset.role;

            $(".editor_btn.selected").removeClass("selected");
            e.currentTarget.classList.add("selected");
        });

        this.popup[2].querySelector("#editor_close").addEventListener("click", this.close);

        this.popup[2].querySelector("#prevPage").addEventListener("click", e => {
            this.index = this.index - 1 <= 0 ? 0 : this.index - 1;
            this.update();
        });

        this.popup[2].querySelector("#nextPage").addEventListener("click", e => {
            this.index = this.index + 1 >= this.pages.length ? this.pages.length - 1 : this.index + 1;
            this.update();
        });

        this.popup[2].querySelector("#addPage").addEventListener("click", e => {
            this.pages.push(new Page(this));
            this.index = this.pages.length - 1;
            this.update();
        });

        this.workspace[0].addEventListener("mousedown", e => {
            if (this.imageURL) {
                this.page.addImage(this.imageURL, e.offsetX, e.offsetY);
                this.imageURL = null;
            } else if (this.videoURL) {
                this.page.addVideo(this.videoURL, e.offsetX, e.offsetY);
                this.videoURL = null;
            } else if (e.which === 1 && this.tool && this.tool.onmousedown) {
                this.tool.onmousedown(e);
            }
        });

        this.workspace[0].addEventListener("mousemove", e => {
            if (e.which === 1 && this.tool && this.tool.onmousemove) this.tool.onmousemove(e);
        });

        window.addEventListener("mouseup", e => {
            if (e.which === 1 && this.tool && this.tool.onmouseup) this.tool.onmouseup(e);
        });

        this.popup[2].querySelector("#image_upload").addEventListener("change", e => {
            this.selected = null;
            $(".editor_btn").removeClass("selected");

            const file = e.target.files.length > 0 ? e.target.files[0] : null;
            if (file) {
                let reader = new FileReader();
                reader.onload = () => this.imageURL = reader.result;
                reader.readAsDataURL(file);
            }
            e.target.value = "";
        });

        this.popup[2].querySelector("#video_upload").addEventListener("change", e => {
            this.selected = null;
            $(".editor_btn").removeClass("selected");

            const file = e.target.files.length > 0 ? e.target.files[0] : null;
            if (file) {
                let reader = new FileReader();
                reader.onload = () => this.videoURL = reader.result;
                reader.readAsDataURL(file);
            }
            e.target.value = "";
        });

        this.popup[2].querySelector("#html_down").addEventListener("click", e => {
            const htmlPages = this.pages.map(item => item.outerHTML);
            const html =
                `<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                </head>
                <body>
                    ${htmlPages.join('')}
                </body>
                </html>`;
            const blob = new Blob([html], { type: "text/html" });
            const a = document.createElement("a");
            a.href = URL.createObjectURL(blob);
            a.download = this.book.name + ".html";
            a.click();
        });
    }

    getLayout() {
        return $(
            `<!-- 에디터 팝업 -->
            <div id="editor" class="w-100 d-flex js-center ai-center">
                <div class="inner">
                    <div class="editor_header">
                        <div class="page_btns d-flex js-between">
                            <div class="nowPage">페이지 : 1 / 3</div>
                            <button class="editor_btn" id="prevPage">이전</button>
                            <button class="editor_btn" id="nextPage">다음</button>
                            <button class="editor_btn" id="addPage">페이지 추가</button>
                        </div>
                        <div class="select_btns d-flex js-between">
                            <button class="editor_btn" data-role="select">객체선택</button>
                            <button class="editor_btn" data-role="line">펜</button>
                            <button class="editor_btn" data-role="rect">사각형</button>
                            <button class="editor_btn" data-role="circle">원형</button>
                            <button class="editor_btn" data-role="triangle">삼각형</button>
                            <button class="editor_btn" data-role="text">텍스트</button>
                            <button class="editor_btn" data-role="eraser">삭제</button>
                            <label for="image_upload" class="editor_btn">사진넣기</label>
                            <label for="video_upload" class="editor_btn">영상넣기</label>
                            <input type="file" id="image_upload" accept="image/*" hidden>
                            <input type="file" id="video_upload" accept="video/*" hidden>
                        </div>
                        <div class="select_color d-flex js-between">
                            <div>
                                <label for="line_color">선색 : </label>
                                <input type="color" id="line_color">
                            </div>
                            <div>
                                <label for="bgc_color">면색 : </label>
                                <input type="color" id="bgc_color">
                            </div>
                            <div>
                                <label for="line_border">선두께 : </label>
                                <input type="number" value="1" min="1" id="line_border">
                            </div>
                            <div>
                                <label for="font_size">글자크기 : </label>
                                <input type="number" value="16" min="1" id="font_size">
                            </div>
                        </div>
                    </div>
                    <div class="editor_body">

                    </div>
                    <div class="editor_footer d-flex js-end ai-center">
                        <button id="html_down" class="editor_btn">HTML 저장</button>
                    </div>
                    <button id="editor_close" class="editor_btn">닫기</button>
                </div>
            </div>`
        );
    }
}