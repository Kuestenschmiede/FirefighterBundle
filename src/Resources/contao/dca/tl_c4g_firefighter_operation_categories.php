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
 * con4gis for Contao Open Source CMS
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

$GLOBALS['TL_DCA']['tl_c4g_firefighter_operation_categories'] = array
(
    //config
    'config' => array
    (
        'dataContainer'     => 'Table',
        'enableVersioning'  => 'true',
        'onsubmit_callback'           => array(
            array('\con4gis\MapsBundle\Classes\Caches\C4GMapsAutomator', 'purgeLayerApiCache')
        ),
        'sql'               => array
        (
            'keys' => array
            (
                'id' => 'primary'
            )
        )
    ),

    //List
    'list' => array
    (
        'sorting' => array
        (
            'mode'              => 11,
            'fields'            => array('operation_category'),
            'panelLayout'       => 'filter;sort,search,limit',
            'icon'              => 'bundles/con4giscore/images/be-icons/con4gis_blue.svg',
        ),

        'label' => array
        (
            'fields'            => array('operation_category'),
            'format'            => '%s',
        ),

        'global_operations' => array
        (
            'all' => [
                'label'         => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'          => 'act=select',
                'class'         => 'header_edit_all',
                'attributes'    => 'onclick="Backend.getScrollOffSet()" accesskey="e"'
            ],
            'back' => [
                'href'                => 'key=back',
                'class'               => 'header_back',
                'button_callback'     => ['\con4gis\CoreBundle\Classes\Helper\DcaHelper', 'back'],
                'icon'                => 'back.svg',
                'label'               => &$GLOBALS['TL_LANG']['MSC']['backBT'],
            ],
        ),

        'operations' => array
        (
            'edit' => array
            (
                'label'         => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operation_categories']['edit'],
                'href'          => 'act=edit',
                'icon'          => 'edit.svg',
            ),
            'copy' => array
            (
                'label'         => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operation_categories']['copy'],
                'href'          => 'act=copy',
                'icon'          => 'copy.svg',
            ),
            'delete' => array
            (
                'label'         => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operation_categories']['delete'],
                'href'          => 'act=delete',
                'icon'          => 'delete.svg',
                'attributes'    => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? null  . '\')) return false;Backend.getScrollOffset()"',
            ),
            'show' => array
            (
                'label'         => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operation_categories']['show'],
                'href'          => 'act=show',
                'icon'          => 'show.svg',
            ),
        )
    ),

    //Palettes
    'palettes' => array
    (
        'default'   =>  '{data_legend},operation_type,operation_category,operation_locstyles',
    ),

    //Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'               => "int(10) unsigned NOT NULL auto_increment"
        ),

        'tstamp' => array
        (
            'sql'               => "int(10) unsigned NOT NULL default '0'"
        ),

        'importId' => array
        (
            'sql'               => "int(10) unsigned NOT NULL default '0'",
            'eval'              => array('doNotCopy' => true)
        ),

        'operation_type' => array
        (
            'label'             => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operation_categories']['operation_type'],
            'exclude'           => true,
            'sorting'           => true,
            'search'            => true,
            'inputType'         => 'select',
            'foreignKey'        => 'tl_c4g_firefighter_operation_types.operation_type',
            'eval'              => array('mandatory' => true, 'chosen' => 'true', 'includeBlankOption' => false, 'doNotSaveEmpty' => true),
            'sql'               => "varchar(255) NOT NULL default ''",
            'relation'          => array('type' => 'hasOne', 'load' => 'lazy'),
        ),

        'operation_category' => array
        (
            'label'             => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operation_categories']['operation_category'],
            'flag'              => 2,
            'sorting'           => true,
            'search'            => true,
            'inputType'         => 'text',
            'eval'              => array('chosen' => true, 'includeBlankOption' => false, 'mandatory' => true, 'tl_class' => 'w50'),
            'sql'               => "varchar(255) NOT NULL default ''"
        ),

        'operation_locstyles' => array
        (
            'label'             => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operation_categories']['operation_locstyles'],
            'inputType'         => 'select',
            'eval'              => array('chosen' => true, 'includeBlankOption' => false, 'tl_class' => 'w50', 'mandatory' => false),
            'foreignKey'        => 'tl_c4g_map_locstyles.name',
            'relation'          => array('type' => 'hasOne', 'load' => 'lazy'),
            'sql'               => "int(10) unsigned NOT NULL default '0'"
        ),

    )
);


/**
 * Class tl_c4g_firefighter_operation_categories
 */
class tl_c4g_firefighter_operation_categories extends Backend
{
    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }
}
