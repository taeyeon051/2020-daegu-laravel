class Tool {
    constructor(editor) {
        this.editor = editor;
        this.canvas = editor.canvas;
        this.ctx = this.canvas.getContext("2d");
    }

    get page() {
        return this.editor.page;
    }

    update() {
        this.editor.update();
    }

    getXY({pageX, pageY}) {
        const {left, top} = this.editor.workspace.offset();
        const width = this.editor.workspace.width();
        const height = this.editor.workspace.height();

        const x = pageX - left < 0 ? 0 : pageX - left > width ? width : pageX - left;
        const y = pageY - top < 0 ? 0 : pageY - top > height ? height : pageY - top;

        return [x, y];
    }
}