<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

\spl_autoload_register('bootstrap_3_shortcodes_for_wordpress_autoload');

function bootstrap_3_shortcodes_for_wordpress_autoload($className) {
	// If the specified $className does not include our namespace, duck out.
	if(\strpos($className, 'WordPress\Plugin\BootstrapShortcodes') === false) {
		return;
	}

	// Split the class name into an array to read the namespace and class.
	$fileParts = \explode('\\', $className);
//	echo '<pre>' . print_r($fileParts, true) . '</pre>';

	// Do a reverse loop through $fileParts to build the path to the file.
	$namespace = '';
	for($i = \count($fileParts) - 1; $i > 0; $i--) {
		// Read the current component of the file part.
//		$current = \strtolower($fileParts[$i]);
//		$current = \str_ireplace('_', '-', $current);
		$current = \str_ireplace('_', '-', $fileParts[$i]);

		// If we're at the first entry, then we're at the filename.
		if(\count($fileParts) - 1 === $i) {
			/* If 'interface' is contained in the parts of the file name, then
			 * define the $file_name differently so that it's properly loaded.
			 * Otherwise, just set the $file_name equal to that of the class
			 * filename structure.
			 */
			if(\strpos(\strtolower($fileParts[\count($fileParts) - 1]), 'interface')) {
				// Grab the name of the interface from its qualified name.
				$interfaceName = \explode('_', $fileParts[\count($fileParts) - 1]);
				$interfaceName = $interfaceName[0];

				$fileName = $interfaceName . '.php';
			} else {
				$fileName = $current . '.php';
			}
		} else {
			$namespace = '/' . $current . $namespace;
		}
		// Now build a path to the file using mapping to the file location.
		$filepath = \trailingslashit(\dirname(\dirname(__FILE__)) . $namespace);
		$filepath .= $fileName;

		// If the file exists in the specified path, then include it.
		if(\file_exists($filepath)) {
			include_once($filepath);
		} else {
//			\wp_die(
//				\esc_html("The file attempting to be loaded at $current does not exist.")
//			);
		}
	}
}
