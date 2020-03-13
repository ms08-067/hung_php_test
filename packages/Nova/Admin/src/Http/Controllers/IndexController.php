<?php

namespace Nova\Admin\Http\Controllers;

use App\Http\Controllers\AdminController as AdminController;

use Common\Index\AppRepository;

use View;

use DB;

use Hash;

use Auth;

use Session;

use Redirect;

use Theme;

use Datetime;

use Validator;

use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

class IndexController extends AdminController {



	protected $layout = 'layouts.master';



	public function login()

	{ 
		
		Theme::init("admin");

		

		if(Auth::guard("admin")->check()){

	        return Redirect::route('admin.home');

		}

		return View('admin::login');

	}



	public function logout()

	{

		Auth::guard("admin")->logout();



		//Session::flush();

		//Session::regenerate();



		return Redirect::route('admin.login');

	}


	public function adminInfo(){

		Theme::init("admin");

		$view  = view('admin::admin_info');
		$view->admin = \Nova\Admin\Models\AdminInfo::where("id",1)->first();
		return view($this->layout, ['content' => $view])->with('module',$this->module);

	}

	public function adminInfoSubmit(Request $request){

		$attr = array(
			'admin_name'	   		=> $request->admin_name,
			'admin_email'	   	    => $request->admin_email
		);

	    $validator = Validator::make($request->all(), [
            'admin_name'  => 'required|min:3',
	        'admin_email' => 'required|min:3'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->with("error_message","Invalid params request.");
        }

        $admin = \Nova\Admin\Models\AdminInfo::where("id",1)->update([
        	"admin_name" => $request->admin_name,
        	"admin_email" => $request->admin_email
        ]);
        return Redirect::route('admin.home')->with('success_message', 'Admin info have been updated successful.');
	}


	/**

		@Des: xu ly dang nhap

	*/

	public function logged()

	{

		Theme::init("admin");

		$params = array(

			'email' => Request()->get('LoginEmail'),

			'password' => Request()->get('LoginPassword')

		);

		if(! Auth::guard('admin')->attempt($params))

        {

    		return Redirect::back()->with('flash_error_message', "Login failed.");

    	}



    	$user = \Nova\Admin\Models\Admin::where('email', '=', $params['email'])->first();

		# Login

        $remember = (Request()->get('LoginRememberMe') == 'on') ? true : false;



		Auth::guard('admin')->login($user, true);

		

        return Redirect::route('admin.home');

  

	}



	public function emailTemplate()
	{
		Theme::init("admin");
		$view = View("admin::email_template.list");
		$view->list_template = \Nova\Admin\Models\emailTemplate::orderBy('id', 'desc')->paginate(12);
		return view($this->layout, ['content' => $view])->with('module',$this->module);
	}





	public function addEmailTemplate($id)
	{
		Theme::init("admin");
		$view = View("admin::email_template.add");

		$template = null;
		if(!empty($id)){
			$template = \Nova\Admin\Models\emailTemplate::where('id','=',$id)->first();
		}
		$view->template = $template;
		return view($this->layout, ['content' => $view])->with('module',$this->module);
	}



	public function storemailTemplate(Request $request)
	{
		
		Theme::init("admin");
		
		$template_id = $request->template_id;
		
		if(!empty($template_id)){

			$validator = Validator::make($request->all(), [
	            'subject' => 'required|max:255',
		        'description' => 'required|max:300',
		        'content' => 'required'
	        ]);

	        if ($validator->fails()) {
	            return Redirect::back()->withErrors($validator)->with("flash_error_message","Invalid params request.");
	        }

			$data_update = array(
				'price' => $request->price,
				'name_popup' => $request->name_popup,
				'desc_popup' => $request->desc_popup,
				'subject' => $request->subject,
				'description' => $request->description,
				'content' => $request->content,
				'url_redirect' => $request->url_redirect,
				'message' => $request->message,
				'url_redirect_err' => $request->url_redirect_err,
				'error_msg' => $request->error_msg
			);

			try{
				DB::connection()->getPdo()->beginTransaction();
				\Nova\Admin\Models\emailTemplate::where('id','=',$template_id)->update($data_update);
				//Auth::user()->updateLogActivity(0, "Admin update email template ID: ".$template_id, 3);
				
				DB::connection()->getPdo()->commit();
   				return Redirect::route('admin.emailtemplate')->with('flash_success_message', 'The Template ID = '.$template_id.' have been updated successful.');

			} catch (Exception $e) {

	            DB::connection()->getPdo()->rollBack();
	            $message = ($e->getCode() == 600) ? $e->getMessage() : 'The email template update failed.';
				return Redirect::back()->withInput()->with('flash_error_message', $message);
	        }
		
		} else {

		    $validator = Validator::make($request->all(), [
	            'slug' => 'bail|required|unique:email_template|max:255',
		        'subject' => 'required|max:255',
		        'description' => 'required|max:300',
		        'content' => 'required'
	        ]);

	        if ($validator->fails()) {
	            return Redirect::back()->withErrors($validator)->with("flash_error_message","Invalid params request.");
	        }

			$attribute = array(
				'slug' => $request->slug,
				'price' => $request->price,
				'name_popup' => $request->name_popup,
				'desc_popup' => $request->desc_popup,
				'subject' => $request->subject,
				'description' => $request->description,
				'content' => $request->content,
				'url_redirect' => $request->url_redirect,
				'message' => $request->message,
				'url_redirect_err' => $request->url_redirect_err,
				'error_msg' => $request->error_msg
			);

			try{
				DB::connection()->getPdo()->beginTransaction();
				$emailTemplate = \Nova\Admin\Models\emailTemplate::create($attribute);			 	
	   			DB::connection()->getPdo()->commit();
	   			return Redirect::route('admin.emailtemplate')->with('flash_success_message', 'The email template have been created successful.');

			} catch (Exception $e) {

	            DB::connection()->getPdo()->rollBack();
	            $message = ($e->getCode() == 600) ? $e->getMessage() : 'The email template creation failed.';
				return Redirect::back()->withInput()->with('flash_error_message', $message);
	        }

		} // end else

		return Redirect::route('admin.emailtemplate');
		
	}

	public function delEmailTemplate($tem_id = 0){

		//$tem_id = (int)  Request()->get('tem_id');
		if(empty($tem_id)){
			return Redirect::route('admin.emailtemplate')->with('flash_error_message', 'Not exists email template ID: '.$tem_id);
		}

		try{

			DB::connection()->getPdo()->beginTransaction();
			\Nova\Admin\Models\emailTemplate::where("id", $tem_id)->delete();		

   			DB::connection()->getPdo()->commit();
   			
   			return Redirect::route('admin.emailtemplate')->with('flash_success_message', 'The email template '.$tem_id.' have been deleted successful.');

		} catch (Exception $e) {

            DB::connection()->getPdo()->rollBack();
            $message = ($e->getCode() == 600) ? $e->getMessage() : 'Delete email template '.$tem_id.' failed.';
			return Redirect::route('admin.emailtemplate')->with('flash_error_message', $message);
        }

        return Redirect::route('admin.emailtemplate');

	}

	public function sendEmailTest(Request $request){
		
		$listEmail = $request->email;
		$subject =   $request->subject;
		$content =   $request->content;
		$listEmail = trim($listEmail);
		
		//echo $email;exit;

		if(!empty($listEmail)){
			$listEmail = explode(",", $listEmail);
			foreach ($listEmail as $k => $email) {

				AppRepository::getInstance()->sendMail($email, $subject, $content);
				
			}
			echo json_encode(array(
				"status" => 1,
				"message" => "Successful"
			));
			exit;
		}
		return json_encode(array(
				"status" => 0,
				"message" => "failed"
		));
		exit;
	}


	public function change_pw(){



		Theme::init("admin");



		$view  = view('admin::change_pw');



		return view($this->layout, ['content' => $view])->with('module',$this->module);



	}



	public function changePassSubmit(Request $request){



		$attr = array(

			'now_password'	   		=> Request()->input('TxtPassword'),

			'password'	   			=> Request()->input('password'),

			'password_confirmation' => Request()->input('password_confirmation')

		);



	    $validator = Validator::make($request->all(), [

            'TxtPassword' => 'required|min:6',

	        'password' => 'required|min:6|confirmed'

        ]);



        if ($validator->fails()) {

            return Redirect::back()->withErrors($validator)->with("flash_error_message","Invalid params request.");

        }



		if(! Hash::check($attr["now_password"], Auth::guard("admin")->user()->password)){



			return Redirect::back()->with("flash_error_message","Your current password incorrect.");

		}



		$admin = Auth::guard("admin")->user();



		try{



   			DB::connection()->getPdo()->beginTransaction();

   			$admin->password = Hash::make($attr["password"]);

   			$admin->updated_at = date("Y-m-d H:i:s");

   			$admin->save();

   			DB::connection()->getPdo()->commit();



        }catch (Exception $e) {



            DB::connection()->getPdo()->rollBack();

            $message = ($e->getCode() == 600) ? $e->getMessage() : 'Change password failed. Please contact administration';

			return Redirect::back()->with('flash_error_message', $message);

        }



        return Redirect::back()->with('flash_success_message', 'Change password successful.');	

		



	}



	public function listForm(){



		Theme::init("admin");



		$view  = view('admin::form.listForm');

		$view->listForm = \Nova\Admin\Models\Form::orderBy("id","DESC")->paginate(20);

		return view($this->layout, ['content' => $view])->with('module',$this->module);



	}

	public function jobApply(){

		Theme::init("admin");
		
		$view  = view('admin::job.job_apply');
		$view->listApplyJob = \Nova\Admin\Models\JobApply::orderBy("id","DESC")->paginate(20);
		return view($this->layout, ['content' => $view])->with('module',$this->module);
	}

	public function blogList(Request $request){

		Theme::init("admin");
		
		$view  = view('admin::blog.list');

		$date_from = trim(strip_tags($request->date_from));
		$view->date_from = $date_from;

		$date_to = trim(strip_tags($request->date_to));
		$view->date_to = $date_to;

		$search_by = trim(strip_tags($request->search_by));
		$view->search_by = $search_by;
		//dd($search_by);

		$status = trim(strip_tags($request->status));
		$view->status = $status;

		$cond = [];
		$cond[] = ["id",">",0];
		if($status !== "" && $status !== null){
			$cond[] = ["status","=",$status];
		}

		switch ($search_by) {
			case '1':
				if(!empty($date_from))
					$cond[] = ["published_at",">=",date("Y-m-d H:i:s",strtotime($date_from." 00:00:00"))];			
				
				if($date_to)
					$cond[] = ["published_at","<=",date("Y-m-d H:i:s",strtotime($date_to." 23:59:59"))];	
				
				break;
			case '2':
				if(!empty($date_from))
					$cond[] = ["created_at",">=",date("Y-m-d H:i:s",strtotime($date_from." 00:00:00"))];			
				
				if($date_to)
					$cond[] = ["created_at","<=",date("Y-m-d H:i:s",strtotime($date_to." 23:59:59"))];
				break;
			case '3':
				if(!empty($date_from))
					$cond[] = ["updated_at",">=",date("Y-m-d H:i:s",strtotime($date_from." 00:00:00"))];			
				
				if($date_to)
					$cond[] = ["updated_at","<=",date("Y-m-d H:i:s",strtotime($date_to." 23:59:59"))];
				break;	
			default:
				break;
		}


		$view->search = 0;
		if(!empty($_POST)){
			$view->search = 1;
		}


		$view->listPost = \Nova\Admin\Models\Post::where($cond)->orderBy("id","DESC")->paginate(20);
		return view($this->layout, ['content' => $view])->with('module',$this->module);
	}

	public function configTemplate(){

		Theme::init("admin");
		
		$view  = view('admin::form.config_template');
		$view->formpayment = \Nova\Admin\Models\FormPay::orderBy("id","DESC")->paginate(20);
		return view($this->layout, ['content' => $view])->with('module',$this->module);
	}



	public function viewfrmSubmit(Request $request){

		$id = (int) $request->id;

		$frm = \Nova\Admin\Models\FormSubmited::where("id",$id)->first();

		return view("admin::form.view_form_submited")->with("frm",$frm);

	}

	public function viewJobs($job_id, Request $request){

		//$job_id = (int) $request->job_id;

		$job = \Nova\Admin\Models\Jobs::where("id",$job_id)->first();
		
		//dd($job_id);

		return view("admin::job.view_job")->with("job",$job);

	}

	public function viewEmail(Request $request){

		$frmID = (int) $request->id;

		$frm = \Nova\Admin\Models\Form::where("id",$frmID)->first();

		return view("admin::form.viewEmail")->with("frm",$frm);

	}

	// public function viewEmail(Request $request){
	// 	$id = (int) $request->id;
	// 	$temp = \Nova\Admin\Models\emailTemplate::where("id",$id)->first();
	// 	return view("admin::email_template.view_email")->with("temp",$temp);
	// }

	public function delForm(Request $request){

		

		if(Request()->ajax()){

			$frmID = $request->id;

			\Nova\Admin\Models\Form::where("id",$frmID)->delete();

			return response()->json(array('msg'=> "Deleted successful form ID ".$frmID), 200);

		}

		return Redirect::route("admin.listForm")->with("flash_error_message","Delete failed");

	}


	public function publishBlog(Request $request){

		if(Request()->ajax()){

			$post_id = $request->itemId;
			$status = $request->statusItem;
			
			$data = ["status" => $status];
			if($status == 1){
				$data["published_at"] = date("Y-m-d H:i:s");
			}
			\Nova\Admin\Models\Post::where("id",$post_id)->update($data);
			
			return response()->json(array('msg'=> "successful"), 200);

		}
		return Redirect::route("admin.listJob")->with("flash_error_message","Delete failed");

	}

	public function delBlogSubmited(Request $request){

		if(Request()->ajax()){

			$post_id = $request->id;

			\Nova\Admin\Models\Post::where("id",$post_id)->delete();

			return response()->json(array('msg'=> "Deleted successful ID ".$post_id), 200);

		}

		return Redirect::route("admin.listJob")->with("flash_error_message","Delete failed");

	}


	public function exContactFormSubmited(){
		
		ob_start();

		$formSubmited  = \Nova\Admin\Models\FormPay::all();
		require_once base_path('PHPExcel/PHPExcel.php');

		$objPHPExcel = new \PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getProperties()->setCreator("Ez Web Company")
                 ->setTitle("List Purchase Website")
                 ->setSubject("List Purchase Website")
                 ->setDescription("List Purchase Website");

        $activeSheet = $objPHPExcel->getActiveSheet();
		$activeSheet->mergeCells('A1:R1');
		$activeSheet->setCellValue('A1', "List Purchase Website");
		//$activeSheet->getStyle('A1')->getAlignment()->setHorizontal( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$activeSheet->getStyle('A1')->getFont()->setSize(24);
		$activeSheet->getStyle('A1')->getFont()->setBold(true);
		$activeSheet->setCellValue('A2', 'Name');
		$activeSheet->setCellValue('B2', 'Country');
		$activeSheet->setCellValue('C2', 'Phone');
		$activeSheet->setCellValue('D2', 'Email');
		$activeSheet->setCellValue('E2', 'Membership Link');
		$activeSheet->setCellValue('F2', 'Account Email');
		$activeSheet->setCellValue('G2', 'Domain');
		$activeSheet->setCellValue('H2', 'Hosting');
		$activeSheet->setCellValue('I2', 'Email Forward');
		$activeSheet->setCellValue('J2', 'FB Link');
		$activeSheet->setCellValue('K2', 'WhatApp LInk');
		$activeSheet->setCellValue('L2', 'Youtube Link');
		$activeSheet->setCellValue('M2', 'Pinterest Link');
		$activeSheet->setCellValue('N2', 'Twitter Link');
		$activeSheet->setCellValue('O2', 'Phone Show On Site');
		$activeSheet->setCellValue('P2', 'Business Name');
		$activeSheet->setCellValue('Q2', 'Date Submited');
		$activeSheet->setCellValue('R2', 'Price');
		$styleArray = array(
		    'font'  => array(
		        'bold'  => true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 14,
		        'name'  => 'Times New Roman'
		    ));

		$activeSheet->getStyle('A1')->applyFromArray($styleArray);
		$activeSheet->getRowDimension('1')->setRowHeight(40);
		$activeSheet->getDefaultRowDimension()->setRowHeight(24);

		$index = 2;

        $cols = array('A', 'B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R');

		foreach($cols as $colName){

			$styleArray = array(

		    'font'  => array(

		        'bold'  => true,

		        'color' => array('rgb' => '000000'),

		        'size'  => 13,

		        'name'  => 'Times New Roman'

		    ));

			$activeSheet->getStyle('A2:R2')->applyFromArray($styleArray);
			$activeSheet->getRowDimension('2')->setRowHeight(24);
        	$fill = $activeSheet->getStyle($colName.$index)->getFill();
		    $fill->setFillType( \PHPExcel_Style_Fill::FILL_SOLID);
		    $fill->getStartColor()->setARGB('cccccc');

		    switch ($colName) {
		    	case 'D':
		    		$activeSheet->getColumnDimension($colName)->setWidth(40);
		    		break;	
		    	default:
		    		$activeSheet->getColumnDimension($colName)->setWidth(20);
		    		break;
		    }

		    $style = $activeSheet->getStyle($colName.$index);

		    $style->getFont()->setSize(13);

		    $style->getAlignment()->setHorizontal( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        }

	    if(!empty($formSubmited))
	    {
	    	$index = 3;
	        foreach($formSubmited as $k => $frm)
	        {

                $activeSheet->setCellValue('A'.$index, $frm->name);

                $activeSheet->setCellValue('B'.$index, $frm->country);

                $activeSheet->setCellValue('C'.$index, $frm->phone);
                
                $activeSheet->getStyle('C'.$index)->getAlignment()->setHorizontal( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $activeSheet->setCellValue('D'.$index, $frm->email);

                $activeSheet->setCellValue('E'.$index, $frm->member_link);
                $activeSheet->getStyle('E'.$index)->getAlignment()->setHorizontal( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $activeSheet->setCellValue('E'.$index, $frm->member_link);
                $activeSheet->setCellValue('F'.$index, $frm->account_email);
                $activeSheet->setCellValue('G'.$index, $frm->domain);

                $hosting = ($frm->hosting == 1) ? "Yes" : ($frm->hosting == 0 ? "No" : '');
                
                $activeSheet->setCellValue('H'.$index, $hosting);
                $activeSheet->setCellValue('I'.$index, $frm->email_forward);
                $activeSheet->setCellValue('J'.$index, $frm->fb_link);
                $activeSheet->setCellValue('K'.$index, $frm->whatapp_link);
                $activeSheet->setCellValue('L'.$index, $frm->youtube_link);
                $activeSheet->setCellValue('M'.$index, $frm->pinterest_link);
                $activeSheet->setCellValue('N'.$index, $frm->twitter_link);
                $activeSheet->setCellValue('O'.$index, $frm->phone_show_on_site);
                $activeSheet->setCellValue('P'.$index, $frm->business_name);
                
                $activeSheet->setCellValue('Q'.$index, date('M d, Y H:i', strtotime($frm->created_at)));
                $activeSheet->getStyle('Q'.$index)->getAlignment()->setHorizontal( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
                $activeSheet->setCellValue('R'.$index, "$247");

                $index++;

	        }

	    }

	    $activeSheet->getStyle('A1:R1'.($index-1))
                 ->getAlignment()
                 ->setVertical( \PHPExcel_Style_Alignment::VERTICAL_CENTER);
		
        $fileName = 'list_purchase_website.xlsx';
		$fullPath = 'exelExport/'.$fileName;
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		
		if (ob_get_contents()) ob_end_clean();
		// if (ob_get_length()) ob_end_clean();
		// ob_start();
		$objWriter->save($fullPath);
		$fsize = filesize($fullPath);
	
			
		header("Pragma: public"); // required
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false); // required for certain browsers
		header('Content-Type: application/vnd.ms-excel;');           
		header("Content-type: application/x-msexcel"); 
		header("Content-Disposition: attachment; filename=\"$fileName\";" );
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: ".$fsize);
		flush();
		readfile( $fullPath );
		unlink($fullPath);
		ob_end_flush(); 
		exit;

	}

	public function introTxt(){
		Theme::init("admin");
		$view  = view('admin::job.intro_text');
		
		$view->introTxt = \Nova\Admin\Models\IntroText::where("id",1)->first();
		
		return view($this->layout, ['content' => $view])->with('module',$this->module);
	}

	public function updateBlog($blog_id = 0){

		Theme::init("admin");
		$view  = view('admin::blog.update_blog');
		if(!empty($blog_id)){
			$view->blog = \Nova\Admin\Models\Post::where("id", $blog_id)->first();
		}
		return view($this->layout, ['content' => $view])->with('module',$this->module);
	}

	public function updateBlogSubmit(Request $request){

		$blog_id = (int) $request->blog_id;
		
		$validator = Validator::make($request->all(), [
	        'title'  => 'required',
	        'intro_txt'  => 'required',
	        'content' => 'required',
	        'status' => 'required|in:0,1,2'
	    ]);

		if($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator);
		}

		try{
   			DB::connection()->getPdo()->beginTransaction();
			$dataBlog = [
				"title" => $request->title,
				"slug" => slug($request->job_title),
				"intro_txt" => strip_tags($request->intro_txt,'<p><b><strong><u><i><ul><li><em><h1><h2><h3><h4><h5><h6><a><img><br/><hr><br/>'),
				"content" => strip_tags($request->content,'<p><b><strong><u><i><ul><li><em><h1><h2><h3><h4><h5><h6><a><img><br><hr><br/>'),
				"published_at" => null,
				"status" => $request->status,
				"updated_at" => date("Y-m-d H:i:s")
			];

			if($request->status == 1){
				$dataBlog["published_at"] = !empty($request->published_at) ? date("Y-m-d H:i:s",strtotime($request->published_at)) : null;
			}

			if(!empty($blog_id)){
				\Nova\Admin\Models\Post::where("id",$blog_id)->update($dataBlog);
			}else{
				$dataBlog["created_at"] = date("Y-m-d H:i:s");
				$post = \Nova\Admin\Models\Post::create($dataBlog);
			}

   			DB::connection()->getPdo()->commit();
        }catch (Exception $e) {
            DB::connection()->getPdo()->rollBack();
			return Redirect::back()->withInput()->with('error_message', $e->getMessage());
        }

   		if($request->submit == 1){
   			if(empty($blog_id)) $blog_id = isset($post) ? $post->id : 0;
   			if(!empty($blog_id)){
   				return Redirect::route('admin.updateBlog',[$blog_id])->with('success_message', 'Update Blog ID: '.$blog_id.' successful.');
   			}else{
   				return Redirect::route('admin.blogList')->with('success_message', 'Update Blog ID: '.$blog_id.' successfully.');	
   			}
   			
   		}else{
   			return Redirect::route('admin.blogList')->with('success_message', 'Update Blog ID: '.$blog_id.' successfully.');
   		}
        
	}

	public function introTxtSubmit(Request $request){

		try{
   			DB::connection()->getPdo()->beginTransaction();
			$data = [
				"intro_txt" => strip_tags($request->intro_txt,'<p><b><strong><u><i><ul><li><em><h1><h2><h3><h4><h5><h6><a><img><br><hr><br/>')
			];
			
			$introTxt = \Nova\Admin\Models\IntroText::where("id",1)->first();

			if(!empty($introTxt)){
				\Nova\Admin\Models\IntroText::where("id",$introTxt->id)->update($data);
			}else{
				$data["created_at"] = date("Y-m-d H:i:s");
				$introTxt = \Nova\Admin\Models\IntroText::create($data);
			}
			

   			DB::connection()->getPdo()->commit();
        }catch (Exception $e) {
            DB::connection()->getPdo()->rollBack();
			return Redirect::back()->withInput()->with('error_message', $e->getMessage());
        }

   		return Redirect::route('admin.introTxt')->with('success_message', 'Update success.');
        
	}

	public function updateTemplate($frmID = 0){
		Theme::init("admin");
		$view  = view('admin::form.update_template');
		if(!empty($frmID)){
			$view->frmPay = \Nova\Admin\Models\FormPay::where("id",$frmID)->first();
		}
		return view($this->layout, ['content' => $view])->with('module',$this->module);
	}
	
	public function removeLogoTopBar(Request $request){

		if(Request()->ajax()){

			$itemId = $request->itemId;
			$frmPay = \Nova\Admin\Models\FormPay::where("id",$itemId)->first();
			if(!empty($frmPay)){
				
				if(file_exists(public_path("/images/".$frmPay->logo_top_navbar)))
					unlink(public_path("/images/".$frmPay->logo_top_navbar));

				\Nova\Admin\Models\FormPay::where("id",$itemId)->update([
					"logo_top_navbar" => null
				]);
			}
			return response()->json(array('msg'=> "remove successful"), 200);
			exit;
		}

		return Redirect::route("admin.configTemplate")->with("flash_error_message","remove failed");

	}


	public function removePhotoContact(Request $request){

		if(Request()->ajax()){

			$photo_contact_id = $request->photo_contact_id;
			$frmPay = \Nova\Admin\Models\FormPay::where("id",$photo_contact_id)->first();
			if(!empty($frmPay)){
				
				if(file_exists(public_path("/images/".$frmPay->photo_contact)))
					unlink(public_path("/images/".$frmPay->photo_contact));

				\Nova\Admin\Models\FormPay::where("id",$photo_contact_id)->update([
					"photo_contact" => null
				]);
			}
			return response()->json(array('msg'=> "remove successful"), 200);
			exit;
		}

		return Redirect::route("admin.configTemplate")->with("flash_error_message","remove failed");

	}

	public function updateTemplateSubmit(Request $request){

		$validator = Validator::make($request->all(), [
	        'subject'   => 'required|min:3',
	        'mail_from' => 'nullable|email',
	        'from_name' => 'nullable|min:3',
	        'admin_email' => 'required|min:3',
	        'url_redirect' => 'required',
	        'url_redirect_err' => 'required',
	        'content' => 'required'
	    ]);

	    if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		
		$frmpay_id = (int) Request()->get("frmpay_id");
		$frmpay = \Nova\Admin\Models\FormPay::where('id','=', $frmpay_id)->first();
	
		$data = [
				"note" => $request->note,
				"name" => $request->name,
				"country" => $request->country,
				"phone" => $request->phone,
				"email" => $request->email,
				"domain" => $request->domain,

				"business_name" => $request->business_name,
				"intro_text" => $request->intro_text,
				"color_code" => $request->color_code,
				"member_link"      => $request->member_link,
				//"phone" => $request->phone,
				"fb_link"      => $request->fb_link,
				"youtube_link"      => $request->youtube_link,
				"pinterest_link"    => $request->pinterest_link,
				"twitter_link"      => $request->twitter_link,
				"whatapp_link"      => $request->whatapp_link,

				"vimeo_link"        => $request->vimeo_link,

				"faq_youtube_link1"      => $request->faq_youtube_link1,
				"faq_youtube_link2"      => $request->faq_youtube_link2,
				"faq_youtube_link3"      => $request->faq_youtube_link3,
				"faq_youtube_link4"      => $request->faq_youtube_link4,
				"faq_youtube_link5"      => $request->faq_youtube_link5,

				"phone_show_on_site" => $request->phone_show_on_site,
				"des_metatag_home_page" => $request->des_metatag_home_page,
				"des_metatag_faq_page" => $request->des_metatag_faq_page,
				"subject" => $request->subject,
				"mail_from" => $request->mail_from,
				"from_name" => $request->from_name,
				"url_redirect" => $request->url_redirect,
				"url_redirect_err" => $request->url_redirect_err,
				"admin_email" => $request->admin_email,
				"content" => $request->content,
				"term" => $request->term
 			];

 		$upload_path = public_path().'/images/';
        
        $files = isset($_FILES['logo_top_navbar']) ? $_FILES['logo_top_navbar'] : '';
        if(!empty($files) && isset($files['name'])  && !empty($files['name']) ) {
            if(!is_dir($upload_path))
                mkdir($upload_path,0755, true); 
            
            $img = $files['name'];
            $tmp_img = $files['tmp_name'];
            move_uploaded_file($tmp_img, $upload_path.$img);
            $data["logo_top_navbar"] = $img;
        	
        }

        $file_photo_contact = isset($_FILES['photo_contact']) ? $_FILES['photo_contact'] : '';
        if(!empty($file_photo_contact) && isset($file_photo_contact['name'])  && !empty($file_photo_contact['name']) ) {
            if(!is_dir($upload_path))
                mkdir($upload_path,0755, true); 
            
            $img = $file_photo_contact['name'];
            $tmp_img = $file_photo_contact['tmp_name'];
            move_uploaded_file($tmp_img, $upload_path.$img);
            $data["photo_contact"] = $img;
        	
        }
        
		if(empty($frmpay)){
			$data["come_from"] = 2;
			$data["created_at"] = date("Y-m-d H:i:s");
			\Nova\Admin\Models\FormPay::create($data);

 			$msg = "Add new configuration for website successful";
		}else{

			\Nova\Admin\Models\FormPay::where("id", $frmpay_id)->update($data);
			$msg = "Update configuration for website successful.";
		}

		if(($request->submit == 1) && !empty($frmpay) ){
			return Redirect::back()->with("success_message",$msg);	
		}

		return Redirect::route("admin.configTemplate")->with("success_message",$msg);
        
	}

	public function newForm($frmID = 1){



		Theme::init("admin");



		$view  = view('admin::form.newForm');

		if(!empty($frmID)){

			$view->frm = \Nova\Admin\Models\Form::where("id",$frmID)->first();

		}

		return view($this->layout, ['content' => $view])->with('module',$this->module);

	}



	public function newFromSubmit(Request $request){

		$validator = Validator::make($request->all(), [
	        'subject'   => 'required|min:3',
	        'mail_from' => 'nullable|email',
	        'from_name' => 'nullable|min:3',
	        'admin_email' => 'required|min:3'
	    ]);

	    if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		
		$frmID = (int) Request()->get("frmID");

		$frm = \Nova\Admin\Models\Form::where('id','=', $frmID)->first();
		
		$data = [
			"note" => $request->note,
			"subject" => $request->subject,
			"mail_from" => $request->mail_from,
			"from_name" => $request->from_name,
			"url_redirect" => $request->url_redirect,
			"url_redirect_err" => $request->url_redirect_err,
			"admin_email" => $request->admin_email,
			"content" => $request->content
 		];

		if(empty($frm)){

			\Nova\Admin\Models\Form::create();

 			$msg = "Add new form successful";
		}else{

			$frm->note = $request->note;
			$frm->subject = $request->subject;
			$frm->mail_from = $request->mail_from;
			$frm->from_name = $request->from_name;
			$frm->url_redirect = $request->url_redirect;
			$frm->message = $request->message;
			$frm->url_redirect_err = $request->url_redirect_err;
			$frm->error_msg = $request->error_msg;
			$frm->admin_email = $request->admin_email;
			$frm->content = $request->content;
			$frm->save();
			$msg = "Your form has been updated.";
		}
		if($request->submit == 1){
			return Redirect::back()->with("success_message",$msg);	
		}

		if($request->submit == 2){
			return Redirect::route("admin.listForm")->with("success_message",$msg);	
		}
        
	}

	public function settingPriceSubmit(Request $request){

		

		$attr = array(

			'price_1' =>  (int) Request()->input('price_1'),

            'price_2' =>  (int) Request()->input('price_2'),

	        'password' => Request()->input('password')

		);



	    $validator = Validator::make($request->all(), [

            'price_1' => 'required|integer|min:0',

            'price_2' => 'required|integer|min:0',

	        'password' => 'required|min:6'

        ]);



        if ($validator->fails()) {

            return Redirect::back()->withErrors($validator)->withInput()->with("flash_error_message","Invalid params request.");

        }

		if(! Hash::check($attr["password"], Auth::guard("admin")->user()->password)){



			return Redirect::back()->withInput()->with("flash_error_message","Your password incorrect.");

		}

		try{

   			DB::connection()->getPdo()->beginTransaction();

   			$price = \Nova\Admin\Models\Price::where("id",1)->first();

   			

   			if(!empty($price)){
   				$price->price_1 = $attr["price_1"];

   				$price->price_2 = $attr["price_2"];

   				$price->updated_at = date("Y-m-d H:i:s");

   				$price->save();



   			}else{

   				\Nova\Admin\Models\Price::create(array(

   					"id" => 1,
   					"price_1" => $attr["price_1"],
   					"price_2" => $attr["price_2"],
   					"created_at" => date("Y-m-d H:i:s"),
   					"updated_at" => date("Y-m-d H:i:s")

   				));

   			}

   			DB::connection()->getPdo()->commit();



        }catch (Exception $e) {



            DB::connection()->getPdo()->rollBack();

			return Redirect::back()->with('flash_error_message', "Update price failed");

        }



        return Redirect::back()->with('flash_success_message', 'Update price successful.');	

		



	}



	public function listUser()

	{

		Theme::init("admin");

		$view = View("admin::listUser");

		$view->list_users = \Nova\User\Models\User::orderBy('id', 'desc')->paginate(12);

		return view($this->layout, ['content' => $view])->with('module',$this->module);

	}



	public function listSubscribe()

	{

		Theme::init("admin");

		$view = View("admin::listSubscribe");

		$view->list_subscribe = \Nova\User\Models\UserSubscribe::orderBy('id', 'desc')->paginate(12);

		return view($this->layout, ['content' => $view])->with('module',$this->module);

	}

	

	public function videolist()

	{ 

		Theme::init("admin");

		$view  = view('admin::videolist');

		$view->customChannelID = AppRepository::getInstance()->generateRandom(24);

		

		$arr_condition = array();

		

		if( !empty(Request()->get("videoId")) ){



			$arr_condition["videoId"] = Request()->get("videoId");

		}



		if( !empty(Request()->get("channelId")) ){

			

			$arr_condition["channelId"] = Request()->get("channelId");

		}



		$view->arr_condition = $arr_condition;



		if(!empty($arr_condition)) {



			$view->list_video = \Nova\Admin\Models\VideoVimeo::where($arr_condition)->orderBy('id', 'desc')->paginate(12);

		} else {



			$view->list_video = \Nova\Admin\Models\VideoVimeo::orderBy('id', 'desc')->paginate(12);

		}



		$list_custom_channel = \Nova\Admin\Models\ChannelVimeo::where("public_flag",1)->orderBy("id","DESC")->get();

		

		$arr_customChannel = array("0" => "Select Category");

		if( !empty($list_custom_channel) ){

			foreach ($list_custom_channel as $customChannel) {

				$arr_customChannel[$customChannel->channelId] = (strlen($customChannel->title) > 40) ? substr($customChannel->title,0,37)."..." : $customChannel->title;	

			}

		}

		$view->arr_customChannel = $arr_customChannel;



		return view($this->layout, ['content' => $view])->with('module',$this->module);

	}

}

