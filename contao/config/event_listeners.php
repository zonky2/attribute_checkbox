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

use MetaModels\MetaModelsEvents;
use MetaModels\Events\MetaModelsBootEvent;
use MetaModels\Events\Attribute\Checkbox\Listener;
use MetaModels\Events\Attribute\Checkbox\PublishedFilterSettingTypeRenderer;
use MetaModels\Attribute\Events\CreateAttributeFactoryEvent;
use MetaModels\Attribute\Checkbox\AttributeTypeFactory;
use MetaModels\Filter\Setting\Events\CreateFilterSettingFactoryEvent;
use MetaModels\Filter\Setting\Published\FilterSettingTypeFactory;

return array
(
    MetaModelsEvents::SUBSYSTEM_BOOT_BACKEND => function (MetaModelsBootEvent $event) {
        new Listener($event->getServiceContainer());
        new PublishedFilterSettingTypeRenderer($event->getServiceContainer());
    },
    MetaModelsEvents::ATTRIBUTE_FACTORY_CREATE => function (CreateAttributeFactoryEvent $event) {
        $factory = $event->getFactory();
        $factory->addTypeFactory(new AttributeTypeFactory());
    },
    MetaModelsEvents::FILTER_SETTING_FACTORY_CREATE => function (CreateFilterSettingFactoryEvent $event) {
        $factory = $event->getFactory();
        $factory->addTypeFactory(new FilterSettingTypeFactory());
    }
);
