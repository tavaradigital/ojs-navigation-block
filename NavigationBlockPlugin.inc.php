<?php

/**
 * @file plugins/blocks/navigation/NavigationBlockPlugin.inc.php
 *
 * Copyright (c) 2013-2022 Simon Fraser University
 * Copyright (c) 2003-2022 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class NavigationBlockPlugin
 * @ingroup plugins_blocks_navigation
 *
 * @brief Class for navigation block plugin
 */

import('lib.pkp.classes.plugins.BlockPlugin');

class NavigationBlockPlugin extends BlockPlugin {

	public function register($category, $path, $mainContextId = NULL) {

		// Register the plugin even when it is not enabled
		$success = parent::register($category, $path);
	
		if ($success && $this->getEnabled()) {
		  // Do something when the plugin is enabled
		}
	
		return $success;
	}

		/**
	 * Install default settings on journal creation.
	 * @return string
	 */
	function getContextSpecificPluginSettingsFile() {
		return $this->getPluginPath() . '/settings.xml';
	}
	
	/**
	 * Get the display name of this plugin.
	 * @return String
	 */
	function getDisplayName() {
		return __('plugins.block.navigation.displayName');
	}

	/**
	 * Get a description of the plugin.
	 */
	function getDescription() {
		return __('plugins.block.navigation.description');
	}

	/**
	 * Get the contents for this block.
	 * @param $templateMgr object
	 * @param $request object
	 * @return string
	 * @see BlockPlugin::getContents
	 */
	public function getContents($templateMgr, $request = null) {
		$templateMgr->assign('articleSearchByOptions', [
			'query' => 'search.allFields',
			'authors' => 'search.author',
			'title' => 'article.title',
			'abstract' => 'search.abstract',
			'indexTerms' => 'search.indexTerms',
			'galleyFullText' => 'search.fullText'
		]);
		return parent::getContents($templateMgr, $request);
	}
}
