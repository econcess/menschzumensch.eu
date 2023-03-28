====================================================================
Plugins
====================================================================
Hier finden Sie alle Informationen über die verfügbaren Plugins in dieser Extension.



Calendar - Anzeige
====================================================================
Diese Plugin wird verwendet um Kalender-Ansichten zu generieren.



Dieses Plugin stellt folgende allgemeine Einstellungen bereit:
--------------------------------------------------------------------

============================================= ============ ============================================================================================================================
Einstellung                                   Sichtbarkeit Beschreibung
============================================= ============ ============================================================================================================================
Kalender-Ansicht                              immer        Hier kann ausgewählt werden, welche Kalender-Daten angezeigt werden sollen.

                                                           **Mögliche Optionen**

                                                           * Große Monatsansicht (alle 12 Monate des Jahres; verwendet Template: ShowFullYear.html)
                                                           * Kalender-Übersicht (alle Jahre und Termin-Gruppen, für SEO; verwendet Template: List.html)
                                                           * Termin-Liste (verwendet Template: ListEvents.html)

Event & Holiday Container-Page                immer        Hier kann ausgewählt werden, aus welchem Container die Termine geladen werden.
Event & Holiday Calendar-Page                 immer        Hier kann eine Seite mit dem Termin verlinkt werden.
Event categories                                  immer        Hier können die Eventgruppen der Anzeige eingegrenzt werden. Wenn keine ausgewählt ist, werden immer alle verwendet.
Filter über der Liste anzeigen!?              Termin-Liste Wenn aktiviert wird ein Filter über der Liste angezeigt.
Offset der Liste                              Termin-Liste Hier kann angegeben werden, ab dem wievielten Eintrag die Liste beginnen soll.
Limit der Liste                               Termin-Liste Hier kann angegeben werden, wieviele Termine maximal angezeigt werden sollen.
============================================= ============ ============================================================================================================================

Die Kategorien werden in den Auswahlen nach dem Feld *sorting* sortiert.


Folgende Einstellungen finden Sie auf dem Tab Pagination:
--------------------------------------------------------------------

============================================= ============ ============================================================================================================================
Einstellung                                   Sichtbarkeit Beschreibung
============================================= ============ ============================================================================================================================
Pagination verwenden                          Termin-Liste Wenn diese Option aktiviert ist, wird eine Pagination für die Liste verwendet.
über der Liste einfügen                       Termin-Liste Wenn diese Option aktiviert ist, wird die Pagination über der Liste eingefügt.
unter der Liste einfügen                      Termin-Liste Wenn diese Option aktiviert ist, wird die Pagination unter der Liste eingefügt.
Einträge je Seite                             Termin-Liste Gibt an wieviele Einträge auf einer Seite der Pagination angezeigt werden sollen.
max. Links                                    Termin-Liste Gibt an wieviele Links maximal in der Pagination stehen dürfen, bevor ein ``...`` eingefügt wird.
============================================= ============ ============================================================================================================================



Calendar - Event-Anmeldung
====================================================================
Diese Plugin wird verwendet um sich an Events anzumelden.



Calendar - Monats-Übersicht
====================================================================
Diese Plugin wird verwendet um eine kleine Montas-Übersicht anzuzeigen.

* Kleine Monatsansicht (verwendet Template: ShowMonth.html)



.. include:: ./include/Footer.rst

