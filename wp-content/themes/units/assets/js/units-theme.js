/**
 * Interface JS functions
 * @since 1.0.0
 *
 * @package Units theme.
 */
/*jslint browser: true */
/*global jQuery,console*/

jQuery(document).ready(function($){
    "use strict";

    if ( 'undefined' === typeof UnitsTheme ) {
        return;
    }

    var api = {
		isArc: false,
		parseBool: function(b)  {
			return !(/^(false|0)$/i).test(b) && !!b;
		},
        init: function() {
			api.isArc = api.parseBool(UnitsTheme.is_archive);
			ymaps.ready(api.map);
		},
        isArchive: function() {
			return api.isArc;
		},
        map: function() {
			if ( api.isArchive() ) {
				// @todo for next version.
			} else {
				var mapObject = $('#'+UnitsTheme.mapID);
				var latitude = mapObject.data('latitude'),
					longitude = mapObject.data('longitude');
					
				var unitsThemeMap = new ymaps.Map(UnitsTheme.mapID, {
					center: [latitude, longitude],
					zoom: 12
				}),
				unitsThemePlacemark = new ymaps.Placemark(unitsThemeMap.getCenter(), {
					hintContent: UnitsTheme.postTitle
				}, {
					iconLayout: 'default#image',
					iconImageSize: [35, 42],
					iconImageOffset: [-5, -38]
				});
				
				unitsThemeMap.geoObjects.add(unitsThemePlacemark);
			}
		}
	};
	
    UnitsTheme = $.extend({}, UnitsTheme, api);
    UnitsTheme.init();

});	
	
		