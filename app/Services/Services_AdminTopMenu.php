<?php
/**
 * contains the contents may required into different part on the system
 * @author Md Fahim Uddin
 * @version 20160503
 */
class Services_AdminTopMenu
{
    private $menu;

    /**
     * get menus from the table
     */
    public function displayMenu()
    {
        $menus = ZIT()->Lib_JSON->loadData('AdminTopMenu.json')->getData('adminTopMenu');

        echo "<ul class=\"dropdown\">";

        foreach ($menus as $section => $menu) {
            if (false === $this->checkToBeDisplayedOrNot($section)) {
                continue;
            }

            if (!is_array($menu)) {
                echo "<li style='z-index: 10;'><a href=\"{$menu}\" class=\"fNiv\">{$section}</a>";
            } elseif (count($menu) > 0) {
                echo "<li style='z-index: 10;'><a href=\"#\" class=\"fNiv\">{$section}</a>";
                echo "<ul>";

                foreach ($menu as $menuLabel => $subMenus) {
                    if (false === $this->checkToBeDisplayedOrNot($menuLabel)) {
                        continue;
                    }

                    if (!is_array($subMenus)) {
                        echo "<li style='z-index: 10;'><a href=\"{$subMenus}\">{$menuLabel}</a>";
                    } elseif (count($subMenus) > 0) {
                        echo "<li style='z-index: 10;'><a href=\"#\">{$menuLabel}</a>";
                        echo "<ul>";

                        foreach ($subMenus as $subMenuLabel => $subMenuURL) {
                            if (false === $this->checkToBeDisplayedOrNot($subMenuLabel)) {
                                continue;
                            }

                            echo "<li style='z-index: 10;'><a href=\"{$subMenuURL}\">{$subMenuLabel}</a></li>";
                        }

                        echo "</ul>";
                        echo "</li>";
                    }
                }

                echo "</ul>";
                echo "</li>";
            }
        }

        echo "</ul>";
    }

    /**
     * check this menu section should be displayed or not
     * @param string $label
     * @return bool
     */
    private function checkToBeDisplayedOrNot($label)
    {
        if (preg_match('(^;;)', $label)) {
            return false;
        } else {
            return true;
        }
    }
}