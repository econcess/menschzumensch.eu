# Migrations-Aufgaben

*   SupportRow entfernen:
	*   ext_conf_template.txt
	*   Translations (locallang_support.xlf)
	*   Im TCA _support-row_ durch _information-row_ ersetzen
	*   `Classes/Tca/InformationRow.php` entfernen
	*   `Classes/Service/UpdateService.php` entfernen
*   TCA
	*   `Classes/Tca/ConfigurationPreset.php` entfernen
	*   `Classes/Tca/ConfigurationPresetCustom.php` wird zu `Classes/Tca/Configuration.php`
		`use CodingMs\AdditionalTca\Tca\Configuration as ConfigurationDefaults;`
*   Allgemein
	*   Abhängigkeiten in composer.json + ext_emconf.php
