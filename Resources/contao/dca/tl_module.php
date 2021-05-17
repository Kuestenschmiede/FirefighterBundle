<?php
/*
 * This file is part of con4gis, the gis-kit for Contao CMS.
 * @package con4gis
 * @version 8
 * @author con4gis contributors (see "authors.txt")
 * @license LGPL-3.0-or-later
 * @copyright (c) 2010-2021, by Küstenschmiede GmbH Software & Design
 * @link https://www.con4gis.org
 */

/**
 *  con4gis for Contao Open Source CMS
 *
 * @version   php 7
 * @package   con4gis-Firefighter (FirefighterBundle)
 * @author    con4gis contributors
 * @license   GNU/LGPL http://opensource.org/licenses/lgpl-3.0.html
 * @copyright Küstenschmiede GmbH Software & Design 2011 - 2019
 * @link      https://www.kuestenschmiede.de
 */


/**
 * Table tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['C4GFirefighterMembers'] = '{title_legend},name,headline,type;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['C4GFirefighterOperations'] = '{title_legend},name,headline,type;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['C4GFirefighterOperationList'] = '{title_legend},name,headline,type;{settings_legend},c4g_row_count;';

$GLOBALS['TL_DCA']['tl_module']['fields']['c4g_row_count'] = array(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['fields']['c4g_row_count'],
    'sorting'                 => true,
    'default'                 => 0,
    'flag'                    => 1,
    'search'                  => true,
    'inputType'               => 'text',
    'eval'                    => array('tl_class'=>'w50', 'mandatory'=>false, 'rgxp'=>'digit'),
    'sql'                     => "int(10) unsigned NOT NULL default = 0"
);
