/**
 * the root module of the entire system
 * @author Md Fahim Uddin
 * @version 20160314
 */
var zitApp = angular.module('zitApp', ['angular-toArrayFilter']);

//change default tag
zitApp.config(function($interpolateProvider){
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});

/**
 * handles displaying loading msg on the top of the page (as pop-up)
 */
zitApp.service('preLoader', function($timeout) {
    var self = this;

    /**
     * On / Off the pre-loader
     * @param bool displayLoader
     */
    self.displayPreLoader = function(displayLoader) {
        if (displayLoader === true) {
            document.getElementById('angularPreLoader').style.display = 'block';
        } else {
            document.getElementById('angularPreLoader').style.display = 'none';
        }
    }

    /**
     * display error message if the last request was not successful
     * @param string message (optional)
     */
    self.displayErrorMsg = function(message) {
        message = message === null ? 'Still loading...' : message;
        document.getElementById('angularPreLoader').innerHTML = message;

        $timeout(function() {
            self.displayPreLoader(false);
        }, 5000); //5 seconds
    }
});

/**
 * service to handle all GET, POST, etc requests
 */
zitApp.service('postGet', function($http, preLoader) {
    self = this;

    /**
     * handles GET request
     * @param string url
     * @return object
     */
    self.doGet = function (url) {
        preLoader.displayPreLoader(true);

        return $http({
            method: 'GET',
            url: url
        }).success(function(response) {
            preLoader.displayPreLoader(false);
        }).error(function() {
            preLoader.displayErrorMsg();
        });
    }

    /**
     * handles POST request
     * @param string url
     * @param array postData
     * @return object
     */
    self.doPost = function(url, postData) {
        preLoader.displayPreLoader(true);

        return $http({
            method: 'POST',
            url: url,
            data: postData
        }).success(function(response) {
            preLoader.displayPreLoader(false);
        }).error(function() {
            preLoader.displayErrorMsg();
        });
    }
})