<?php

/**
 * Contao Open Source CMS
 *
 * @version   php 5
 * @package   con4gis_mapcil
 * @author    Matthias Eilers
 * @license   GNU/LGPL http://opensource.org/licenses/lgpl-3.0.html
 * @copyright Küstenschmiede GmbH Software & Design 2011 - 2019
 * @link      https://www.kuestenschmiede.de
 */

use con4gis\FirefighterBundle\Classes\C4GFirefighterBrickTypes;


/**
 * Table tl_c4g_maps
 */

$GLOBALS['TL_DCA']['tl_c4g_maps']['palettes'][C4GFirefighterBrickTypes::BRICK_C4G_FIREFIGHTER_MAP] = '{general_legend},name,profile,profile_mobile,published;{map_legend},is_map;{location_legend},location_type,tDontShowIfEmpty,locstyle,data_layername,data_hidelayer,popup_info,routing_to,loc_linkurl,loc_minzoom,loc_maxzoom,hide_when_in_tab;{protection_legend:hide},protect_element;';

$GLOBALS['TL_DCA']['tl_c4g_maps']['subpalettes']['useDatabaseStatus'] = 'databaseStatus';


$GLOBALS['TL_DCA']['tl_c4g_maps']['fields']['tDontShowIfEmpty'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_c4g_maps']['tDontShowIfEmpty'],
  'exclude'                 => true,
  'filter'                  => true,
  'inputType'               => 'checkbox',
  'eval'                    => array('submitOnChange'=>false, 'tl_class'=>'clr'),
  'sql'                     => "char(1) NOT NULL default ''"
);
