# TYPO3 - Calendars Migration

## Version 2.0.0

*   Some registration fields has been renamed in order to get equal names with frontend user (street => address, postalCode => zip, phone => telephone)


## Migration from ftm_ext_calendar

1.  MySQL-Export of all tables and replace `tx_ftmextcalendar` with `tx_calendars` - afterwards import that data.
2.  MySQL statement
    1.  UPDATE `sys_file_reference` SET `tablenames` = 'tx_calendars_domain_model_calendarevent' WHERE `tablenames` LIKE '%tx_ftmextcalendar%'
3.  MySQL statement
    1.  UPDATE `tt_content` SET `list_type` = 'calendars_calendarlist' WHERE `list_type` LIKE 'ftmextcalendar_calendarlist'
    2.  UPDATE `tt_content` SET `list_type` = 'calendars_calendarmonth' WHERE `list_type` LIKE 'ftmextcalendar_calendarmonth'
    3.  UPDATE `tt_content` SET `list_type` = 'calendars_registration' WHERE `list_type` LIKE 'ftmextcalendar_registration'
    4.  UPDATE `tt_content` SET `list_type` = 'calendars_calendarfullyear' WHERE `list_type` LIKE 'ftmextcalendar_calendarfullyear'
    4.  UPDATE `tt_content` SET `list_type` = 'calendars_jsonapi' WHERE `list_type` LIKE 'ftmextcalendar_jsonapi'
4.  Rename group to category
    1. ALTER TABLE `tx_calendars_domain_model_calendarevent` CHANGE `calendar_event_group` `calendar_event_category` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
    2. RENAME TABLE `quiris_necom_2019`.`tx_calendars_domain_model_calendareventgroup`
                  TO `quiris_necom_2019`.`tx_calendars_domain_model_calendareventcategory`;
5.  Search in the theme/configuration for
    1.  `tx_ftmextcalendar` and replace with `tx_calendars`.
    2.  `tx-ftm-ext-calendar` and replace with `tx-calendars`.
6.  Uninstall ftm_ext_calendar
