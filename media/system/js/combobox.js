/**
 * @package		Joomla.JavaScript
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */


/**
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

 /**
 * Unobtrusive transformation for combobox
 *
 *
 * @package		Joomla.Framework
 * @subpackage	Forms
 */

(function($,document,undefined)
{
	var combobox = function(options, elem)
	{
		var self={},

		init = function(options, elem)
		{
			self.$elem = $(elem);
			self.options = $.extend({}, $.fn.ComboTransform.options, options);
			self.$input = $(elem).find('input[type="text"]');
			self.$dropBtnDiv = $(elem).find('div.btn-group');
			self.$dropBtn = self.$dropBtnDiv.find('[type="button"]');
			self.$dropDown = $(elem).find('ul.dropdown-menu'),
			self.$dropDownOptions = self.$dropDown.find('li a');

			render();

			addEventHandlers();
		},

		render = function()
		{
			// Align dropdown correctly
			var inputWidth = self.$elem.width(),
				btnWidth = self.$dropBtnDiv.width(),
				totalWidth = inputWidth - 3,
				dropDownLeft = -inputWidth + btnWidth,
				dropDownWidth = self.$dropDown.width();

			dropDownWidth < totalWidth ? self.$dropDown.width(totalWidth+'px') : null;
			self.$dropDown.css('left',dropDownLeft+'px');
			self.$dropDown.css('max-height','150px');
			self.$dropDown.css('overflow-y','scroll');
			self.$dropDown.css('left',dropDownLeft+'px');
		},

		addEventHandlers = function()
		{
			self.$input.bind('focus', drop);
			self.$input.bind('blur', pick);

			if(self.options.updateList)
			{
				self.$input.bind('keyup', updateList);
			}

			self.$dropDown.on('mouseenter',function() {
				self.$input.unbind('blur', pick);
			});
			self.$dropDown.on('mouseleave',function() {
				self.$input.bind('blur', pick);
			});

			self.$dropBtn.on('click', focusCombo);
			self.$dropDown.find('li').click(updateCombo);
		},

		drop = function()
		{
			if(!self.$dropDown.hasClass('empty'))
			{
				var dropDownHeight = self.$dropDown.height(),
					inputClientHeight = self.$input[0].clientHeight,
					inputHeight = self.$input.height(),
					dropDownTop = -(inputHeight + dropDownHeight);

				// Drop it in viewable area
				self.$dropDown.css('top','100%');

				self.$elem.addClass('nav-hover');
				self.$dropBtnDiv.addClass('open');

				if(!inViewport(self.$dropDown))
				{
					self.$dropDown.css('top',dropDownTop+'px');
				}
			}
		},

		pick = function()
		{
			self.$elem.removeClass('nav-hover');
			self.$dropBtnDiv.removeClass('open');
		},

		focusCombo = function()
		{
			self.$input.focus();
		},

		updateCombo = function(event)
		{
			var selectedOption = $(event.target).text();
			self.$input.val(selectedOption);
			pick();
			return false;
		},

		updateList = function(event)
		{
			var text = self.$input.val(),
				$options = self.$dropDownOptions,
				value = new RegExp(text, 'i'),
				hiddenOptions = 0;
			$options.each(function()
			{
				 if(value.test(this.innerHTML))
				 {
				 	$(this).show();
				 }
				 else
				 {
				 	$(this).hide();
				 	hiddenOptions++;
				 }
			});

			if(hiddenOptions == $options.length)
			{
				self.$dropDown.addClass('empty');
				pick();
			}
			else
			{
				self.$dropDown.removeClass('empty');
				drop();
			}
		},

		// Helper functions
		inViewport = function(el) {
		    var rect = el[0].getBoundingClientRect();
		    return (
		        rect.top >= 0 &&
		        rect.left >= 0 &&
		        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && /*or $(window).height() */
		        rect.right <= (window.innerWidth || document.documentElement.clientWidth) /*or $(window).width() */
		        );
		};

		init(options, elem);
	};
	$.fn.ComboTransform = function(options)
	{
		return this.each(function(){
			combobox(options, this);
		});
	};

	$.fn.ComboTransform.options = {
		updateList : true
	};

	$(function()
	{
		$('div.combobox').ComboTransform({updateList : true});
	});
})(jQuery,document);