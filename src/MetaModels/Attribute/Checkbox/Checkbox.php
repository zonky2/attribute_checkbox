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
 * @author     Sven Baumann <baumann.sv@gmail.com>
 * @copyright  2012-2016 The MetaModels team.
 * @license    https://github.com/MetaModels/attribute_checkbox/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

namespace MetaModels\Attribute\Checkbox;

use Contao\Database;
use MetaModels\Attribute\BaseSimple;

/**
 * This is the MetaModelAttribute class for handling checkbox fields.
 */
class Checkbox extends BaseSimple
{
    /**
     * The database.
     *
     * @var Database
     */
    protected $database;

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
            'check_inverse',
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
        $values = parent::getFilterOptions($idList, $usedOnly, $arrCount);
        // If not used only or id list, we need to override the handling now.
        if (!($idList || $usedOnly)) {
            $values = ['', '1'];
            if (null !== $arrCount) {
                $arrCount[''] = 0;
                $arrCount[1]  = 0;
                $colName      = $this->getColName();
                $rows         = $this->getDatabase()->execute(
                    sprintf(
                        'SELECT %1$s, COUNT(%1$s) as mm_count FROM %2$s GROUP BY %1$s ORDER BY %1$s',
                        $colName,
                        $this->getMetaModel()->getTableName()
                    )
                );
                while ($rows->next()) {
                    $arrCount[$rows->$colName] = $rows->mm_count;
                }
            }
        }

        // Finally use the correct language strings.
        $mapped = [];
        foreach ($values as $value) {
            $mapped[(string) $value] =
                $GLOBALS['TL_LANG']['MSC']['metamodelattribute_checkbox']['value_' . ($value ?: '0')];
        }

        return $mapped;
    }

    /**
     * Retrieve the database.
     *
     * @return Database
     */
    protected function getDatabase()
    {
        if (null !== $this->database) {
            return $this->database;
        }

        return $this->database = $this->getMetaModel()->getServiceContainer()->getDatabase();
    }
}
