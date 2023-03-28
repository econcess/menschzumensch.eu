# Configure registrations for calendar events

The Calendars extension for TYPO3 is shipped with a simple registration logic. How you can use it is described on this page.



## Configuring registration page

First of all, you need to create a page with a event registation plugin on it. If you want to allow registration only by logged in users protect the registration page for non logged in users. Afterwards you have to insert the page uid into the following TypoScript constant:

```typo3_typoscript
themes.configuration.pages.calendar.registration = 0
```

Additionally you are able to configure, which form fields are visible and which are mandatory. This can be done by using setup TypoScript:

```typo3_typoscript
plugin.tx_calendars {
	settings {
		registration {
			# Fields for email message text
			fields {
				# These fields will be validated as required. Event and email are always required!
				required = firstName, lastName, email
				# These fields will be processed while registration
				available = firstName, lastName, address, zip, city, telephone, fax, email, message
			}
		}
	}
}
```



## Configuring registration mails

The registration mails are basically configured by the following setup TypoScript:

```typo3_typoscript
plugin.tx_calendars {
	settings {
		registration {
			subject = Event-Anmeldung
			# Default receiver mail address
			toEmail = typo3@coding.ms
			# Default receiver name
			toName = Thomas Deuling
			# Sender E-Mail
			fromEmail = typo3@coding.ms
			# Sender Name
			fromName = Event-Registrierung
			# BCC mail address
			bccEmail =
			# BCC Name
			bccName = Event-Registrierung (BCC)
		}
	}
}
```

The `toEmail` and `toName` contains the default target address.



## Defining different target addresses for registration mails

Sometimes it happens, that you need to send registrations for a special event to another mail address. For that reason you are able to define different receiver addresses. This happens in two steps - first step is the definition of the addresses self:

```typo3_typoscript
plugin.tx_calendars {
	settings {
		registration {
			address {
				# Different addresses, selectable in calendar event record
				anotherOne {
					toEmail = typo3@coding.ms
					toName = Thomas Deuling
				}
				anotherTwo {
					toEmail = typo3@coding.ms
					toName = Thomas Deuling
				}
			}
		}
	}
}
```

Afterwards you need to register this new receiver addresses, so that they ar selectable in calendar events. This happens by using Page TypoScript:

```typo3_typoscript
TCEFORM {
	tx_calendars_domain_model_calendarevent {
		# Define some supported features
		registration_address.addItems {
			anotherOne = Receiver is another person 1
			anotherTwo = Receiver is another person 2
		}
	}
}
```


