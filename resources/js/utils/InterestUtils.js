/**
 * Recursively remove properties with an empty array value from an object.
 * Mutates the original object and returns it for convenience.
 *
 * @param {Object} obj
 * @returns {Object}
 */
export function removeEmptyArrays(obj) {
    for (const key in obj) {
      const val = obj[key];
  
      // If it's an array and empty, delete it
      if (Array.isArray(val) && val.length === 0) {
        delete obj[key];
  
      // If it's a non-null object, recurse
      } else if (val && typeof val === 'object' && !Array.isArray(val)) {
        removeEmptyArrays(val);
  
        // If the recursive clean made it an empty object, delete it too
        if (Object.keys(val).length === 0) {
          delete obj[key];
        }
      }
    }
  
    return obj;
  }
  