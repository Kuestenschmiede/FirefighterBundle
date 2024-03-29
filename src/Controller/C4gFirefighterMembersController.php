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
 *  con4gis for Contao Open Source CMS
 *
 * @version   php 7
 * @package   con4gis-Firefighter (FirefighterBundle)
 * @author    con4gis contributors
 * @license   GNU/LGPL http://opensource.org/licenses/lgpl-3.0.html
 * @copyright Küstenschmiede GmbH Software & Design 2011 - 2019
 * @link      https://www.kuestenschmiede.de
 */

namespace con4gis\FirefighterBundle\Controller;

use con4gis\FirefighterBundle\Classes\C4GFirefighterBrickTypes;
use con4gis\ProjectsBundle\Classes\Fieldlist\C4GBrickFieldSourceType;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GDateField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GEmailField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GImageField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GKeyField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GNumberField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GTelField;
use con4gis\ProjectsBundle\Classes\Fieldtypes\C4GTextField;
use con4gis\ProjectsBundle\Classes\Files\C4GBrickFileType;
use con4gis\ProjectsBundle\Classes\Framework\C4GBaseController;
use con4gis\ProjectsBundle\Classes\Framework\C4GBrickModuleParent;
use con4gis\ProjectsBundle\Classes\Views\C4GBrickViewType;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\ModuleModel;
use Symfony\Component\HttpFoundation\Session\Session;


class C4gFirefighterMembersController extends C4GBaseController
{
    public const TYPE = 'C4gFirefighterMembers';
    protected $tableName    = 'tl_members';
    protected $modelClass   = 'Contao\MemberModel';
    protected $findBy       = array('disable', array(0, ""));
    protected $languageFile = 'fe_c4g_firefighter_members';
    protected $brickKey     = C4GFirefighterBrickTypes::BRICK_C4G_FIREFIGHTER_MEMBERS;
    protected $viewType     = C4GBrickViewType::PUBLICVIEW;
    protected $withBackup   = false;

    /**
     * @param string $rootDir
     * @param Session $session
     * @param ContaoFramework $framework
     */
    public function __construct(string $rootDir, Session $session, ContaoFramework $framework, ModuleModel $model = null)
    {
        parent::__construct($rootDir, $session, $framework, $model);
    }

    public function initBrickModule($id)
    {
        parent::initBrickModule($id);

        $this->setBrickCaptions(
            $GLOBALS['TL_LANG']['fe_c4g_firefighter_members']['brickCaption'],
            $GLOBALS['TL_LANG']['fe_c4g_firefighter_members']['brickCaptionPlural']);

        $this->listParams->getExportButtons()->setOrientation("portrait");
    }

    /**
     * @return array|void
     */
    public function addFields() : array
    {
        $fieldList = array();

        $idField = new C4GKeyField();
        $idField->setFieldName('id');
        $idField->setEditable(false);
        $idField->setFormField(false);
        $fieldList[] = $idField;

        $imgField = new C4GImageField();
        $imgField->setFieldName('memberImage');
        $imgField->setTitle($GLOBALS['TL_LANG']['fe_c4g_firefighter_members']['avatar']);
        $imgField->setFileTypes(C4GBrickFileType::IMAGES_PNG_JPG);
        $imgField->setFormField(true);
        $imgField->setTableColumn(false);
        $imgField->setDeserialize(true);
        $imgField->setShowIfEmpty(false);
        $fieldList[] = $imgField;

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

        return $fieldList;

    }

}
