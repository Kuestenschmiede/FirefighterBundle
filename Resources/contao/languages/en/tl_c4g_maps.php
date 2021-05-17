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

$GLOBALS['TL_LANG']['tl_c4g_maps']['tDontShowIfEmpty'] = array('hide if no entries exist', 'hides the layer in the starboard if it contains no entries.');

$GLOBALS['TL_LANG']['tl_c4g_maps']['references'][C4GFirefighterBrickTypes::BRICK_C4G_FIREFIGHTER_MAP]  = '[firefighter] Operations';
