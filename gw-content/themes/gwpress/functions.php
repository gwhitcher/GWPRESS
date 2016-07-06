<?php
/* DROP DOWN NAV FUNCTIONS */
function prepareList(array $items, $pid = 0) {
    $output = array();
    foreach ($items as $item) {
        if ((int) $item['parent_id'] == $pid) {
            if ($children = prepareList($items, $item['id'])) {
                $item['children'] = $children;
            }
            $output[] = $item;
        }
    }
    return $output;
}
function nav($menu_items, $child = false){
    $output = '';
    if (count($menu_items)>0) {

        $output .= ($child === false) ? '<ul class="nav navbar-nav">' : '<ul class="dropdown-menu">';
        foreach ($menu_items as $nav_item) {

            if(!empty($nav_item['target'])) {
                $nav_target = ' target="'.$nav_item['target'].'"';
            } else {
                $nav_target = "";
            }
            if(strpos($nav_item['url'], "http://") !== false OR strpos($nav_item['url'], "https://") !== false) {
                $nav_url = $nav_item['url'];
            } else {
                $nav_url = "".BASE_URL."".$nav_item['url']."";
            }

            //Set active
            if($_SERVER['REQUEST_URI'] == $nav_item['url']) {
                $class = 'class="active"';
            } else {
                $class = '';
            }

            $output .= ($child === false) ? '<li '.$class.'>' : '<li class="dropdown">';

            //Drop down menu activator
            if (isset($nav_item['children']) && count($nav_item['children'])) {
                $output .= '<a href="'.$nav_url.'" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$nav_item['title'].' <span class="caret"></span></a>' ;
            } else {
                $output .= '<a href="'.$nav_url.'"'.$nav_target.'>'.$nav_item['title'].'</a>';
            }

            //Check if there are any children
            if (isset($nav_item['children']) && count($nav_item['children'])) {
                $output .= nav($nav_item['children'], true);
            }

            $output .= '</li>';
        }
        $output .= '</ul>';
    }
    return $output;
}