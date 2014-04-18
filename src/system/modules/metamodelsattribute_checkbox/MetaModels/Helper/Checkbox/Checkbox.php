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

namespace MetaModels\Helper\Checkbox;

use DcGeneral\DataContainerInterface;
use MetaModels\Factory;
use MetaModels\IItem;

/**
 * This class is used from checkbox attributes for button callbacks etc.
 *
 * @package    MetaModels
 * @subpackage AttributeCheckbox
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 */
class Checkbox extends \Backend
{
	/**
	 * Just to make it public.
	 */
	// @codingStandardsIgnoreStart - This is not an useless override, as we change the visibility.
	public function __construct()
	{
		parent::__construct();
	}
	// @codingStandardsIgnoreEnd

	/**
	 * Render a row for the list view in the backend.
	 *
	 * @param array  $arrRow        The current data row.
	 *
	 * @param string $strHref       The href to add.
	 *
	 * @param string $strLabel      The label text.
	 *
	 * @param string $strTitle      The title text.
	 *
	 * @param string $strIcon       The path to the image.
	 *
	 * @param string $strAttributes The html attributes to use.
	 *
	 * @return string
	 */
	public function toggleIcon($arrRow, $strHref, $strLabel, $strTitle, $strIcon, $strAttributes)
	{
		if (preg_match('#attribute=([^&$]*)#', $strHref, $arrMatch))
		{
			if ($arrRow[$arrMatch[1]])
			{
				$strNewState = '0';
			} else {
				$strNewState = '1';
				// Makes invisible out of visible.
				$strIcon = 'in' . $strIcon;
			}

			$strImg = $this->generateImage($strIcon, $strLabel);

			return "\n\n" . sprintf('<a href="%s" title="%s"%s>%s</a> ',
				$this->addToUrl($strHref . sprintf('&amp;tid=%s&amp;state=%s', $arrRow['id'], $strNewState)),
				specialchars($strTitle),
				$strAttributes,
				$strImg?$strImg:$strLabel
			) . "\n\n";
		}

		return '';
	}

	/**
	 * Check if a toggling has been performed and save the new value to the database if so.
	 *
	 * NOTE: This method exits the script.
	 *
	 * @param DataContainerInterface $objDC The data container.
	 *
	 * @return void
	 */
	public function checkToggle($objDC)
	{
		if (\Input::getInstance()->get('action') != 'publishtoggle')
		{
			return;
		}

		$environment  = $objDC->getEnvironment();
		$input        = $environment->getInputProvider();
		$strState     = ($input->getParameter('state') == '1') ? '1' : '';
		$strAttribute = $input->getParameter('attribute');
		// TODO: check if the attribute is allowed to be edited by the current backend user.
		if (($objMetaModel = Factory::byTableName($input->getParameter('metamodel')))
			&& ($objAttribute = $objMetaModel->getAttribute($strAttribute))
		)
		{
			if (!($intId = intval(\Input::getInstance()->get('tid'))))
			{
				return;
			}

			$arrIds = array($intId => $strState);
			// Determine variants.
			if ($objMetaModel->hasVariants() && !$objAttribute->get('isvariant'))
			{
				if (!($objItem = $objMetaModel->findById($intId)))
				{
					return;
				}

				if ($objItem->isVariantBase())
				{
					$objChildren = $objItem->getVariants(null);
					foreach ($objChildren as $objItem)
					{
						/** @var IItem $objItem */
						$arrIds[intval($objItem->get('id'))] = $strState;
					}
				}
			}

			// TODO: replace with $objAttribute->setData(); call when simple attributes also have a setData and getData option.
			// Update database.
			\Database::getInstance()->prepare(sprintf(
				'UPDATE %s SET %s=? WHERE id IN (%s)',
				$objMetaModel->getTableName(),
				$objAttribute->getColName(),
				implode(',', array_keys($arrIds))
			))
				->execute($strState);
			exit;
		}
	}
}
