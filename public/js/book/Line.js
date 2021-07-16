class Line extends Tool {
    constructor() {
        super(...arguments);
    }

    onmousedown(e) {
        if (this.isDown) return;
        const [x, y] = this.getXY(e);

        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.ctx.lineWidth = this.editor.lineWidth;
        this.ctx.strokeStyle = this.editor.lineColor;
        this.ctx.lineJoin = "round";
        this.ctx.beginPath();
        this.ctx.moveTo(x, y);
        this.isDown = true;
    }

    onmousemove(e) {
        if (!this.isDown) return;
        const [x, y] = this.getXY(e);
        this.ctx.lineTo(x, y);
        this.ctx.stroke();
    }

    onmouseup() {
        if (!this.isDown) return;
        const url = this.canvas.toDataURL("image/png");
        this.page.addImage(url, 0, 0);

        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.update();
        this.isDown = false;
    }
}