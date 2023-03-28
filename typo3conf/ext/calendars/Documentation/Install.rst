============
Users manual
============

Nachdem die Extension über den Extension-Manager installiert wurde und das Include-Static integriert wurde, fahren Sie mit den folgenden Punkten fort:


1. Container erstellen
Unter DomainStorage einen Container mit dem Namen Products anlegen

2. TYPOScript Konfiguration
settings {
    basket {
        # Page-ID des Warenkorbs
        pid = 814
        # Page-ID auf der die NUtzungsbedingungen angezeigt werden
        termsOfUsePid = 818
    }
}




Für den Warenkorb-Button, einen Marker erstellen




------------------------------------------
JavaScript
------------------------------------------
* Hinweisen auf jQuery Integration -> BRAUCHT TOOLTIP-> also erst im EM jquery-Tools aktivieren; dann mit jQuery TOOLS Tooltip kompilieren
-> Auch always integrate jQuery

* Hinweisen auf ColorBox Installation
# Ext installieren
# Include Static in folgender Reihenfolge:
    # 4.5 jQuery ColorBox Base for t3jquery (rzcolorbox)
    # jQuery ColorBox Style 2 (rzcolorbox)

Achtung: ColorBox liegt standardmäßig nur auf dem Produkt-Bild der Einzelansicht. Ist kein Produkt-Bild zugewiesen, wird keine ColorBox verwendet.



Das JavaScript dieser Extension wird wie folgt eingebunden:

.. code-block:: ts

page {
    includeJS {
        ftm_ext_shop = typo3conf/ext/ftm_ext_shop/Resources/Public/JavaScript/FtmExtShop.js
    }
}

.. important:: Wenn Sie TYPO3 in einem Unterverzeichnis Ihre Domain installiert haben, müssen Sie hier ggf. den Pfad entsprechend erweitern.

.. include:: ./include/Footer.rst

