<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

/**
 * Test class for JFormFieldUrl.
 *
 * @package     Joomla.UnitTest
 * @subpackage  Form
 * @since       12.1
 */
class JFormFieldUrlTest extends TestCase
{
	/**
	 * Backup of the SERVER superglobal
	 *
	 * @var    array
	 * @since  3.1
	 */
	protected $backupServer;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	protected function setUp()
	{
		parent::setUp();

		require_once JPATH_PLATFORM . '/joomla/form/fields/url.php';

		$this->saveFactoryState();

		JFactory::$application = $this->getMockApplication();

		$this->backupServer = $_SERVER;

		$_SERVER['HTTP_HOST'] = 'example.com';
		$_SERVER['SCRIPT_NAME'] = '';
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	protected function tearDown()
	{
		$_SERVER = $this->backupServer;

		$this->restoreFactoryState();

		parent::tearDown();
	}

	/**
	 * Test the getInput method where there is no value from the element
	 * and no checked attribute.
	 *
	 * @return  void
	 *
	 * @since   12.2
	 */
	public function testGetInputNoValue()
	{
		$formField = new JFormFieldUrl;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');

		$this->assertEquals(
			'<input type="url" name="myTestName" id="myTestId" value="" />',
			TestReflection::invoke($formField, 'getInput'),
			'Line:' . __LINE__ . ' The field with no value and no checked attribute did not produce the right html'
		);
	}

	/**
	 * Test the getInput method where there is value from the element
	 * and no checked attribute.
	 *
	 * @return  void
	 *
	 * @since   12.2
	 */
	public function testGetInputValue()
	{
		$formField = new JFormFieldUrl;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'value', 'http://foobar.com');

		$this->assertEquals(
			'<input type="url" name="myTestName" id="myTestId" value="http://foobar.com" />',
			TestReflection::invoke($formField, 'getInput'),
			'Line:' . __LINE__ . ' The field with no value and no checked attribute did not produce the right html'
		);
	}

	/**
	 * Test the getInput method when field has class set from xml
	 * and no checked attribute.
	 *
	 * @return  void
	 *
	 * @since   12.2
	 */
	public function testGetInputClass()
	{
		$formField = new JFormFieldUrl;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'class', 'foo bar');

		$this->assertEquals(
			'<input type="url" name="myTestName" class="foo bar" id="myTestId" value="" />',
			TestReflection::invoke($formField, 'getInput'),
			'Line:' . __LINE__ . ' The field with no value and no checked attribute did not produce the right html'
		);
	}

	/**
	 * Test the getInput method when field has size set from xml
	 * and no checked attribute.
	 *
	 * @return  void
	 *
	 * @since   12.2
	 */
	public function testGetInputSize()
	{
		$formField = new JFormFieldUrl;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'size', 60);

		$this->assertEquals(
			'<input type="url" name="myTestName" id="myTestId" value="" size="60" />',
			TestReflection::invoke($formField, 'getInput'),
			'Line:' . __LINE__ . ' The field with no value and no checked attribute did not produce the right html'
		);
	}

	/**
	 * Test the getInput method when field has disabled and readonly set from xml
	 * and no checked attribute.
	 *
	 * @return  void
	 *
	 * @since   12.2
	 */
	public function testGetInputDisabledReadonly()
	{
		$formField = new JFormFieldUrl;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'disabled', true);
		TestReflection::setValue($formField, 'readonly', true);

		$this->assertEquals(
			'<input type="url" name="myTestName" id="myTestId" value="" disabled readonly />',
			TestReflection::invoke($formField, 'getInput'),
			'Line:' . __LINE__ . ' The field with no value and no checked attribute did not produce the right html'
		);
	}

	/**
	 * Test the getInput method when field has hint (placeholder) set from xml
	 * and no checked attribute.
	 *
	 * @return  void
	 *
	 * @since   12.2
	 */
	public function testGetInputHint()
	{
		$formField = new JFormFieldUrl;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'hint', 'Type any url.');

		$this->assertEquals(
			'<input type="url" name="myTestName" id="myTestId" value="" placeholder="Type any url." />',
			TestReflection::invoke($formField, 'getInput'),
			'Line:' . __LINE__ . ' The field with no value and no checked attribute did not produce the right html'
		);
	}

	/**
	 * Test the getInput method when field has autocomplete set to off from xml
	 * and no checked attribute.
	 *
	 * @return  void
	 *
	 * @since   12.2
	 */
	public function testGetInputAutocomplete()
	{
		$formField = new JFormFieldUrl;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'autocomplete', false);

		$this->assertEquals(
			'<input type="url" name="myTestName" id="myTestId" value="" autocomplete="off" />',
			TestReflection::invoke($formField, 'getInput'),
			'Line:' . __LINE__ . ' The field with no value and no checked attribute did not produce the right html'
		);
	}

	/**
	 * Test the getInput method when field has autofocus set to true from xml
	 * and no checked attribute.
	 *
	 * @return  void
	 *
	 * @since   12.2
	 */
	public function testGetInputAutofocus()
	{
		$formField = new JFormFieldUrl;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'autofocus', true);

		$this->assertEquals(
			'<input type="url" name="myTestName" id="myTestId" value="" autofocus />',
			TestReflection::invoke($formField, 'getInput'),
			'Line:' . __LINE__ . ' The field with no value and no checked attribute did not produce the right html'
		);
	}

	/**
	 * Test the getInput method when field has spellcheck set to false from xml
	 * and no checked attribute.
	 *
	 * @return  void
	 *
	 * @since   12.2
	 */
	public function testGetInputSpellcheck()
	{
		$formField = new JFormFieldUrl;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'spellcheck', false);

		$this->assertEquals(
			'<input type="url" name="myTestName" id="myTestId" value="" spellcheck="false" />',
			TestReflection::invoke($formField, 'getInput'),
			'Line:' . __LINE__ . ' The field with no value and no checked attribute did not produce the right html'
		);
	}

	/**
	 * Test the getInput method when field has onchange set to js function from xml
	 * and no checked attribute.
	 *
	 * @return  void
	 *
	 * @since   12.2
	 */
	public function testGetInputOnchange()
	{
		$formField = new JFormFieldUrl;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'onchange', 'foobar();');

		$this->assertEquals(
			'<input type="url" name="myTestName" id="myTestId" value="" onchange="foobar();" />',
			TestReflection::invoke($formField, 'getInput'),
			'Line:' . __LINE__ . ' The field with no value and no checked attribute did not produce the right html'
		);
	}

	/**
	 * Test the getInput method when field has maxlength set from xml
	 * and no checked attribute.
	 *
	 * @return  void
	 *
	 * @since   12.2
	 */
	public function testGetInputMaxlength()
	{
		$formField = new JFormFieldUrl;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'maxLength', 250);

		$this->assertEquals(
			'<input type="url" name="myTestName" id="myTestId" value="" maxlength="250" />',
			TestReflection::invoke($formField, 'getInput'),
			'Line:' . __LINE__ . ' The field with no value and no checked attribute did not produce the right html'
		);
	}

	/**
	 * Test the getInput method when field has required set from xml
	 * and no checked attribute.
	 *
	 * @return  void
	 *
	 * @since   12.2
	 */
	public function testGetInputRequired()
	{
		$formField = new JFormFieldUrl;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'required', true);

		$this->assertEquals(
			'<input type="url" name="myTestName" id="myTestId" value="" required aria-required="true" />',
			TestReflection::invoke($formField, 'getInput'),
			'Line:' . __LINE__ . ' The field with no value and no checked attribute did not produce the right html'
		);
	}
}
