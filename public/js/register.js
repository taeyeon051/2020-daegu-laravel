const log = console.log;

class Register {
    constructor() {
        this.ranText = "";
        this.canvas = document.querySelector("#captchaImage");
        this.ctx = this.canvas.getContext("2d");

        this.randomText();
        this.addEvent();
    }

    addEvent() {
        const refresh = document.querySelector(".fa-refresh");
        refresh.addEventListener("click", e => {
            this.randomText();
        });

        const age = document.querySelector("#age");
        age.addEventListener("input", e => { e.target.value = Math.floor(e.target.value); });

        const checkBtn = document.querySelector("#captchaCheck");
        const checkbox = document.querySelector("#capCheckBox");
        const checkIcon = document.querySelector(".fa-check");
        checkBtn.addEventListener("click", e => {
            const captcha = document.querySelector("#captcha");
            if (captcha.value == this.ranText) {
                checkbox.setAttribute('checked', 'true');
                checkIcon.classList.remove("danger");
                checkIcon.classList.add("success");
            } else {
                checkbox.removeAttribute('checked');
                checkIcon.classList.remove("success");
                checkIcon.classList.add("danger");
                alert("captcha가 올바르지 않습니다.");
            }
        });
    }

    randomText() {
        this.ranText = "";
        for (let i = 0; i < 6; i++) {
            const nc = Math.round(Math.random()) > 0.5 ? 1 : 0;
            if (nc == 0) this.ranText += Math.round(Math.random() * 10);
            if (nc == 1) this.ranText += String.fromCharCode(Math.floor(Math.random() * 26) + 65);
        }
        if (this.ranText.length > 6) this.ranText = this.ranText.substr(0, 6);
        
        this.renderText();
    }

    renderText() {
        const c = this.ctx;
        c.clearRect(0, 0, 200, 60);

        for (let i = 0; i < this.ranText.length; i++) {
            const n = Math.round(Math.random()) > 0.5 ? 1 : 0;
            if (n == 0) {
                c.font = `bold ${Math.round(Math.random() * 20) + 20}px Courier`;
                c.fillText(this.ranText[i], (i + 1) * 25, 40);
            }
            if (n == 1) {
                c.font = `italic ${Math.round(Math.random() * 20) + 20}px Courier`;
                c.strokeText(this.ranText[i], (i + 1) * 25, 40);
            }
        }

        for (let y = 0; y < this.canvas.height; y++) {
            for (let x = 0; x < this.canvas.width; x++) {
                c.fillStyle = this.getRanColor();
                c.fillRect(x, y, 1, 1);
            }
        }
    }

    getRanColor() {
        let r = 255 * Math.random() | 0;
        let g = 255 * Math.random() | 0;
        let b = 255 * Math.random() | 0;
        return `rgba(${r}, ${g}, ${b}, 0.6)`;
    }
}

window.addEventListener("load", () => {
    const register = new Register();
});