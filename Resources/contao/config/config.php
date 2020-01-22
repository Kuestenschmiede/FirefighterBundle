<?php

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
 * Frontend Modules
 */
$GLOBALS['FE_MOD']['con4gis']['C4GFirefighterMembers'] = 'con4gis\FirefighterBundle\Resources\contao\modules\C4GFirefighterMembers';
$GLOBALS['FE_MOD']['con4gis']['C4GFirefighterOperations'] = 'con4gis\FirefighterBundle\Resources\contao\modules\C4GFirefighterOperations';
$GLOBALS['FE_MOD']['con4gis']['C4GFirefighterOperationList'] = 'con4gis\FirefighterBundle\Resources\contao\modules\C4GFirefighterOperationList';
asort($GLOBALS['FE_MOD']['con4gis']);
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
