<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

JFormHelper::loadFieldClass('list');

/**
 * Form Field class for the Joomla Framework.
 *
 * @package     Joomla.Platform
 * @subpackage  Form
 * @since       11.4
 */
class JFormFieldPlugins extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var    string
	 * @since  11.4
	 */
	protected $type = 'Plugins';

	/**
	 * The path to folder for plugins.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $folder = false;

	/**
	 * Method to attach a JForm object to the field.
	 *
	 * @param   SimpleXMLElement  $element  The SimpleXMLElement object representing the <field /> tag for the form field object.
	 * @param   mixed             $value    The form field value to validate.
	 * @param   string            $group    The field name group control value. This acts as as an array container for the field.
	 *                                      For example if the field has name="foo" and the group value is set to "bar" then the
	 *                                      full field name would end up being "bar[foo]".
	 *
	 * @return  boolean  True on success.
	 *
	 * @see 	JFormField::setup()
	 * @since   11.1
	 */
	public function setup(SimpleXMLElement $element, $value, $group = null)
	{
		$this->folder = (string) $this->element['folder'];

		return parent::setup($element, $value, $group);
	}

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 *
	 * @since   11.4
	 */
	protected function getOptions()
	{
		$folder	= $this->folder;

		if (!empty($folder))
		{
			// Get list of plugins
			$db     = JFactory::getDbo();
			$query  = $db->getQuery(true)
				->select('element AS value, name AS text')
				->from('#__extensions')
				->where('folder = ' . $db->quote($folder))
				->where('enabled = 1')
				->order('ordering, name');
			$db->setQuery($query);

			$options = $db->loadObjectList();

			$lang = JFactory::getLanguage();

			foreach ($options as $i => $item)
			{
				$source = JPATH_PLUGINS . '/' . $folder . '/' . $item->value;
				$extension = 'plg_' . $folder . '_' . $item->value;
					$lang->load($extension . '.sys', JPATH_ADMINISTRATOR, null, false, false)
				||	$lang->load($extension . '.sys', $source, null, false, false)
				||	$lang->load($extension . '.sys', JPATH_ADMINISTRATOR, $lang->getDefault(), false, false)
				||	$lang->load($extension . '.sys', $source, $lang->getDefault(), false, false);
				$options[$i]->text = JText::_($item->text);
			}
		}
		else
		{
			JLog::add(JText::_('JFRAMEWORK_FORM_FIELDS_PLUGINS_ERROR_FOLDER_EMPTY'), JLog::WARNING, 'jerror');
		}

		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
