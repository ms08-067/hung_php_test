var CustomValidationEngine = {

    config:{

        binded: false,

        autoHidePrompt: true,

        autoHideDelay: 3000,

        autoPositionUpdate: true,

        'custom_error_messages':{

            '#TxtDepartment':{

                'min': {

                    'message': 'Vui lòng chọn trò chơi/hệ thống.'

                }

            },

            '#TxtTask':{

                'min': {

                    'message': 'Vui lòng chọn vấn đề.'

                }

            }

        }

    }

};


function addImage()

{

    if($("#gallery input").length >= 3)

    {

        return false;

    }

    var html = '<p><input name="ThreadImageUrl[]" type="file" /></p>';

    $("#gallery").append(html);
    
    $("#gallery input").last().focus();
    
    if($("#gallery input").length >= 3)
    {
        $(".more-image").css('display', 'none');
    }

}



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



function pretty_number(number)

{

    number = Math.floor(number);



    return number_format(number, 0, ",", ".");

}



/*

 * Tooltip script

 * powered by jQuery (http://www.jquery.com)

 *

 * written by Alen Grakalic (http://cssglobe.com)

 *

 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery

 *

 */

this.tooltip = function() {

    /* CONFIG */

    xOffset = 10;

    yOffset = 20;

    // these 2 variable determine popup's distance from the cursor

    // you might want to adjust to get the right result

    /* END CONFIG */

    $(".tooltip").hover(function(e) {

            this.t = this.title;

            this.title = "";

            $("body").append("<p id='tooltip'>" + this.t + "</p>");

            $("#tooltip")

                .css("top", (e.pageY - xOffset) + "px")

                .css("left", (e.pageX + yOffset) + "px")

                .fadeIn("fast");

        },

        function() {

            this.title = this.t;

            $("#tooltip").remove();

        });

    $(".tooltip").mousemove(function(e) {

        $("#tooltip")

            .css("top", (e.pageY - xOffset) + "px")

            .css("left", (e.pageX + yOffset) + "px");

    });

};



// starting the script on page load

$(document).ready(function() {
    tooltip();
});

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

  $(".gototop").click(function(){

      $("html, body").animate({ scrollTop: 0 }, "slow"); 

  });

  $(".error").on("keyup",function(){

    $(this).removeClass('error');

  });

})





