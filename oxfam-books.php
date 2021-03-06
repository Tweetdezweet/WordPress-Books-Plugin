<?php
/*
Plugin Name: Oxfam Books Plugin
Plugin URI:  https://koengabriels.be
Description: WordPress plugin to support the sales and inventory management of secondhand books for Oxfam
Version:     20170828
Author:      Koen Gabriëls
Author URI:  https://koengabriels.be
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: oxfambooks
Domain Path: /languages
*/

require_once __DIR__ . '/includes/class-oxfam-book-search.php';
require_once __DIR__ . '/includes/class-oxfam-admin-pages.php';

new \oxfambooks\OxfamBookSearch( new \oxfambooks\OxfamBook(), new \oxfambooks\OxfamGoogleBookApi() );
new \oxfambooks\OxfamAdminPages();