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

$GLOBALS['TL_EVENTS'][\MetaModels\MetaModelsEvents::SUBSYSTEM_BOOT_BACKEND][] = function (
    MetaModels\Events\MetaModelsBootEvent $event
) {
    new MetaModels\Events\Attribute\Checkbox\Listener($event->getServiceContainer());
    new MetaModels\Events\Attribute\Checkbox\PublishedFilterSettingTypeRenderer($event->getServiceContainer());
};

$GLOBALS['TL_EVENTS'][\MetaModels\MetaModelsEvents::ATTRIBUTE_FACTORY_CREATE][] = function (
    \MetaModels\Attribute\Events\CreateAttributeFactoryEvent $event
) {
    $factory = $event->getFactory();
    $factory->addTypeFactory(new MetaModels\Attribute\Checkbox\AttributeTypeFactory());
};

$GLOBALS['TL_EVENTS'][\MetaModels\MetaModelsEvents::FILTER_SETTING_FACTORY_CREATE][] = function (
    \MetaModels\Filter\Setting\Events\CreateFilterSettingFactoryEvent $event
) {
    $factory = $event->getFactory();
    $factory->addTypeFactory(new MetaModels\Filter\Setting\Published\FilterSettingTypeFactory());
};
