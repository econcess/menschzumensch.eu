//+3758/econcess
window.addEventListener('CookiebotOnAccept', function (e) {
	if (Cookiebot.consent.preferences) 
		{
		if(jQuery( ".faqcontainer" ).length ){
			var json =     {
				"@context": "https://schema.org",
				"@type": "FAQPage",
				"mainEntity": [
				]};

					jQuery( ".faqcontainer" ).each(function( index ) {
							var frage = jQuery(this).find(".frage").text().replace(/\t|\n/g, '');
							var antwort = jQuery(this).find(".antwort").html().replace(/\t|\n/g, '');
							var json_temp = {}; 
							json_temp["@type"] = 'Question';
							json_temp.name = frage;
							json_temp.acceptedAnswer = {};
							json_temp.acceptedAnswer["@type"] = 'Answer'; 
							json_temp.acceptedAnswer.text = antwort; 
							json.mainEntity.push(json_temp);

					});
					//console.log(json);

					var s = document.createElement("script");
					s.type = "application/ld+json";
					s.text = JSON.stringify(json);
					jQuery("head").append(s);
		}
	} 
}, false);
//-3758/econcess