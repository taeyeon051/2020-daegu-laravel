class Circle extends Tool {
    constructor() {
        super(...arguments);
    }

    onmousedown(e) {
        if (this.isDown) return;
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.ctx.fillStyle = this.editor.fillColor;
        this.ctx.strokeStyle = this.editor.lineColor;
        this.ctx.lineWidth = this.editor.lineWidth;

        this.downXY = this.getXY(e);
        this.isDown = true;
    }

    onmousemove(e) {
        if (!this.isDown) return;
        const [x, y] = this.getXY(e);
        const [dx, dy] = this.downXY;

        const radius = Math.sqrt(Math.pow(x - dx, 2) + Math.pow(y - dy, 2));

        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.ctx.beginPath();
        this.ctx.arc(dx, dy, radius, 0, Math.PI * 2);
        this.ctx.stroke();
        this.ctx.fill();
    }

    onmouseup() {
        if (!this.isDown) return;
        const url = this.canvas.toDataURL("image/png");
        this.page.addImage(url, 0, 0);

        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.isDown = false;
    }
}