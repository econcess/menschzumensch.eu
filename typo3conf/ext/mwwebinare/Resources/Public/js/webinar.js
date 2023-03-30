
$(document).on('click', '.anke', function(event){
    event.preventDefault();
	var href = $(this).attr("href");
	var hash = href.substr(href.indexOf("#"));

    $('html, body').animate({
        scrollTop: $( hash ).offset().top-90
    }, 500);
	
	return false;
});

//+1968/econcess
$(window).on('load',function(){
				
	if($('#containerisotop').length){
		var $grid = $('.grid').isotope({
		  itemSelector: '.element-item',
		  layoutMode: 'fitRows',
		  getSortData: {
			name: '.name',
			symbol: '.symbol',
			number: '.number parseInt',
			category: '[data-category]',
			weight: function( itemElem ) {
			  var weight = $( itemElem ).find('.weight').text();
			  return parseFloat( weight.replace( /[\(\)]/g, '') );
			}
		  }
		});

		// filter functions
		var filterFns = {
		  // show if number is greater than 50
		  numberGreaterThan50: function() {
			var number = $(this).find('.number').text();
			return parseInt( number, 10 ) > 50;
		  },
		  // show if name ends with -ium
		  ium: function() {
			var name = $(this).find('.name').text();
			return name.match( /ium$/ );
		  }
		};

		// bind filter button click
		$('#filters').on( 'click', 'button', function() {
		  var filterValue = $( this ).attr('data-filter');
		  // use filterFn if matches value
		  filterValue = filterFns[ filterValue ] || filterValue;
		  $grid.isotope({ filter: filterValue });
		});


		// change is-checked class on buttons
		$('.button-group').each( function( i, buttonGroup ) {
		  var $buttonGroup = $( buttonGroup );
		  $buttonGroup.on( 'click', 'button', function() {
			$buttonGroup.find('.is-checked').removeClass('is-checked');
			$( this ).addClass('is-checked');
		  });
		});
		
		$('#morevideo').click(function() {
			$.ajax({
										url: $('#morevideo').data('url'),
										dataType:'html',
										success: function(data) {

										var $content = $(data)
										$('.grid').append( $content ).isotope( 'appended', $content )

										$('#morevideo').fadeOut();
											
										},
										error: function(xhr, status, error) {
											alert(xhr.responseText);
											//alert('Es ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut oder kontaktieren Sie unser Büro: <a href="mailto:office@austria.at">office@austria.at</a>');
											
										}
									});
			return false;
			
		});
	}

if($('#containerisotop2').length){
		var $grid2 = $('.rowouter').isotope({
		  itemSelector: '.element-item2',
		  layoutMode: 'fitRows',
		  getSortData: {
			name: '.name2',
			symbol: '.symbol2',
			number: '.number parseInt',
			category: '[data-category]',
			weight: function( itemElem2 ) {
			  var weight2 = $( itemElem2 ).find('.weight2').text();
			  return parseFloat( weight2.replace( /[\(\)]/g, '') );
			}
		  }
		});
		// filter functions
		var filterFns2 = {
		  // show if number is greater than 50
		  numberGreaterThan50: function() {
			var number = $(this).find('.number').text();
			return parseInt( number, 10 ) > 50;
		  },
		  // show if name ends with -ium
		  ium: function() {
			var name = $(this).find('.name').text();
			return name.match( /ium$/ );
		  }
		};

		// bind filter button click
		$('#filters2').on( 'click', 'button', function() {
		  var filterValue2 = $( this ).attr('data-filter');
		  // use filterFn if matches value
		  filterValue2 = filterFns2[ filterValue2 ] || filterValue2;
		  $grid2.isotope({ filter: filterValue2 });
		});


		// change is-checked class on buttons
		$('.button-group2').each( function( i, buttonGroup2 ) {
		  var $buttonGroup2 = $( buttonGroup2 );
		  $buttonGroup2.on( 'click', 'button', function() {
			$buttonGroup2.find('.is-checked').removeClass('is-checked');
			$( this ).addClass('is-checked');
		  });
		});
		

	}
});



			
	$('.acc_head').click(function() {
		
		
		var toToggle = $(this).data('toggle');
		//$('#'+toToggle+' .acc_content').slideToggle();
		//$('#'+toToggle).toggleClass('open');
		if($('#'+toToggle).hasClass('open')) {
			$('.acc_content').slideUp();
			$('.acc_outer').removeClass('open');
			
		   	$('#'+toToggle+' .acc_content').slideUp();
			$('#'+toToggle).removeClass('open');
		}
		else {
			$('.acc_content').slideUp();
			$('.acc_outer').removeClass('open');
			
		   	$('#'+toToggle+' .acc_content').slideDown();
			$('#'+toToggle).addClass('open');
		}
		return false;
		
	});
		
		jQuery(window).bind('orientationchange', function(event) {
          if (window.orientation == 90 || window.orientation == -90 || window.orientation == 270) {
             setsize();
          } else {
           setsize();
           //setAccordion();
          }
        }).trigger('orientationchange');
        
        jQuery(window).resize(function(){
          setsize();
          
        });
        
        jQuery(window).on('load',function(){
          setsize();
			if($('#carouthumb').length){
				$('#carouthumb div.owl-item.active:first-child').addClass('current');
			}
			
			if($(window).width() > 767) {
					$('.parallax').each(function (index, value){
						var yPos = ( ($(window).scrollTop() - $(this).offset().top) / 7);
						var coords = '50% '+ yPos + 'px';
						// $('.slides li').css({ backgroundPosition: coords });
						$(this).css('background-position', coords);
					});
				}
			
			if($(window).scrollTop() > 200) {
				$('#header').addClass("sticky");
			}
        });
        
        jQuery(document).ready(function(){
          setsize();
        });
        
        
        
        function setsize() {  
			
				
				if($('.webinar_txt').length){
					setTimeout(function(){ 
					var highestBox = 0;
					jQuery('.webinar_txt').css('height', 'auto');
					jQuery('.webinar_txt').each(function(){
					  if(jQuery(this).height() > highestBox) {
						 highestBox = jQuery(this).height(); 
					  }
					});  
					jQuery('.webinar_txt').height(highestBox);
				   }, 30);
				}

        }
//-1968/econcess