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
 * Contao Open Source CMS
 *
 * @version   php 5
 * @package   con4gis_mapcil
 * @author    Matthias Eilers
 * @license   GNU/LGPL http://opensource.org/licenses/lgpl-3.0.html
 * @copyright Küstenschmiede GmbH Software & Design 2011 - 2019
 * @link      https://www.kuestenschmiede.de
 */
namespace con4gis\FirefighterBundle\Classes;

use con4gis\FirefighterBundle\Resources\contao\models\C4gFirefighterOperationCategoriesModel;
use con4gis\FirefighterBundle\Resources\contao\models\C4gFirefighterOperationsModel;
use con4gis\FirefighterBundle\Resources\contao\models\C4gFirefighterOperationTypesModel;
use con4gis\ProjectsBundle\Classes\Actions\C4GBrickActionType;
use con4gis\ProjectsBundle\Classes\Maps\C4GBrickMapFrontendParent;
use Contao\Database;
use con4gis\MapsBundle\Classes\Events\LoadLayersEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class C4GFirefighterFrontend
 * @package con4gis\FirefighterBundle\Classes
 */
class C4GFirefighterFrontend extends C4GBrickMapFrontendParent
{
    private $arrAllowedLocationTypes = [
        C4GFirefighterBrickTypes::BRICK_C4G_FIREFIGHTER_MAP,
    ];

    public function onAddLocations(
        LoadLayersEvent $event,
        $eventName,
        EventDispatcherInterface $eventDispatcher
    ) {
        $child = $event->getLayerData();
        if (in_array($child['type'], $this->arrAllowedLocationTypes)) {
            $arrData = C4GFirefighterFrontend::addMapStructureElement(
                $child['pid'],
                $child['id'],
                $child['id'],
                'none',
                $child['name'],
                $child['name'],
                true,
                $child['hide']);

            // set hide when in tab if set in backend
            if ($child['hide_when_in_tab']) {
                $arrData['hide_when_in_tab'] = $child['hide_when_in_tab'];
            }

            switch ($child['type']) {
                case C4GFirefighterBrickTypes::BRICK_C4G_FIREFIGHTER_MAP:
                    $arrChildData = C4GFirefighterFrontend::getPoiData($child);

                    break;
                default:
                    break;
            }

            if (sizeof($arrChildData) == 0 && $child['raw']->tDontShowIfEmpty) {
                $returnData = $arrData;
            } else {
                $returnData = C4GFirefighterFrontend::addMapStructureChilds($arrData, $arrChildData, true);
            }

            $returnData['content'] = [];
            $event->setLayerData($returnData);
        }
    }

    /**
     * @param $child
     * @return array
     */
    protected function getPoiData($child)
    {
        $arrLayers = [];

        $operations = C4gFirefighterOperationsModel::findBy('published', '1');
        foreach ($operations as $operation) {
            $typeId = $operation->operation_type;
            $categoryId = $operation->operation_category;

            if (!$categoryId || ($categoryId <= 0)) {
                $categoryId = 0;
            }

            $arrLayers[$typeId][$categoryId][$operation->id] = $operation;
        }

        $layerElements = [];
        foreach ($arrLayers as $typeId => $categories) {
            $type = C4gFirefighterOperationTypesModel::findByPk($typeId);
            $typeLayerElement = C4GFirefighterFrontend::addMapStructureElementWithIdCalc(
                $typeId,
                $child['id'],
                -1,
                10,
                'none',
                $type->operation_type,
                $type->operation_type,
                true,
                $child['hide']);

            foreach ($categories as $categoryId => $operations) {
                if ($categoryId) {
                    $category = C4gFirefighterOperationCategoriesModel::findByPk($categoryId);

                    $categoryLayerElement = C4GFirefighterFrontend::addMapStructureElementWithIdCalc(
                        $categoryId,
                        $typeId,
                        $child['id'],
                        20,
                        'none',
                        $category->operation_category,
                        $category->operation_category,
                        true,
                        $child['hide']);
                } else {
                    $category = false;
                }
                foreach ($operations as $operationID => $operation) {
                    $operationLayerElement = C4GFirefighterFrontend::getOperationLayerData($child, $operation, $type, $category);
                    if (!$category) {
                        $typeLayerElement = C4GFirefighterFrontend::addMapStructureChild($typeLayerElement, $operationLayerElement);
                    } else {
                        $categoryLayerElement = C4GFirefighterFrontend::addMapStructureChild($categoryLayerElement, $operationLayerElement);
                    }
                }

                if ($category) {
                    $typeLayerElement = C4GFirefighterFrontend::addMapStructureChild($typeLayerElement, $categoryLayerElement);
                }
            }
            $layerElements[] = $typeLayerElement;
        }

        return $layerElements;
    }

    /**
     * @param $child
     * @param $element
     * @param $type
     * @param $category
     * @return array|null
     */
    protected function getOperationLayerData($child, $element, $type, $category)
    {
        if ($element !== null) {
            if (!$element->loc_geox || !$element->loc_geoy) {
                return null;
            }

            $caption = $element->caption;

            $typeName = $type->operation_type;
            $locStyle = $type->operation_locstyles;

            $categoryName = '';
            if ($category && $element->operation_category) {
                $categoryName = $category->operation_category;
                if ($category->operation_locstyles) {
                    $locStyle = $category->operation_locstyles;
                }
            }

            $language = $GLOBALS['TL_LANGUAGE'];
            \System::loadLanguageFile('fe_c4g_firefighter_operations', $language);

            $description = C4GFirefighterFrontend::addPopupDescriptionElement($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['infoHeadline'], $element->description);

            $subtitle = $typeName;
            if ($categoryName) {
                $subtitle = $typeName . ' (' . $categoryName . ')';
            }

            $settings = Database::getInstance()->execute('SELECT * FROM tl_c4g_settings LIMIT 1')->fetchAllAssoc();
            $pageId = 0;
            if ($settings) {
                $settings = $settings[0];
                $pageId = $settings['redirect_to_operations'];
            }

            $popupInfo =
                C4GFirefighterFrontend::addPopupKeyElement($element->id) .
                C4GFirefighterFrontend::addPopupHeader($caption, $subtitle) .
                '<ul>' .
                C4GFirefighterFrontend::addPopupListElement($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['operationDate'], date('d.m.Y', $element->startDate)) .
                C4GFirefighterFrontend::addPopupListElement($GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['locationDescription'], $element->location) .
                '</ul>' .
                $description .
                C4GFirefighterFrontend::addRedirectButton($pageId, C4GBrickActionType::IDENTIFIER_DIALOG . ':' . $element->id, $GLOBALS['TL_LANG']['fe_c4g_firefighter_operations']['readMore'], false, 0, 0, C4GFirefighterBrickTypes::BRICK_C4G_FIREFIGHTER_OPERATIONS);

            $layerContent = $this->addMapStructureContent(
                $locStyle,
                $element->loc_geox,
                $element->loc_geoy,
                $popupInfo,
                '',
                $caption
            );

            $structureElement = $this->addMapStructureElementWithIdCalc(
                $element->id,
                $category->id,
                $type->id,
                30,
                'none',
                $caption,
                $caption,
                true,
                $child['hide'],
                $layerContent,
                false);

            return $structureElement;
        }
    }
}
