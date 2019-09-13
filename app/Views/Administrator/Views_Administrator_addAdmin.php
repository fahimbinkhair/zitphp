<?php
    echo ZIT()->Services_Assets->includeAsset('/assets/angularjs/1.5.5/Administrator.js', 'js');
?>

<div style="max-width: 800px;" class="center-block" ng-controller="Administrator">
    <h4>Add administrator</h4>

    <form name="frmAddAdmin" role="form">
        <div class="form-group row row-alt-color">
            <label for="userId" class="col-xs-3">User ID</label>
            <div class="col-xs-9">
                <input type="text" id="userId" ng-model="userId" class="form-control input-sm">
                <span class="errorMsg" ng-hide="!(result.error.userId.msg + '').length">{[{ result.error.userId.msg }]}</span>
            </div>
        </div>

        <div class="form-group row row-alt-color">
            <label for="password" class="col-xs-3">Password</label>
            <div class="col-xs-9">
                <input type="password" id="password" ng-model="password" class="form-control input-sm">
                <span class="errorMsg" ng-hide="!(result.error.password.msg + '').length">{[{ result.error.password.msg }]}</span>
            </div>
        </div>

        <div class="form-group row row-alt-color">
            <label for="confirmPassword" class="col-xs-3">Confirm password</label>
            <div class="col-xs-9">
                <input type="password" id="confirmPassword" ng-model="confirmPassword" class="form-control input-sm">
                <span class="errorMsg" ng-hide="!(result.error.confirmPassword.msg + '').length">{[{ result.error.confirmPassword.msg }]}</span>
            </div>
        </div>

        <div class="form-group row row-alt-color">
            <label for="adminName" class="col-xs-3">Name</label>
            <div class="col-xs-9">
                <input type="text" id="adminName" ng-model="adminName" class="form-control input-sm">
                <span class="errorMsg" ng-hide="!(result.error.adminName.msg + '').length">{[{ result.error.adminName.msg }]}</span>
            </div>
        </div>

        <div class="form-group row row-alt-color">
            <label class="col-xs-3">&nbsp;</label>
            <div class="col-xs-9">
                <input type="button" ng-value="btnAdd" class="btn btn-danger" ng-click="addAdmin()">
            </div>
        </div>
    </form>
</div>