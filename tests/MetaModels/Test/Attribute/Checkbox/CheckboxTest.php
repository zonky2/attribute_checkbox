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
 * @copyright  2012-2016 The MetaModels team.
 * @license    https://github.com/MetaModels/attribute_checkbox/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

namespace MetaModels\Test\Attribute\Checkbox;

use MetaModels\Attribute\Checkbox\Checkbox;
use MetaModels\IMetaModel;

/**
 * Unit tests to test class Checkbox.
 */
class CheckboxTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Mock a MetaModel.
     *
     * @param string $language         The language.
     * @param string $fallbackLanguage The fallback language.
     *
     * @return IMetaModel
     */
    protected function mockMetaModel($language, $fallbackLanguage)
    {
        $metaModel = $this->getMock(
            'MetaModels\MetaModel',
            array(),
            array(array())
        );

        $metaModel
            ->expects($this->any())
            ->method('getTableName')
            ->will($this->returnValue('mm_unittest'));

        $metaModel
            ->expects($this->any())
            ->method('getActiveLanguage')
            ->will($this->returnValue($language));

        $metaModel
            ->expects($this->any())
            ->method('getFallbackLanguage')
            ->will($this->returnValue($fallbackLanguage));

        return $metaModel;
    }

    /**
     * Test that the attribute can be instantiated.
     *
     * @return void
     */
    public function testInstantiation()
    {
        $text = new Checkbox($this->mockMetaModel('en', 'en'));
        $this->assertInstanceOf('MetaModels\Attribute\Checkbox\Checkbox', $text);
    }

    /**
     * Generate test data for testSerialize().
     *
     * @return array
     */
    public function serializeProvider()
    {
        return [
            'false is empty'        => ['', false],
            '0 is empty'            => ['', 0],
            'empty string is empty' => ['', ''],
            '\'0\' is empty'        => ['', '0'],
            'true is \'1\''         => ['1', true],
            '5 is \'1\''            => ['1', 5],
            '\'string\' is \'1\''   => ['1', 'string'],
        ];
    }

    /**
     * Test that the attribute can be instantiated.
     *
     * @param string $expected The expected value.
     * @param mixed  $value    The input value.
     *
     * @return void
     *
     * @dataProvider serializeProvider
     */
    public function testSerialize($expected, $value)
    {
        $checkbox = new Checkbox($this->mockMetaModel('en', 'en'));
        $this->assertEquals($expected, $checkbox->serializeData($value));
        $this->assertSame($expected, $checkbox->serializeData($value));
    }

    /**
     * Generate test data for testSerialize().
     *
     * @return array
     */
    public function unserializeProvider()
    {
        return [
            'false is empty'        => ['', false],
            '0 is empty'            => ['', 0],
            'empty string is empty' => ['', ''],
            '\'0\' is empty'        => ['', '0'],
            'true is \'1\''         => ['1', true],
            '5 is \'1\''            => ['1', 5],
            '\'string\' is \'1\''   => ['1', 'string'],
        ];
    }

    /**
     * Test that the attribute can be instantiated.
     *
     * @param string $expected The expected value.
     * @param mixed  $value    The input value.
     *
     * @return void
     *
     * @dataProvider unserializeProvider
     */
    public function testUnserialize($expected, $value)
    {
        $checkbox = new Checkbox($this->mockMetaModel('en', 'en'));
        $this->assertEquals($expected, $checkbox->unserializeData($value));
        $this->assertSame($expected, $checkbox->unserializeData($value));
    }
}
