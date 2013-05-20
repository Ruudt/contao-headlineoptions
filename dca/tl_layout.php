<?php

/**
 * Table tl_layout
 */

// Palettes
$GLOBALS['TL_DCA']['tl_layout']['palettes']['__selector__'][] = 'mainChangeHeadlineoptions';
$GLOBALS['TL_DCA']['tl_layout']['palettes']['__selector__'][] = 'leftChangeHeadlineoptions';
$GLOBALS['TL_DCA']['tl_layout']['palettes']['__selector__'][] = 'rightChangeHeadlineoptions';
$GLOBALS['TL_DCA']['tl_layout']['palettes']['default'] .= ';{headlineoptions_legend},mainChangeHeadlineoptions,leftChangeHeadlineoptions,rightChangeHeadlineoptions';

// Subpalettes
$GLOBALS['TL_DCA']['tl_layout']['subpalettes']['mainChangeHeadlineoptions'] = 'mainHeadlineoptions';
$GLOBALS['TL_DCA']['tl_layout']['subpalettes']['leftChangeHeadlineoptions'] = 'leftHeadlineoptions';
$GLOBALS['TL_DCA']['tl_layout']['subpalettes']['rightChangeHeadlineoptions'] = 'rightHeadlineoptions';

// Fields
$GLOBALS['TL_DCA']['tl_layout']['fields']['mainChangeHeadlineoptions'] = array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['mainChangeHeadlineoptions'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		);

$GLOBALS['TL_DCA']['tl_layout']['fields']['mainHeadlineoptions'] = array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['mainHeadlineoptions'],
			'exclude'                 => true,
			'filter'                  => true,
			'search'                  => true,
			'inputType'               => 'checkboxWizard',
			'options'                 => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
			'eval'                    => array('mandatory'=>true, 'multiple'=>true),
			'sql'                     => "text NULL"
		);

$GLOBALS['TL_DCA']['tl_layout']['fields']['leftChangeHeadlineoptions'] = array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['leftChangeHeadlineoptions'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		);

$GLOBALS['TL_DCA']['tl_layout']['fields']['leftHeadlineoptions'] = array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['leftHeadlineoptions'],
			'exclude'                 => true,
			'filter'                  => true,
			'search'                  => true,
			'inputType'               => 'checkboxWizard',
			'options'                 => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
			'eval'                    => array('mandatory'=>true, 'multiple'=>true),
			'sql'                     => "text NULL"
		);

$GLOBALS['TL_DCA']['tl_layout']['fields']['rightChangeHeadlineoptions'] = array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['rightChangeHeadlineoptions'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		);

$GLOBALS['TL_DCA']['tl_layout']['fields']['rightHeadlineoptions'] = array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['rightHeadlineoptions'],
			'exclude'                 => true,
			'filter'                  => true,
			'search'                  => true,
			'inputType'               => 'checkboxWizard',
			'options'                 => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
			'eval'                    => array('mandatory'=>true, 'multiple'=>true),
			'sql'                     => "text NULL"
		);