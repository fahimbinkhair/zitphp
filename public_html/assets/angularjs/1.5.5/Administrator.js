/**
 * handles tasks related to the administrators
 * @author Md Fahim Uddin
 * @version 20160519
 */
zitApp.controller('Administrator', function($scope, preLoader, postGet) {
    $scope.btnAdd = 'Submit';
    $scope.result = {};

    /**
    * add admin
    */
    $scope.addAdmin = function() {
        postGet.doPost('/Admin_AK/administrator/add', {
            userId: $scope.userId,
            password: $scope.password,
            confirmPassword: $scope.confirmPassword,
            adminName: $scope.adminName,
            btnAdd: $scope.btnAdd
        }).then(function (result) {
            $scope.result = result.data;
            console.log($scope.result);
        });
    }
});
