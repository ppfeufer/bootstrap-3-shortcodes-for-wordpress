<?php

/**
 * Plugin Name: Bootstrap 3 Shortcodes for WordPress
 * Plugin URI: https://github.com/ppfeufer/bootstrap-3-shortcodes-for-wordpress
 * GitHub Plugin URI: https://github.com/ppfeufer/bootstrap-3-shortcodes-for-wordpress
 * Description: Provides a way to implement the Bootstrap 3 stuff into WordPress via shortcodes. (Best with a theme running with <a href="http://getbootstrap.com/">Bootstrap</a>)
 * Version: 0.1-r20170912
 * Author: Peter Pfeufer
 * Author URI: http://ppfeufer.de
 * Text Domain: bootstrap-3-shortcodes-for-wordpress
 * Domain Path: /l10n
 */

/*
 * Copyright (C) 2017 ppfeufer
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace WordPress\Plugins\BootstrapShortcodes;
const WP_GITHUB_FORCE_UPDATE = true;

// Include the autoloader so we can dynamically include the rest of the classes.
require_once(\trailingslashit(\dirname(__FILE__)) . 'inc/autoloader.php');

class BootstrapShortcodes {
    private $textDomain = null;
    private $pluginDir = null;
    private $pluginUri = null;

    public function __construct() {
        /**
         * Initializing Variables
         */
        $this->textDomain = 'bootstrap-3-shortcodes-for-wordpress';
        $this->pluginDir = \plugin_dir_path(__FILE__);
        $this->pluginUri = \trailingslashit(\plugins_url('/', __FILE__));
    }

    public function init() {
        // Loaduing CSS
        $cssLoader = new Libs\ResourceLoader\CssLoader;
        $cssLoader->init();

        // Loading JavaScript
        $javascriptLoader = new Libs\ResourceLoader\JavascriptLoader;
        $javascriptLoader->init();

        $this->initShortcodes();

        if(\is_admin()) {
            $this->initGitHubUpdater();
        }
    }

    private function initGitHubUpdater() {
        /**
         * Check Github for updates
         */
        $githubConfig = array(
            'slug' => \plugin_basename(__FILE__),
            'proper_folder_name' => \dirname(\plugin_basename(__FILE__)),
            'api_url' => 'https://api.github.com/repos/ppfeufer/bootstrap-3-shortcodes-for-wordpress',
            'raw_url' => 'https://raw.github.com/ppfeufer/bootstrap-3-shortcodes-for-wordpress/master',
            'github_url' => 'https://github.com/ppfeufer/bootstrap-3-shortcodes-for-wordpress',
            'zip_url' => 'https://github.com/ppfeufer/bootstrap-3-shortcodes-for-wordpress/archive/master.zip',
            'sslverify' => true,
            'requires' => '4.7',
            'tested' => '4.8',
            'readme' => 'README.md',
            'access_token' => '',
        );

        new Libs\GithubUpdater($githubConfig);
    }

    private function initShortcodes() {
        new Libs\Shortcodes(true);

        new Libs\Shortcodes\Accordion;
        new Libs\Shortcodes\Alert;
        new Libs\Shortcodes\Badge;
        new Libs\Shortcodes\Breadcrumb;
        new Libs\Shortcodes\Button;
        new Libs\Shortcodes\Caret;
        new Libs\Shortcodes\Carousel;
        new Libs\Shortcodes\Code;
        new Libs\Shortcodes\Lists;
        new Libs\Shortcodes\Navigation;
        new Libs\Shortcodes\Progress;
    }
}

function initializePlugin() {
    $bootstrapShortcodes = new BootstrapShortcodes;

    /**
     * Initialize the plugin
     */
    $bootstrapShortcodes->init();
}

// Start the show
\add_action('plugins_loaded', 'WordPress\Plugins\BootstrapShortcodes\initializePlugin');
