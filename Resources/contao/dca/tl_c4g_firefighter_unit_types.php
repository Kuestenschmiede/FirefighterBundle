<?php
/**
 * con4gis for Contao Open Source CMS
 *
 * @version   php 7
 * @package   con4gis-Firefighter (FirefighterBundle)
 * @author    con4gis contributors
 * @license   GNU/LGPL http://opensource.org/licenses/lgpl-3.0.html
 * @copyright Küstenschmiede GmbH Software & Design 2015 - 2018
 * @link      https://www.kuestenschmiede.de
 */


/**
 * Table tl_module
 */

$GLOBALS['TL_DCA']['tl_c4g_firefighter_unit_types'] = array
(
    //config
    'config' => array
    (
        'dataContainer'     => 'Table',
        'enableVersioning'  => 'true',
//        'onsubmit_callback'           => array(
//            array('\con4gis\CoreBundle\Resources\contao\classes\C4GAutomator', 'purgeApiCache')
//        ),
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
            'fields'            => array('unit_type'),
            'panelLayout'       => 'filter;sort,search,limit',
            'headerFields'      => array('unit_type'),
        ),

        'label' => array
        (
            'fields'            => array('unit_type'),
            'format'            => '%s',
        ),

        'global_operations' => array
        (
            'all' => array
            (
                'label'         => $GLOBALS['TL_LANG']['MSC']['all'],
                'href'          => 'act=select',
                'class'         => 'header_edit_all',
                'attributes'    => 'onclick="Backend.getScrollOffSet()" accesskey="e"'
            )
        ),

        'operations' => array
        (
            'edit' => array
            (
                'label'         => $GLOBALS['TL_LANG']['tl_c4g_firefighter_unit_types']['edit'],
                'href'          => 'act=edit',
                'icon'          => 'edit.gif',
            ),
            'copy' => array
            (
                'label'         => $GLOBALS['TL_LANG']['tl_c4g_firefighter_unit_types']['copy'],
                'href'          => 'act=copy',
                'icon'          => 'copy.gif',
            ),
            'delete' => array
            (
                'label'         => $GLOBALS['TL_LANG']['tl_c4g_firefighter_unit_types']['delete'],
                'href'          => 'act=delete',
                'icon'          => 'delete.gif',
                'attributes'    => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false;Backend.getScrollOffset()"',
            ),
            'show' => array
            (
                'label'         => $GLOBALS['TL_LANG']['tl_c4g_firefighter_unit_types']['show'],
                'href'          => 'act=show',
                'icon'          => 'show.gif',
            ),
        )
    ),

    //Palettes
    'palettes' => array
    (
        'default'   =>  '{data_legend}, unit_type, unit_locstyle',
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

        'unit_type' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_unit_types']['unit_type'],
            'flag'              => 1,
            'sorting'           => true,
            'default'           => '',
            'search'            => true,
            'inputType'         => 'text',
            'eval'              => array('mandatory' => true, 'tl_class' => 'long'),
            'sql'               => "varchar(255) NOT NULL default ''"
        ),

        'unit_locstyle' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_unit_types']['unit_locstyle'],
            'inputType'         => 'select',
            //'eval'              => array('tl_class' => 'w50'),
            'default'           => '0',
            'foreignKey'        => 'tl_c4g_map_locstyles.name',
            'relation'          => array('type' => 'hasOne', 'load' => 'lazy'),
            'sql'               => "int(10) unsigned NOT NULL default '0'"
        ),
    )
);


/**
 * Class tl_c4g_firefighter_unit_types
 */
class tl_c4g_firefighter_unit_types extends Backend
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
