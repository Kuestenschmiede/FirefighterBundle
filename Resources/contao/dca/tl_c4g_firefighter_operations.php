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

use \con4gis\MapsBundle\Resources\contao\classes\GeoPicker;
use con4gis\MapsBundle\Resources\contao\classes\Utils;


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
            array('\con4gis\CoreBundle\Resources\contao\classes\C4GAutomator', 'purgeApiCache'),
            array('tl_c4g_firefighter_operations', 'adjustTime')
        ),
        'databaseAssisted'  => true,
        'sql'               => array
        (
            'keys' => array
            (
                'id' => 'primary',
            )
        )
    ),


    //List
    'list' => array
    (

        'sorting' => array
        (
            'mode'              => 2,
            'fields'            => array('startDate DESC', 'startTime DESC','operation_type','operation_category','caption'),
            'panelLayout'       => 'filter;sort,search,limit'
        ),

        'label' => array
        (
            'fields'            => array('startDate', 'startTime','operation_type:tl_c4g_firefighter_operation_types.operation_type','operation_category:tl_c4g_firefighter_operation_categories.operation_category','caption'),
            'showColumns'       => true
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
            'toggle' => array
            (
                'label'           => &$GLOBALS['TL_LANG']['tl_content']['toggle'],
                'icon'            => 'visible.gif',
                'attributes'      => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback' => array('tl_c4g_firefighter_operations', 'toggleIcon')
            ),
        )
    ),

    //Palettes
    'palettes' => array
    (
        '__selector__' => array('addTime'),
        'default'      =>  '{info_legend}, operation_type, operation_category, caption, description, operation_leader;{date_legend},addTime,startDate,endDate;'.
                           '{maps_legend},location,loc_geox,loc_geoy;{section_legend},numberStaff,vehicles,units;{media_legend},gallery,pressRelease1,pressRelease2,pressRelease3;{publish_legend},userId,published;'
    ),

    // Subpalettes
    'subpalettes' => array
    (
        'addTime'   => 'startTime,endTime',
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

        'caption' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['caption'],
            'default'           => '',
            'sorting'           => true,
            'flag'              => 1,
            'search'            => true,
            'inputType'         => 'text',
            'eval'              => array('mandatory' => true, 'maxlength' => 255),
            'sql'               => "varchar(255) NOT NULL"
        ),

        'description' => array
        (
            'label'             => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['description'],
            'default'           => '',
            'inputType'         => 'textarea',
            'sorting'           => true,
            'flag'              => 1,
            'search'            => true,
            'eval'              => array('mandatory' => true, 'tl_class'=>'long', 'rte'=>'tinyMCE', 'decodeEntities'=>true),
            'sql'               => "text NOT NULL"
        ),

        'operation_type' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['operation_type'],
            'inputType'         => 'select',
            'default'           => 0,
            'sorting'           => true,
            'flag'              => 1,
            'search'            => true,
            'foreignKey'        => 'tl_c4g_firefighter_operation_types.operation_type',
            'eval'              => array('mandatory' => true, 'tl_class' => 'long', 'chosen' => true, 'includeBlankOption' => false),
            'sql'               => "int(10) unsigned NOT NULL",
            'relation'          => array('type' => 'hasOne', 'load' => 'lazy'),
        ),

        'operation_category' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['operation_category'],
            'inputType'         => 'select',
            'default'           => 0,
            'foreignKey'        => 'tl_c4g_firefighter_operation_categories.operation_category',
            'eval'              => array('mandatory' => true, 'tl_class' => 'long', 'chosen' => true, 'includeBlankOption' => false),
            'sql'               => "int(10) unsigned NOT NULL",
            'relation'          => array('type' => 'hasOne', 'load' => 'lazy'),
        ),

        'operation_leader' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['operation_leader'],
            'default'           => '',
            'sorting'           => true,
            'flag'              => 1,
            'search'            => true,
            'inputType'         => 'text',
            'eval'              => array('mandatory' => false, 'maxlength' => 255),
            'sql'               => "varchar(255) NOT NULL"
        ),

        'addTime' => array
        (
            'label'             => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['addTime'],
            'exclude'           => true,
            'inputType'         => 'checkbox',
            'eval'              => array('submitOnChange'=>true, 'doNotCopy'=>true),
            'sql'               => "char(1) NOT NULL default ''"
        ),

        'startTime' => array
        (
            'label'            => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['startTime'],
            'default'          => time(),
            'exclude'          => true,
            'filter'           => true,
            'sorting'          => true,
            'flag'             => 8,
            'inputType'        => 'text',
            'eval'             => array('rgxp'=>'time', 'mandatory'=>true, 'doNotCopy'=>true, 'tl_class'=>'w50'),
            'load_callback'    => array
            (
                array('tl_c4g_firefighter_operations', 'loadTime')
            ),
            'sql'                     => "int(10) unsigned NULL"
        ),
        'endTime' => array
        (
            'label'            => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['endTime'],
            'default'          => time(),
            'exclude'          => true,
            'inputType'        => 'text',
            'eval'             => array('rgxp'=>'time', 'doNotCopy'=>true, 'tl_class'=>'w50'),
            'load_callback'    => array
            (
                array('tl_c4g_firefighter_operations', 'loadTime')
            ),
            'save_callback'    => array
            (
                array('tl_c4g_firefighter_operations', 'setEmptyEndTime')
            ),
            'sql'              => "int(10) unsigned NULL"
        ),
        'startDate' => array
        (
            'label'            => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['startDate'],
            'exclude'          => true,
            'filter'           => true,
            'sorting'          => true,
            'inputType'        => 'text',
            'flag'             => 6,
            'eval'             => array('rgxp'=>'date', 'mandatory'=>true, 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'              => "int(10) unsigned NULL"
        ),
        'endDate' => array
        (
            'label'            => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['endDate'],
            'default'          => null,
            'exclude'          => true,
            'inputType'        => 'text',
            'eval'             => array('rgxp'=>'date', 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'              => "int(10) unsigned NULL"
        ),
        'location' => array
        (
            'label'            => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['location'],
            'exclude'          => true,
            'search'           => true,
            'inputType'        => 'text',
            'eval'             => array('maxlength'=>255, 'tl_class'=>'long'),
            'sql'              => "varchar(255) NOT NULL default ''"
        ),
        'loc_geox' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['c4g_loc_lon'],
            'exclude'                 => true,
            'default'                 => '',
            'inputType'               => 'c4g_text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>20, 'tl_class'=>'w50 wizard' ),
            'save_callback'           => array(array('tl_c4g_firefighter_operations','setLocLon')),
            'wizard'                  => array(array('\con4gis\MapsBundle\Resources\contao\classes\GeoPicker', 'getPickerLink')),
            'sql'                     => "varchar(20) NOT NULL default ''"
        ),

        'loc_geoy' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['c4g_loc_lat'],
            'exclude'                 => true,
            'default'                 => '',
            'inputType'               => 'c4g_text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>20, 'tl_class'=>'w50 wizard' ),
            'save_callback'           => array(array('tl_c4g_firefighter_operations','setLocLat')),
            'wizard'                  => array(array('\con4gis\MapsBundle\Resources\contao\classes\GeoPicker', 'getPickerLink')),
            'sql'                     => "varchar(20) NOT NULL default ''"
        ),

        'vehicles' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['vehicles'],
            'exclude'                 => true,
            'inputType'               => 'select',
//            'options_callback'        => array('tl_c4g_map_profiles','getAllBaseLayers'),
            'foreignKey'              => 'tl_c4g_firefighter_vehicles.caption',
            'eval'                    => array('chosen'=>true, 'mandatory'=>false, 'multiple'=>true),
            'sql'                     => "blob NULL"
        ),

        'units' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['units'],
            'exclude'                 => true,
            'inputType'               => 'select',
//            'options_callback'        => array('tl_c4g_map_profiles','getAllBaseLayers'),
            'foreignKey'              => 'tl_c4g_firefighter_units.caption',
            'eval'                    => array('chosen'=>true, 'mandatory'=>false, 'multiple'=>true),
            'sql'                     => "blob NULL"
        ),

        'numberStaff' => array
        (
            'label'            => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['numberStaff'],
            'default'          => 0,
            'exclude'          => true,
            'inputType'        => 'text',
            'eval'             => array('rgxp' => 'digit', 'tl_class'=>'w50'),
            'sql'              => "int(5) unsigned NULL"
        ),

        'gallery' => array
        (
            'label'             => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['gallery'],
            'inputType'         => 'fileTree',
            'sorting'           => false,
            'search'            => false,
            'extensions'        => 'jpg, jpeg, png, tif',
            'exclude'           => true,
            'eval'              => array('filesOnly'=>true, 'files'=>true, 'fieldType'=>'checkbox', 'tl_class'=>'long clr', 'extensions'=>Config::get('validImageTypes'), 'multiple'=>true),
            'sql'               => "blob NULL"
        ),

        'pressRelease1' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['pressRelease1'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'url', 'multiple' => false,'decodeEntities'=>true, 'maxlength'=>255, 'fieldType'=>'radio', 'filesOnly'=>false, 'tl_class'=>'long wizard'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),

        'pressRelease2' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['pressRelease2'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'url', 'multiple' => false,'decodeEntities'=>true, 'maxlength'=>255, 'fieldType'=>'radio', 'filesOnly'=>false, 'tl_class'=>'long wizard'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'pressRelease3' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['pressRelease3'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'url', 'multiple' => false,'decodeEntities'=>true, 'maxlength'=>255, 'fieldType'=>'radio', 'filesOnly'=>false, 'tl_class'=>'long wizard'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),

        'published' => array(
            'label'             => &$GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['published'],
            'default'           => '',
            'inputType'         => 'checkbox',
            'eval'              => array('tl_class'=>'w50'),
            'sql'               => "char(1) NOT NULL default ''"
        ),

        'userId' => array
        (
            'label'             => $GLOBALS['TL_LANG']['tl_c4g_firefighter_operations']['userId'],
            'exclude'           => true,
            'sorting'           => true,
            'search'            => true,
            'default'           => $this->User->id,
            'flag'              => 1,
            'inputType'         => 'select',
            'foreignKey'        => 'tl_user.name',
            'eval'              => array('mandatory' => true, 'tl_class' => 'w50'),
            'sql'               => "int(10) unsigned NOT NULL",
            'relation'          => array('type' => 'hasOne', 'load' => 'lazy')
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

    /**
     * Set the timestamp to 1970-01-01 (see #26)
     *
     * @param integer $value
     *
     * @return integer
     */
    public function loadTime($value)
    {
        return strtotime('1970-01-01 ' . date('H:i:s', $value));
    }


    /**
     * Automatically set the end time if not set
     *
     * @param mixed         $varValue
     * @param DataContainer $dc
     *
     * @return string
     */
    public function setEmptyEndTime($varValue, DataContainer $dc)
    {
        if ($varValue === null)
        {
            $varValue = $dc->activeRecord->startTime;
        }

        return $varValue;
    }

    /**
     * Adjust start end end time of the event based on date, span, startTime and endTime
     *
     * @param DataContainer $dc
     */
    public function adjustTime(DataContainer $dc)
    {
        // Return if there is no active record (override all)
        if (!$dc->activeRecord)
        {
            return;
        }

        $arrSet['startTime'] = $dc->activeRecord->startDate;
        $arrSet['endTime'] = $dc->activeRecord->startDate;

        // Set end date
        if ($dc->activeRecord->endDate)
        {
            if ($dc->activeRecord->endDate > $dc->activeRecord->startDate)
            {
                $arrSet['endDate'] = $dc->activeRecord->endDate;
                $arrSet['endTime'] = $dc->activeRecord->endDate;
            }
            else
            {
                $arrSet['endDate'] = $dc->activeRecord->startDate;
                $arrSet['endTime'] = $dc->activeRecord->startDate;
            }
        }

        // Add time
        if ($dc->activeRecord->addTime)
        {
            $arrSet['startTime'] = strtotime(date('Y-m-d', $arrSet['startTime']) . ' ' . date('H:i:s', $dc->activeRecord->startTime));
            $arrSet['endTime'] = strtotime(date('Y-m-d', $arrSet['endTime']) . ' ' . date('H:i:s', $dc->activeRecord->endTime));
        }

        // Adjust end time of "all day" events
        elseif (($dc->activeRecord->endDate && $arrSet['endDate'] == $arrSet['endTime']) || $arrSet['startTime'] == $arrSet['endTime'])
        {
            $arrSet['endTime'] = (strtotime('+ 1 day', $arrSet['endTime']) - 1);
        }

        $this->Database->prepare("UPDATE tl_c4g_firefighter_operations %s WHERE id=?")->set($arrSet)->execute($dc->id);
    }

    /**
     * Return the "toggle visibility" button
     *
     * @param array  $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     *
     * @return string
     */
    public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
    {
        if (strlen(Input::get('tid')))
        {
            $this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1), (@func_get_arg(12) ?: null));
            $this->redirect($this->getReferer());
        }

        $href .= '&amp;id='.Input::get('id').'&amp;tid='.$row['id'].'&amp;state='.$row['published'];

        if (!$row['published'])
        {
            $icon = 'invisible.gif';
        }

        return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ';
    }


    /**
     * Toggle the visibility of an element
     *
     * @param integer       $intId
     * @param boolean       $blnVisible
     * @param DataContainer $dc
     */
    public function toggleVisibility($intId, $blnVisible, DataContainer $dc=null)
    {
        // Check permissions to edit
        Input::setGet('id', $intId);
        Input::setGet('act', 'toggle');

        $objVersions = new Versions('tl_c4g_firefighter_operations', $intId);
        $objVersions->initialize();


        // Update the database
        $this->Database->prepare("UPDATE tl_c4g_firefighter_operations SET tstamp=". time() .", published='" . ($blnVisible ? '1' : '') . "' WHERE id=?")
            ->execute($intId);

        $objVersions->create();
        $this->log('A new version of record "tl_c4g_firefighter_operations.id='.$intId.'" has been created'.$this->getParentEntries('tl_c4g_firefighter_operations', $intId), __METHOD__, TL_GENERAL);
    }

}