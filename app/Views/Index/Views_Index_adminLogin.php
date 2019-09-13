<div style="width: 300px;" class="well center-block">
    <form name="frmAdminLogin" method="post" action="/<?php echo ZIT()->Lib_Input->urlPath; ?>" role="form">
        <div class="form-group">
            <?php echo ZIT()->Lib_Error->printError('adminLoginError', 'msg', true); ?>
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <?php echo ZIT()->Lib_Error->printError('email'); ?>
            <input type="text" name="email" id="email" class="form-control" value="<?php echo ZIT()->Lib_Input->getInput('email'); ?>">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <?php echo ZIT()->Lib_Error->printError('password'); ?>
            <input type="password" name="password" id="password" class="form-control" value="<?php echo ZIT()->Lib_Input->getInput('password'); ?>">
        </div>

        <div class="form-group">
            <input type="submit" name="btnSubmit" value="Login" class="form-control-static">
        </div>
    </form>
</div>