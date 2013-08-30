<?php

/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 * @package     MetaModels
 * @subpackage  AttributeCheckbox
 * @author      Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author      Andreas Isaak <info@andreas-isaak.de>
 * @copyright   The MetaModels team.
 * @license     LGPL.
 * @filesource
 */

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'MetaModels\Attribute\Checkbox\Checkbox'       => 'system/modules/metamodelsattribute_checkbox/MetaModels/Attribute/Checkbox/Checkbox.php',
	'MetaModels\Helper\Checkbox\Checkbox'          => 'system/modules/metamodelsattribute_checkbox/MetaModels/Helper/Checkbox/Checkbox.php',
	'MetaModels\Filter\Setting\Published\Checkbox' => 'system/modules/metamodelsattribute_checkbox/MetaModels/Filter/Setting/Published/Checkbox.php',

	'MetaModelAttributeCheckbox'              => 'system/modules/metamodelsattribute_checkbox/deprecated/MetaModelAttributeCheckbox.php',
	'MetaModelAttributeCheckboxBackendHelper' => 'system/modules/metamodelsattribute_checkbox/deprecated/MetaModelAttributeCheckboxBackendHelper.php',
	'MetaModelFilterSettingPublishedCheckbox' => 'system/modules/metamodelsattribute_checkbox/deprecated/MetaModelFilterSettingPublishedCheckbox.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mm_attr_checkbox'              => 'system/modules/metamodelsattribute_checkbox/templates',
));
