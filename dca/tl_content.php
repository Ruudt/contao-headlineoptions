<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package Core
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Table tl_content
 */

	// Config
	// $GLOBALS['TL_DCA']['tl_content']['config'] => array
		// 'onload_callback'             => array
		// (
			// array('tl_content', 'showJsLibraryHint')
		// ),

	// Fields
$GLOBALS['TL_DCA']['tl_content']['fields']['headline']['_options'] = $GLOBALS['TL_DCA']['tl_content']['fields']['headline']['options'];
unset($GLOBALS['TL_DCA']['tl_content']['fields']['headline']['options']);
$GLOBALS['TL_DCA']['tl_content']['fields']['headline']['options_callback'] = array('tl_content_headlineoptions', 'getHeadlines');
	// (
		// 'type' => array
		// (
			// 'label'                   => &$GLOBALS['TL_LANG']['tl_content']['type'],
			// 'default'                 => 'text',
			// 'exclude'                 => true,
			// 'filter'                  => true,
			// 'inputType'               => 'select',
			// 'options_callback'        => array('tl_content', 'getContentElements'),
			// 'reference'               => &$GLOBALS['TL_LANG']['CTE'],
			// 'eval'                    => array('helpwizard'=>true, 'chosen'=>true, 'submitOnChange'=>true, 'gallery_types'=>array('gallery'), 'downloads_types'=>array('downloads')),
			// 'sql'                     => "varchar(32) NOT NULL default ''"
		// ),
		 // => array
		// (
			// 'label'                   => &$GLOBALS['TL_LANG']['tl_content']['headline'],
			// 'exclude'                 => true,
			// 'search'                  => true,
			// 'inputType'               => 'inputUnit',
			// 'options'                 => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
			// 'eval'                    => array('maxlength'=>200),
			// 'sql'                     => "varchar(255) NOT NULL default ''"
		// ),


/**
 * Class tl_content_headlineoptions
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Ruud Walraven 2013
 * @author     Ruud Walraven <ruud.walraven@gmail.com>
 */
class tl_content_headlineoptions extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	/**
	 * Return all headlines as array
	 * @return array
	 */
	public function getHeadlines()
	{
		if (!CURRENT_ID)
		{
			return $GLOBALS['TL_DCA']['tl_content']['fields']['headline']['_options'];
		}
		
		$headlines = array();

		$objArticle = $this->Database->prepare("SELECT id, pid, InColumn FROM tl_article WHERE id=?")
									  ->execute(CURRENT_ID);

		// Invalid ID
		if ($objArticle->numRows < 1)
		{
			$this->log('Invalid article ID ' . $id, 'tl_content_headlineoptions getHeadlines()', TL_ERROR);
			return $GLOBALS['TL_DCA']['tl_content']['fields']['headline']['_options'];
		}

		// TODO: can this be more efficient?
		$objPage = PageModel::findPublishedByIdOrAlias($objArticle->pid)->current()->loadDetails();
		$objLayout = $this->Database->prepare("SELECT * FROM tl_layout WHERE id=?")
									->execute($objPage->layout);

		// Invalid page or layout
		if ($objLayout->numRows < 1)
		{
			$this->log('Layout of page ' . $objArticle->pid . ' not found', 'tl_content_headlineoptions getHeadlines()', TL_ERROR);
			return $GLOBALS['TL_DCA']['tl_content']['fields']['headline']['_options'];
		}

		// Get headline options for current column
		$fldColumnCheck = $objArticle->InColumn . 'ChangeHeadlineoptions';
		$fldColumn = $objArticle->InColumn . 'Headlineoptions';

		if (!$objLayout->$fldColumnCheck || !$objLayout->$fldColumn)
		{
			return $GLOBALS['TL_DCA']['tl_content']['fields']['headline']['_options'];
		}

		return deserialize($objLayout->$fldColumn);
	}
}
