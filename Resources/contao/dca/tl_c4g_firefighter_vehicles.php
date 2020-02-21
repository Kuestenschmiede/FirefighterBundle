<?php
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

$GLOBALS['TL_DCA']['tl_c4g_firefighter_vehicles'] = array
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
            'mode'              => 2,
            'fields'            => array('caption ASC', 'vehicle_type_id'),
            'panelLayout'       => 'filter;sort,search,limit',
            'icon'              => 'bundles/con4giscore/images/be-icons/con4gis_blue.svg',
        ),

        'label' => array
        (
            'fields'            => array('caption','vehicle_type_id:tl_c4g_firefighter_vehicle_types.vehicle_type'),
            'showColumns'       => true
        ),

        'global_operations' => array
        (
            'all' => [
                'label'         => $GLOBALS['TL_LANG']['MSC']['all'],
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
                'label'         => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['edit'],
                'href'          => 'act=edit',
                'icon'          => 'edit.svg',
            ),
            'copy' => array
            (
                'label'         => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['copy'],
                'href'          => 'act=copy',
                'icon'          => 'copy.svg',
            ),
            'delete' => array
            (
                'label'         => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['delete'],
                'href'          => 'act=delete',
                'icon'          => 'delete.svg',
                'attributes'    => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false;Backend.getScrollOffset()"',
            ),
            'show' => array
            (
                'label'         => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['show'],
                'href'          => 'act=show',
                'icon'          => 'show.svg',
            ),
        )
    ),

    //Palettes
    'palettes' => array
    (
        'default'   =>  '{custom_legend},caption,vehicle_type_id,vehicle_page_link;',
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
            'sql'               => "int(10) unsigned NOT NULL default '0'"
        ),

        'caption' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['caption'],
            'sorting'           => true,
            'default'           => '',
            'flag'              => 1,
            'search'            => true,
            'inputType'         => 'text',
            'eval'              => array('mandatory' => true, 'tl_class' => 'w50', 'maxlength' => 255),
            'sql'               => "varchar(255) NOT NULL"
        ),

        'vehicle_type_id' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['vehicle_type_id'],
            'inputType'         => 'select',
            'default'           => '0',
            'foreignKey'        => 'tl_c4g_firefighter_vehicle_types.vehicle_type',
            'eval'              => array('mandatory' => true, 'tl_class' => 'w50'),
            'sql'               => "int(10) unsigned NOT NULL",
            'relation'          => array('type' => 'hasOne', 'load' => 'lazy'),
        ),

        'vehicle_page_link' => array
        (
            'label'                   => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['vehicle_page_link'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'fieldType'=>'radio', 'feEditable' => true, 'feViewable' => true, 'tl_class'=>'long'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        )
    )

);


/**
 * Class tl_c4g_firefighter_vehicles
 */
class tl_c4g_firefighter_vehicles extends Backend
{
    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }


    public function updateDCA (DataContainer $dc)
    {

    }
}
