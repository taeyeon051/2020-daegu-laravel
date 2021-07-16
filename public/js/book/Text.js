class Text extends Tool {
    constructor(){
        super(...arguments);
    }

    onmousedown(e){
        let [x, y] = this.getXY(e);
        let text = prompt("삽입할 텍스트를 입력하세요");
        if(!text) return;
        let elem = $(`<div class="page__item" style="color: ${this.editor.styleColor};font-size: ${this.editor.fontSize}px;">${text}</div>`)[0];
        
        this.page.addItem(elem, x, y);
        this.update();
    }
}