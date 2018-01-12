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

$GLOBALS['TL_DCA']['tl_c4g_firefighter_operations'] = array
(
    //config
    'config' => array
    (
        'dataContainer'     => 'Table',
        'enableVersioning'  => true,
        'onsubmit_callback'           => array(
            array('\con4gis\CoreBundle\Resources\contao\classes\C4GAutomator', 'purgeApiCache')
        ),
        'databaseAssisted'  => true,
        'sql'               => array
        (
            'keys' => array
            (
                'id' => 'primary',
                'uuid' => 'unique',
            )
        )
    ),


    //List
    'list' => array
    (
        'sorting' => array
        (
            'mode'              => 2,
            'fields'            => array('group_Id', 'caption ASC'),
            'panelLayout'       => 'filter;sort,search,limit',
            #'headerFields'      => array('group_Id', 'number', 'caption'),
        ),

        'label' => array
        (
            'fields'            => array('caption'),
            'format'            => '<span style="color:#023770">%s</span>',
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
                'label'         => $GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['edit'],
                'href'          => 'act=edit',
                'icon'          => 'edit.gif',
            ),
            'copy' => array
            (
                'label'         => $GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['copy'],
                'href'          => 'act=copy',
                'icon'          => 'copy.gif',
            ),
            'delete' => array
            (
                'label'         => $GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['delete'],
                'href'          => 'act=delete',
                'icon'          => 'delete.gif',
                'attributes'    => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false;Backend.getScrollOffset()"',
            ),
            'show' => array
            (
                'label'         => $GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['show'],
                'href'          => 'act=show',
                'icon'          => 'show.gif',
            ),
        )
    ),

    //Palettes
    'palettes' => array
    (
        'default'   =>  '{custom_legend},caption, operation_type_id, description,leader_caption,headcount,leader_phone;{data_legend},call_sign,issi;'.
                '{group_legend},group_id,project_id;{maps_legend},loc_geox,loc_geoy,loc_label,locstyle;'
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

        'uuid' => array
        (
            'save_callback'     => array(array('tl_c4g_projects','generateUuid')),
            'sql'               => "varchar(128) NOT NULL default ''"
        ),

        'brick_key' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_projects']['brick_key'],
            'sorting'           => true,
            'flag'              => 1,
            'search'            => true,
            'inputType'         => 'text',
            'eval'              => array('mandatory' => true, 'tl_class' => 'w50', 'maxlength' => 255),
            'sql'               => "varchar(255) NOT NULL"
        ),

        'group_id' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_projects']['group_id'],
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

        'caption' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_projects']['caption'],
            'sorting'           => true,
            'flag'              => 1,
            'search'            => true,
            'inputType'         => 'text',
            'eval'              => array('mandatory' => true, 'maxlength' => 255),
            'sql'               => "varchar(255) NOT NULL"
        ),

        'description' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_c4g_projects']['description'],
            //'exclude'                 => true,
            'inputType'               => 'textarea',
            'search'                  => true,
            'eval'                    => array('tl_class'=>'long','style'=>'height:60px', 'decodeEntities'=>true),
            'sql'                     => "text NULL"
        ),

        'last_member_id' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_projects']['last_member_id'],
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

        'is_frozen' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_c4g_projects']['is_frozen'],
            //'sorting'                 => true,
            //'flag'                    => 1,
            //'search'                  => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default '0'"
        ),

        'operation_type_id' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_rescuemap_operations']['operation_type_id'],
            'inputType'         => 'select',
            'foreignKey'        => 'tl_rescuemap_operation_types.operation_type',
            'eval'              => array('mandatory' => true, 'tl_class' => 'w50'),
            'sql'               => "int(10) unsigned NOT NULL",
            'relation'          => array('type' => 'hasOne', 'load' => 'lazy'),
        ),

        'vehicle_id' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_rescuemap_operations']['vehicle_id'],
            'inputType'         => 'select',
            'foreignKey'        => 'tl_rescuemap_vehicle.caption',
            'eval'              => array('mandatory' => true, 'tl_class' => 'w50'),
            'sql'               => "int(10) unsigned NOT NULL",
            'relation'          => array('type' => 'hasOne', 'load' => 'lazy'),
        ),

        'startDate' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_rescuemap_operations']['startDate'],
            'default'                 => time(),
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'date', 'mandatory'=>true, 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "int(10) unsigned NULL"
        ),

        'endDate' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_rescuemap_operations']['endDate'],
            'default'                 => null,
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'date', 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "int(10) unsigned NULL"
        ),

        'startTime' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_rescuemap_operations']['startTime'],
            'default'                 => time(),
            'exclude'                 => true,
            'filter'                  => true,
            'sorting'                 => true,
            'flag'                    => 8,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'time', 'mandatory'=>true, 'doNotCopy'=>true, 'tl_class'=>'w50'),
            'sql'                     => "int(10) unsigned NULL"
        ),

        'endTime' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_rescuemap_operations']['endTime'],
            'default'                 => null,
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'time', 'doNotCopy'=>true, 'tl_class'=>'w50'),
            'sql'                     => "int(10) unsigned NULL"
        ),

        'call_sign' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_rescuemap_operations']['call_sign'],
            'inputType'         => 'text',
            'eval'              => array('tl_class' => 'w50', 'maxlength' => 45),
            'sql'               => "varchar(45) NOT NULL default ''"
        ),

        'issi' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_rescuemap_operations']['issi'],
            'inputType'         => 'text',
            'eval'              => array('tl_class' => 'w50', 'maxlength' => 45),
            'sql'               => "varchar(45) NOT NULL"
        ),

        'leader_caption' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_rescuemap_operations']['leader_caption'],
            'sorting'           => true,
            'flag'              => 1,
            'search'            => true,
            'inputType'         => 'text',
            'eval'              => array('mandatory' => false, 'tl_class' => 'w50', 'maxlength' => 255),
            'sql'               => "varchar(255) NOT NULL"
        ),

        'headcount' => array
        (
            'label'             =>$GLOBALS['TL_LANG']['fe_rescuemap_operations']['headcount'],
            'search'            =>true,
            'inputType'         =>'text',
            'eval'              => array('maxlength'=>64,'feEditable'=>false, 'feViewable'=>true, 'tl_class'=>'w50'),
            'sql'               => "varchar(64) NOT NULL default ''"
        ),

        'leader_phone' => array(
            'label'             => $GLOBALS['TL_LANG']['tl_rescuemap_operations']['leader_phone'],
            'exclude'           => true,
            'search'            => true,
            'inputType'         => 'text',
            'eval'              => array('maxlength'=>64, 'rgxp'=>'phone', 'decodeEntities'=>true, 'feEditable'=>true, 'feViewable'=>true, 'feGroup'=>'contact', 'tl_class'=>'w50'),
            'sql'               => "varchar(64) NOT NULL default ''"
        ),

        'in_rescuemap' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_rescuemap_operations']['in_rescuemap'],
            //'sorting'                 => true,
            //'flag'                    => 1,
            //'search'                  => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),

        'loc_caption' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_rescuemap_operations']['loc_caption'],
            'sorting'           => true,
            'flag'              => 1,
            'search'            => true,
            'inputType'         => 'text',
            'eval'              => array('mandatory' => true, 'tl_class' => 'w50', 'maxlength' => 255),
            'sql'               => "varchar(255) NOT NULL"
        ),

        'loc_geox' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_rescuemap_operations']['loc_geox'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>20, 'tl_class'=>'w50 wizard' ),
            'save_callback'           => array(array('tl_rescuemap_operations','setLocLon')),
            'wizard'                  => array(array('GeoPicker', 'getPickerLink')),
            'sql'                     => "varchar(20) NOT NULL default ''"
        ),

        'loc_geoy' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_rescuemap_operations']['loc_geoy'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>20, 'tl_class'=>'w50 wizard' ),
            'save_callback'           => array(array('tl_rescuemap_operations','setLocLat')),
            'wizard'                  => array(array('GeoPicker', 'getPickerLink')),
            'sql'                     => "varchar(20) NOT NULL default ''"
        ),

        'loc_label' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_rescuemap_operations']['loc_label'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('tl_class'=>'clr' ),
            'sql'                     => "varchar(100) NOT NULL default ''"
        ),

        'locstyle' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_rescuemap_operations']['locstyle'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options_callback'        => array('tl_rescuemap_stations','getLocStyles'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),

        'last_station_identifier' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_rescuemap_stations']['caption'],
            'sorting'           => true,
            'flag'              => 1,
            'search'            => true,
            'inputType'         => 'text',
            'eval'              => array('mandatory' => true, 'tl_class' => 'w50', 'maxlength' => 255),
            'sql'               => "varchar(255) NOT NULL default '0'"
        )

    )

);


/**
 * Class tl_c4g_firefighter_operations
 */
class tl_c4g_firefighter_operations extends Backend
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

    /**
     * Return all Location Styles as array
     * @param object
     * @return array
     */
    public function getLocStyles(DataContainer $dc)
    {
        $locStyles = $this->Database->prepare("SELECT id,name FROM tl_c4g_map_locstyles ORDER BY name")
            ->execute();
        $return[''] = '-';
        while ($locStyles->next())
        {
            $return[$locStyles->id] = $locStyles->name;
        }
        return $return;
    }

    /**
     * Validate Longitude
     */
    public function setLocLon($varValue, \DataContainer $dc)
    {
        if ($varValue != 0)
        {
            if (!Utils::validateLon($varValue))
            {
                throw new \Exception($GLOBALS['TL_LANG']['c4g_maps']['geox_invalid']);
            }
        }
        return $varValue;
    }

    /**
     * Validate Latitude
     */
    public function setLocLat($varValue, \DataContainer $dc)
    {
        if ($varValue != 0)
        {
            if (!Utils::validateLat($varValue))
            {
                throw new \Exception($GLOBALS['TL_LANG']['c4g_maps']['geoy_invalid']);
            }
        }
        return $varValue;
    }


}



////Callbacks
//$GLOBALS['TL_DCA']['tl_c4g_projects']['config']['onload_callback'][]   = array('tl_rescuemap_operations', 'updateDCA');


////Palettes
//$GLOBALS['TL_DCA']['tl_c4g_projects']['palettes']['default'] =
//    str_replace('{redirect_legend', '{custom_legend},caption, operation_type_id, description,leader_caption,headcount,leader_phone;{data_legend},call_sign,issi;'.
//                '{group_legend},group_id,project_id;{maps_legend},loc_geox,loc_geoy,loc_label,locstyle;'.
//                '{redirect_legend', $GLOBALS['TL_DCA']['tl_c4g_projects']['palettes']['default']);
