/**
 * Englishchoice Side Menu.
 * Interface JS functions
 *
 * @package Listable Child
 */
/*jslint browser: true*/
/*global jQuery, console*/
jQuery(document).ready(function($) {
	"use strict";
	if ( 'undefined' === typeof EnglishchoiceSideMenu ) {
		return;
	}
	var api = {
		init: function(){
			var lastItems = $(EnglishchoiceSideMenu.lastItemSelector);
			if ( lastItems.length > 0 ) {
				lastItems.on('click', function(evnt){
					evnt.preventDefault();
					var $this = $(this);
					var $menuID = '#'+$this.parents('ul').attr('id');
					if ( $this.hasClass(EnglishchoiceSideMenu.menuCloseClass) ) {
						$($menuID+' '+EnglishchoiceSideMenu.menuItemSelectableSelector).css({'display':''});
						$this.find('.listable-arrow-up').css({'display':''});
						$this.find('.listable-arrow-down').css({'display':'none'});
					} else {
						$($menuID+' '+EnglishchoiceSideMenu.menuItemSelectableSelector).css({'display':'none'});
						$this.find('.listable-arrow-up').css({'display':'none'});
						$this.find('.listable-arrow-down').css({'display':''});
					}
					$this.toggleClass(EnglishchoiceSideMenu.menuCloseClass);
				});
			}
		}
	}
	EnglishchoiceSideMenu =  $.extend({}, EnglishchoiceSideMenu, api);
	EnglishchoiceSideMenu.init();	
});