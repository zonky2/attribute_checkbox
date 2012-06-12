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
 * This is the MetaModelFilterRule class for handling checkbox fields.
 * 
 * @package	   MetaModels
 * @subpackage AttributeCheckbox
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 */
class MetaModelFilterRuleCheckBox extends MetaModelFilterRule
{
	public function __construct(MetaModelAttributeCheckbox $objAttribute, $strValue)
	{
		parent::__construct($objAttribute);
		$this->value = $strValue;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getMatchingIds()
	{
		$objDB = Database::getInstance();
		$objMatches = $objDB->prepare('SELECT id FROM ' . $this->objAttribute->getMetaModel()->getTableName() . ' WHERE ' . $this->objAttribute->getColName() . '=?')
		->execute($this->value);
		return $objMatches->fetchEach('id');
	}
}

?>