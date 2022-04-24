'use strict';

/**
 * Settings
 */
var DIFFICULTY = 0.05; // from 0 to 1, 1 being hardest

var WIDTH = 320;
var HEIGHT = 230;
var PADDLEWIDTH = 50;
var LEFTARROW = 37;
var RIGHTARROW = 39;
var OFFWHITE = "#f9fafc";
var BLUE = "#3b79b4";

/**
 * Draws a rounded rectangle using the current state of the canvas. 
 * If you omit the last three params, it will draw a rectangle 
 * outline with a 5 pixel border radius 
 * @param {CanvasRenderingContext2D} ctx
 * @param {Number} x The top left x coordinate
 * @param {Number} y The top left y coordinate 
 * @param {Number} width The width of the rectangle 
 * @param {Number} height The height of the rectangle
 * @param {Number} radius The corner radius. Defaults to 5;
 * @param {Boolean} fill Whether to fill the rectangle. Defaults to false.
 * @param {Boolean} stroke Whether to stroke the rectangle. Defaults to true.
 */
function roundRect(ctx, x, y, width, height, radius, fill, stroke) {
    if (typeof stroke === "undefined") {
        stroke = true;
    }
    if (typeof radius === "undefined") {
        radius = 5;
    }
    ctx.beginPath();
    ctx.moveTo(x + radius, y);
    ctx.lineTo(x + width - radius, y);
    ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
    ctx.lineTo(x + width, y + height - radius);
    ctx.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
    ctx.lineTo(x + radius, y + height);
    ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
    ctx.lineTo(x, y + radius);
    ctx.quadraticCurveTo(x, y, x + radius, y);
    ctx.closePath();
    if (stroke) {
        ctx.stroke();
    }
    if (fill) {
        ctx.fill();
    }
}

/**
 * Simple randomization between a min and max.
 * @param {number} min
 * @param {number} max
 * @returns {number} A random number between two points.
 */
function randomOffset(min, max) {
    return (Math.random() * (max - min)) + min;
}



/**
 * The paddle which is later attached to player and computer.
 * @param {number} x
 * @param {number} y
 * @param {number} width
 * @param {number} height
 */
function Paddle(x, y) {
    this.width = PADDLEWIDTH;
    this.height = 10;

    this.x = x;
    this.y = y;
    this.x_speed = 0;
    this.y_speed = 0;
}
/**
 * Render the paddle on the canvas.
 * @param {CanvasContext} ctx
 */
Paddle.prototype.render = function (ctx) {
    roundRect(ctx, this.x, this.y, this.width, this.height, 5, true, null);
};
/**
 * Move the paddle position on the canvas.
 * @param {number} x
 * @param {number} y
 */
Paddle.prototype.move = function (x, y) {
    this.x += x;
    this.y += y;
    this.x_speed = x;
    this.y_speed = y;
    if (this.x < 0) {
        this.x = 0;
        this.x_speed = 0;
    }
    else if (this.x + this.width > WIDTH) {
        this.x = WIDTH - this.width;
        this.x_speed = 0;
    }
};

/**
 * The AI user.
 */
function Computer() {
    this.score = 0;
    var paddleX = (WIDTH / 2) - (PADDLEWIDTH / 2);
    var paddleY = 10;
    this.paddle = new Paddle(paddleX, paddleY);
}
Computer.prototype.render = function (ctx) {
    this.paddle.render(ctx);
    ctx.fillText(this.score.toString(), 5, 30);
};
/**
 * Computer automatically adjusts position based on ball position, with a calculated margin of error.
 */
Computer.prototype.update = function (ball) {
    var ball_x_position = ball.x;
    // difference between ball x and the paddle x
    var diff = -((this.paddle.x + (this.paddle.width / 2)) - ball_x_position);
    if (diff < 0 && diff < -4) {
        diff = -5;
    }
    else if (diff > 0 && diff > 4) {
        diff = 5;
    }

    // sets the difficulty, an offset between these two numbers
    this.paddle.move(diff * randomOffset(DIFFICULTY, 1), 0);

    if (this.paddle.x < 0) {
        this.paddle.x = 0;
    }
    else if (this.paddle.x + this.paddle.width > WIDTH) {
        this.paddle.x = WIDTH - this.paddle.width;
    }
};

/**
 * The human user.
 */
function Player() {
    this.score = 0;
    var paddleX = (WIDTH / 2) - (PADDLEWIDTH / 2);
    var paddleY = HEIGHT - 20;
    this.paddle = new Paddle(paddleX, paddleY);
}

Player.prototype.render = function (ctx) {
    this.paddle.render(ctx);
    ctx.fillText(this.score.toString(), 5, HEIGHT - 30);
};

Player.prototype.update = function (keysDown) {
    var value;
    for (var key in keysDown) {
        value = Number(key);
        if (value === LEFTARROW) {
            this.paddle.move(-4, 0);
        }
        else if (value === RIGHTARROW) {
            this.paddle.move(4, 0);
        }
        else {
            this.paddle.move(0, 0);
        }
    }
};

/**
 * A ball, which handles it's own internal "physics"
 * @param {number} x optional default x position
 * @param {number} y optional default y position
 * @param {number} speedX optional default x speed
 * @param {number} speedY optional default y speed
 * @param {number} rad optional default radius
 */
function Ball(x, y, speedX, speedY, rad) {
    // console.debug('Creating Ball', x, y, speedX, speedY, rad);
    this.radius = rad || 5;

    this.default_x_position = function () { return typeof x === 'undefined' ? WIDTH / 2 : x; };
    this.default_y_position = function () { return typeof y === 'undefined' ? HEIGHT / 2 : y; };

    this.default_x_speed = function () { return typeof speedX === 'undefined' ? 0 : speedX; };
    this.default_y_speed = function () { return typeof speedY === 'undefined' ? 3 : speedY; };
    
    this.resetSpeed = function () {
        this.x_speed = this.default_x_speed();
        this.y_speed = this.default_y_speed();
        // console.debug('Resetting Ball speed', this.x_speed, this.y_speed);
    };
    this.resetPosition = function () {
        this.x = this.default_x_position();
        this.y = this.default_y_position();
        // console.debug('Resetting Ball position', this.x, this.y);
    };

    this.reset = function () {
        this.resetSpeed();
        this.resetPosition();
    };

    this.reset();
}

Ball.prototype.render = function (ctx) {
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.radius, 2 * Math.PI, false);
    ctx.fill();
};
/**
 * Ball movement is coded here. Score is determined when the ball moves.
 * Speed and position of the ball are determined internal to the ball object.
 */
Ball.prototype.update = function (playerBottom, playerTop) {
    // The speed is applied to the x and y positions of the ball, which moves the ball.
    this.x += this.x_speed;
    this.y += this.y_speed;

    var top_x = this.x - this.radius;
    var top_y = this.y - this.radius;
    var bottom_x = this.x + this.radius;
    var bottom_y = this.y + this.radius;
    var paddleBottom = playerBottom.paddle;
    var paddleTop = playerTop.paddle;

    // Figures out if the ball direction should change.
    var ballHitLeftWall = this.x - this.radius < 0;
    var ballHitRightWall = this.x + this.radius > WIDTH;
    if (ballHitLeftWall) {
        this.x = this.radius;
        this.x_speed = -this.x_speed;
    }
    else if (ballHitRightWall) {
        this.x = WIDTH - this.radius;
        this.x_speed = -this.x_speed;
    }

    // When somebody scores, reset the ball to the center.
    var bottomScored = this.y < 0;
    var topScored = this.y > 300;
    if (bottomScored || topScored) {

        if (bottomScored) {
            playerBottom.score++;
        }
        if (topScored) {
            playerTop.score++;
        }

        this.reset();
    }

    // Determines how much to change the ball speed.
    // When the ball hits a paddle:
    // the ball vertical trajectory reverses and gets set to a randomly but loosely based on the paddle speed,
    // and the horizontal speed increases by half the speed of the paddle.

    var ballInBottomOfScreen = top_y > (HEIGHT * 0.75);
    if (ballInBottomOfScreen) {

        var bottomPaddleYArea = paddleBottom.y + paddleBottom.height;
        var ballTopIsUnderBottomPaddle = top_y < bottomPaddleYArea;
        var ballBottomIsAboveBottomPaddle = bottom_y > paddleBottom.y;
        var ballYOverlapsBottomPaddle = ballTopIsUnderBottomPaddle && ballBottomIsAboveBottomPaddle;

        var bottomPaddleXArea = paddleBottom.x + paddleBottom.width;
        var ballXOverlapsBottomPaddle = top_x < bottomPaddleXArea && bottom_x > paddleBottom.x;

        var ballHitBottomPaddle = ballYOverlapsBottomPaddle && ballXOverlapsBottomPaddle;

        if (ballHitBottomPaddle) {
            this.y_speed = randomOffset(-(Math.abs(paddleBottom.x_speed || 4)), -0.9 * Math.abs(paddleBottom.x_speed || 4));
            this.x_speed += (paddleBottom.x_speed / 2);
            this.y += this.y_speed;
        }
    }
    else {
        var topPaddleBottom = paddleTop.y + paddleTop.height;
        var ballTopIsOverTopPaddle = top_y < topPaddleBottom;
        var ballBottomIsUnderTopPaddle = bottom_y > paddleTop.y;
        
        var ballXOverlapsTopPaddle = top_x < (paddleTop.x + paddleTop.width) && bottom_x > paddleTop.x;

        var ballHitTopPaddle = ballTopIsOverTopPaddle && ballBottomIsUnderTopPaddle && ballXOverlapsTopPaddle;
        
        if (ballHitTopPaddle) {
            this.y_speed = randomOffset(0.9 * Math.abs(paddleTop.x_speed || 4), Math.abs(paddleTop.x_speed || 4));
            this.x_speed += (paddleTop.x_speed / 2);
            this.y += this.y_speed;
        }
    }

};


/**
 * Play some pong.
 * @param string appendToElementId The id of the element you want to put pong inside.
 * @param object window
 * @param object document
 * @returns HTML5CanvasElement The canvas inside the element for which you supplied the id.
 */
function Pong(appendToElementId, window, document) {

    var el = document.getElementById(appendToElementId);
    var animate = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || function (callback) {
        window.setTimeout(callback, 1000 / 60);
    };

    var canvas = document.createElement("canvas");
    canvas.width = WIDTH;
    canvas.height = HEIGHT;
    canvas.style.borderRadius = '5px';
    canvas.style.border = '2px solid ' + OFFWHITE;

    var context = canvas.getContext('2d');
    context.fillStyle = BLUE;
    context.font = "12px sans-serif";

    var player = new Player();
    var computer = new Computer();

    var ball = new Ball();

    var keysDown = {};


    function render() {
        context.fillStyle = OFFWHITE;
        context.fillRect(0, 0, canvas.width, canvas.height);
        context.fillStyle = BLUE;

        player.render(context);
        computer.render(context);
        ball.render(context);
    }

    function update() {
        player.update(keysDown);
        computer.update(ball);
        ball.update(player, computer);
    }

    function step() {
        update();
        render(context);
        animate(step);
    }

    
    el.appendChild(canvas);
    animate(step);

    var keydownEvent = function (event) {
        keysDown[event.keyCode] = true;
    };
    var keyupEvent = function (event) {
        delete keysDown[event.keyCode];
    };
    var elementDestroyed = function (event) {
        window.removeEventListener('keydown', keydownEvent, false);
        window.removeEventListener('keyup', keyupEvent, false);
        window.removeEventListener('DOMNodeRemoved', elementDestroyed, false);
    };

    window.addEventListener("keydown", keydownEvent);
    window.addEventListener("keyup", keyupEvent);
    window.addEventListener("DOMNodeRemoved", elementDestroyed);

    return el;
};