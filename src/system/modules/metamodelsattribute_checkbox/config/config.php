<?php
/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 *
 * @package     MetaModels
 * @subpackage  AttributeCheckbox
 * @author      Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @copyright   The MetaModels team.
 * @license     LGPL.
 * @filesource
 */

$GLOBALS['METAMODELS']['attributes']['checkbox']['class'] = 'MetaModels\Attribute\Checkbox\Checkbox';
$GLOBALS['METAMODELS']['attributes']['checkbox']['image'] =
    'system/modules/metamodelsattribute_checkbox/html/checkbox.png';

$GLOBALS['METAMODELS']['filters']['checkbox_published']['class']         =
    'MetaModels\Filter\Setting\Published\Checkbox';
$GLOBALS['METAMODELS']['filters']['checkbox_published']['image']         =
    'system/modules/metamodels/html/visible.png';
$GLOBALS['METAMODELS']['filters']['checkbox_published']['info_callback'] = array(
    'MetaModels\DcGeneral\Events\Table\FilterSetting\DrawSetting',
    'modelToLabelWithAttributeAndUrlParam'
);
$GLOBALS['METAMODELS']['filters']['checkbox_published']['attr_filter'][] = 'checkbox';

$GLOBALS['TL_EVENT_SUBSCRIBERS'][] = 'MetaModels\Events\Attribute\Checkbox\Listener';
