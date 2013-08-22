<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  HTML
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

/**
 * Data set class for JHtmlFieldRange.
 *
 * @package     Joomla.UnitTest
 * @subpackage  HTML
 * @since       3.1
 */
class JHtmlFieldRangeTest_DataSet
{
	static public $getInputTest = array(
		'NoValue' => array(
			array(
				'id' => 'myTestId',
				'name' => 'myTestName',
			),
			'<input type="range" name="myTestName" id="myTestId" value="0" />',
		),

		'Value' => array(
			array(
				'id' => 'myTestId',
				'name' => 'myTestName',
				'value' => '2',
			),
			'<input type="range" name="myTestName" id="myTestId" value="2" />',
		),

		'Class' => array(
			array(
				'id' => 'myTestId',
				'name' => 'myTestName',
				'class' => 'foo bar',
			),
			'<input type="range" name="myTestName" id="myTestId" value="0" class="foo bar" />',
		),

		'Size' => array(
			array(
				'id' => 'myTestId',
				'name' => 'myTestName',
				'size' => 60,
			),
			'<input type="range" name="myTestName" id="myTestId" value="0" size="60" />',
		),

		'Disabled' => array(
			array(
				'id' => 'myTestId',
				'name' => 'myTestName',
				'disabled' => true,
			),
			'<input type="range" name="myTestName" id="myTestId" value="0" disabled />',
		),

		'Readonly' => array(
			array(
				'id' => 'myTestId',
				'name' => 'myTestName',
				'readonly' => true,
			),
			'<input type="range" name="myTestName" id="myTestId" value="0" readonly />',
		),

		'Hint' => array(
			array(
				'id' => 'myTestId',
				'name' => 'myTestName',
				'hint' => 'Type any text.',
			),
			'<input type="range" name="myTestName" id="myTestId" value="0" placeholder="Type any text." />',
		),

		'Autocomplete' => array(
			array(
				'id' => 'myTestId',
				'name' => 'myTestName',
				'autocomplete' => false,
			),
			'<input type="range" name="myTestName" id="myTestId" value="0" autocomplete="off" />',
		),

		'Autofocus' => array(
			array(
				'id' => 'myTestId',
				'name' => 'myTestName',
				'autofocus' => true,
			),
			'<input type="range" name="myTestName" id="myTestId" value="0" autofocus />',
		),

		'Onchange' => array(
			array(
				'id' => 'myTestId',
				'name' => 'myTestName',
				'onchange' => 'foobar();',
			),
			'<input type="range" name="myTestName" id="myTestId" value="0" onchange="foobar();" />',
		),

		'Maxlength' => array(
			array(
				'id' => 'myTestId',
				'name' => 'myTestName',
				'maxLength' => 250,
			),
			'<input type="range" name="myTestName" id="myTestId" value="0" maxlength="250" />',
		),

		'Required' => array(
			array(
				'id' => 'myTestId',
				'name' => 'myTestName',
				'required' => true,
			),
			'<input type="range" name="myTestName" id="myTestId" value="0" required aria-required="true" />',
		),

	);
}
