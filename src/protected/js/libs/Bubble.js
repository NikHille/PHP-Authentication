import Vector2 from '/js/getprotected.php?js=libs/Vector2';
import * as phys from '/js/getprotected.php?js=libs/physics';

export class Bubble {
    constructor(ctx, radius, position, color, options) {
        this.ctx = ctx;
        this.radius = radius;
        this.position = position,
        this.color = color;
        this.options = options;

        this.mouseForceFactor = 0.005;
        this.deceleration = 0.001;
        this.maxSpeed = 10;
        this.minSpeed = 0.05;
        this.velocity = {
            x: Math.floor(Math.random() * 2 * this.maxSpeed) - this.maxSpeed,
            y: Math.floor(Math.random() * 2 * this.maxSpeed) - this.maxSpeed
        };

        this.velMod = 0.008;
        this.velocity.x *= this.velMod;
        this.velocity.y *= this.velMod;
    }


    /**
     * Updating the positon of the bubble depending on the current velocity and possible collisions with other objects.
     */
    updatePosition() {
        // deceleration to min speed
        if (new Vector2(this.velocity.x, this.velocity.y ).getLength() > this.minSpeed) {
            this.velocity.x *= 1 - this.deceleration;
            this.velocity.y *= 1 - this.deceleration;
        }
        
        // mouse interaction
        let mouseMaxDistance = 200;
        let mouseDistance = phys.calcDistance({ x: document.mousePos.x, y: document.mousePos.y }, { x: this.position.x, y: this.position.y });

        if (mouseDistance <= mouseMaxDistance) {
            let normal = new Vector2(this.position.x - document.mousePos.x, this.position.y - document.mousePos.y);
            Vector2.normalize(normal);
            let mouseForce = ((mouseDistance - mouseMaxDistance) * -1) / mouseMaxDistance * this.mouseForceFactor;
            this.velocity.x += normal.x * mouseForce;
            this.velocity.y += normal.y * mouseForce;
        }

        this.updateVelocity();
        
        const newPos = {
            x: this.position.x + this.velocity.x,
            y: this.position.y + this.velocity.y
        }

        if (this.validPosition(newPos) === true) {
            // * set new position
            this.position.x = this.position.x + this.velocity.x;
            this.position.y = this.position.y + this.velocity.y;
        } else {
            // * resolve collision and update position
            phys.resolveCollision(this, this.collisionTarget);

            // INFO: resetting collision target, since collision has been resolved!
            this.collisionTarget = undefined;
        }
        
    }
    

    /**
     * Validating if the new position is valid, or if a collision has to be resolved.
     * @param {Object} newPos Object with x and y value representing the new coordinates.
     * @returns Returns true if there is no collosion detected. Otherwise it returns the collision target.
     */
    validPosition(newPos) {
        for (let i = 0; i < this.options.bubbles.length; i++) {
            if (this.options.bubbles[i] === this) continue;
            if (this.checkCollision(newPos, this.options.bubbles[i])) {
                return this.options.bubbles[i];
            }
        }
        return true;
    }


    /**
     * Checking for a collision between the new coordinates of a bubble and another.
     * @param {Object} newPos Object with x and y value representing the new coordinates.
     * @param {Bubble} other Another bubble to be checked.
     * @returns Returns true if collision between bubbles, otherwise false.
     */
    checkCollision(newPos, other) {
        let distance = phys.calcDistance(newPos, other.position);
        if (distance <= this.radius + other.radius) {
            this.collisionTarget = other;
            return true;
        }
        else return false;
    }
    

    /**
     * Checking if a wall collision is detected and changing velocity accordingly.
     */
    updateVelocity() {

        if (this.position.x + this.velocity.x > (this.ctx.canvas.width - this.radius)) {
            this.velocity.x *= -1;
        }
        if (this.position.x + this.velocity.x < this.radius) {
            this.velocity.x *= -1;
        }

        if (this.position.y + this.velocity.y > (this.ctx.canvas.height - this.radius)) {
            this.velocity.y *= -1;
        }
        if (this.position.y + this.velocity.y < this.radius) {
            this.velocity.y *= -1;
        }
    }
    
    
    /**
     * Drawing the bubble on a given canvas context.
     */
    draw() {
        this.updatePosition();
        
        this.ctx.beginPath();
        this.ctx.arc(this.position.x, this.position.y, this.radius, 0, 360);

        this.ctx.fillStyle = `rgba(${this.color.r}, ${this.color.g}, ${this.color.b}, 0.8`;
        this.ctx.closePath();
        this.ctx.fill();
    }
}

