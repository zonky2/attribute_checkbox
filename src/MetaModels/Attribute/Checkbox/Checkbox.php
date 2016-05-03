<?php

/**
 * This file is part of MetaModels/attribute_checkbox.
 *
 * (c) 2012-2016 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    MetaModels
 * @subpackage AttributeCheckbox
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author     Andreas Isaak <info@andreas-isaak.de>
 * @author     Christopher Boelter <c.boelter@cogizz.de>
 * @author     David Maack <maack@men-at-work.de>
 * @author     Stefan Heimes <stefan_heimes@hotmail.com>
 * @copyright  2012-2016 The MetaModels team.
 * @license    https://github.com/MetaModels/attribute_checkbox/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

namespace MetaModels\Attribute\Checkbox;

use MetaModels\Attribute\BaseSimple;

/**
 * This is the MetaModelAttribute class for handling checkbox fields.
 */
class Checkbox extends BaseSimple
{
    /**
     * Determine if the attribute is for publish usage.
     *
     * @return bool
     */
    public function isPublishedField()
    {
        return $this->get('check_publish') == 1;
    }

    /**
     * {@inheritdoc}
     */
    public function getSQLDataType()
    {
        return 'char(1) NOT NULL default \'\'';
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributeSettingNames()
    {
        return array_merge(parent::getAttributeSettingNames(), array(
            'mandatory',
            'check_publish',
            'check_listview',
            'check_listviewicon',
            'check_listviewicondisabled',
            'filterable',
            'submitOnChange'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getFieldDefinition($arrOverrides = array())
    {
        $arrFieldDef              = parent::getFieldDefinition($arrOverrides);
        $arrFieldDef['inputType'] = 'checkbox';
        return $arrFieldDef;
    }

    /**
     * {@inheritdoc}
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     * @SuppressWarnings(PHPMD.CamelCaseVariableName)
     */
    public function getFilterOptions($idList, $usedOnly, &$arrCount = null)
    {
        if (!($idList || $usedOnly)) {
            return array(
                '0' => $GLOBALS['TL_LANG']['MSC']['metamodelattribute_checkbox']['value_0'],
                '1' => $GLOBALS['TL_LANG']['MSC']['metamodelattribute_checkbox']['value_1']
            );
        }

        return parent::getFilterOptions($idList, $usedOnly, $arrCount);
    }
}
