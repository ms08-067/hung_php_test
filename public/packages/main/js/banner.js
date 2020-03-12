var CustomValidationEngine = {
    config:{
        binded: false,
        autoHidePrompt: true,
        autoHideDelay: 3000,
        showOneMessage: true,
        autoPositionUpdate: true,
        'custom_error_messages':{
            '#TxtServer':{
                'min': {
                    'message': 'Vui lòng chọn máy chủ.'
                }
            },
            '#TxtTask':{
                'min': {
                    'message': 'Vui lòng chọn vấn đề.'
                }
            },
            '#TxtAnswer_confirmation':{
                'equals': {
                    'message': 'Câu trả lời không khớp.'
                }
            }
        }
    }
};

function closePopup()
{
	$("#registry-form").css('display', 'none');
    $("#divClickFrame").css('display', 'block');
}

function changeCaptcha()
{
	$(".img-captcha").attr('src', $(".img-captcha").attr('src'));
}

function NOclickIE()
{
	if (event.button==2)
	{
		return false;
	}
}

function NOclickNN(e)
{
	if (document.layers||document.getElementById&&!document.all)
	{
		if (e.which==2||e.which==3)
		{
			return false;
		}
	}
}

// Prevent from right mouse
if(preventFromRightMouse)
{
if (document.layers)
{
	document.captureEvents(Event.MOUSEDOWN);
	document.onmousedown=NOclickNN;
}else if(document.all&&!document.getElementById)
{
	document.onmousedown=NOclickIE;
}

document.oncontextmenu = new Function("return false");
}

// Before unload needs confirm
try{
	window.onbeforeunload = function()
	{
		if(preventFromExit)
		{
	    	return "Đăng ký chơi game ngay bây giờ để có những trải nghiệm mới nhất.";
		}
	}
} catch (e) {}