# Link-Handler

## TYPO3 8.7

Page-TypoScript

```typo3_typoscript
// Page TSconfig for registering the linkhandler for "product" records
TCEMAIN.linkHandler.tx_calendars_event {
	handler = TYPO3\CMS\Recordlist\LinkHandler\RecordLinkHandler
	label = LLL:EXT:calendars/Resources/Private/Language/locallang_db.xlf:tx_calendars_domain_model_calendarevent
	configuration {
		table = tx_calendars_domain_model_calendarevent
	}
	scanBefore = page
}
```

Setup-TypoScript

```typo3_typoscript
config.recordLinks {
    tx_calendars_event {
        typolink {
            parameter = {$themes.configuration.pages.calendar.detail}
            additionalParams.data = field:uid
            additionalParams.wrap = &tx_calendars_calendarslist[controller]=Calendar&tx_calendars_calendarslist[action]=showEvent&tx_calendars_calendarslist[event]=|
            useCacheHash = 1
            ATagParams.data = parameters:allParams
            target.data = parameters:target
            title.data = parameters:title
            extTarget = _blank
            extTarget.override.data = parameters:target
        }
        forceLink = 1
    }
}
```
