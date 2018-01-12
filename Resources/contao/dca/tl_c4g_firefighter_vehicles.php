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

$GLOBALS['TL_DCA']['tl_c4g_firefighter_vehicles'] = array
(
    //config
    'config' => array
    (
        'dataContainer'     => 'Table',
        'enableVersioning'  => 'true',
        'onsubmit_callback'           => array(
            array('\con4gis\CoreBundle\Resources\contao\classes\C4GAutomator', 'purgeApiCache')
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
            'fields'            => array('group_Id', 'caption ASC'),
            'panelLayout'       => 'filter;sort,search,limit',
            #'headerFields'      => array('group_Id', 'number', 'caption'),
        ),

        'label' => array
        (
            'fields'            => array('caption'),
            'format'            => '<span style="color:#023770">%s</span>'
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
                'label'         => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['edit'],
                'href'          => 'act=edit',
                'icon'          => 'edit.gif',
            ),
            'copy' => array
            (
                'label'         => $GLOBALS['TÖ_LANG']['tl_c4g_firefighter_vehicles']['copy'],
                'href'          => 'act=copy',
                'icon'          => 'copy.gif',
            ),
            'delete' => array
            (
                'label'         => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['delete'],
                'href'          => 'act=delete',
                'icon'          => 'delete.gif',
                'attributes'    => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false;Backend.getScrollOffset()"',
            ),
            'show' => array
            (
                'label'         => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['show'],
                'href'          => 'act=show',
                'icon'          => 'show.gif',
            ),
        )
    ),

    //Palettes
    'palettes' => array
    (
        'default'   =>  '{custom_legend},caption,vehicle_type_id,leader_caption,leader_phone;'.
                        '{data_legend},call_sign,issi;'.
                        '{group_legend},group_id',
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

        'group_id' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['group_id'],
            'exclude'           => true,
            'sorting'           => true,
            'search'            => true,
            'flag'              => 1,
            'inputType'         => 'select',
            'foreignKey'        => 'tl_member_group.name',
            'eval'              => array('mandatory' => true),
            'sql'               => "int(10) unsigned NOT NULL",
            'relation'          => array('type' => 'hasOne', 'load' => 'lazy')
        ),

        /*'number' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['number'],
            'sorting'           => true,
            'flag'              => 1,
            'search'            => true,
            'inputType'         => 'text',
            'eval'              => array('mandatory' => true,'tl_class' => 'w50', 'rgxp' => 'digit'),
            'sql'               => "int(10) unsigned NOT NULL"
        ),*/

        'caption' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['caption'],
            'sorting'           => true,
            'flag'              => 1,
            'search'            => true,
            'inputType'         => 'text',
            'eval'              => array('mandatory' => true, 'tl_class' => 'w50', 'maxlength' => 255),
            'sql'               => "varchar(255) NOT NULL"
        ),

        'call_sign' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['call_sign'],
            'inputType'         => 'text',
            'eval'              => array('tl_class' => 'w50', 'maxlength' => 45),
            'sql'               => "varchar(45) NOT NULL default ''"
        ),

        'issi' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['issi'],
            'inputType'         => 'text',
            'eval'              => array('tl_class' => 'w50', 'maxlength' => 45),
            'sql'               => "varchar(45) NOT NULL"
        ),

        'call_state' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['call_state'],
            'sorting'                 => true,
            'flag'                    => 1,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'rgxp'=>'digit'),
            'sql'                     => "varchar(10) NOT NULL default '-1'"
        ),

        /*    'leader_id' => array
            (
                'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['leader_id'],
                'flag'              => 1,
                'sorting'           => true,
                'search'            => true,
                'inputType'         => 'select',
                'eval'              => array('mandatory' => true, 'tl_class' => 'w50'),
                'exclude'           => true,
                'foreignKey'        => 'tl_member.firstname',
                'relation'          => array('type' => 'hasOne', 'load' => 'lazy'),
                'sql'               => "int(10) unsigned NOT NULL default '0'"
            ),*/

        'leader_caption' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['leader_caption'],
            'sorting'           => true,
            'flag'              => 1,
            'search'            => true,
            'inputType'         => 'text',
            'eval'              => array('mandatory' => false, 'tl_class' => 'w50', 'maxlength' => 255),
            'sql'               => "varchar(255) NOT NULL"
        ),

        'leader_phone' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['leader_phone'],
            'exclude'           => true,
            'search'            => true,
            'inputType'         => 'text',
            'eval'              => array('maxlength'=>64, 'rgxp'=>'phone', 'decodeEntities'=>true, 'feEditable'=>true, 'feViewable'=>true, 'feGroup'=>'contact', 'tl_class'=>'w50'),
            'sql'               => "varchar(64) NOT NULL default ''"
        ),

        'vehicle_type_id' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['vehicle_type_id'],
            'inputType'         => 'select',
            'foreignKey'        => 'tl_rescuemap_vehicle_types.vehicle_type',
            'eval'              => array('mandatory' => true, 'tl_class' => 'w50'),
            'sql'               => "int(10) unsigned NOT NULL",
            'relation'          => array('type' => 'hasOne', 'load' => 'lazy'),
        ),

        'tracking_type_id' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['tracking_type_id'],
            'exclude'                 => true,
            'sorting'                 => true,
            'flag'                    => 11,
            'filter'                  => true,
            'inputType'               => 'select',
            'options_callback'        => array('tl_rescuemap_vehicles', 'getTypes'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_rescuemap_vehicles']['tracking_types'] ,
            'eval'                    => array('mandatory'=>true, 'helpwizard'=>false, 'chosen'=>false, 'submitOnChange'=>true, 'tl_class'=>'w50 clr', 'includeBlankOption'=>true),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),

        'tracking_device_id' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['tracking_device_id'],
            'inputType'         => 'select',
            'foreignKey'        => 'tl_c4g_tracking_devices.name',
            'eval'              => array('mandatory' => true, 'tl_class' => 'w50'),
            'sql'               => "int(10) unsigned NOT NULL",
            'relation'          => array('type' => 'hasOne', 'load' => 'lazy'),
        ),

        'tracking_member_id' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['tracking_member_id'],
            'flag'              => 1,
            'sorting'           => true,
            'search'            => true,
            'inputType'         => 'select',
            'eval'              => array('mandatory' => true, 'tl_class' => 'w50'),
            'exclude'           => true,
            'foreignKey'        => 'tl_member.firstname',
            'relation'          => array('type' => 'hasOne', 'load' => 'lazy'),
            'sql'               => "int(10) unsigned NOT NULL default '0'"
        ),

        'map_interval' => array
        (
            'label'             => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['interval'],
            'exclude'           => true,
            'inputType'         => 'select',
            'options'           => array('none', '10', '30', '60', '300'),
            'reference'         => &$GLOBALS['TL_LANG']['MSC'],
            'eval'              => array('mandatory' => false,'includeBlankOption'=>true, 'feEditable'=>true, 'feViewable'=>true, 'tl_class'=>'w50'),
            'sql'               => "varchar(32) NOT NULL default ''"
        ),

        'loc_label' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['loc_label'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('tl_class'=>'clr' ),
            'sql'                     => "varchar(100) NOT NULL default ''"
        ),

        'maxheadcount' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['headcount'],
            'sorting'                 => true,
            'flag'                    => 1,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit'),
            'sql'                     => "int(10) unsigned NOT NULL"
        ),

        'base_id' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['base_id'],
            'inputType'         => 'select',
            'foreignKey'        => 'tl_rescuemap_bases.caption',
            'eval'              => array('mandatory' => true, 'tl_class' => 'w50'),
            'sql'               => "int(10) unsigned NOT NULL",
            'relation'          => array('type' => 'hasOne', 'load' => 'lazy'),
        ),

        'published' => array(
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['published'],
            'inputType'         => 'checkbox',
            'eval'              => array('tl_class'=>'w50'),
            'sql'               => "char(1) NOT NULL default ''"
        ),

        'contact_name' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['contact_name'],
            'sorting'           => true,
            'flag'              => 1,
            'search'            => true,
            'inputType'         => 'text',
            'eval'              => array('mandatory' => true, 'tl_class' => 'w50', 'maxlength' => 255),
            'sql'               => "varchar(255) NOT NULL"
        ),

        'contact_phone' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['contact_phone'],
            'inputType'         => 'text',
            'eval'              => array('maxlength'=>64, 'rgxp'=>'phone', 'decodeEntities'=>true, 'feEditable'=>true, 'feViewable'=>true, 'feGroup'=>'contact', 'tl_class'=>'w50'),
            'sql'               => "varchar(64) NOT NULL default ''"
        ),

        'last_member_id' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_vehicles']['last_member_id'],
            'flag'              => 1,
            'sorting'           => true,
            'search'            => true,
            'inputType'         => 'select',
            'eval'              => array('mandatory' => true, 'tl_class' => 'w50'),
            'exclude'           => true,
            'foreignKey'        => 'tl_member.firstname',
            'relation'          => array('type' => 'hasOne', 'load' => 'lazy'),
            'sql'               => "int(10) unsigned NOT NULL default '0'"
        ),
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
