<?php
/**
 * manages assets like CSS, JS, etc
 * @author Md Fahim Uddin
 * @version 20160503
 */
class Services_Assets
{
    /**
     * @return string
     */
    public function getBootstrapCSS()
    {
        $content = <<<CSS

            <!-- compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

            <!-- Optional theme -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
CSS;

        return $content;
    }

    /**
     * @return string
     */
    public function getBootstrapJS()
    {
        $content = "<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js\"
                        integrity=\"sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS\" crossorigin=\"anonymous\">
                    </script>";

        return $content;
    }

    /**
     * @return string
     */
    public function getJQuery()
    {
        $content = "<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js\"></script>";
        return $content;
    }

    /**
     * @return string
     */
    public function getAngularJS()
    {
        $content = "<script src=\"https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js\"></script>";
        $content .= $this->includeAsset('/assets/angularjs/1.5.5/toArrayFilter.js', 'js');
        $content .= $this->includeAsset('/assets/angularjs/1.5.5/zitApp.js', 'js');

        return $content;
    }

    /**
     * the purpose of this method is to add JS or CSS file into your class
     * @param string $file (with full public path i.e /assets/angularjs/1.5.5/youFile.js)
     * @param string $fileExtension (supports js, css)
     * @return string (file with html tag)
     */
    public function includeAsset($file, $fileExtension)
    {
        $asset = '';
        $fileExtension = strtolower($fileExtension);
        $realFile = dirname(dirname(dirname(__FILE__))) . "/public_html{$file}";
        $fileMTime = time();

        if (is_file($realFile)) {
            $fileMTime = filemtime($realFile);
        }

        switch ($fileExtension) {
            case 'js':
                $asset = "<script src=\"{$file}?{$fileMTime}\"></script>";
                break;
            case 'css':
                $asset = "<link rel=\"stylesheet\" href=\"{$file}?{$fileMTime}\">";
                break;

        }

        return $asset;
    }

    /**
     * @param bool $addMenu (add top menu or not)
     * @return string
     */
    public function getAssetsForAdmin($addMenu = false)
    {
        $content = $this->getBootstrapCSS();
        $content .= $this->getJQuery();
        $content .= $this->getBootstrapJS();
        $content .= $this->getAngularJS();

        if ($addMenu === true) {
            $content .= $this->includeAsset('/assets/css/admin-top-menu.css', 'css');
        }

        $content .= $this->includeAsset('/assets/css/style.css', 'css');

        return $content;
    }
}