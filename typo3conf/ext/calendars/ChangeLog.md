# Calendars Change-Log

## 2020-11-13 Release of version 2.1.1

*   [TASK] Back button in registration view



## 2020-11-06 Release of version 2.1.0

*   [FEATURE] optionally disable links to the detail view
*   [FEATURE] optionally disable event selection in the registration view
*   [TASK] remove error log messsage if calenders json api not found
*   [TASK] remove required from teaser field in calendar event
*   [BUGFIX] Fix Namespace in TCA configuration
*   [BUGFIX] Fix TypoScript constants label



## 2020-10-04 Release of version 2.0.1

*   [BUGFIX] Rise additional_tca requirement



## 2020-10-03 Release of version 2.0.0

*	[FEATURE] Add own file reference for marking preview images
*	[FEATURE] Add frontend management support
*	[FEATURE] Add slug field for human readable urls
*	[TASK] Finalize additional-TCA support
*	[TASK] Add additional-TCA support see #4
*	[TASK] Remove non breaking spaces from PHP doc comments
*	[TASK] Add render types in Flex forms
*	[TASK] Add moment library for JavaScript features
*	[TASK] ViewHelper migration
*	[TASK] Migrate lazy annotation
*	[TASK] Remove $_EXTKEY variable from configuration files
*	[TASK] Change TypoScript file extension to .typoscript
*	[TASK] Replace $TCA with $GLOBALS
*	[TASK] Preparations for TYPO3 10 migration



## 2020-07-30 Release of version 1.6.1

*	[BUGFIX] Fix initialization of calendar event registration object



## 2020-05-04 Release of version 1.6.0

*	[TASK] set default value for "files" in order to prevent problems with strict database configuration
*	[TASK] set default value for "sys_language_uid" in order to prevent problems with strict database configuration
*	[TASK] Optimize image usage in Fluid templates
*	[TASK] Change external_link to a header link field in TCA.
*	[TASK] Add redirect after registration to event page functionality.
*	[TASK] Add registration confirmation email functionality.
*	[TASK] Add translation for registration error.
*	[TASK] Add cleaning function for csv filename.
*	[TASK] Update support row
*	[FEATURE] Registration based on frontend user
*	[BUGFIX] Fix default value in event TCA
*	[TASK] Tidy up csh language labels.
*	[TASK] Add language labels to templates.
*	[TASK] Add variant column to category overview.
*	[TASK] Correct spelling mistake.
*	[TASK] Add getters and setters for registrations in CalendarEvent model.
*	[TASK] Add sys files selectbox to Events in EventsOverview
*	[TASK] Add translations for language labels.
*	[BUGFIX] Events db field changed to event.
*	[TASK] Add overview registrations backend methods, labels, event property methods.
*	[TASK] Add inject methods.
*	[TASK] Add registration relations, TCA and model.
*	[TASK] Refactoring of current documentation files
*	[TASK] Preparation for registration relations
*	[TASK] Add TypoScript constant language labels.
*	[BUGFIX] Fix nesting issue in Translation file
*	[TASK] Remove showEvent action from non cachable actions
*	[TASK] Add migration information for ftm_ext_calender extension
*	[TASK] Add translations for registration options.
*	[TASK] Do not show description header for empty descriptions in list and details.
*	[FEATURE] Add buttons for sharing on facebook, twitter or by mail.
*	[TASK] Adjust renderType of external link in event options.
*	[TASK] Code clean up.
*	[BUGFIX] Number of available tickets does not decrease. (issue #1)
*	[TASK] Add descriptions for variables ticketsAvailable+ticketAmount.
*	[BUGFIX] Fix possible registration with no available tickets left.
*	[TASK] Add configuration options for registration.
*	[TASK] Show registration button in event description and amount of tickets if available.
*	[BUGFIX] Move TCA labels for access and language.
*	[FEATURE] Add methods in event repository.
*	[TASK] Update translation file paths in TCA files.
*	[TASK] Add event category colors in default CSS.



## 2019-03-06 Release of version 1.5.1

*	[TASK] Modify Gitlab-CI configuration.
*	[TASK] Changing links inside class SupportRow.
*	[BUGFIX] Fixing JavaScript issue when some contribution libraries are not included.



## 2019-03-06 Release of version 1.5.0

*	[BUGFIX] Fixing pre selected categories in event list plugin.
*	[TASK] Removing DEV identifier.



## 2019-01-17 Release of version 1.4.0

*	[TASK] Splitting TypoScript in different static includes.
*	[TASK] Migration for TYPO3 9.5.



## 2018-11-16  Release of version 1.3.0

*	[FEATURE] Adding optional BCC for registration mails.



## 2018-11-07  Release of version 1.2.0

*	[FEATURE] Adding different optional addresses for registration mails.



## 2018-10-29  Release of version 1.1.0

*	[TASK] Preparing license and version number.
*	[FEATURE] Adding support rows in backend including license key.
*	[TASK] Refactoring of the registration.
*	[TASK] Adding documentation for registration realurl configuration.
*	[BUGFIX] Fixing pre selected categories in event list plugin.
*	[FEATURE] Adding template selection into event list plugin.
*	[FEATURE] Adding description into category.
*	[BUGFIX] Fixing Fluid template paths
*	[BUGFIX] Fixing Month overview event-selection
*	[BUGFIX] Fixing Month overview event-selection
*	[TASK] Extending translations
*	[BREAKING] Remove the PID from FlexForm - Use container-constant or RecordStorage in CE. Before update you need to migrate the selected storage pid!
*	[BREAKING] tt_address is replaced by an own extension for addresses (ftm_ext_address), because of the old code base of tt_address and some trouble with this extension!
*	[BREAKING] showAllMonthAction was renamed to showFullYearAction, because the naming was confusing.
*	[BREAKING] switchableControllerActions in FlexForm was resolved into different plugins.
*	[BREAKING] Remove listAction, because it doesn't make sense.
*	[FEATURE] Adding Registration page field in events, for selecting a special page for registrations
*	[FEATURE] Adding a simple single view
*	[TASK] Extending translations
*	[FEATURE] Adding event field for ticket amount and tickets available
*	[FEATURE] Adding event detail view. An Update of CE flexforms is necessary!
*	[BUGFIX] Fixing Tooltip in overview
*	[CLEANUP] Cleanup old source
*	[FEATURE] Adding an external link to events
