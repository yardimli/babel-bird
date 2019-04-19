let ready = $(document).ready(function () {

    var SnakeDirection = "right";
    var SnakeXPositon = 1;
    var SnakeYPositon = 1;

    var TheSnake = [];
    var SnakeLength = 5;

    var LastKeyPress = 0;

    var RightBorder = 19;
    var LeftBorder = 0;
    var BottomBorder = 19;
    var TopBorder = 0;
    var lastremovedsquare = [];

    var Random_X = 0;
    var Random_Y = 0;

    var Gameover = false;

    ///=========================================

    //-------FOOD LOOP
    var FoodInterval = setInterval(function () {
        addFood();
    }, 3000);


    function resetFoodInterval() {

        clearInterval(FoodInterval);
        addFood();
        FoodInterval = setInterval(1000);

            // {
            console.log("restarted interval");
            //     var FoodHasBeenAdded = false;
            //     while (FoodHasBeenAdded === false) {
            //         resetFoodInterval();
            //         addFood();
            //
            //         if ($("#x_" + Random_X + "_y_" + Random_Y).hasClass("a_snake")
            //         ) {
            //             $('.a_square').removeClass("has_food");
            //             console.log('changeFoodLocation');
            //         } else
            //         {
            //             FoodHasBeenAdded = true;
            //         }
            //     }
            //
            //
        // }, 1000);

    }


    function addFood() {

        Random_X = Math.floor(Math.random() * 20);
        Random_Y = Math.floor(Math.random() * 20);

        $(".a_square").removeClass("has_food");
        $("#x_" + Random_X + "_y_" + Random_Y).addClass("has_food");

        // resetFoodInterval();
    }

    function ResetFoodLocation() {
        if ($("#x_" + SnakeXPositon + "_y_" + SnakeYPositon).hasClass("has_food")) {
            $(".a_square").removeClass("has_food");
            resetFoodInterval();
            console.log('changeFoodLocation')
        }

        if ($("#x_" + Random_X + "_y_" + Random_Y).hasClass("a_snake")) {
            $(".a_square").removeClass("has_food");
            resetFoodInterval();
            addFood();
            console.log("FoodoverlapsSnakeBody")
        }

    }


    function GameOver() {
        clearInterval(GameInterval);
        clearInterval(FoodInterval);
        $("#game_over").show();
    }

    function UpdateSnakeHead() {
        if (SnakeDirection === "up") {
            SnakeYPositon--;
        }
        if (SnakeDirection === "down") {
            SnakeYPositon++;
        }
        if (SnakeDirection === "left") {
            SnakeXPositon--;
        }
        if (SnakeDirection === "right") {
            SnakeXPositon++;
        }

        if (SnakeXPositon > RightBorder) {
            // SnakeXPositon = LeftBorder;
            // SnakeXPositon = RightBorder;
            GameOver();

        }
        if (SnakeXPositon < LeftBorder) {
            // SnakeXPositon = RightBorder;
            // SnakeXPositon = LeftBorder;
            GameOver();
        }

        if (SnakeYPositon > BottomBorder) {
            // SnakeYPositon = TopBorder;
            // SnakeYPositon = BottomBorder;
            GameOver();
        }
        if (SnakeYPositon < TopBorder) {
            // SnakeYPositon = BottomBorder;
            // SnakeYPositon = TopBorder;
            GameOver();
        }
    }


    //----------- DRAW FIRST GAME
    for (var y = 0; y < 20; y++) {

        var rowString = "";
        for (var x = 0; x < 20; x++) {
            rowString += "<div class='a_square' id='x_" + x + "_y_" + y + "'></div>";
        }
        $("#game_board").append("<div class='a_row'>" + rowString + "</div>");
    }

    addFood();


    //--------GAME LOOP
    var GameInterval = setInterval(function () {
        if (LastKeyPress === 38) {
            if (SnakeDirection !== "down") {
                SnakeDirection = "up";
            }
            console.log("up");
            // up arrow
        } else if (LastKeyPress === 40) {
            if (SnakeDirection !== "up") {
                SnakeDirection = "down";
            }
            console.log("down");
            // down arrow
        } else if (LastKeyPress === 37) {
            if (SnakeDirection !== "right") {
                SnakeDirection = "left";
            }
            console.log("left");
            // left arrow
        } else if (LastKeyPress === 39) {
            if (SnakeDirection !== "left") {
                SnakeDirection = "right";
            }
            console.log("right");
            // right arrow
        }

        UpdateSnakeHead();




        TheSnake.push("#x_" + SnakeXPositon + "_y_" + SnakeYPositon);
        if (TheSnake.length > SnakeLength) {
            lastremovedsquare = TheSnake.shift();

        }

        console.log(TheSnake);

        $(".a_square").removeClass("a_snake");
        var TheSnakeLength = TheSnake.length;
        for (var i = 0; i < TheSnakeLength; i++) {
            if ($(TheSnake[i]).hasClass("a_snake")) {
                GameOver();
                Gameover = true;
                // TheSnake.unshift();
                // $(lastremovedsquare).addClass("a_snake");

            } else if (Gameover === true){
                // TheSnake.unshift();
                $(lastremovedsquare).addClass("a_snake");

            }

            $(TheSnake[i]).addClass("a_snake");

        }






//        console.log(TheSnake);

        if ($("#x_" + SnakeXPositon + "_y_" + SnakeYPositon).hasClass("has_food")
        ) {

            // var FoodHasBeenAdded = false;
            // while (FoodHasBeenAdded === false) {
            //     resetFoodInterval();
            //     addFood();
            //
            //     if ($("#x_" + Random_X + "_y_" + Random_Y).hasClass("a_snake")
            //     ) {
            //         $('.a_square').removeClass("has_food");
            //         console.log('changeFoodLocation');
            //     } else {
            //         FoodHasBeenAdded = true;
            //     }
            // }
            SnakeLength = SnakeLength + 5;
            console.log("ate food");
            ResetFoodLocation();

        }


    }, 100);


    //------------------ KEYPRESS STUFF
    document.onkeydown = checkKey;

    function checkKey(e) {

        e = e || window.event;
        LastKeyPress = e.keyCode;

    }

});