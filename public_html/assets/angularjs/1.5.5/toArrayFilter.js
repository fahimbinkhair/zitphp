/**
 * convert JSON object to array
 */
angular.module('angular-toArrayFilter', [])
    .filter('toArray', function () {
        return function (obj, addKey) {
            if (!angular.isObject(obj)) {
                return obj;
            }

            if ( addKey === false ) {
                return Object.keys(obj).map(function(key) {
                    var value = obj[key];
                    value.toArrayObjKey = key;
                    return value;
                });
            } else {
                return Object.keys(obj).map(function (key) {
                    var value = obj[key];
                    console.log(va)

                    return angular.isObject(value) ?
                        Object.defineProperty(value, '$key', { enumerable: false, value: key}) :
                    { $key: key, $value: value };
                });
            }
        };
    });