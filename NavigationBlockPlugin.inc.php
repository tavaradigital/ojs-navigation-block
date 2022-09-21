<?php

/**
 * @file plugins/blocks/navigation/NavigationBlockPlugin.inc.php
 *
 * Copyright (c) 2013-2019 Simon Fraser University
 * Copyright (c) 2003-2019 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class NavigationBlockPlugin
 * @ingroup plugins_blocks_navigation
 *
 * @brief Class for navigation block plugin
 */

import('lib.pkp.classes.plugins.BlockPlugin');

class NavigationBlockPlugin extends BlockPlugin {
	/**
	 * Determine whether the plugin is enabled. Overrides parent so that
	 * the plugin will be displayed during install.
	 *
	 * @param $contextId int Context ID (journal/press)
	 * @return boolean
	 */
	function getEnabled($contextId = null) {
		if (!Config::getVar('general', 'installed')) return true;
		return parent::getEnabled($contextId);
	}

	/**
	 * Install default settings on system install.
	 * @return string
	 */
	function getInstallSitePluginSettingsFile() {
		return $this->getPluginPath() . '/settings.xml';
	}

	/**
	 * Install default settings on journal creation.
	 * @return string
	 */
	function getContextSpecificPluginSettingsFile() {
		return $this->getPluginPath() . '/settings.xml';
	}

	/**
	 * Get the block context. Overrides parent so that the plugin will be
	 * displayed during install.
	 *
	 * @param $contextId int Context ID (journal/press)
	 * @return int
	 */
	function getBlockContext($contextId = null) {
		if (!Config::getVar('general', 'installed')) return BLOCK_CONTEXT_SIDEBAR;
		return parent::getBlockContext($contextId);
	}

	/**
	 * Determine the plugin sequence. Overrides parent so that
	 * the plugin will be displayed during install.
	 *
	 * @param $contextId int Context ID (journal/press)
	 */
	function getSeq($contextId = null) {
		if (!Config::getVar('general', 'installed')) return 5;
		return parent::getSeq($contextId);
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
	 * @return string
	 */
	function getContents(&$templateMgr) {
		$templateMgr->assign('articleSearchByOptions', array(
			'query' => 'search.allFields',
			'authors' => 'search.author',
			'title' => 'article.title',
			'abstract' => 'search.abstract',
			'indexTerms' => 'search.indexTerms',
			'galleyFullText' => 'search.fullText'
		));
		return parent::getContents($templateMgr);
	}
}
