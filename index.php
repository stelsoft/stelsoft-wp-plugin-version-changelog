<?php
/*
Plugin Name: Stelsoft Version CHANGELOG
Description:
Version: 1.0
Author URI: mailto:michal@stelmak.pl
Author: Stelsoft Michał Stelmak
*/

class Stelsoft_Version_CHANGELOG {

    public function run()
    {
        add_action( 'admin_menu', [$this, 'admin_menu'], 999 );
    }

    public function admin_menu()
    {
        add_menu_page('Version - CHANGELOG.md', 'Version', 'manage_options', 'stelsoft-version-changelog', [$this, 'render'], 'dashicons-info', 999);
    }

    public function render(){
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        $str = file_exists(ABSPATH . 'CHANGELOG.md') ? file_get_contents(ABSPATH . 'CHANGELOG.md') : '<p>File not found.</p>';
        $str = nl2br($str);
//        $str = preg_replace('/^##\s(.*?)$/m', '<h3>$1</h3>', $str);
//        $str = preg_replace('/^###\s(.*?)$/m', '<h4>$1</h4>', $str);
//        $str = preg_replace('/^####\s(.*?)$/m', '<h5>$1</h5>', $str);
        echo "<div><h2>CHANGELOG.md</h2><div>$str</div></div>";
    }

}

$cache = new Stelsoft_Version_CHANGELOG();
$cache->run();
