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


/**
 * Table tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['C4GFirefighterMembers'] = '{title_legend},name,headline,type;{style_legend},c4g_uitheme_css_select,c4g_appearance_themeroller_css';
$GLOBALS['TL_DCA']['tl_module']['palettes']['C4GFirefighterOperations'] = '{title_legend},name,headline,type;{style_legend},c4g_uitheme_css_select,c4g_appearance_themeroller_css;{settings_legend},contentid';
$GLOBALS['TL_DCA']['tl_module']['palettes']['C4GFirefighterOperationList'] = '{title_legend},name,headline,type;{settings_legend},c4g_redirect_to,c4g_row_count;';

$GLOBALS['TL_DCA']['tl_module']['fields']['c4g_uitheme_css_select'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['fields']['c4g_uitheme_css_select'],
    'exclude'                 => true,
    'default'                 => 'base',
    'inputType'               => 'radio',
    'options'                 => array('base','black-tie','blitzer','cupertino','dark-hive','dot-luv','eggplant','excite-bike','flick','hot-sneaks','humanity','le-frog','mint-choc','overcast','pepper-grinder','redmond','smoothness','south-street','start','sunny','swanky-purse','trontastic','ui-darkness','ui-lightness','vader'),
    'eval'                    => array('tl_class'=>'long', 'mandatory'=>true, 'submitOnChange' => true),
    'reference'               => &$GLOBALS['TL_LANG']['tl_module']['c4g_references'],
    'sql'                     => "char(100) NOT NULL default 'base'"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['c4g_appearance_themeroller_css'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['fields']['appearance_themeroller_css'],
    'exclude'                 => true,
    'inputType'               => 'fileTree',
    'eval'                    => array('tl_class'=>'long wizard', 'fieldType'=>'radio', 'files'=>true, 'extensions'=>'css'),
    'sql'                     => "binary(16) NULL"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['contentid'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['fields']['contentid'],
    'exclude'                 => true,
    'options_callback'        => array('con4gis\ProjectsBundle\Classes\Common\C4GBrickCommon','getContentId'),
    'inputType'               => 'select',
    'eval'                    => array('tl_class'=>'clr long wizard', 'includeBlankOption' => true),
    'sql'                     => "varchar(128) NULL"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['c4g_redirect_to'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['fields']['c4g_redirect_to'],
    'exclude'                 => true,
    'inputType'               => 'pageTree',
    'foreignKey'              => 'tl_page.title',
    'eval'                    => array('mandatory'=>true, 'fieldType'=>'radio'),
    'sql'                     => "int(10) unsigned NOT NULL default '0'",
    'relation'                => array('type'=>'hasOne', 'load'=>'eager')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['c4g_row_count'] = array(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['fields']['c4g_row_count'],
    'sorting'                 => true,
    'default'                 => 0,
    'flag'                    => 1,
    'search'                  => true,
    'inputType'               => 'text',
    'eval'                    => array('tl_class'=>'w50', 'mandatory'=>false, 'rgxp'=>'digit'),
    'sql'                     => "int(10) unsigned NOT NULL default = 0"
);
