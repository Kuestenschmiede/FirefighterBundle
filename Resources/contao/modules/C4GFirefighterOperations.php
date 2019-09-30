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

namespace con4gis\FirefighterBundle\Resources\contao\modules;

use con4gis\FirefighterBundle\Classes\C4GFirefighterBrickTypes;
use con4gis\FirefighterBundle\Resources\contao\models\C4gFirefighterVehiclesModel;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GCheckboxField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GCKEditorField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GDateField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GEmailField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GGalleryField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GGeopickerField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GHeadlineField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GKeyField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GMultiCheckboxField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GNumberField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GSelectField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GTelField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GTextField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GTimeField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GUrlField;
use con4gis\ProjectsBundle\Classes\Framework\C4GBrickModuleParent;
use con4gis\ProjectsBundle\Classes\Filter\C4GDateTimeListFilter;
use con4gis\ProjectsBundle\Classes\Lists\C4GBrickRenderMode;
use con4gis\ProjectsBundle\Classes\Views\C4GBrickViewType;

class C4GFirefighterOperations extends C4GBrickModuleParent
{
    protected $tableName    = 'tl_c4g_firefighter_operations';
    protected $modelClass   = 'con4gis\FirefighterBundle\Resources\contao\models\C4gFirefighterOperationsModel';
    protected $findBy       = array('published', '1');
    protected $languageFile = 'fe_c4g_firefighter_operations';
    protected $brickKey     = C4GFirefighterBrickTypes::BRICK_C4G_FIREFIGHTER_OPERATIONS;
    protected $viewType     = C4GBrickViewType::PUBLICVIEW;
    protected $withBackup   = false;
    protected $captionField = 'caption';
    protected $brickStyle   = 'bundles/con4gisfirefighter/frontend.css';
    protected $loadClearBrowserUrlResources = false;
    protected $jQueryUseMaps = true;

    public function initBrickModule($id)
    {
        parent::initBrickModule($id); 

        $this->setBrickCaptions(
            $GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['brickCaption'],
            $GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['brickCaptionPlural']);

        $this->dialogParams->setTabContent(true);
        $this->dialogParams->setWithNextPrevButtons(false);
        $this->listParams->setWithExportButtons(false);

        $filter = new C4GDateTimeListFilter($this->brickKey);
        $filter->setFieldName('startDate')
            ->setDefaultFilter(
                mktime(0, 0, 0,1, 1),
                mktime(23, 59, 59, date("n"), date("d"))
            )
            ->setButtonText($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['button_period']);
        $this->listParams->setFilterObject($filter);
    }

    /**
     * @return array|void
     */
    public function addFields()
    {
        $fieldList = array();

        $idField = new C4GKeyField();
        $idField->setFieldName('id');
        $idField->setEditable(false);
        $idField->setFormField(false);
        $fieldList[] = $idField;

        $infoHeadlineField = new C4GHeadlineField();
        $infoHeadlineField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['infoHeadline']);
        $fieldList[] = $infoHeadlineField;

        $captionField = new C4GTextField();
        $captionField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['caption']);
        $captionField->setFieldName('caption');
        $captionField->setTableColumn(true);
        $fieldList[] = $captionField;

        $startDateField = new C4GDateField();
        $startDateField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['startDate']);
        $startDateField->setFieldName('startDate');
        $startDateField->setTableColumn(true);
        $startDateField->setSortColumn(true);
        $startDateField->setSortType('de_date');
        $startDateField->setSortSequence('desc');
        $startDateField->setShowIfEmpty(false);
        $fieldList[] = $startDateField;

        $startTimeField = new C4GTimeField();
        $startTimeField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['startTime']);
        $startTimeField->setFieldName('startTime');
        $startTimeField->setTableColumn(true);
        $startTimeField->setShowIfEmpty(false);
        $fieldList[] = $startTimeField;

        $endDateField = new C4GDateField();
        $endDateField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['endDate']);
        $endDateField->setFieldName('endDate');
        $endDateField->setSortType('de_date');
        $endDateField->setSortSequence('desc');
        $endDateField->setShowIfEmpty(false);
        $fieldList[] = $endDateField;

        $endTimeField = new C4GTimeField();
        $endTimeField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['endTime']);
        $endTimeField->setFieldName('endTime');
        $fieldList[] = $endTimeField;

        $operationTypeField = new C4GSelectField();
        $operationTypeField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['operationType']);
        $operationTypeField->setFieldName('operation_type');
        $operationTypeField->setTableColumn(true);
        $operationTypeField->setOptionsByModel('\con4gis\FirefighterBundle\Resources\contao\models\C4gFirefighterOperationTypesModel','operation_type');
        $operationTypeField->setShowIfEmpty(false);
        $fieldList[] = $operationTypeField;

        $operationCategoryField = new C4GSelectField();
        $operationCategoryField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['operationCategory']);
        $operationCategoryField->setFieldName('operation_category');
        $operationCategoryField->setTableColumn(false);
        $operationCategoryField->setOptionsByModel('\con4gis\FirefighterBundle\Resources\contao\models\C4gFirefighterOperationCategoriesModel', 'operation_category');
        $operationCategoryField->setShowIfEmpty(false);
        $fieldList[] = $operationCategoryField;

        $leaderField = new C4GTextField();
        $leaderField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['operation_leader']);
        $leaderField->setFieldName('operation_leader');
        $leaderField->setTableColumn(false);
        $fieldList[] = $leaderField;

        $descriptionField = new C4GTextField();
        $descriptionField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['description']);
        $descriptionField->setFieldName('description');
        $descriptionField->setSimpleTextWithoutEditing(true);
        $fieldList[] = $descriptionField;

        $mapsHeadlineField = new C4GHeadlineField();
        $mapsHeadlineField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['mapsHeadline']);
        $fieldList[] = $mapsHeadlineField;

        $locationField = new C4GTextField();
        $locationField->setFieldName('location');
        $locationField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['location']);
        $locationField->setColumnWidth(20);
        $locationField->setSortColumn(false);
        $locationField->setTableColumn(true);
        $locationField->setMandatory(false);
        $fieldList[] = $locationField;

        $geopickerField = new C4GGeopickerField();
        $geopickerField->setFieldName('geopicker');
        $geopickerField->setTitle("");
        $geopickerField->setSortColumn(false);
        $geopickerField->setTableColumn(false);
        $geopickerField->setMandatory(false);
        $geopickerField->setEditable(false);
        $geopickerField->setWithoutAddressRow(true);
        $fieldList[] = $geopickerField;

        $sectionHeadlineField = new C4GHeadlineField();
        $sectionHeadlineField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['sectionHeadline']);
        $fieldList[] = $sectionHeadlineField;

        $vehiclesField = new C4GMultiCheckboxField();
        $vehiclesField->setFieldName('vehicles');
        $vehiclesField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['vehicles']);
        $vehiclesField->setSortColumn(false);
        $vehiclesField->setTableColumn(false);
        $vehiclesField->setColumnWidth(20);
        $vehiclesField->setSize(10);
        $vehiclesField->setMandatory(false);
        $vehiclesField->setOptionsByModel('\con4gis\FirefighterBundle\Resources\contao\models\C4gFirefighterVehiclesModel');
        $vehiclesField->setModernStyle(true);
        $vehiclesField->setShowIfEmpty(false);
        $fieldList[] = $vehiclesField;

        $unitsField = new C4GMultiCheckboxField();
        $unitsField->setFieldName('units');
        $unitsField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['units']);
        $unitsField->setSortColumn(false);
        $unitsField->setTableColumn(false);
        $unitsField->setColumnWidth(20);
        $unitsField->setSize(10);
        $unitsField->setMandatory(false);
        $unitsField->setOptionsByModel('\con4gis\FirefighterBundle\Resources\contao\models\C4gFirefighterUnitsModel');
        $unitsField->setModernStyle(true);
        $unitsField->setShowIfEmpty(false);
        $fieldList[] = $unitsField;

        $mediaHeadlineField = new C4GHeadlineField();
        $mediaHeadlineField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['mediaHeadline']);
        $fieldList[] = $mediaHeadlineField;

        $galleryField = new C4GGalleryField();
        $galleryField->setFieldName('gallery');
        $galleryField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['gallery']);
        $fieldList[] = $galleryField;

        $pressRelease1Field = new C4GUrlField();
        $pressRelease1Field->setFieldName('pressRelease1');
        $pressRelease1Field->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['pressRelease1']);
        $pressRelease1Field->setShowIfEmpty(false);
        $fieldList[] = $pressRelease1Field;

        $pressRelease2Field = new C4GUrlField();
        $pressRelease2Field->setFieldName('pressRelease2');
        $pressRelease2Field->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['pressRelease2']);
        $pressRelease2Field->setShowIfEmpty(false);
        $fieldList[] = $pressRelease2Field;

        $pressRelease3Field = new C4GUrlField();
        $pressRelease3Field->setFieldName('pressRelease3');
        $pressRelease3Field->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['pressRelease3']);
        $pressRelease3Field->setShowIfEmpty(false);
        $fieldList[] = $pressRelease3Field;

        $this->fieldList = $fieldList;
    }

}
