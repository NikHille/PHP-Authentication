import Vector2 from './Vector2.js';

// INFO: getting canvas context for debugging purposes
const canvas = document.querySelector('#canvas');
const ctx = canvas.getContext('2d');

export function calcDistance(pos1, pos2) {
    let dx = pos1.x - pos2.x;
    let dy = pos1.y - pos2.y;
    return Math.sqrt(Math.pow(dx, 2) + Math.pow(dy, 2));
}


/**
 * Calculating and resolving vectorial velocities of two spheres.
 * @param {Object} bubble1 First bubble which initiated collision.
 * @param {Object} bubble2 Second bubble which is being hit.
 */
export function resolveCollision(bubble1, bubble2) {
    let normal = new Vector2(bubble1.position.x - bubble2.position.x, bubble1.position.y - bubble2.position.y);
    let median = new Vector2(-normal.y, normal.x);
    
    let v1 = bubble1.velocity;
    let v2 = bubble2.velocity;
    
    let v1median = Vector2.project(v1, median);
    let v2median = Vector2.project(v2, median);

    let v1normal = Vector2.project(v1, normal);
    let v2normal = Vector2.project(v2, normal);
    
    bubble1.velocity = new Vector2(v2normal.x + v1median.x, v2normal.y + v1median.y);
    bubble2.velocity = new Vector2(v1normal.x + v2median.x, v1normal.y + v2median.y);
}