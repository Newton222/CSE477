function Simon(sel) {

    console.log('Simon started');

    // Get a reference to the form object
    this.form = $(sel);
    this.configureButton(0,"red");
    this.configureButton(1,"green");
    this.configureButton(2,"blue");
    this.configureButton(3,"yellow");
    this.state = "initial";
    this.sequence = [Math.floor(4 * Math.random())];
    this.current = 0;

    this.play();
}

Simon.prototype.buttonPress = function(buttonidx, color) {
    var that = this;
    console.log("Button press: " + buttonidx);
    if (this.state == "enter"){
        var seqidx = this.sequence[this.current];
        if (seqidx == buttonidx){
            this.current++;
            if (this.current >= this.sequence.length){
                console.log("Won that round!");
                this.sequence.push(Math.floor(4 * Math.random()));
                console.log(this.sequence);
                window.setTimeout(function() {
                    that.playCurrent();
                }, 1000);
                this.current = 0;
            }
        }else{
            document.getElementById("buzzer").play();
            this.sequence = [Math.floor(4 * Math.random())];
            window.setTimeout(function() {
                that.playCurrent();
            }, 1000);
            this.current = 0;
        }
    }
}

Simon.prototype.play = function() {
    this.state = "play";    // State is now playing
    this.current = 0;       // Starting with the first one
    this.playCurrent();
}

Simon.prototype.playCurrent = function() {
    var that = this;

    if(this.current < this.sequence.length) {
        // We have one to play
        var colors = ['red', 'green', 'blue', 'yellow'];
        document.getElementById(colors[this.sequence[this.current]]).play();
        this.buttonOn(this.sequence[this.current]);
        console.log("current ",this.current);
        this.current++;

        window.setTimeout(function() {
            that.playCurrent();
        }, 1000);
    } else {
        this.buttonOn(-1);
        this.state = "enter";
        this.current = 0;
    }
}

Simon.prototype.buttonOn = function(idx) {
    var colors = ['red', 'green', 'blue', 'yellow'];
    for(var i=0; i<4; i++){
        var button = $(this.form.find("input").get(i));
        if (i==idx){
            button.css("background-color", colors[i]);
        }else{
            button.css("background-color", "lightgrey");
        }
    }
}

Simon.prototype.configureButton = function(ndx, color) {
    var button = $(this.form.find("input").get(ndx));
    var that = this;

    button.click(function(event) {
        document.getElementById(color).currentTime = 0;
        document.getElementById(color).play();
        that.buttonPress(ndx, color);
    });

    button.mousedown(function(event) {
        button.css("background-color", color);
        //console.log("presse "+color);
    });

    button.mouseup(function(event) {
        button.css("background-color", "lightgrey");
    });
}