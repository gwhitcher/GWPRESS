<?php
//Admin listing
if(empty($plugins)) {
    $plugins = array();
}
$plugin = array(
    'plugin_title' => 'Example Plugin',
    'plugin_url' => '/admin/plugin/example',
    'plugin_description' => 'This is an example plugin for GWPRESS.'
);
array_push($plugins, $plugin);

//Routes
if(empty($plugin_routes)) {
    $plugin_routes = array();
}
$plugin_route = array(
    'plugin_url' => '/admin/plugin/example',
    'plugin_page_name' => 'example/example.php'
);
array_push($plugin_routes, $plugin_route);

class ExamplePlugin {

    public function example_function() {
        $hello = 'Hello world!';
        return $hello;
    }


}