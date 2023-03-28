# Fluid Templates

Hier finden Sie alle Informationen über das Templating in dieser Extension.



## Verfügbare Templates

Templates->Email->Registration.html
- Für dieses Template sind firstName, lastName, event, email Pflichfelder. alle anderen werden gesammelt und mit in die E-Mail geschrieben
- Somit können die Name beliebig (ohne sonderzeichen)



## Eigene Templates verwenden

Um die vorhandenen Templates optimal in Ihr Theme einzubinden folgen Sie bitte dieser `Anleitung <http://fluid-template-manager.de/documentation/Extensions.html#extensions-richtig-einbinden>`_.

Zusammenfassung der Anleitung:

1. Im Theme-Verzeichnis ein Verzeichnis `ftm_theme_website/Resources/Public/Extensions/calendars` anlegen und die Public-Dateien ablegen.

2. Im Theme-Verzeichnis ein Verzeichnis `ftm_theme_website/Resources/Private/Extensions/calendars` anlegen und die Private-Dateien ablegen.

3. Folgende TYPOScript-Konstanten definieren.

```typo3_typoscript
plugin.tx_calendars {
  view {
    templateRootPath = typo3conf/ext/{$ftmTemplateDir}/Resources/Private/Extensions/calendars/Templates/
    partialRootPath  = typo3conf/ext/{$ftmTemplateDir}/Resources/Private/Extensions/calendars/Partials/
    layoutRootPath   = typo3conf/ext/{$ftmTemplateDir}/Resources/Private/Extensions/calendars/Layouts/
  }
}
```
