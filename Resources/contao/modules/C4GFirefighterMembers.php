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

namespace con4gis\FirefighterBundle\Resources\contao\modules;

use con4gis\FirefighterBundle\Classes\C4GFirefighterBrickTypes;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GDateField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GEmailField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GKeyField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GNumberField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GTelField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GTextField;
use con4gis\ProjectsBundle\Classes\Framework\C4GBrickModuleParent;
use con4gis\ProjectsBundle\Classes\Views\C4GBrickViewType;

class C4GFirefighterMembers extends C4GBrickModuleParent
{
    protected $tableName    = 'tl_members';
    protected $modelClass   = 'Contao\MemberModel';
    protected $findBy       = array('disable', array(0, ""));
    protected $languageFile = 'fe_c4g_firefighter_members';
    protected $brickKey     = C4GFirefighterBrickTypes::BRICK_C4G_FIREFIGHTER_MEMBERS;
    protected $brickCaption = 'Mitglied'; //ToDO Language
    protected $brickCaptionPlural = 'Mitglieder'; //ToDO Language
    protected $viewType     = C4GBrickViewType::PUBLICVIEW;
    protected $withBackup   = false;

//    protected $strTemplate = 'mod_c4g_brick_simple';

    public function initBrickModule($id)
    {
        parent::initBrickModule($id); // TODO: Change the autogenerated stub
        $this->listParams->getExportButtons()->setOrientation("landscape");
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

        $lastnameField = new C4GTextField();
        $lastnameField->setFieldName('lastname');
        $lastnameField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_members']['lastname']);
        $lastnameField->setEditable(true);
        $lastnameField->setFormField(true);
        $lastnameField->setTableColumn(true);
        $lastnameField->setMandatory(true);
        $lastnameField->setSortColumn(true);
        $fieldList[] = $lastnameField;

        $firstnameField = new C4GTextField();
        $firstnameField->setFieldName('firstname');
        $firstnameField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_members']['firstname']);
        $firstnameField->setEditable(true);
        $firstnameField->setFormField(true);
        $firstnameField->setTableColumn(true);
        $firstnameField->setSortColumn(false);
        $fieldList[] = $firstnameField;

        $emailField = new C4GEmailField();
        $emailField->setFieldName('email');
        $emailField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_members']['email']);
        $emailField->setEditable(true);
        $emailField->setFormField(true);
        $emailField->setTableColumn(true);
        $emailField->setMandatory(true);
        $emailField->setSortColumn(false);
        $fieldList[] = $emailField;

        $phoneField = new C4GTelField();
        $phoneField->setFieldName('phone');
        $phoneField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_members']['phone']);
        $phoneField->setEditable(true);
        $phoneField->setFormField(true);
        $phoneField->setTableColumn(true);
        $phoneField->setSortColumn(false);
        $fieldList[] = $phoneField;

        $mobileField = new C4GTelField();
        $mobileField->setFieldName('mobile');
        $mobileField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_members']['mobile']);
        $mobileField->setEditable(true);
        $mobileField->setFormField(true);
        $mobileField->setTableColumn(true);
        $mobileField->setSortColumn(false);
        $fieldList[] = $mobileField;

        $faxField = new C4GTelField();
        $faxField->setFieldName('fax');
        $faxField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_members']['fax']);
        $faxField->setEditable(true);
        $faxField->setFormField(true);
        $faxField->setTableColumn(true);
        $faxField->setSortColumn(false);
        $fieldList[] = $faxField;

        $birthdateField = new C4GDateField();
        $birthdateField->setFieldName('dateOfBirth');
        $birthdateField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_members']['birthdate']);
        $birthdateField->setSortColumn(false);
        $birthdateField->setFormField(true);
        $birthdateField->setTableColumn(true);
        $birthdateField->setMandatory(false);
        $fieldList[] = $birthdateField;

        $this->fieldList = $fieldList;

    }

}
