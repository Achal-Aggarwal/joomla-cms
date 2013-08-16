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
class JFormFieldNumberTest extends TestCase
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

		require_once JPATH_PLATFORM . '/joomla/form/fields/number.php';

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
	 * Tests maxLength attribute setup by JFormFieldText::setup method
	 *
	 * @covers JFormField::setup
	 * @covers JFormField::__get
	 *
	 * @return void
	 */
	public function testSetup()
	{
		$field = new JFormFieldNumber;
		$element = simplexml_load_string(
			'<field name="myName" type="text" max="60" min="1" step="2" />');

		$this->assertThat(
			$field->setup($element, ''),
			$this->isTrue(),
			'Line:' . __LINE__ . ' The setup method should return true if successful.'
		);

		$this->assertThat(
			$field->max,
			$this->equalTo(60),
			'Line:' . __LINE__ . ' The property should be computed from the XML.'
		);

		$this->assertThat(
			$field->min,
			$this->equalTo(1),
			'Line:' . __LINE__ . ' The property should be computed from the XML.'
		);

		$this->assertThat(
			$field->step,
			$this->equalTo(2),
			'Line:' . __LINE__ . ' The property should be computed from the XML.'
		);
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
		$formField = new JFormFieldNumber;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');

		$this->assertEquals(
			'<input type="number" name="myTestName" id="myTestId" value="0" />',
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
		$formField = new JFormFieldNumber;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'value', '2');

		$this->assertEquals(
			'<input type="number" name="myTestName" id="myTestId" value="2" />',
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
		$formField = new JFormFieldNumber;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'class', 'foo bar');

		$this->assertEquals(
			'<input type="number" name="myTestName" id="myTestId" value="0" class="foo bar" />',
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
		$formField = new JFormFieldNumber;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'size', 60);

		$this->assertEquals(
			'<input type="number" name="myTestName" id="myTestId" value="0" size="60" />',
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
		$formField = new JFormFieldNumber;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'disabled', true);
		TestReflection::setValue($formField, 'readonly', true);

		$this->assertEquals(
			'<input type="number" name="myTestName" id="myTestId" value="0" disabled readonly />',
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
		$formField = new JFormFieldNumber;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'hint', 'Type any number.');

		$this->assertEquals(
			'<input type="number" name="myTestName" id="myTestId" value="0" placeholder="Type any number." />',
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
		$formField = new JFormFieldNumber;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'autocomplete', false);

		$this->assertEquals(
			'<input type="number" name="myTestName" id="myTestId" value="0" autocomplete="off" />',
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
		$formField = new JFormFieldNumber;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'autofocus', true);

		$this->assertEquals(
			'<input type="number" name="myTestName" id="myTestId" value="0" autofocus />',
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
		$formField = new JFormFieldNumber;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'onchange', 'foobar();');

		$this->assertEquals(
			'<input type="number" name="myTestName" id="myTestId" value="0" onchange="foobar();" />',
			TestReflection::invoke($formField, 'getInput'),
			'Line:' . __LINE__ . ' The field with no value and no checked attribute did not produce the right html'
		);
	}

	/**
	 * Test the getInput method when field has max set from xml
	 * and no checked attribute.
	 *
	 * @return  void
	 *
	 * @since   12.2
	 */
	public function testGetInputMax()
	{
		$formField = new JFormFieldNumber;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'max', 250);

		$this->assertEquals(
			'<input type="number" name="myTestName" id="myTestId" value="0" max="250" />',
			TestReflection::invoke($formField, 'getInput'),
			'Line:' . __LINE__ . ' The field with no value and no checked attribute did not produce the right html'
		);

		// Floating max
		TestReflection::setValue($formField, 'max', 250.245);

		$this->assertEquals(
			'<input type="number" name="myTestName" id="myTestId" value="0" max="250.245" />',
			TestReflection::invoke($formField, 'getInput'),
			'Line:' . __LINE__ . ' The field with no value and no checked attribute did not produce the right html'
		);
	}

	/**
	 * Test the getInput method when field has min set from xml
	 * and no checked attribute.
	 *
	 * @return  void
	 *
	 * @since   12.2
	 */
	public function testGetInputMin()
	{
		$formField = new JFormFieldNumber;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'min', 50.625);

		$this->assertEquals(
			'<input type="number" name="myTestName" id="myTestId" value="50.625" min="50.625" />',
			TestReflection::invoke($formField, 'getInput'),
			'Line:' . __LINE__ . ' The field with no value and no checked attribute did not produce the right html'
		);
	}

	/**
	 * Test the getInput method when field has step set from xml
	 * and no checked attribute.
	 *
	 * @return  void
	 *
	 * @since   12.2
	 */
	public function testGetInputStep()
	{
		$formField = new JFormFieldNumber;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'step', 5.9);

		$this->assertEquals(
			'<input type="number" name="myTestName" id="myTestId" value="0" step="5.9" />',
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
		$formField = new JFormFieldNumber;

		TestReflection::setValue($formField, 'id', 'myTestId');
		TestReflection::setValue($formField, 'name', 'myTestName');
		TestReflection::setValue($formField, 'required', true);

		$this->assertEquals(
			'<input type="number" name="myTestName" id="myTestId" value="0" required aria-required="true" />',
			TestReflection::invoke($formField, 'getInput'),
			'Line:' . __LINE__ . ' The field with no value and no checked attribute did not produce the right html'
		);
	}
}
