<?php
/*
 * This file is part of con4gis, the gis-kit for Contao CMS.
 * @package con4gis
 * @version 8
 * @author con4gis contributors (see "authors.txt")
 * @license LGPL-3.0-or-later
 * @copyright (c) 2010-2022, by Küstenschmiede GmbH Software & Design
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

use con4gis\CoreBundle\Classes\C4GVersionProvider;
use con4gis\FirefighterBundle\Classes\C4GFirefighterBrickTypes;

/**
 * Backend Modules
 */
$GLOBALS['BE_MOD']['con4gis'] = array_merge($GLOBALS['BE_MOD']['con4gis'], array(
        'c4g_firefighter_operation_types' => array
        (
            'brick' => 'firefighter',
            'tables' => array('tl_c4g_firefighter_operation_types'),
            'icon' => 'bundles/con4gisfirefighter/images/be-icons/operationtypes.svg'
        ),
        'c4g_firefighter_operation_categories' => array
        (
            'brick' => 'firefighter',
            'tables' => array('tl_c4g_firefighter_operation_categories'),
            'icon' => 'bundles/con4gisfirefighter/images/be-icons/operationcategories.svg'
        ),
        'c4g_firefighter_vehicle_types' => array
        (
            'brick' => 'firefighter',
            'tables' => array('tl_c4g_firefighter_vehicle_types'),
            'icon' => 'bundles/con4gisfirefighter/images/be-icons/vehicletypes.svg'
        ),
        'c4g_firefighter_vehicles' => array
        (
            'brick' => 'firefighter',
            'tables' => array('tl_c4g_firefighter_vehicles'),
            'icon' => 'bundles/con4gisfirefighter/images/be-icons/vehicles.svg'
        ),
        'c4g_firefighter_unit_types' => array
        (
            'brick' => 'firefighter',
            'tables' => array('tl_c4g_firefighter_unit_types'),
            'icon' => 'bundles/con4gisfirefighter/images/be-icons/unittypes.svg'
        ),
        'c4g_firefighter_units' => array
        (
            'brick' => 'firefighter',
            'tables' => array('tl_c4g_firefighter_units'),
            'icon' => 'bundles/con4gisfirefighter/images/be-icons/units.svg'
        ),
        'c4g_firefighter_operations' => array
        (
            'brick' => 'firefighter',
            'tables' => array('tl_c4g_firefighter_operations'),
            'icon' => 'bundles/con4gisfirefighter/images/be-icons/operations.svg'
        )
    )
);

/** Models */
$GLOBALS['TL_MODELS']['tl_c4g_firefighter_operations'] = 'con4gis\FirefighterBundle\Resources\contao\models\C4gFirefighterOperationsModel';
$GLOBALS['TL_MODELS']['tl_c4g_firefighter_operation_types'] = 'con4gis\FirefighterBundle\Resources\contao\models\C4gFirefighterOperationTypesModel';
$GLOBALS['TL_MODELS']['tl_c4g_firefighter_operation_categories'] = 'con4gis\FirefighterBundle\Resources\contao\models\C4gFirefighterOperationCategoriesModel';
$GLOBALS['TL_MODELS']['tl_c4g_firefighter_vehicle_types'] = 'con4gis\FirefighterBundle\Resources\contao\models\C4gFirefighterVehicleTypesModel';
$GLOBALS['TL_MODELS']['tl_c4g_firefighter_vehicles'] = 'con4gis\FirefighterBundle\Resources\contao\models\C4gFirefighterVehiclesModel';
$GLOBALS['TL_MODELS']['tl_c4g_firefighter_unit_types'] = 'con4gis\FirefighterBundle\Resources\contao\models\C4gFirefighterUnitTypesModel';
$GLOBALS['TL_MODELS']['tl_c4g_firefighter_units'] = 'con4gis\FirefighterBundle\Resources\contao\models\C4gFirefighterUnitsModel';

/** Kartenstrukturelemente */
$GLOBALS['c4g_locationtypes'][] = C4GFirefighterBrickTypes::BRICK_C4G_FIREFIGHTER_MAP;
