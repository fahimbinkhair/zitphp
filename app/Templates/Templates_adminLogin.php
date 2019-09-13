<!DOCTYPE html>
<html>
<head>
    <title>Welcome admin!</title>
    <?php echo ZIT()->Services_Assets->getAssetsForAdmin(); ?>
</head>
<body>
<div class="container">
<?php
    ZIT()->Lib_Render->getView();
?>
</div>
</body>
</html>