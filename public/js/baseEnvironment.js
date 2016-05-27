document.addEventListener( 'DOMContentLoaded', function () {


// main visibility API function 
// use visibility API to check if current tab is active or not
var vis = (function(){
    var stateKey, 
        eventKey, 
        keys = {
                hidden: "visibilitychange",
                webkitHidden: "webkitvisibilitychange",
                mozHidden: "mozvisibilitychange",
                msHidden: "msvisibilitychange"
    };
    for (stateKey in keys) {
        if (stateKey in document) {
            eventKey = keys[stateKey];
            break;
        }
    }
    return function(c) {
        if (c) document.addEventListener(eventKey, c);
        return !document[stateKey];
    }
})();

"use strict";





var deltaTimePassed ;
var startingTime;
var lastTime;
var gameTime;
var baseTime = 16.674;
var time = deltaTimePassed / baseTime;
var timeSqr = Math.pow(time,2);
var counter = 0;

// check if current tab is active or not
vis(function(){
                    
    if(vis()){  

        // tween resume() code goes here                                                   
    } else {
    
        // tween pause() code goes here
        lastTime = null;
        gameObject.movingRightFlag = false;
        gameObject.movingLeftFlag = false;
    }
});




    //*************************  Key Events  *************************\\

    $(document).keyup(function (event){
        processKeyUp(event.keyCode);
    });

    $(document).keydown(function (event){
        processKeyDown(event.keyCode);
    });

    function processKeyDown(event){

        if(event === 39) {  
                            if (gameObject.movingRightFlag === false){
                                gameObject.stopMovingLeft();
                                square.ft = 15;
                                square.ftMax = 216;
                                square.ftSize = 1;
                                gameObject.movingRightFlag = true;
                            }
                        }
        if(event === 37){
                            if (gameObject.movingLeftFlag === false) {
                                gameObject.stopMovingRight();
                                square.ft = 15;
                                square.ftMax = 216;
                                square.ftSize = 1;
                                gameObject.movingLeftFlag = true;   
                            }
                        }
        (event === 32) && gameObject.jump();
        (event === 13) && gameObject.firePressed();
        // if (event ===13) {
        //  setInterval (function(){
        //      counter++;
        //      new gameObject.fire();
        //  },1);
        // }
        // if(event === 48) gameOver();
    }
    function processKeyUp(event){
        (event === 39) && gameObject.stopMovingRight();
        (event === 37) && gameObject.stopMovingLeft();
    }


        //************************  Variable Declarations  ****************\\

    var requestAnimationFrame =  window.requestAnimationFrame ||
                                 window.mozRequestAnimationFrame ||
                                 window.webkitRequestAnimationFrame ||
                                 window.msRequestAnimationFrame;

    var c = document.getElementById("canvas");
    var ctx = c.getContext("2d");

    // var controller = document.getElementById("myController");


    /**
     *  Sizing for diffrent devices
     *
     *  Gets the size of the canvas_container that is set by bootstrap
     *  and used that to set the canvas width and height.
     */
    c.setAttribute('width', document.getElementById("main").offsetWidth - 2);
    c.setAttribute('height', ctx.canvas.width * .45);
    var cx = ctx.canvas.width;
    var cy = ctx.canvas.height;

    /**
     *  Set cSizing (canvas sizing) to height / 100.   
     *  cSizing is just a canvas unit used to make game scaleable.
     */
    var cSizing = cy;
    cSizing *= .01;
    cy *= .01;
    cx *= .01;

 // ********************  Controller listeners  ************************\\

var buttonFlag = false;

function handleStart(evt) {
  evt.preventDefault();
  var el = document.getElementById("canvas");
  var touches = evt.changedTouches;
  // var yOff = -70;
  var yOff = 0;
  var xOff = 0;

  if ( buttonFlag === false){
    buttonFlag = true;
    gameObject.createButtons();
  }
        
  for (var i = 0; i < touches.length; i++) {
    for (var j = 0; j < gameObject.buttons.length; j++){
        if (gameObject.buttons[j].left()  < evt.changedTouches[i].pageX + xOff && 
            gameObject.buttons[j].right() > evt.changedTouches[i].pageX + xOff &&
            gameObject.buttons[j].top()   < evt.changedTouches[i].pageY + yOff &&
            gameObject.buttons[j].bottom()> evt.changedTouches[i].pageY + yOff)
        {
            var startAction = gameObject.buttons[j].startAction;
            var endAction = gameObject.buttons[j].endAction;
            gameObject[startAction]();
            gameObject.ongoingTouches[evt.changedTouches[i].identifier] = endAction;
        }
    }
  }
}

/*
 *  Prevent Default()
 *  
 *  Push the touch identifier onto the ongoingTouches array
 */
function handleEnd(evt) {

  evt.preventDefault();
  gameObject[gameObject.ongoingTouches[evt.changedTouches[0].identifier]]();
}

  var el = document.getElementById("canvas");
  el.addEventListener("touchstart",handleStart, false);
  el.addEventListener("touchend", handleEnd, false);


    var gameObject = {

        collisionCheckArray: [],
        updatedArray: [],
        backdrops: [],
        buttons: [],
        canvasOffsetX: 0,
        canvasOffsetY: 0,
        activeObj: null,

        // dead: false,
        levelOver: false,
        movingRightFlag: false,
        movingLeftFlag: false,
        collisionRightFlag: false,
        collisionLeftFlag: false,
        fallFlag: false,

        ongoingTouches: {
            0: 'doNothing',
            1: 'doNothing',
            2: 'doNothing',
            3: 'doNothing',
            4: 'doNothing',
            5: 'doNothing'
        }, //ongoingTouches

        button: function (shape,x,y,width,height,color,startAction,endAction) {

            this.x = x * cSizing;
            this.y = y * cSizing;
            this.width = width * cSizing;
            this.height = height * cSizing;
            this.xVel = 0;
            this.yVel = 0;
            this.color = color;
            this.startAction = startAction;
            this.endAction = (endAction === undefined) ? 'doNothing' : endAction;

            this.top = gameObject.topBoundary;
            this.bottom = gameObject.bottomBoundary;
            this.left = gameObject.leftBoundary;
            this.right = gameObject.rightBoundary;

            this.drawSelf = function () {

                if(shape === 'square'){
                    ctx.fillStyle = this.color;
                    ctx.fillRect(gameObject.activeObj.x - 80 * cSizing + this.x,this.y,this.width,this.height);
                } else if (shape === 'round'){

                    ctx.fillStyle = this.color;
                    ctx.arc(this.x - gameObject.canvasOffsetX + this.width/2,this.y - gameObject.canvasOffsetY + this.width/2,this.width/2,0,2*Math.PI);
                    ctx.fill(); 
                }
            },

            this.update = function () {

                this.drawSelf();
            }

            gameObject.buttons.push(this);
        },// backgroundObj

        firePressed: function (){

            new gameObject.fire(
                    gameObject.activeObj.right() - 2 * cSizing,
                    gameObject.activeObj.top() + 2 * cSizing,
                    cSizing * .7,
                    - cSizing * .7);
        },// firePressed

        doNothing: function () {
        },// doNothing

        playerObj: function (x,y,width,height,color,iname1,file1,iname2,file2) {

            var that = this;
            this.id = gameObject.setId('player');
            this.type = 'player';

            /**
             *  Loading Images to this obj
             */
            var iname1 = new Image();
            iname1.src = file1;
            this.imgRunningLeft = iname1;

            var iname2 = new Image();
            iname2.src = file2;
            this.imgIdle = iname2;

            /**
             *  Frame trackers Used for keeping track of how fast to flip threw images
             */
            this.ft = 0;
            this.ftMax = 60;
            this.ftSize = 1;

            /**
             *  Source dimensions for croping source image
             */
            this.sx = 0;
            this.sy = 0;
            this.swidth = 64;
            this.sheight = 64;

            /**
             *  Canvas positions and dimensions for placing the image to the canvas
             */
            this.x = x * cSizing;
            this.y = y * cSizing;
            this.width = width * cSizing;
            this.height = height * cSizing;

            /**
             *  Velocity values to create more realistic movement
             */
            this.xVel = 0;
            this.yVel = 0;

            this.maxVelocity = cSizing * .5;
            this.accelerationXUnit = cSizing * .008;

            /**
             *  Velocicy after colisions
             */
            this.newVelX = function () {
                return 0;
            } 
            this.newVelY = function () {
                return 0;
            }

            /**
             *  Boundary functions that can be used as getters and setters
             *      for the edges of collision boarders to make it easier to 
             *      understand and write the collision logic.
             */
            this.top = gameObject.topBoundary;
            this.bottom = gameObject.bottomBoundary;
            this.left = gameObject.leftBoundary;
            this.right = gameObject.rightBoundary;

            this.drawSelf = function () {

                this.ft = (this.ft < this.ftMax - this.ftSize) ? this.ft + this.ftSize : 0;

                if (gameObject.movingRightFlag) {

                    this.sx = 64 * Math.floor(10 * this.ft / this.ftMax);
                    gameObject.flipSprite(this.imgRunningLeft,this.sx,this.sy,this.swidth,this.sheight,this.x,this.y,this.width,this.height);
                }

                else if (gameObject.movingLeftFlag) {

                    this.sx = 64 * Math.floor(10 * this.ft / this.ftMax);
                    ctx.drawImage(this.imgRunningLeft,this.sx,this.sy,this.swidth,this.sheight,this.x,this.y,this.width,this.height);
                }

                else {

                    this.sx = 64 * Math.floor(11 * this.ft / this.ftMax);
                    ctx.drawImage(this.imgIdle,this.sx,this.sy,this.swidth,this.sheight,this.x,this.y,this.width,this.height);
                }
            }// this.drawSelf

            this.update = function () {

                gameObject.checkCollisions(this);
                this.tryToMove();
                this.drawSelf();
            }

            this.tryToMove = function () {

                (gameObject.fallFlag === false) && gameObject.fall(this);
                (gameObject.movingRightFlag === true && gameObject.collisionRightFlag === false) && gameObject.moveRight(this);
                (gameObject.movingLeftFlag  === true && gameObject.collisionLeftFlag  === false) && gameObject.moveLeft(this);
            }

            this.handleCollison = function (other, side) {

                (other.type === 'won') && gameObject.levelComplete();
                if (other.type === 'fell') {
                    this.respawn();
                    return false;
                }
                if(other.type === 'turtle' && (side === 'right' || side === 'left') ) {
                    this.respawn();
                    return false;
                }
                if ( other.type === 'turtle' && side === 'bottom') {
                    other.destroy();
                    return true;
                }
                return true;
            }

            this.moveRightInit = function () {

                this.ftSize = Math.floor(3 + Math.abs(this.xVel) / (cSizing * .7 / 6));
            }

            this.moveLeftInit = function () {

                this.ftSize = Math.floor(3 + Math.abs(this.xVel) / (cSizing * .7 / 6));
            }           

            this.respawn = function (){

                gameObject.movingRightFlag = false;
                gameObject.movingLeftFlag  = false;
                gameObject.fallFlag = false;
                gameObject.collisionRightFlag = false;
                gameObject.collisionLeftFlag = false;

                this.xVel = 0;
                this.yVel = 0;
                
                this.x = x * cSizing;
                this.y = y * cSizing;

                this.ftMax = 60;
                this.ftSize = 2;
                this.ft = 15;

                ctx.translate(-gameObject.canvasOffsetX,-gameObject.canvasOffsetY);
                gameObject.canvasOffsetX = 0;
                gameObject.canvasOffsetY = 0;
            }

            gameObject.updatedArray.push(this);
        },//playerObj

        enemyObj: function (x,y,width,height,color) {
            var that = this;

            this.type = 'turtle';
            this.id = gameObject.setId('enemy');
            this.nextAction = 0;

            this.x = x * cSizing;
            this.y = y * cSizing;
            this.width = width * cSizing;
            this.height = height * cSizing;
            this.xVel = cSizing * .15;
            this.yVel = 0;
            this.color = color;
            this.maxVelocity = cSizing * .05;
            this.accelerationXUnit = 0;
            // this.ftSizeConstant = cSizing * .14;
            this.ftSize = 7;

            this.newVelX = function () {
                return 0;
            } 
            this.newVelY = function () {
                return 0;
            }



            this.top = gameObject.topBoundary;
            this.bottom = gameObject.bottomBoundary;
            this.left = gameObject.leftBoundary;
            this.right = gameObject.rightBoundary;

            this.drawSelf = function () {

                ctx.fillStyle = this.color;
                ctx.fillRect(this.x,this.y,this.width,this.height);
            },

            this.update = function () {

                gameObject.checkCollisions(this);
                this.tryToMove();
                this.AI();
                this.drawSelf();
            }

            this.handleCollison = function (other, side) {

                if ( other.type === 'player' && (side === 'right' || side === 'left') ){

                    other.respawn();
                    return false;
                }
                if ( other.type === 'player' && side === 'top') {

                    this.destroy();
                    return false;
                }
                return true;
            }

            this.tryToMove = function () {
                (gameObject.fallFlag === false) && gameObject.fall(this);
            };

            this.AI = function () {
                if ( gameTime > this.nextAction && gameObject.activeObj.right() > this.left() - cSizing * 60 ){

                    this.nextAction = gameTime + 900;
                    new gameObject.fire(this.x, this.y, -cSizing * .6, 0);
                }
            };

            this.destroy = function () {

                gameObject.removeReferenceById(this.id);
            }
            gameObject.updatedArray.push(this);
            gameObject.collisionCheckArray.push(this);
        },// enemeyObj

        backgroundObj: function (x,y,width,height,color) {

            this.type = 'background';

            this.x = x * cSizing;
            this.y = y * cSizing;
            this.width = width * cSizing;
            this.height = height * cSizing;
            this.xVel = 0;
            this.yVel = 0;
            this.color = color;
            this.maxVelocity = 0;
            this.accelerationXUnit = 0;
            // this.ftSizeConstant = cSizing * .14;

            this.top = gameObject.topBoundary;
            this.bottom = gameObject.bottomBoundary;
            this.left = gameObject.leftBoundary;
            this.right = gameObject.rightBoundary;

            this.drawSelf = function () {

                ctx.fillStyle = this.color;
                ctx.fillRect(this.x,this.y,this.width,this.height);
            },

            this.update = function () {

                this.drawSelf();
            }

            gameObject.updatedArray.push(this);
            gameObject.collisionCheckArray.push(this);
        },// backgroundObj

        backdropObj: function (x,y,width,height,color) {

            this.type = 'background';

            this.x = x * cSizing;
            this.y = y * cSizing;
            this.width = width * cSizing;
            this.height = height * cSizing;
            this.xVel = 0;
            this.yVel = 0;
            this.color = color;
            this.maxVelocity = 0;
            this.accelerationXUnit = 0;
            // this.ftSizeConstant = cSizing * .14;

            this.top = gameObject.topBoundary;
            this.bottom = gameObject.bottomBoundary;
            this.left = gameObject.leftBoundary;
            this.right = gameObject.rightBoundary;

            this.drawSelf = function () {

                ctx.fillStyle = this.color;
                ctx.fillRect(this.x,this.y,this.width,this.height);
            },

            this.update = function () {

                this.drawSelf();
            }
            gameObject.backdrops.push(this);
            // gameObject.updatedArray.push(this);
            // gameObject.collisionCheckArray.push(this);
        },// backdropObj

        flipSprite: function (img,sx,sy,swidth,sheight,dx,dy,dwidth,dheight) {

            ctx.save();
            ctx.scale(-1,1);
            ctx.drawImage(img,sx,sy,swidth,sheight,-dx - (cSizing*7),dy,dwidth,dheight);
            ctx.restore();
        },// flipSprite

        accel: function (obj){
            if (obj.xVel >= 0) {
                return obj.accelerationXUnit;
            } else {
                return -obj.accelerationXUnit;
            }
        },// accel

        checkCollisions: function (obj) {
            
            gameObject.collisionRightFlag = false;
            gameObject.collisionLeftFlag = false;
            gameObject.fallFlag = false;
        
            gameObject.collisionCheckArray.forEach(function(element){
                gameObject.checkCollisionBottom(obj, element, obj.newVelY());
                gameObject.checkCollisionTop(obj, element, obj.newVelY());
                gameObject.checkCollisionRight(obj, element, obj.newVelX());
                gameObject.checkCollisionLeft(obj, element, obj.newVelX());
            });
        },// checkCollision

        checkCollisionBottom: function (obj, other, newVel) {

            if (
                obj.right() > other.left() + other.xVel - obj.xVel - cSizing * .01 + cSizing * .01 && 
                obj.left() < other.right() + other.xVel - obj.xVel - cSizing * .01  && 
                obj.bottom() >= other.top() + other.yVel - obj.yVel - cSizing * .02 && 
                obj.bottom() <= other.top() + other.yVel
                ) {

                if(obj.handleCollison(other, 'bottom')){

                    gameObject.resolveCollision(obj, other, 'bottom', newVel);
                    gameObject.fallFlag = true;
                }
            }
        },// checkCollisionBottom

        checkCollisionTop: function (obj, other, newVel) {

            if (
                obj.right() > other.left() + other.xVel - obj.xVel - cSizing * .01 + cSizing * .01 && 
                obj.left() < other.right() + other.xVel - obj.xVel - cSizing * .01  && 
                obj.top() <= other.bottom() + other.yVel - obj.yVel - cSizing * .02 &&
                obj.top() >= other.bottom() + other.yVel
                ) {

                if(obj.handleCollison(other, 'top')){

                    gameObject.resolveCollision(obj, other, 'top', newVel);
                    gameObject.fallFlag = true;
                }
            }
        },// checkCollisionTop

        checkCollisionRight: function (obj, other, newVel) {

            var newOtherPosition = (other.left() + other.xVel * time + .5 * this.accel(other) * timeSqr);
            var deltaXObj = (obj.xVel * time + .5 * this.accel(obj) * timeSqr);

            if (
                obj.bottom() > other.top() + other.yVel - obj.yVel - cSizing * .02 &&
                obj.top() < other.bottom() + other.yVel - obj.yVel - cSizing * .02 &&

                obj.right() >= newOtherPosition - deltaXObj * 2.2 &&// this has a funny smell? why the 2.2???
                obj.right() <= other.left() + .1
            ){

                if( obj.handleCollison( other,'right') ){

                    gameObject.resolveCollision(obj, other, 'right', newVel);
                    gameObject.collisionRightFlag = true;
                }
            }   
        },// checkCollisionRight

        checkCollisionLeft: function (obj, other, newVel) {

            var newOtherPosition = (other.right() + other.xVel * time + .5 * this.accel(other) * timeSqr);
            var deltaXObj = (obj.xVel * time + .5 * this.accel(obj) * timeSqr);

            if (
               obj.bottom() > other.top() + other.yVel - obj.yVel - cSizing * .02 &&
               obj.top() < other.bottom() + other.yVel - obj.yVel - cSizing * .02 &&
 
               obj.left() <= newOtherPosition -  deltaXObj * 2.2 &&  // this has a funny smell
               obj.left() >= other.right() - .1
            ) {
                if(obj.handleCollison(other, 'left')){

                    gameObject.resolveCollision(obj, other, 'left', newVel);
                    gameObject.collisionLeftFlag = true;
                }
            }
        },// checkCollisionLeft

        resolveCollision: function (obj, other, collision, newVel) {

            var objSide ;
            var objVel ;
            var otherSide ;
            var otherVel ;

            if (collision === 'bottom'){
                objSide = 'bottom';
                objVel = 'yVel';
                otherSide = 'top';
                otherVel = 'yVel';
            } else if (collision === 'top'){
                objSide = 'top';
                objVel = 'yVel';
                otherSide = 'bottom';
                otherVel = 'yVel';
            } else if (collision === 'right'){
                objSide = 'right';
                objVel = 'xVel';
                otherSide = 'left';
                otherVel = 'xVel';
            } else if (collision === 'left'){
                objSide = 'left';
                objVel = 'xVel';
                otherSide = 'right';
                otherVel = 'xVel';
            }

            var collision = 0;

            if (other[otherVel] === 0) {

                collision = other[otherSide]();
            } else {

                /*
                 *  This is an aproximation assuming that the time samples are too small
                 *      to make a differnce in the acceleration.
                 */
                var X = other[otherSide]() - obj[objSide]();
                var V = obj[objVel] - other[otherVel];
                var T = X / V;

                // collision = obj[objSide]() + obj[objVel] * T + .5 * this.accel(obj) * Math.pow(T,2);
                collision = obj[objSide]() + obj[objVel] * T;
            }

            other[otherSide](collision);
            obj[objSide](collision);
            obj[objVel] = newVel;
        },// resolveCollision

        leftPressed: function () {
            if (gameObject.movingLeftFlag === false) {
                gameObject.stopMovingRight();
                square.ft = 15;
                square.ftMax = 216;
                square.ftSize = 1;
                gameObject.movingLeftFlag = true;   
            }
        },// rightPressed

        moveLeft: function (obj) {

            var VelInital = obj.xVel;
            if (obj.xVel > - obj.maxVelocity) {

              obj.xVel = VelInital - obj.accelerationXUnit * time;
            }
            obj.x += (VelInital * time + .5 * this.accel(obj) * timeSqr);

            ( obj.hasOwnProperty('moveRightInit') ) && obj.moveRightInit();
        },// moveLeft

        stopMovingLeft: function () {

            if(gameObject.movingLeftFlag) {

                gameObject.movingLeftFlag = false;
                square.xVel = 0;
                square.ftMax = 60;
                square.ftSize = 2;
                square.ft = 15;
            }
        },// stopMovingLeft

        rightPressed: function () {
            if (gameObject.movingRightFlag === false){
                gameObject.stopMovingLeft();
                square.ft = 15;
                square.ftMax = 216;
                square.ftSize = 1;
                gameObject.movingRightFlag = true;
            }
        },// leftPressed

        moveRight: function (obj) {

            var VelInital = obj.xVel;
            if (obj.xVel < obj.maxVelocity) {

              obj.xVel = VelInital + obj.accelerationXUnit * time;
            }
            obj.x += (VelInital * time + .5 * this.accel(obj) * timeSqr);

            ( obj.hasOwnProperty('moveLeftInit') ) && obj.moveRightInit();
        },// moveRight

        stopMovingRight: function () {

            if(gameObject.movingRightFlag) {

                gameObject.movingRightFlag = false;
                square.xVel = 0;
                square.ftMax = 60;
                square.ftSize = 2;
                square.ft = 15;
            }
        },// stopMovingRight

        fall: function (obj) {

            obj.yVel += cSizing * .02;
            obj.y += obj.yVel;
        },//this fall

        fire: function (x,y,xVel,yVel) {

            var that = this;
            this.color = 'black';
            this.id = gameObject.setId('fire');
            this.type = 'fire';
            
            /**
             *  Canvas positions and dimensions for placing the image to the canvas
             */
            this.x = x;
            this.y = y;
            this.width = 1 * cSizing;
            this.height = 1 * cSizing;

            /**
             *  Velocity values to create more realistic movement
             */
            this.xVel = xVel
            this.yVel = yVel
            this.accelerationXUnit = 0;
            this.maxVelocity = cSizing * 1;    


            /**
             *  Velocicy after colisions
             */
            this.newVelX = function () {
                return -this.xVel * .7;
            }
            this.newVelY = function () {
                return (this.yVel > cSizing * .5) ? -this.yVel * .7 : 0 ;
            }

            /**
             *  Boundary functions that can be used as getters and setters
             *      for the edges of collision boarders to make it easier to 
             *      understand and write the collision logic.
             */
            this.top = gameObject.topBoundary;
            this.bottom = gameObject.bottomBoundary;
            this.left = gameObject.leftBoundary;
            this.right = gameObject.rightBoundary;

            this.drawSelf = function () {
                ctx.fillStyle = this.color;
                ctx.fillRect(this.x,this.y,this.width,this.height);
            }

            this.update = function () {
                gameObject.checkCollisions(this);
                this.tryToMove();
                this.drawSelf();
            }

            this.tryToMove = function () {
                (gameObject.fallFlag === false) && gameObject.fall(this);
                (gameObject.collisionRightFlag === false) && gameObject.moveRight(this);
                (gameObject.collisionLeftFlag  === false) && gameObject.moveLeft (this);
            }

            this.handleCollison = function (other, newVel) {

                if( other.type === 'turtle'){
                    other.destroy();
                    this.destroy();
                    return false;
                }
                if ( other.type === 'player'){
                    other.respawn();
                    this.destroy();
                    return false;
                }
                return true;
            }

            this.destroy = function () {

                gameObject.removeReferenceById(this.id);
            }

            setTimeout(function() {
                that.destroy();
            },2000);
            gameObject.updatedArray.push(this);
            gameObject.collisionCheckArray.push(this);
        },// fire

        levelComplete: function () {
            if(!gameObject.levelOver){
                // new gameObject.backgroundObj(0,0,2000,100,'rgba(50,200,20,.1');
                gameObject.levelOver = true;
                window.location.replace("http://shawnpivonka.com/games/" + nextLevel);
            }
        },//levelComplete

        jump: function() {

            square.yVel = -.9 * cSizing;
        },// jump

        removeReferenceById: function (id) {
            gameObject.updatedArray = gameObject.updatedArray.filter(function(el) {
                return el.id !== id;
            });
            gameObject.collisionCheckArray = gameObject.collisionCheckArray.filter(function(el) {
                return el.id !== id;
            });
            // var filtered = someArray.filter(function(el) { return el.Name != "Kristian"; });  
        },// removeReferenceById

        paintCanvas: function (currentTime) {
            var offX = gameObject.canvasOffsetX;
            var offY = gameObject.canvasOffsetY;
            var active = gameObject.activeObj;

            ctx.clearRect( - offX - 600, - offY - 10, ctx.canvas.width * 5 + 1200, ctx.canvas.height + 20 );
           
            offXtemp = (active.x - 80);
            offYtemp = 0;


            if(!startingTime) {startingTime = currentTime;}
            if(!lastTime) {lastTime=currentTime;}
  
            deltaTimePassed = (currentTime - lastTime);
            lastTime = currentTime;
            gameTime = currentTime;
            time = deltaTimePassed / baseTime;
            timeSqr = Math.pow(time,2);  

            gameObject.backdrops.forEach(function (element) {
               
                element.update();
            });

            gameObject.updatedArray.forEach(function (element) {

                element.update();
            });
            gameObject.buttons.forEach(function (element) {

                element.update();
            });

            offX = (active.x - 80);
            offY = 0;
            ctx.translate( offXtemp - offX, 0);

            requestAnimationFrame(gameObject.paintCanvas);
        },// paintCanvas

        createButtons: function () {
            // new gameObject.button ('square',200,45,20,20,'rgba(100,100,100,.3','jump');
            // new gameObject.button ('square',200,75,20,20,'rgba(100,100,100,.3','firePressed');
            // new gameObject.button ('square',30,60,20,20,'rgba(100,100,100,.3','rightPressed','stopMovingRight');
            // new gameObject.button ('square',5,60,20,20,'rgba(100,100,100,.3','leftPressed','stopMovingLeft'); 
            new gameObject.button ('square',200,45,20,20,'gray','jump');
            new gameObject.button ('square',200,75,20,20,'gray','firePressed');
            new gameObject.button ('square',30,60,20,20,'gray','rightPressed','stopMovingRight');
            new gameObject.button ('square',5,60,20,20,'gray','leftPressed','stopMovingLeft');
        },// createButtons

        setId: function (id) {
            var genId = id + counter;
            counter++;
            return genId;
        },// setId



        topBoundary: function(topEdgeOfThis) {

            if(topEdgeOfThis !== undefined) {
                this.y = topEdgeOfThis;
            } else {
                return this.y;
            }
        }, // topBoundary

        bottomBoundary: function (bottomEdgeOfThis) {

            if (bottomEdgeOfThis !== undefined){
                this.y = bottomEdgeOfThis - this.height;
            } else {
                return this.y + this.height;
            }
        }, // bottomBoundary

        leftBoundary: function (leftEdgeOfThis) {

            if (leftEdgeOfThis !== undefined){
                this.x = leftEdgeOfThis;
            } else {
                return this.x;
            }
        }, // leftBoundary

        rightBoundary: function (rightEdgeOfThis) {

            if (rightEdgeOfThis !== undefined){
                this.x = rightEdgeOfThis - this.width;
            } else {
                return this.x + this.width;
            }
        } // rightBoundary
    }// end game object



    /**
     *  Commands to run at start of game
     */


    var square = new gameObject.playerObj (80,70,7,7,'green','runningMonsterLeft','/img/runningMonster.png','idleMonster','/img/standingMonster.png');
    gameObject.activeObj = square;
    gameObject.collisionCheckArray.push(square);

    var fell = new gameObject.backgroundObj(-50,110,2000,50,'white');
    fell.type = 'fell';

    var endOfLevel = new gameObject.backgroundObj(560,0,10,100,'white');
    endOfLevel.type = 'won';

    var lvlId = document.getElementById('level_id').value;
    var nextLevel = document.getElementById('next_level').value;
    console.log(lvlId);
    console.log(nextLevel);

    $.get("/games/levels/" + lvlId).done(function(data) {
        buildLevel(data);
    });

    function buildLevel(data){
        data.forEach(function (piece){
            new gameObject[piece.function](piece.x,piece.y,piece.width,piece.height,piece.color);
        });
        gameObject.paintCanvas();
    }

    // new gameObject.backgroundObj         (400,70,15 ,4 ,'black');
    // var gunner2 = new gameObject.enemyObj(407,50,6  ,6 ,'gray' );

    // new gameObject.backdropObj          (0   ,0  ,700,100,'black');
    // var gunner = new gameObject.enemyObj(307 ,50 ,6  ,6  ,'gray' );
}, false );//document ready function