# Migration tasks

*   Remove SupportRow:
	*   ext_conf_template.txt
	*   Translations (locallang_support.xlf)
	*   Replace TCA _support-row_ by _information-row_
	*   Remove `Classes/Tca/InformationRow.php`
	*   Remove `Classes/Service/UpdateService.php`
*   TCA
	*   Remove `Classes/Tca/ConfigurationPreset.php`
	*   Rename `Classes/Tca/ConfigurationPresetCustom.php` to `Classes/Tca/Configuration.php`
		`use CodingMs\AdditionalTca\Tca\Configuration as ConfigurationDefaults;`
*   General
	*   Dependencies in composer.json + ext_emconf.php
