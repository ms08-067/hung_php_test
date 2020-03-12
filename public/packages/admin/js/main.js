

function isNumber(evt,v)

{



	if(evt.which == 8) return true;

	

	if(v.length > 12) {

		alert("Không gõ số quá lớn ");

		return false;

	}

	

	var charCode = (evt.which) ? evt.which : event.keyCode

	

	if (charCode > 31 && (charCode < 48 || charCode > 57))

	return false;

	

	return true;

}



$(document).ready(function(){

	

  $(".confirm").live('click', function(event) {



		var text = ($(this).data('confirm-title')) ? $(this).data('confirm-title') : 'Are you sure ? ';



		if (confirm(text)) {

			var func = $(this).data('func');



			if (func != undefined) {

				eval(func);

			}

		} else {



			event.preventDefault();



			return false;



		}



	});



	$(".confirm-danger").live('click', function(event) {



		var a = Math.floor((Math.random() * 30) + 1);;

		var b = Math.floor((Math.random() * 30) + 1);;



		var answer = prompt(a + ' + ' + b + ' = ?');

		var right_answer = Math.floor(a + b);



		if (answer == right_answer) {

			var func = $(this).data('func');



			if (func != undefined) {

				eval(func);

			}



		} else {



			if (answer != null) {

				alert('Incorrect your answer.');

			}



			event.preventDefault();



			return false;



		}



	});



	$(".fade-in").stop(false, true).show().fadeOut(5000);

});



function number_format(number, decimals, dec_point, thousands_sep)

{

  number = (number + '')

	.replace(/[^0-9+\-Ee.]/g, '');

  var n = !isFinite(+number) ? 0 : +number,

	prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),

	sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,

	dec = (typeof dec_point === 'undefined') ? '.' : dec_point,

	s = '',

	toFixedFix = function(n, prec) {

	  var k = Math.pow(10, prec);

	  return '' + (Math.round(n * k) / k)

		.toFixed(prec);

	};

  // Fix for IE parseFloat(0.55).toFixed(0) = 0;

  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))

	.split('.');

  if (s[0].length > 3) {

	s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);

  }

  if ((s[1] || '')

	.length < prec) {

	s[1] = s[1] || '';

	s[1] += new Array(prec - s[1].length + 1)

	  .join('0');

  }

  return s.join(dec);

}



function pretty_currency(cash)

{

	if(cash > 100000)

	{

	  return number_format(cash / 1000)+'K';

	}else{

	  return number_format(cash);

	}

}



function hidden_navbar()

{

  	$("#nav").animate({left: -100});

  	$("#content").animate({

  		'padding-left': 0

  	});



  	$(".hidden-navbar").css('display', 'none');

  	$(".show-navbar").css('display', 'block');



  	$.cookie('HiddenNavbar', 1);

}



function show_navbar()

{

	$("#nav").animate({left: 0});

  	$("#content").animate({

  		'padding-left': 90

  	});



  	$(".hidden-navbar").css('display', 'block');

  	$(".show-navbar").css('display', 'none');



	$.cookie('HiddenNavbar', 0);

}


var Amo = {};
Amo.alert = function(text, t = 8000)
{
    if(t > 0){

        $(".alert-danger").stop(true, true).find('p').html(text);
        $(".alert-danger").stop(true, true).css('display', 'none').css('display', 'block').fadeOut(t);

    }else{
        
        $(".alert-danger").stop(true, true).find('p').html(text);
        $(".alert-danger").stop(true, true).css('display', 'none').css('display', 'block');    
    }
    
}

Amo.success = function(text, t = 8000)
{
    if(t > 0){
        
        $(".alert-success").stop(true, true).find('p').html(text);
        $(".alert-success").stop(true, true).css('display', 'none').css('display', 'block').fadeOut(t);

    }else {
        
        $(".alert-success").stop(true, true).find('p').html(text);
        $(".alert-success").stop(true, true).css('display', 'none').css('display', 'block');
    }
    
}

$(function(){
  $(".alert .close").click(function(){
        $("#error-container .alert").hide();
   });
});

tinymce.init({
	
    selector: ".tinymce",
	  convert_urls : false,
    height: 250,

    plugins: [

      "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",

      "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",

      "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern"

    ],



    toolbar1: "newdocument | bold italic | alignleft aligncenter alignright alignjustify styleselect |  formatselect fontselect fontsizeselect",

    toolbar2: "paste | searchreplace | bullist numlist | outdent indent undo redo | link unlink image media code preview | forecolor backcolor",

    toolbar3: "table | hr removeformat charmap  | ltr rtl pagebreak",



    menubar: false,

    toolbar_items_size: 'small',



    style_formats: [{

      title: 'Bold text',

      inline: 'b'

    }, {

      title: 'Red text',

      inline: 'span',

      styles: {

        color: '#ff0000'

      }

    }, {

      title: 'Red header',

      block: 'h1',

      styles: {

        color: '#ff0000'

      }

    }, {

      title: 'Example 1',

      inline: 'span',

      classes: 'example1'

    }, {

      title: 'Example 2',

      inline: 'span',

      classes: 'example2'

    }, {

      title: 'Table styles'

    }, {

      title: 'Table row 1',

      selector: 'tr',

      classes: 'tablerow1'

    }],



    templates: [{

      title: 'Test template 1',

      content: 'Test 1'

    }, {

      title: 'Test template 2',

      content: 'Test 2'

    }],

    content_css: [

    ]

  });





