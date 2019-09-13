<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin panel...</title>
    <?php echo ZIT()->Services_Assets->getAssetsForAdmin(true); ?>
</head>
<body>
<div class="container" style="border: solid 1px #dddddd; min-height: 549px;" ng-app="zitApp">
    <div id="angularPreLoader" style="position: fixed;
            top:0px;
            left:50%;
            width: 200px;
            height: 25px;
            margin-left:-100px;
            border:none;
            background-color: yellow;
            z-index: 10;
            text-align: center;
            padding: 7px 0px 0px 0px;
            display: none;">Loading...</div>
    <div class="row" style="border: 1px solid #dddddd">
        <div class="col-xs-6">
            <div class="row text-center text-uppercase">Aplatun's admin panel</div>
            <div class="row">
                <div class="col-xs-6 col-offset-xs-1 h6 text-center">You are <?php echo ZIT()->Models_Sessions->getAdminInfo('name'); ?></div>
                <div class="col-xs-6 col-lg-offset-2 h6 text-center">Order waiting: 10</div>
            </div>
        </div>
        <div class="col-xs-6 h6 text-right">
            <form name="frmQuickSearch" action="#">
                <div class="col-lg-6">
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="#">Search order</a></li>
                                <li><a href="#">Search product</a></li>
                                <li><a href="#">Search member</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row" style="border-bottom: 1px outset #d5d5d5"><?php ZIT()->Services_AdminTopMenu->displayMenu(); ?></div>
    <div class="divider">&nbsp;</div>
    <div style="width: 100%;"><?php ZIT()->Lib_Render->getView(); ?></div>
</div>
</body>
</html>