class Triangle extends Tool {
    constructor(){
        super(...arguments);
    }

    onmousedown(e){
        if(this.isDown) return;
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.ctx.fillStyle = this.editor.fillColor;
        this.ctx.strokeStyle = this.editor.styleColor;
        this.ctx.lineWidth = this.editor.lineWidth;

        this.downXY = this.getXY(e);
        this.isDown = true;
    }

    onmousemove(e){
        if(!this.isDown) return;
        let [x, y] = this.getXY(e);
        let [dx, dy] = this.downXY;

        let angle = Math.atan2(y - dy, x - dx);
        let length = Math.sqrt( Math.pow(x - dx, 2) + Math.pow(y - dy, 2) );

        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.ctx.beginPath();

        x = Math.cos( 0 * Math.PI / 180 + angle ) * length;
        y = Math.sin( 0 * Math.PI / 180 + angle ) * length;
        this.ctx.lineTo(x + dx, y + dy);

        x = Math.cos( 120 * Math.PI / 180 + angle ) * length;
        y = Math.sin( 120 * Math.PI / 180 + angle ) * length;
        this.ctx.lineTo(x + dx, y + dy);
        
        x = Math.cos( 240 * Math.PI / 180 + angle ) * length;
        y = Math.sin( 240 * Math.PI / 180 + angle ) * length;
        this.ctx.lineTo(x + dx, y + dy);

        x = Math.cos( 0 * Math.PI / 180 + angle ) * length;
        y = Math.sin( 0 * Math.PI / 180 + angle ) * length;
        this.ctx.lineTo(x + dx, y + dy);

        this.ctx.closePath();
        this.ctx.stroke();
        this.ctx.fill();
    }

    onmouseup(){
        if(!this.isDown) return;
        let url = this.canvas.toDataURL("image/png");
        this.page.addImage(url, 0, 0);

        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.update();

        this.isDown = false;
    }
}