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

use con4gis\FirefighterBundle\Classes\C4GFirefighterBrickTypes;

/**
 * Global settings
 */
$GLOBALS['con4gis']['firefighter']['installed']    = true;


/**
 * Frontend Modules
 */
array_insert( $GLOBALS['FE_MOD']['con4gis'], $GLOBALS['con4gis']['maps']['installed']?1:0, array
  (
    'C4GFirefighterMembers' => 'con4gis\FirefighterBundle\Resources\contao\modules\C4GFirefighterMembers',
    'C4GFirefighterOperations' => 'con4gis\FirefighterBundle\Resources\contao\modules\C4GFirefighterOperations',
    'C4GFirefighterOperationList' => 'con4gis\FirefighterBundle\Resources\contao\modules\C4GFirefighterOperationList',
  )
);

/**
 * Backend Modules
 */
$GLOBALS['BE_MOD']['con4gis'] = array_merge($GLOBALS['BE_MOD']['con4gis'], array(
        'c4g_firefighter_operation_types' => array
        (
            'tables'    => array('tl_c4g_firefighter_operation_types')
        ),
        'c4g_firefighter_operation_categories' => array
        (
            'tables'    => array('tl_c4g_firefighter_operation_categories')
        ),
        'c4g_firefighter_vehicle_types' => array
        (
            'tables'    => array('tl_c4g_firefighter_vehicle_types')
        ),
        'c4g_firefighter_vehicles' => array
        (
            'tables'    => array('tl_c4g_firefighter_vehicles')
        ),
        'c4g_firefighter_unit_types' => array
        (
            'tables'    => array('tl_c4g_firefighter_unit_types')
        ),
        'c4g_firefighter_units' => array
        (
            'tables'    => array('tl_c4g_firefighter_units')
        ),
        'c4g_firefighter_operations' => array
        (
            'tables'    => array('tl_c4g_firefighter_operations')
        )
    )
);

if (TL_MODE == "BE") {
    $GLOBALS['TL_CSS'][] = '/bundles/con4gisfirefighter/css/con4gis.css';
}

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
