<?php

/**
 * @copyright  Ruud Walraven 2013
 * @author     Ruud Walraven <ruud.walraven@gmail.com>
 */


/**
 * Table tl_content
 */

// Fields
$GLOBALS['TL_DCA']['tl_content']['fields']['headline']['_options'] = $GLOBALS['TL_DCA']['tl_content']['fields']['headline']['options'];
unset($GLOBALS['TL_DCA']['tl_content']['fields']['headline']['options']);
$GLOBALS['TL_DCA']['tl_content']['fields']['headline']['options_callback'] = array('tl_content_headlineoptions', 'getHeadlines');

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
		$objPage = PageModel::findById($objArticle->pid)->current()->loadDetails();
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
