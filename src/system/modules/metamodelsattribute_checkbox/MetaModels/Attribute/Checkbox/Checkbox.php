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
 * @copyright   The MetaModels team.
 * @license     LGPL.
 * @filesource
 */

namespace MetaModels\Attribute\Checkbox;

use MetaModels\Attribute\BaseSimple;

/**
 * This is the MetaModelAttribute class for handling checkbox fields.
 *
 * @package	   MetaModels
 * @subpackage AttributeCheckbox
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 */
class Checkbox extends BaseSimple
{

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
			'check_publish',
			'filterable',
			'searchable',
			'sortable',
			'submitOnChange'
		));
	}

	/**
	 * {@inheritdoc}
	 */
	public function getFieldDefinition($arrOverrides = array())
	{
		$arrFieldDef = parent::getFieldDefinition($arrOverrides);
		$arrFieldDef['inputType'] = 'checkbox';
		return $arrFieldDef;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getItemDCA($arrOverrides = array())
	{
		$arrDCA = parent::getItemDCA($arrOverrides);
		if ($this->isPublishedField())
		{
			$arrDCA = array_replace_recursive(
				$arrDCA,
				array
				(
					'config' => array
					(
						'onload_callback' => array(array('MetaModels\Helper\Checkbox\Checkbox', 'checkToggle')),
					),
					'list' => array
					(
						'operations' => array
						(
							'toggle' => array
							(
								'label'               => &$GLOBALS['TL_LANG']['MSC']['metamodelattribute_checkbox']['toggle'],
								'icon'                => 'visible.gif',
								'href'                => sprintf(
									'&amp;action=publishtoggle&amp;metamodel=%s&amp;attribute=%s',
									$this->getMetaModel()->getTableName(),
									$this->getColName()
								),
								'attributes'          => 'onclick="Backend.getScrollOffset(); return AjaxRequest.togglePublishCheckbox(this, %s);"',
								'button_callback'     => array('MetaModels\Helper\Checkbox\Checkbox', 'toggleIcon')
							)
						)
					)
				)
			);
			$GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/metamodelsattribute_checkbox/html/publish.js';
		}
		return $arrDCA;
	}
}
