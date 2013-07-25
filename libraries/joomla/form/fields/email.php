<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Form Field class for the Joomla Platform.
 * Provides and input field for e-mail addresses
 *
 * @package     Joomla.Platform
 * @subpackage  Form
 * @link        http://www.w3.org/TR/html-markup/input.email.html#input.email
 * @see         JFormRuleEmail
 * @since       11.1
 */
class JFormFieldEMail extends JFormFieldText
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $type = 'Email';

	/**
	 * Method to get the field input markup for e-mail addresses.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   11.1
	 */
	protected function getInput()
	{
		// Translate placeholder text
		$hint = $this->translateHint ? JText::_($this->hint) : $this->hint;

		// Initialize some field attributes.
		$size = !empty($this->size) ? ' size="' . $this->size . '"' : '';
		$maxLength = !empty($this->maxlength) ? ' maxlength="' . $this->maxlength . '"' : '';
		$class = !empty($this->class) ? ' class="' . $this->class . '"' : '';
		$readonly = $this->readonly ? ' readonly' : '';
		$disabled = $this->disabled ? ' disabled' : '';
		$required = $this->required ? ' required aria-required="true"' : '';
		$hint = $hint ? ' placeholder="' . $hint . '"' : '';
		$autocomplete = !$this->autocomplete ? ' autocomplete="off"' : ' autocomplete="' . $this->autocomplete . '"';
		$autocomplete = $autocomplete == ' autocomplete="on"' ? '' : $autocomplete;
		$autofocus = $this->autofocus ? ' autofocus' : '';
		$multiple = $this->multiple ? ' multiple' : '';

		// Initialize JavaScript field attributes.
		$onchange = $this->onchange ? ' onchange="' . $this->onchange . '"' : '';

		// Including fallback code for HTML5 non supported browsers.
		JHtml::_('jquery.framework');
		JHtml::_('script', 'system/html5fallback.js', false, true);

		return '<input type="email" name="' . $this->name . '" class="validate-email' . $class . '" id="' . $this->id . '" value="'
			. JStringPunycode::emailToUTF8($this->value, ENT_COMPAT, 'UTF-8') . '"' . $size . $disabled . $readonly . $onchange . $autocomplete
			. $multiple . $maxLength . $hint . $required . $autofocus . '/>';
	}
}
