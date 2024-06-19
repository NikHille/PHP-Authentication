export default class Vector2 {
    /**
     * Creates an instance of a two dimensional vector with given values.
     * @param {Number} x X portion of the vector.
     * @param {Number} y Y portion of the vector.
     */
    constructor(x, y) {
        this.x = x;
        this.y = y;
    }
    

    /**
     * Calculating length of the vector.
     * @returns Length of the vector.
     */
    getLength() {
        return Math.sqrt(Math.pow(this.x, 2) + Math.pow(this.y, 2));
    }


    /**
     * Normalizing a given vector.
     * @param {Vector2} vec The vector that is to be normalized.
     */
    static normalize(vec) {
        let length = vec.getLength();
        vec.x /= length;
        vec.y /= length;
    }
    

    /**
     * Projection of vec1 vector on the vec2 vector.
     * @param {Object} vec1 Vector which is to be projected onto the other.
     * @param {Object} vec2 Vector to be projected on.
     * @returns A projection vector of vec1 onto vec2.
     */
    static project(vec1, vec2) {
        // vec1OnVec2 = (vec1 * vec2 / |vec2|^2) * vec2
        let product = vec1.x * vec2.x + vec1.y * vec2.y;
        let vec2LengthSqrd = Math.pow(Math.sqrt(Math.pow(vec2.x, 2) + Math.pow(vec2.y, 2)), 2);
        let factor = product / vec2LengthSqrd;
        let projectedVec1 = new Vector2(factor * vec2.x, factor * vec2.y);
        return projectedVec1;
    }
}