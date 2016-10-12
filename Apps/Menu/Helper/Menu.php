<?php
namespace Apps\Menu\Helper;


class Menu {

    static function make_admin_menu($mitems = null) {
        if (isset($mitems)) {
            echo '<ol class="dd-list">';
            foreach ($mitems as $mitem) {
                $html = '<li class="dd-item" data-id="'.$mitem->id.'" data-name="'.$mitem->title.'" data-slug="'.$mitem->arg.'" data-new="0" data-deleted="0">';
                $html .= '<div class="dd-handle">'.$mitem->title.'</div>';
                $html .= '<span class="button-delete btn btn-default btn-xs pull-right" data-owner-id="'.$mitem->id.'">';
                $html .= '<i class="fa fa-times-circle-o" aria-hidden="true"></i>';
                $html .= '</span>';
                $html .= '<span class="button-edit btn btn-default btn-xs pull-right" data-owner-id="'.$mitem->id.'">';
                $html .= '<i class="fa fa-pencil" aria-hidden="true"></i>';
                $html .= '</span>';
                $html .= '</li>';
                echo $html;
                if (isset($mitem->children)) {
                    self::make_admin_menu($mitem->children);
                }
            }
            echo '</ol>';
        }
    }

}