function hangman(){
    var wrong_guess = 0;
    var correct_guess = 0;
    var guess_word = "";
    var guess_word_display = "";
    var correct_word = "";
    var first = true;

    // the initial image
    var html = "<p><img id='image' src='image/hm0.png' width='125' height='300'></p>";

    // guess
    html += "<p id='guess'></p>";

    // input form
    html += "<form>"

    // hidden tag
    html += "<input type='hidden' id='word' value='cave'>";

    // input letter
    html += "<p><label for='input_letter'>Letter: <input type='text' id='input_letter'></p>";

    // bottom
    html += "<p><input id='submit' type='submit' value='Guess!'>";
    html += "<input id='new_game' type='submit' value='New Game'></p>";

    // message
    html += "<p id='message'>&nbsp;</p>";

    html += "</form>";

    document.getElementById("play-area").innerHTML = html;

    // at the begin of game
    //correct_word = document.getElementById("word").value;

    if (document.getElementById("word").value == "cave"){
        correct_word = randomWord();
        document.getElementById("word").value = correct_word;
        console.log(correct_word);
    }

    var guess = document.getElementById("guess");
    guess.innerHTML = "";
    guess_word_display = "";
    for (var i=0; i < correct_word.length; i++){
        guess_word_display += "_ ";
    }
    guess.innerHTML = guess_word_display;


    document.getElementById("submit").onclick = function(event){
        event.preventDefault();
        var input = document.getElementById("input_letter");
        var image = document.getElementById("image");
        var guess = document.getElementById("guess");
        var message = document.getElementById("message");
        var correct = false;

        // invalid input check
        if (input.value === "" || typeof input.value != 'string' || input.value.length != 1){
            message.innerHTML = "You must enter a letter!";
            console.log("guess wrong");
            //wrong_guess += 1;
        } else {
            for (var i = 0; i < word.value.length; i++){
                if (input.value === correct_word.charAt(i)){
                    guess_word_display = guess_word_display.substring(0, 2 * i) + input.value + guess_word_display.substring(2 * i + 1);
                    correct = true;
                    correct_guess += 1;
                }
            }

            if (correct){
                console.log("guess true");
                //correct_guess += 1;
            }
            else {
                console.log("guess wrong");
                wrong_guess += 1;
            }

        }

        update(wrong_guess);
        guess.innerHTML = guess_word_display;
        // check all correct
        if (correct_guess === correct_word.length){
            message.innerHTML = "You Win!"
        }

        input.value = "";

    }



    document.getElementById("new_game").onclick = function (event) {
        event.preventDefault();

        correct_word = randomWord();
        document.getElementById("word").value = correct_word;

        var input = document.getElementById("input_letter");
        input.value = "";
        var image = document.getElementById("image");
        image.src = 'image/hm0.png';
        var guess = document.getElementById("guess");
        guess.innerHTML = "";
        var message = document.getElementById("message");
        message.innerHTML = "";

        wrong_guess = 0;
        correct_guess = 0;

        guess_word_display = "";
        for (var i=0; i < correct_word.length; i++){
            guess_word_display += "_ ";
        }
        guess.innerHTML = guess_word_display;

        console.log(correct_word);
    }


    function update(w){
        var input = document.getElementById("input_letter");
        var image = document.getElementById("image");
        var guess = document.getElementById("guess");
        var message = document.getElementById("message");
        // update image
        if (w === 0){
            image.src = 'image/hm0.png';
        }
        else if (w === 1){
            image.src = 'image/hm1.png';
        }
        else if (w === 2){
            image.src = 'image/hm2.png';
        }
        else if (w === 3){
            image.src = 'image/hm3.png';
        }
        else if (w === 4){
            image.src = 'image/hm4.png';
        }
        else if (w === 5){
            image.src = 'image/hm5.png';
        }
        else if (w === 6){
            image.src = 'image/hm6.png';
            message.innerHTML = "You guessed poorly!";
            guess_word_display = "";
            for (var i = 0; i < correct_word.length; i++){
                guess_word_display += correct_word.charAt(i);
                guess_word_display += " "
            }
            guess.innerHTML = guess_word_display;
        }
    }

    function randomWord() {
        var words = ["moon","home","mega","blue","send","frog","book","hair","late",
            "club","bold","lion","sand","pong","army","baby","baby","bank","bird","bomb","book",
            "boss","bowl","cave","desk","drum","dung","ears","eyes","film","fire","foot","fork",
            "game","gate","girl","hose","junk","maze","meat","milk","mist","nail","navy","ring",
            "rock","roof","room","rope","salt","ship","shop","star","worm","zone","cloud",
            "water","chair","cords","final","uncle","tight","hydro","evily","gamer","juice",
            "table","media","world","magic","crust","toast","adult","album","apple",
            "bible","bible","brain","chair","chief","child","clock","clown","comet","cycle",
            "dress","drill","drink","earth","fruit","horse","knife","mouth","onion","pants",
            "plane","radar","rifle","robot","shoes","slave","snail","solid","spice","spoon",
            "sword","table","teeth","tiger","torch","train","water","woman","money","zebra",
            "pencil","school","hammer","window","banana","softly","bottle","tomato","prison",
            "loudly","guitar","soccer","racket","flying","smooth","purple","hunter","forest",
            "banana","bottle","bridge","button","carpet","carrot","chisel","church","church",
            "circle","circus","circus","coffee","eraser","family","finger","flower","fungus",
            "garden","gloves","grapes","guitar","hammer","insect","liquid","magnet","meteor",
            "needle","pebble","pepper","pillow","planet","pocket","potato","prison","record",
            "rocket","saddle","school","shower","sphere","spiral","square","toilet","tongue",
            "tunnel","vacuum","weapon","window","sausage","blubber","network","walking","musical",
            "penguin","teacher","website","awesome","attatch","zooming","falling","moniter",
            "captain","bonding","shaving","desktop","flipper","monster","comment","element",
            "airport","balloon","bathtub","compass","crystal","diamond","feather","freeway",
            "highway","kitchen","library","monster","perfume","printer","pyramid","rainbow",
            "stomach","torpedo","vampire","vulture"];

        return words[Math.floor(Math.random() * words.length)];
    }
}