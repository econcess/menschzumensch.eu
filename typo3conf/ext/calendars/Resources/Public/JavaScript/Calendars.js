/**
 * Author: Thomas Deuling <typo3@coding.ms>
 */
var Calendars = {

    /**
     * JSON API URL
     */
    jsonApi: '',

    calendar: null,

    popover: {
        placement: 'auto'
    },

    initialize: function () {
        // Get JSON API url
        var jsonApiContainer = jQuery('[data-calendars-json-api]');
        if (jsonApiContainer.length > 0) {
            Calendars.jsonApi = jsonApiContainer.attr('data-calendars-json-api');
        }
        // Build year calendar
        var calendars = jQuery('.calender-year');
        if (calendars.length > 0) {
            Calendars.selectCalendarEvents();
            jQuery.each(calendars, function (key, value) {

                var calendarNode = jQuery(value);
                var calendarWeekVisible = calendarNode.attr('data-calendar-week-visible');
                calendarWeekVisible = (calendarWeekVisible === '1');

                /**
                 * @todo pass language by settings.[...] and data-attribute
                 */

                Calendars.calendar = calendarNode.calendar({
                    displayWeekNumber: calendarWeekVisible,
                    language: 'de',
                    enableRangeSelection: true,
                    clickDay: function (event) {
                        var events = jQuery(event.events);
                        if (events.length > 0) {
                            var element = jQuery(event.element);
                            var otherElements = jQuery('.calender-year td.has-events').not('#' + element.attr('id'));
                            jQuery('.day-content', otherElements).popover('hide');
                            element.popover('show');
                        }
                    },
                    /** @todo handle touch/no-touch
                     * mouseOnDay: function(event) {
						var events = jQuery(event.events);
						if(events.length > 0) {
							var element = jQuery(event.element);
							if(!element.hasClass('has-popover')) {
								// Build content
								var popoverContent = '';
								for(var i=0; i<events.length; i++) {
									popoverContent += events[i].name + '<br />';
								}
								// Create popover
								element.popover({
									title: 'test',
									placement: Calendars.popover.placement,
									html: true,
									content: popoverContent
								}).popover('show').addClass('has-popover');
							}
							else {
								element.popover('show');
							}
						}
					},
                     mouseOutDay: function(event) {
						var events = jQuery(event.events);
						if(events.length > 0) {
							var element = jQuery(event.element);
							element.popover('hide');
						}
					},*/
                    selectRange: function (startDate, endDate) {
                        //console.log(startDate, endDate);
                    },
                    //startYear: (new Date().getFullYear()),
                    style: 'custom',
                    customDataSourceRenderer: function (element, date, events) {
                        if (events.length > 0) {
                            var variantsArray = [];
                            var popoverContent = '';
                            for (var i = 0; i < events.length; i++) {
                                var event = events[i];
                                popoverContent += event.popover;
                                for (var j = 0; j < event.variants.length; j++) {
                                    variantsArray.push('event-category-' + event.variants[j]);
                                }
                            }
                            // Create popover
                            element.popover({
                                //title: 'test',
                                placement: Calendars.popover.placement,
                                html: true,
                                content: popoverContent
                            });
                            variantsArray = variantsArray.filter(Calendars.arrayUnique);
                            element.addClass(variantsArray.join(' '));
                            // Get day of year
                            var timestamp = new Date().setFullYear(date.getFullYear(), 0, 1);
                            var yearFirstDay = Math.floor(timestamp / 86400000);
                            var today = Math.ceil((date.getTime()) / 86400000);
                            var dayOfYear = today - yearFirstDay;
                            element.parent().addClass('has-events').attr('id', 'day-' + dayOfYear);
                        }
                    }
                });
            });
        }
    },

    arrayUnique: function (value, index, self) {
        return self.indexOf(value) === index;
    },

    selectCalendarEvents: function () {
        // Clear portfolio
        var data = {
            tx_portfolios_jsonapi: {
                clear: true
            }
        };
        // Select calendar events
        jQuery.ajax({
            url: Calendars.jsonApi,
            dataType: 'json',
            data: data,
            success: function (json) {
                Calendars.calendar.setDataSource(json.events);
                if (typeof json.messages.info !== 'undefined') {
                    FlashMessage.push(json.messages.info, 'info', '#calendars-flash-messages');
                }
            },
            error: function () {
                FlashMessage.push('Calendar server error!', 'error', '#calendars-flash-messages');
            }
        });
    }

};
jQuery(document).ready(function () {
    // Fixing encoding issue
    if (typeof jQuery.fn.calendar !== 'undefined') {
        jQuery.fn.calendar.dates['de'] = {
            days: ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'],
            daysShort: ['Son', 'Mon', 'Die', 'Mit', 'Don', 'Fre', 'Sam'],
            daysMin: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
            months: ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],
            monthsShort: ['Jan', 'Feb', 'Mär', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'],
            weekShort: 'KW',
            weekStart: 1
        };
    }
    Calendars.initialize();
});
