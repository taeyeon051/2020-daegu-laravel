class Select extends Tool {
    constructor(){
        super(...arguments);
    }

    isImageClicked(item, x, y){
        if(item.nodeName !== "IMG") return true;

        let canvas = document.createElement("canvas");
        canvas.width = item.width;
        canvas.height = item.height;

        let ctx = canvas.getContext("2d");
        ctx.drawImage(item, 0, 0);

        let [r,g,b,a] = ctx.getImageData(x, y, 1, 1).data;
        return r+g+b+a !== 0;
    }

    getMouseTarget(e){
        let [x, y] = this.getXY(e);
        let items = Array.from(this.editor.workspace.find(".editor_canvas, .video"));
        for(let i = items.length - 1; i >= 0; i--){
            let item = items[i];
            if(item.nodeName == "CANVAS") continue;

            let left = item.offsetLeft;
            let top = item.offsetTop;
            let width = item.offsetWidth;
            let height = item.offsetHeight;

            if(this.isImageClicked(item, x - left, y - top) && left <= x && x <= left + width && top <= y && y <= top + height){
                return item;
            }     
        }
        return null;
    }

    onmousedown(e){
        let selected = this.getMouseTarget(e);
        if(selected) {
            this.editor.page.selectItem(selected.id);
            this.update();
        }
    } 
}