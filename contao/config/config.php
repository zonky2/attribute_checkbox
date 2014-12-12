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
 * @author      Andreas Isaak <info@andreas-isaak.de>
 * @author      David Maack <maack@men-at-work.de>
 * @copyright   The MetaModels team.
 * @license     LGPL.
 * @filesource
 */

$GLOBALS['METAMODELS']['filters']['checkbox_published']['class']         =
    'MetaModels\Filter\Setting\Published\Checkbox';
$GLOBALS['METAMODELS']['filters']['checkbox_published']['image']         =
    'system/modules/metamodels/html/visible.png';
$GLOBALS['METAMODELS']['filters']['checkbox_published']['info_callback'] = array(
    'MetaModels\DcGeneral\Events\Table\FilterSetting\DrawSetting',
    'modelToLabelWithAttributeAndUrlParam'
);
$GLOBALS['METAMODELS']['filters']['checkbox_published']['attr_filter'][] = 'checkbox';

$GLOBALS['TL_EVENTS'][\MetaModels\MetaModelsEvents::SUBSYSTEM_BOOT_BACKEND][] = function (
    MetaModels\Events\MetaModelsBootEvent $event
) {
    new MetaModels\Events\Attribute\Checkbox\Listener($event->getServiceContainer());
};

$GLOBALS['TL_EVENTS'][\MetaModels\MetaModelsEvents::ATTRIBUTE_FACTORY_CREATE][] = function (
    \MetaModels\Attribute\Events\CreateAttributeFactoryEvent $event
) {
    $factory = $event->getFactory();
    $factory->addTypeFactory(new MetaModels\Attribute\Checkbox\AttributeTypeFactory());
};
