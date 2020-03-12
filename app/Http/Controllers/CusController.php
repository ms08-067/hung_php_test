<?php
namespace App\Http\Controllers;
use Extend\DetectMobile\Detect;
use Illuminate\Routing\Controller;

class CusController extends Controller {

	protected $module;

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
	
		if ( ! is_null($this->layout) )
		{

			if(Request()->has('popup'))
			{
			
				switch(Request()->input('popup')){
					
					case 2: 
						$this->layout = 'layout.popup2';
						break;
					default: 
						$this->layout = 'layout.popup';
				}
				
			}

			$this->layout = View($this->layout)->with('mainModule', $this->module);
		}
	}

	private function _detectVersionStyle()
	{
		$detect = new Detect;

		if($detect->isMobile())
		{
 			return 'mobile';
		}

		return 'pc';
	}
}