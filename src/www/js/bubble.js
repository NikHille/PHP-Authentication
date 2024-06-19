import { Bubble } from "./libs/Bubble.js";

const canvas = document.querySelector('#canvas');
const ctx = canvas.getContext('2d');
const screen = {};

let bubbles = [];
let bubbleRadius = 120;
let bubbleCount = 14;

document.mousePos = {
    x: 0,
    y: 0
};

function main() {
    if (!ctx) {
        alert('your browser doesn\'t supports canvas');
        return;
    }

    setScreenSize();
    window.addEventListener('resize', () => {
        setScreenSize();
    });

    createBubbles(bubbleCount);

    requestAnimationFrame(animate);

    userInteraction();
}


function setScreenSize() {
    console.log('setting canvas size');
    ctx.canvas.width = window.innerWidth;
    screen.width = window.innerWidth;
    ctx.canvas.height = window.innerHeight;
    screen.height = window.innerHeight;
}


function userInteraction() {
    document.body.addEventListener('mousemove', (e) => {
        document.mousePos = {
            x: e.clientX,
            y: e.clientY
        }
    });
}


function generatePosition(radius, position) {
    let isValid = true;
    if (Object.keys(position).length === 0) {
        position = {
            x: Math.floor(Math.random() * (canvas.width - radius * 2)) + radius,
            y: Math.floor(Math.random() * (canvas.height - radius * 2)) + radius
        }
    } else {
        let trialOffset = 20;

        position.x += Math.floor(Math.random() * 2) % 2 ? trialOffset : -trialOffset;
        position.y += Math.floor(Math.random() * 2) % 2 ? trialOffset : -trialOffset;

        // * not off screen in x or y plus
        if (Math.abs(canvas.width - position.x) < radius) {
            if (position.x < canvas.width / 2) position.x += trialOffset;
            else position.x += -trialOffset;
        }
        if (Math.abs(canvas.height - position.y) < radius) {
            if (position.y < canvas.height / 2) position.y += trialOffset;
            else position.y += -trialOffset;
        }

        // * not smaller then 
        if (position.x < radius) {
            if (position.x < canvas.width / 2) position.x += trialOffset;
            else position.x += trialOffset;
        }
        if (position.y < radius) {
            if (position.y < canvas.height / 2) position.y += trialOffset;
            else position.y += trialOffset;
        }
    }


    for (let i = 0; i < bubbles.length; i++) {
        // * check for collision
        if (Math.abs(bubbles[i].position.x - position.x) <= bubbles[i].radius + radius
            && Math.abs(bubbles[i].position.y - position.y) <= bubbles[i].radius + radius) {
            isValid = false;
            break;
        }
    }

    if (!isValid) {
        ctx.beginPath();
        ctx.strokeStyle = 'rgba(' + color.r + ',' + color.g + ',' + color.b + ')';
        ctx.rect(position.x - 25, position.y - 25, 25, 25);
        ctx.closePath();
        ctx.stroke();
    }
    return [isValid, position];
}

const colorPalette = [
    { r: 100, g: 125, b: 15 },
    { r: 35, g: 45, b: 55 },
    { r: 75, g: 90, b: 115 }
]
let color = {};

function createBubbles(bubbleCount) {
    // TODO: use to create random bubble from bubbleCount
    for (let i = 0; i < bubbleCount; i++) {
        let radius = bubbleRadius - ((Math.random()) * (bubbleRadius / 2));

        // choosing random color from color palette
        color = colorPalette[Math.floor(Math.random() * colorPalette.length)];

        let position = {};
        let isValidPos = false;
        let loops = 0;
        while (!isValidPos && loops < 1000) {
            [isValidPos, position] = generatePosition(radius, position);
            loops++;
        }

        if (!isValidPos) continue;

        bubbles.push(new Bubble(ctx, radius, position, color, { bubbles: bubbles }));
    }
    document.bubbleCount = bubbles.length;
    document.bubble = bubbles[0];
    document.bubbles = bubbles;
}


function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    bubbles.forEach((bubble) => {
        bubble.draw();
    });

    document.totalBubbleSpeed = 0;

    bubbles.forEach(bubble => {
        document.totalBubbleSpeed += Math.sqrt(Math.pow(bubble.velocity.x, 2) + Math.pow(bubble.velocity.y, 2));
    });

    if (document.play) requestAnimationFrame(animate);
}

document.animate = animate;
document.play = true;


main();
