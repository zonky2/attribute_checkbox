<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 * @package	   MetaModels
 * @subpackage AttributeText
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @copyright  CyberSpectrum, MEN AT WORK
 * @license    private
 * @filesource
 */

/**
 * This is the MetaModelAttribute class for handling checkbox fields.
 * 
 * @package	   MetaModels
 * @subpackage AttributeCheckbox
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 */
class MetaModelAttributeCheckbox extends MetaModelAttributeSimple
{
	public function isPublishedField()
	{
		return $this->get('check_publish') == 1;
	}

	public function getSQLDataType()
	{
		return 'char(1) NOT NULL default \'\'';
	}

	public function getAttributeSettingNames()
	{
		return array_merge(parent::getAttributeSettingNames(), array(
		'check_publish',
		));
	}

	public function getFieldDefinition()
	{
		$arrFieldDef = parent::getFieldDefinition();
		$arrFieldDef['inputType'] = 'checkbox';
		return $arrFieldDef;
	}

	/**
	 * {@inheritdoc}
	 */
	public function parseFilterUrl($arrUrlParams)
	{
		$objFilterRule = NULL;
		if (key_exists($this->getColName(), $arrUrlParams))
		{
			$objFilterRule = new MetaModelFilterRuleSimpleQuery('SELECT id FROM ' . $this->getMetaModel()->getTableName() . ' WHERE ' . $this->getColName() . '=?', $arrUrlParams[$this->getColName()]);
		}
		if ($this->isPublishedField())
		{
			$objFilterRule = new MetaModelFilterRuleSimpleQuery('SELECT id FROM ' . $this->getMetaModel()->getTableName() . ' WHERE ' . $this->getColName() . '=?', 1);
		}
		return $objFilterRule;
	}
}

?>