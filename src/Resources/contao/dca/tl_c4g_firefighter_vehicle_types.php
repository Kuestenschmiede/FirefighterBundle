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

$GLOBALS['TL_DCA']['tl_c4g_firefighter_vehicle_types'] = array
(
    //config
    'config' => array
    (
        'dataContainer'     => 'Table',
        'enableVersioning'  => 'true',
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
            'fields'            => array('vehicle_type'),
            'panelLayout'       => 'filter;sort,search,limit',
            'icon'              => 'bundles/con4giscore/images/be-icons/con4gis_blue.svg',
        ),

        'label' => array
        (
            'fields'            => array('vehicle_type'),
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
                'label'         => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicle_types']['edit'],
                'href'          => 'act=edit',
                'icon'          => 'edit.svg',
            ),
            'copy' => array
            (
                'label'         => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicle_types']['copy'],
                'href'          => 'act=copy',
                'icon'          => 'copy.svg',
            ),
            'delete' => array
            (
                'label'         => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicle_types']['delete'],
                'href'          => 'act=delete',
                'icon'          => 'delete.svg',
                'attributes'    => 'onclick="if(!confirm(\'' . key_exists('deleteConfirm', $GLOBALS['TL_LANG']['MSC']) && $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ? $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] : null . '\')) return false;Backend.getScrollOffset()"',
            ),
            'show' => array
            (
                'label'         => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicle_types']['show'],
                'href'          => 'act=show',
                'icon'          => 'show.svg',
            ),
        )
    ),

    //Palettes
    'palettes' => array
    (
        'default'   =>  '{data_legend},vehicle_type,vehicle_langtext,vehicle_locstyle',
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

        'vehicle_type' => array
        (
            'label'             => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicle_types']['vehicle_type'],
            'flag'              => 1,
            'default'           => '',
            'sorting'           => true,
            'search'            => true,
            'inputType'         => 'text',
            'eval'              => array('mandatory' => true, 'tl_class' => 'long'),
            'sql'               => "varchar(255) NOT NULL default ''"
        ),

        'vehicle_langtext' => array
        (
            'label'             => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicle_types']['vehicle_langtext'],
            'sorting'           => true,
            'default'           => '',
            'flag'              => 1,
            'search'            => true,
            'inputType'         => 'text',
            'eval'              => array('mandatory' => false, 'tl_class' => 'long', 'maxlength' => 255),
            'sql'               => "varchar(255) NOT NULL"
        ),

//        'vehicle_opta' => array(
//            'label'                   => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicle_types']['vehicle_opta'],
//            'sorting'                 => true,
//            'default'                 => '0',
//            'flag'                    => 1,
//            'search'                  => true,
//            'inputType'               => 'text',
//            'eval'                    => array('mandatory'=>false, 'rgxp'=>'digit'),
//            'sql'                     => "int(10) unsigned NOT NULL"
//        ),

        'vehicle_locstyle' => array
        (
            'label'             => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicle_types']['vehicle_locstyle'],
            'inputType'         => 'select',
            'default'           => '0',
            //'eval'              => array('tl_class' => 'w50'),
            'foreignKey'        => 'tl_c4g_map_locstyles.name',
            'relation'          => array('type' => 'hasOne', 'load' => 'lazy'),
            'sql'               => "int(10) unsigned NOT NULL default '0'"
        ),

    )
);

/**
 * Class tl_c4g_firefighter_vehicle_types
 */
class tl_c4g_firefighter_vehicle_types extends Backend
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
