<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

JFormHelper::loadFieldClass('number');

/**
 * Form Field class for the Joomla Platform.
 * Supports a one line text field.
 *
 * @package     Joomla.Platform
 * @subpackage  Form
 * @link        http://www.w3.org/TR/html-markup/input.text.html#input.text
 * @since       11.1
 */
class JFormFieldRange extends JFormFieldNumber
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 *
	 * @since  11.1
	 */
	protected $type = 'Range';

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   11.1
	 */
	protected function getInput()
	{
		// Initialize some field attributes.
		$max = !empty($this->max) ? ' max="' . $this->max . '"' : '';
		$min = !empty($this->min) ? ' min="' . $this->min . '"' : '';
		$step = !empty($this->step) ? ' step="' . $this->step . '"' : '';
		$class = !empty($this->class) ? ' class="' . $this->class . '"' : '';
		$readonly = $this->readonly ? ' readonly' : '';
		$disabled = $this->disabled ? ' disabled' : '';

		$autofocus = $this->autofocus ? ' autofocus' : '';

		$value = (float) $this->value;
		$value = empty($value) ? $this->min : $value;

		// Initialize JavaScript field attributes.
		$onchange = !empty($this->onchange) ? ' onchange="' . $this->onchange . '"' : '';

		// Including fallback code for HTML5 non supported browsers.
		JHtml::_('jquery.framework');
		JHtml::_('script', 'system/html5fallback.js', false, true);

		return '<input type="range" name="' . $this->name . '" id="' . $this->id . '"' . ' value="'
			. htmlspecialchars($value, ENT_COMPAT, 'UTF-8') . '"' . $class . $disabled . $readonly
			. $onchange . $max . $step . $min . $autofocus . ' />';
	}
}
