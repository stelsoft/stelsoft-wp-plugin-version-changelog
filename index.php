<?php
/*
Plugin Name: Stelsoft Version CHANGELOG
Description:
Version: 1.0
Author URI: mailto:michal@stelmak.pl
Author: Stelsoft Michał Stelmak
*/
use Michelf\Markdown;

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

        include_once 'vendor/autoload.php';

        $str = file_exists(ABSPATH . 'CHANGELOG.md') ? file_get_contents(ABSPATH . 'CHANGELOG.md') : '<p>File not found.</p>';
        $html = Markdown::defaultTransform($str);
        echo "<div><h2>CHANGELOG.md</h2><div>$html</div></div>";
    }

}

$cache = new Stelsoft_Version_CHANGELOG();
$cache->run();
