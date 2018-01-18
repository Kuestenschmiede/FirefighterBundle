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
  )
);

/**
 * Backend Modules
 */
array_insert($GLOBALS['BE_MOD'], array_search('content', array_keys($GLOBALS['BE_MOD'])) + 1, array
(
    'C4GFirefighter' => array
    (
        'C4gFirefighterOperationTypes' => array
        (
            'tables'    => array('tl_c4g_firefighter_operation_types')
        ),
        'C4gFirefighterOperationCategories' => array
        (
            'tables'    => array('tl_c4g_firefighter_operation_categories')
        ),
        'C4gFirefighterOperations' => array
        (
            'tables'    => array('tl_c4g_firefighter_operations')
        ),
        'C4gFirefighterVehicleTypes' => array
        (
            'tables'    => array('tl_c4g_firefighter_vehicle_types')
        ),
        'C4gFirefighterVehicles' => array
        (
            'tables'    => array('tl_c4g_firefighter_vehicles')
        ),
        'C4gFirefighterUnitTypes' => array
        (
            'tables'    => array('tl_c4g_firefighter_unit_types')
        ),
        'C4gFirefighterUnits' => array
        (
            'tables'    => array('tl_c4g_firefighter_units')
        )
    )
));

/** Backend Icons */
if ('BE' === TL_MODE) {
   $GLOBALS['TL_CSS'][] = 'bundles\con4gisfirefighter\backend_svg.css';
}

/** Models */
$GLOBALS['TL_MODELS']['tl_c4g_firefighter_operations'] = 'con4gis\FirefighterBundle\Resources\contao\models\C4gFirefighterOperationsModel';