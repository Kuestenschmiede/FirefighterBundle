<?php

/**
 *  con4gis for Contao Open Source CMS
 *
 * @version   php 7
 * @package   con4gis-Firefighter (FirefighterBundle)
 * @author    con4gis contributors
 * @license   GNU/LGPL http://opensource.org/licenses/lgpl-3.0.html
 * @copyright Küstenschmiede GmbH Software & Design 2015 - 2018
 * @link      https://www.kuestenschmiede.de
 */


//Palettes
$GLOBALS['TL_DCA']['tl_c4g_settings']['palettes']['default'] =
    $GLOBALS['TL_DCA']['tl_c4g_settings']['palettes']['default'] .
    '{firefighter_legend},redirect_to_operations;';

$GLOBALS['TL_DCA']['tl_c4g_settings']['fields']['redirect_to_operations'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_c4g_settings']['redirect_to_operations'],
    'exclude'                 => true,
    'inputType'               => 'pageTree',
    'foreignKey'              => 'tl_page.title',
    'eval'                    => array('mandatory'=>true, 'fieldType'=>'radio'),
    'sql'                     => "int(10) unsigned NOT NULL default '0'",
    'relation'                => array('type'=>'hasOne', 'load'=>'eager')
);
