class Page {
    constructor(editor) {
        this.editor = editor;
        this.popup = $("<div class='page'></div>");
    }

    get outerHTML() {
        return this.popup[0].outerHTML;
    }

    addItem(el, x, y) {
        el.id = "item_" + new Date().getTime();
        el.classList.add("editor_canvas");
        $(el).css({ left: x + "px", top: y + "px" });
        this.popup.append(el);
        return el.id;
    }

    selectItem(id) {
        $('.page>*').removeClass("select");
        this.popup.find("#" + id).addClass("select");
    }

    removeItem(id) {
        this.popup.find("#" + id).remove();
    }

    addImage(url, x, y) {
        const image = document.createElement("img");
        image.src = url;

        const id = "item_" + new Date().getTime();
        this.popup.append(`<img id="${id}" src="${image.src}" class="editor_canvas" style="left: ${x}px; top: ${y}px;">`);
        this.editor.update();
        return id;
    }

    addVideo(url, x, y) {
        const id = "item_" + new Date().getTime();
        const video = document.createElement("video");
        video.src = url;
        video.onloadedmetadata = () => {
            this.popup.append(`<div id="${id}" class="video" style="left: ${x}px; top: ${y}px;">
                                    <video src="${video.src}"></video>
                                    <input type="range" min="0" max="${parseInt(video.duration)}" step="1" value="0">
                                    <button>재생</button>
                                </div>`);
            this.popup.append(`<script>
                                    (() => {
                                        const box = document.querySelector("#${id}");
                                        if (!box) return;
                                    
                                        const button = box.querySelector("button");
                                        const input = box.querySelector("input");
                                        const video = box.querySelector("video");
                                        button.innerText = "재생";
                                        video.pause();
                                    
                                        video.addEventListener("timeupdate", e => {
                                            input.value = parseInt(e.target.currentTime);
                                        });
                                    
                                        video.addEventListener("ended", e => {
                                            video.pause();
                                            input.value = 0;
                                            button.innerText = "재생";
                                        });
                                    
                                        button.addEventListener("mousedown", e => {
                                            e.stopPropagation();
                                            if (video.paused) {
                                                video.play();
                                                e.currentTarget.innerText = "일시정지";
                                            } else {
                                                video.pause();
                                                e.currentTarget.innerText = "재생";
                                            }
                                        });
                                    
                                        input.addEventListener("mousedown", e => {
                                            e.stopPropagation();
                                        });
                                    
                                        input.addEventListener("input", e => {
                                            video.currentTime = e.target.value;
                                        });
                                    })();
                                </script>`);
            this.editor.update();
        };
        return id;
    }
}