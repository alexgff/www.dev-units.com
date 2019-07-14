/**
 * Englishchoice Side Menu.
 * Interface JS functions
 *
 * @package Listable Child
 * @subpackage Administration
 */
/*jslint browser: true*/
/*global jQuery, console, wp*/
jQuery(document).ready(function($) {
	"use strict";
	if ( 'undefined' === typeof EnglishchoiceNavMenus ) {
		return;
	}
	if ( 'undefined' === typeof wp.media.editor ) {
		return;
	}
	var api = {
		init: function(){
			api.attachListeners();
		},
		attachListeners: function() {
			$(document).on('click', '.listable-child-load-custom-icon', function(event) {
				var sendAttachment = wp.media.editor.send.attachment,
					$elem = $( event.currentTarget ),
					id = $elem.data('id'),
					itemID = $elem.data('item-id');
					
				event.preventDefault();				
				
				wp.media.editor.send.attachment = function(props, attachment) {
					if ( 'undefined' !== typeof attachment.id ) {
						$('input[name="menu-item-custom-icon['+itemID+']"').val(attachment.id);
					}
					if ( 'undefined' !== typeof attachment.url ) {
						$('.preview-custom-icon-'+itemID).html('<img src="'+attachment.url+'" />');
					}
					wp.media.editor.send.attachment = sendAttachment;
				}
				wp.media.editor.open(id);
				return false;
			});
			
			$(document).on('click', '.listable-child-remove-custom-icon', function(event) {
				var $elem = $( event.currentTarget ),
					id = $elem.data('id'),
					itemID = $elem.data('item-id');
					
				event.preventDefault();
				$('#edit-menu-item-custom-icon-'+itemID).val('');
				$('.preview-custom-icon-'+itemID).html('');				

			});				
		}
	}
	EnglishchoiceNavMenus =  $.extend({}, EnglishchoiceNavMenus, api);
	EnglishchoiceNavMenus.init();	
});