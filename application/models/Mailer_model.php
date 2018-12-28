<?php

class Mailer_model extends CI_Model
{
	function __construct()
	{
		$this->load->database();
        $this->load->library('session');
        $this->load->library('email');
        $this->load->library('Phpmailer');
	}

		public function assignment_start_mail($assignment_name,$number_of_level,$level_name,$name,$email)
		{
		try {
					$mail = new PHPMailer();
					$to =$email;
					$subject = 'Level Start';
					$date = date('Y-m-d');
					$date1=strtotime($date);
					$date2=date("F d, Y ", $date1);			
					$data['name']=$name;
					$data['assignment_name']=$assignment_name;
					$data['number_of_level']=$number_of_level;
					$data['level_name']=$level_name;
					$data['to']=$to;
					$message=$this->load->view('mailer/assignment-start',$data,true);
					$mail->IsSMTP();
					$mail->Host = "mondaymorning.in";
					$mail->SMTPAuth = true;
					$mail->Port = 587;
					$mail->Username = "mondaymorning@mondaymorning.in";
					$mail->Password = "monday@01";
					$mail->From = "mondaymorning@mondaymorning.in";
					$mail->FromName = $subject;
					$mail->AddAddress($to);
					$mail->IsHTML(true);
					$mail->Subject = $subject;
					$mail->Body = $message;
					//if(!$mail->Send())
					//{
					//echo "Message could not be sent. <p>";
					//echo "Mailer Error: " . $mail->ErrorInfo;
					//} 

					#############################new mailer ###############
			}
		catch(Exception $e)
	         {
	             echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	         }
		}

		public function assignment_end_mail($assignment_name,$number_of_level,$level_name,$name,$username)
		{
			try {
					$mail = new PHPMailer();
					$to =$username;
					$subject = 'Level Completion';
					$from = 'mondaymorning@mondaymorning.in';
					$date = date('Y-m-d');
					$date1=strtotime($date);
					$date2=date("F d, Y ", $date1);
					$data['name']=$name;
					$data['number_of_level']=$number_of_level;
					$data['level_name']=$level_name;
					$data['to']=$to;
					$message=$this->load->view('mailer/assignment-end1',$data,true);
					$mail->IsSMTP();
					$mail->Host = "mondaymorning.in";
					$mail->SMTPAuth = true;
					$mail->Port = 587;
					$mail->Username = "mondaymorning@mondaymorning.in";
					$mail->Password = "monday@01";
					$mail->From = "mondaymorning@mondaymorning.in";
					$mail->FromName = $subject;
					$mail->AddAddress($to);
					$mail->IsHTML(true);
					$mail->Subject = $subject;
					$mail->Body = $message;
					//if(!$mail->Send())
					//{
					//echo "Message could not be sent. <p>";
					//echo "Mailer Error: " . $mail->ErrorInfo;
					//}
					
					// mail($to, $subject, $message, $headers);
			}
		catch(Exception $e)
	         {
	             echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	         }
		}

	public function ticket_mail($field,$username,$email)
		{
		try {
					$mail = new PHPMailer();
					$to =$email;
					$subject = 'Ticket';
				
					$from = 'support@mondaymorning.in';
					$date = date('Y-m-d');
					$date1=strtotime($date);
					$date2=date("F d, Y ", $date1);
					
					// To send HTML mail, the Content-type header must be set
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= 'From: '.$from."\r\n".
					'Reply-To: '.$from."\r\n" .
					'X-Mailer: PHP/' . phpversion();
					// Create email headers
					$data['ticket_sequence_no']=$field;
					$data['username']=$username;
					$data['email']=$email;
					$message=$this->load->view('mailer/ticket',$data,true);
					mail($to, $subject, $message, $headers);
					$data['ticket_sequence_no']=$field;
					$data['username']=$username;
					$data['email']=$email;
					$message=$this->load->view('mailer/ticket',$data,true);
					$mail->IsSMTP();
					$mail->Host = "smtp.gmail.com";
					$mail->SMTPAuth = true;
					$mail->SMTPSecure = 'tls';
					$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
					$mail->Port = 587;
					$mail->Username = "support@mondaymorning.in";
					$mail->Password = "Support123@";
					$mail->From = "support@mondaymorning.in";
					$mail->FromName = $subject;
					$mail->AddAddress($to);
					$mail->IsHTML(true);
					$mail->Subject = $subject;
					$mail->Body = $message;
					if(!$mail->Send())
					{
					echo "Message could not be sent. <p>";
					echo "Mailer Error: " . $mail->ErrorInfo;
					}
			}
		catch(Exception $e)
	         {
	             echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
	         }
		}
		
	public function admin_mail($array_support,$field,$depart_id,$subject,$priority,$username,$email,$msg,$attachs,$mobile)
	{
		try {
			$mail = new PHPMailer();
			// $to =implode(',',$array_support);
			// print_r($to);
			// die();
			$to='support@mondaymorning.in';

			
			$subject = $subject;

			$from = 'support@mondaymorning.in';
			$date = date('Y-m-d');

			$date1=strtotime($date);
			$date2=date("F d, Y ", $date1);


			$path = base_url().'upload/';
			if($attachs!=''){
				$filename = $attachs;
				$file = $path.$filename;
				$myAttachment = chunk_split(base64_encode(file_get_contents( $file )));
				$mail->addAttachment($myAttachment, 'image/jpeg'); 
			}
			$data['ticket_id']=$field;
			$data['username']=$username;
			$data['email']=$email;
			$data['priority']=$priority;
			$data['depart_id']=$depart_id;
			$data['subject']=$subject;
			$data['array_support']=$array_support;
			$data['msg']=$msg;
			$data['mobile']=$mobile;
			$message=$this->load->view('mailer/admin-ticket',$data,true);
			$mail->IsSMTP();
			$mail->Host = "smtp.gmail.com"; 
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->Port = 587;
			$mail->Username = "support@mondaymorning.in";
			$mail->Password = "Support123@";
			$mail->From = "support@mondaymorning.in";
			$mail->FromName = $subject;
			$mail->AddAddress($to);
			$mail->AddCC('sheetanshu@mondaymorning.in');
			$mail->IsHTML(true);
			$mail->Subject = $subject;
			
			$mail->Body = $message;
			if(!$mail->Send())
			{
			echo "Message could not be sent. <p>";
			echo "Mailer Error: " . $mail->ErrorInfo;
			}
		}
		catch(Exception $e)
		{
			echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
		}
	}

public function referral_mail($email,$name_of_honer,$link)
	{
		try {
		
			$mail = new PHPMailer();
			$to =$email;
			$subject = $this->session->userdata('name_user').' referred you - Join Mondaymorning!';
			$from = 'mondaymorning@mondaymorning.in';
			
			$data['to']=$to;
			$data['link']=$link;
			$data['name']=$name_of_honer;
			$message=$this->load->view('mailer/referral',$data,true);
			$mail->IsSMTP();
            $mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->Port = 587;
			$mail->Username="mondaymorning@mondaymorning.in";
			$mail->Password="mondaymorning2017";
			$mail->From="mondaymorning@mondaymorning.in";
			$mail->FromName = $subject;
			$mail->AddAddress($to);
			$mail->IsHTML(true);
			$mail->Subject = $subject;
			$mail->Body = $message;
			if($mail->Send()){
				return 1;	 
			}else{
				return 0;
			}
			

		}
		catch(Exception $e)
		{
			echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
		}
	}
	public function employer_mail($subject,$authkey,$email,$pwd,$name) // mail at registration time for email verification
	{
		try {
			$mail = new PHPMailer();
			$to=$email; 
			$subject = $subject;
			$from = 'jobs@mondaymorning.in';
			$date = date('Y-m-d');
			$date1=strtotime($date);
			$date2=date("F d, Y ", $date1);
			$data['email']=$email;
			$data['password']=$pwd;
			$data['date']=$date2;
			$data['authkey']=$authkey;
			$data['emp_name']=$name;

			$data['subject']=$subject;
	
		    $message=$this->load->view('mailer/welcome',$data,true);

			$mail->IsSMTP();
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->Port = 587;
			$mail->Username = "jobs@mondaymorning.in";
			$mail->Password = "mmJobs@123
";
			$mail->From = "jobs@mondaymorning.in";
			$mail->FromName = $subject;
			$mail->AddAddress($to);
			$mail->AddCC('sheetanshu@mondaymorning.in');
			$mail->AddCC('righthire@mondaymorning.in');
			$mail->IsHTML(true);
			$mail->Subject = $subject; 
			$mail->Body = $message;
			if(!$mail->Send()){
			echo "Message could not be sent. <p>";
			echo "Mailer Error: " . $mail->ErrorInfo;
			}

		}
		catch(Exception $e)
		{
			echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
		}
	}

/**Employer Account Activation Mail**/
public function employer_account_activation_mail($subject,$email,$name)
{
try {
$mail = new PHPMailer();
$to=$email;
$subject = $subject;
$from = 'mondaymorning@mondaymorning.in';
$date = date('Y-m-d');
$date1=strtotime($date);
$date2=date("F d, Y ", $date1);
$data['email']=$email;
$data['emp_name']=$name;
$data['date']=$date2;
$data['subject']=$subject;
$message=$this->load->view('mailer/employer_account_activation_mailer',$data,true);
$mail->IsSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->Port = 587;
$mail->Username = "jobs@mondaymorning.in";
$mail->Password = "mmJobs@123";
$mail->From = "jobs@mondaymorning.in";
$mail->FromName = $subject;
$mail->AddAddress($to);
$mail->AddCC('sheetanshu@mondaymorning.in');
	$mail->AddCC('righthire@mondaymorning.in');
$mail->IsHTML(true);
$mail->Subject = $subject;
$mail->Body = $message;
if(!$mail->Send())
{
echo "Message could not be sent. <p>";
echo "Mailer Error: " . $mail->ErrorInfo;
}

}
catch(Exception $e)
{
echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
}
}	

// mail at schedule data to applicant    
public function schedule_mail_to_user($data){    
        $mail = new PHPMailer();
        $to=$data['user_email'];    
        $subject = $data['emp_compnay'].'|'.$data['mode'].'|'.date("F d,Y h:i A",strtotime($data['schedule_date'].' '.$data['schedule_time']));
        $from = 'mondaymorning@mondaymorning.in';
        $message=$this->load->view('mailer/schedule_mail_to_user',$data,true);
        $mail->IsSMTP();
        $mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->Port = 587;
			$mail->Username = "jobs@mondaymorning.in";
			$mail->Password = "mmJobs@123
";
			$mail->From = "jobs@mondaymorning.in";
        $mail->FromName = $subject;
        $mail->AddAddress($to);
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        if($mail->Send()){
            return 1;
        }else{
            return 0;
        }
        
    }
public function reschedule_mail_to_user($data){    
        $mail = new PHPMailer();
        $to=$data['user_email'];    
        $subject = $data['emp_compnay'].'|'.$data['mode'].'| reschedule '.date("F d,Y h:i A",strtotime($data['old_schedule_date'].' '.$data['old_schedule_time']));
        $from = 'mondaymorning@mondaymorning.in';
        $message=$this->load->view('mailer/reschedule_mail_to_user',$data,true);
        $mail->IsSMTP();
        $mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->Port = 587;
			$mail->Username = "jobs@mondaymorning.in";
			$mail->Password = "mmJobs@123
";
			$mail->From = "jobs@mondaymorning.in";
        $mail->FromName = $subject;
        $mail->AddAddress($to);
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        if($mail->Send()){
            return 1;
        }else{
            return 0;
        }
    }

public function send_offer_letter($full_path,$file_name,$data){    
        $mail = new PHPMailer();
        $full_path = (file_get_contents($full_path));
        $to=$data['user_email'];    
        $subject =$data['emp_compnay'].'|'.'Offer letter';
        $from = 'mondaymorning@mondaymorning.in';
        $message=$this->load->view('mailer/offer_letter_to_user',$data,true);
        $mail->IsSMTP();
       $mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->Port = 587;
			$mail->Username = "jobs@mondaymorning.in";
			$mail->Password = "mmJobs@123
";
			$mail->From = "jobs@mondaymorning.in";
        $mail->FromName = $subject;
        $mail->AddAddress($to);
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->addstringAttachment($full_path,$file_name); 
        $mail->Body = $message;
        if($mail->Send()){
            return 1;
        }else{
            return 0;
        }
        
    }
public function shortlist_mail($data){    
        $mail = new PHPMailer();
        $to=$data['user_email'];    
        $subject = $data['emp_compnay'].'|'.'shotlisted';
        $from = 'mondaymorning@mondaymorning.in';
        $message=$this->load->view('mailer/shortlist_mail_to_user',$data,true);
        $mail->IsSMTP();
        $mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
		$mail->Port = 587;
		$mail->Username = "jobs@mondaymorning.in";
		$mail->Password = "mmJobs@123";
		$mail->From = "jobs@mondaymorning.in";
        $mail->FromName = $subject;
        $mail->AddAddress($to);
        $mail->IsHTML(true);
        $mail->Subject = $subject; 
        $mail->Body = $message;
        if($mail->Send()){
            return 1;
        }else{
            return 0;
        }
        
    }
public function interview_final_mail($data){    
        $mail = new PHPMailer();
        $to=$data['user_email'];    
        $subject = $data['emp_compnay'].'|'.'shotlisted';
        $from = 'mondaymorning@mondaymorning.in';
        $message=$this->load->view('mailer/interview_final_mail_to_user',$data,true);
        $mail->IsSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
		$mail->Port = 587;
		$mail->Username = "jobs@mondaymorning.in";
		$mail->Password = "mmJobs@123";
		$mail->From = "jobs@mondaymorning.in";
        $mail->FromName = $subject;
        $mail->AddAddress($to);
        $mail->IsHTML(true);
        $mail->Subject = $subject; 
        $mail->Body = $message;
        if($mail->Send()){
            return 1;
        }else{
            return 0;
        }
        
    }

//  subjective score mail 
public function subjective_mail($level_name,$email,$name,$package_name,$ass_name,$href)
    {
        try {                                       
            $mail = new PHPMailer();
            $to=$email;
            $subject = 'MondayMorning | Case Study evaluated';
            $from = 'info@mondaymorning.in';
            $date = date('Y-m-d');
            $date1=strtotime($date);
            $date2=date("F d, Y ", $date1);
            $data['email']=$email;
            $data['name']=$name; 
            $data['level_name']=$level_name;
            $data['date']=$date2;
            $data['package_name']=$package_name;
            $data['assignment_name']=$ass_name;
            $data['link']=$href;
            $data['subject']='MondayMorning | Case Study evaluated';
            $message=$this->load->view('mailer/subjective-check-notification-mail',$data,true);
            $mail->IsSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Port = 587;
			$mail->SMTPDebug = 1;
			$mail->SMTPSecure = 'tls';
            $mail->Username = "info@mondaymorning.in";
            $mail->Password = "Info@123";
            $mail->From = "info@mondaymorning.in";
            $mail->FromName = $subject;
            $mail->AddAddress($to);
            $mail->IsHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;
            if(!$mail->Send()){
				echo "Message could not be sent. <p>";
				echo "Mailer Error: " . $mail->ErrorInfo;
				exit();
            }
        }catch(Exception $e){
            echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
        }
    }
   public function employer_job_status_mail($subject,$eid,$email,$name,$job_id,$job_title,$created_date,$modified_date,$status,$reason)
    {
        try {
            $mail = new PHPMailer();
            $to=$email;
            $subject = $subject;
            $from = 'mondaymorning@mondaymorning.co.in';
            $date = date('Y-m-d');
            $date1=strtotime($date);
            $date2=date("F d, Y ", $date1);
            $data['email']=$email;
            $data['name']=$name;
            $data['date']=$date2;
            $data['subject']=$subject;
            $data['job_id']=$job_id;
            $data['employer_id']=$employer_id;
            $data['job_title']=$job_title;
            $data['created_date']=$created_date;
            $data['modified_date']=$modified_date;
            $data['status']=$status;
            $data['reason']=$reason;
            $message=$this->load->view('mailer/employer_job_status_mailer',$data,true);
            $mail->IsSMTP();
            $mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->Port = 587;
			$mail->Username = "jobs@mondaymorning.in";
			$mail->Password = "mmJobs@123";
			$mail->From = "jobs@mondaymorning.in";
            $mail->FromName = $subject;
            $mail->AddAddress($to);
            $mail->AddCC('sheetanshu@mondaymorning.in');
            $mail->IsHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;
            if(!$mail->Send()){
				echo "Message could not be sent. <p>";
				echo "Mailer Error: " . $mail->ErrorInfo;
            }
        }catch(Exception $e){
            echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
        }
    }        
         
public function demo_mailer($neurons_report,$certi_report,$job_report,$email,$name,$pass){
		try {
		$data['job_report']=$job_report; 
		$data['certi_report']=$certi_report;
		$data['neurons_report']=$neurons_report;
		//$uid=$this->Crud_modal->user_data_insert1("user",$field);
		$package_id=28;
		//$this->Userlogin_modal->sign_in_by_demopackage($email);	
      	$uid=$this->session->userdata('mm_uid');
      	//$this->demo_package_data($uid);
      	$neurons_report=$this->Crud_modal->all_data_select("*","score","package_id='$package_id' and u_id='$uid'","score_id ASC");
      	$certi_report=$this->Crud_modal->fetchdata_with_limit("*","mm_master_certification","status='1'","certification_id ASC","9");
      	$job_report=$this->Crud_modal->fetchdata_with_limit("*","mm_master_job","status='1'","job_id ASC","5");

	      	###################end class;
     	// $package_det=$this->Crud_modal->fetch_single_data("*","mm_packages","package_id='20'");
		// $maid_ex=$package_det['ma_id'];
		// $datalevel=$this->Crud_modal->all_data_select('*','master_level',"maid in($maid_ex)",'ml_id asc');
		// $data_array=array();
		// $k=0;
		// for($i=0;$i<sizeof($datalevel);$i++){
			// if(sizeof($data_array)>0){
				// $val=-1;
				// for ($dd=0; $dd <sizeof($data_array) ; $dd++) { 
					// if($data_array[$dd]['skills']==$datalevel[$i]['skills']){
						 // $val=$dd;
						 // break;
					// }
				// }
				// if($val!=-1){
					// if($data_array[$val]['skills']==$datalevel[$i]['skills']){
					 // $data_array[$val]['level_id']=$datalevel[$i]['ml_id'].",".$datalevel[$val]['ml_id'];
					// }
				// }else{
					// $data_array[$k]['skills']=$datalevel[$i]['skills'];
					// $data_array[$k]['level_id']=$datalevel[$i]['ml_id'];
					// $k++;	
				// }
				// }else{
					// $data_array[$k]['skills']=$datalevel[$i]['skills'];
					// $data_array[$k]['level_id']=$datalevel[$i]['ml_id'];
					// $k++;
				// }	
		// }
		// for ($sk=0; $sk <sizeof($data_array) ; $sk++) {
			// $level_id=$data_array[$sk]['level_id'];
			// $skills_id=$data_array[$sk]['skills'];
			// ########### average nerons per skill ###############
			// $sum_total=$this->Crud_modal->all_data_select('sum(total_level_marks) as total_level_marks','score',"level_id in($level_id)",'score_id asc');
			// $total_neurons[$sk]=$sum_total[0]['total_level_marks'];
			// $total_neu_per[$sk]=100;
			// $count_distinct=$this->Crud_modal->all_data_select('count(distinct(u_id)) as uid','score',"level_id in($level_id)",'score_id asc');
			// $sum_skills=$this->Crud_modal->all_data_select('sum(neurons) as neurons','score',"level_id in($level_id)",'score_id asc');
			// $skill_name=$this->Crud_modal->fetch_single_data("skills_name","master_skills_test","skills_id='$skills_id'");
			// $data_val[$sk]=round(($sum_skills[0]['neurons']*100)/($total_neurons[$sk]*$count_distinct[0]['uid']));
			// $data_val_skills[$sk]=$skill_name['skills_name'];
			// ########### average nerons per skill ###############
			// ########### user nerons per skill ###############
			// $sum_skills_user=$this->Crud_modal->all_data_select('sum(neurons) as neurons','score',"level_id in($level_id) and u_id='$uid'",'score_id asc');
			// $skill_name=$this->Crud_modal->fetch_single_data("skills_name","master_skills_test","skills_id='$skills_id'");
			// $data_val_user[$sk]=round(($sum_skills_user[0]['neurons']*100)/($total_neurons[$sk]));
			// $data_color3[$sk]="#f2f2f2";
           	// if($data_val[$sk]>$data_val_user[$sk]){
           		// $data_color1[$sk]="#7bd27c";
           		// $data_color2[$sk]="#7bd27c";
           	// }else{
           		// $data_color1[$sk]="#f9ba76";
           		// $data_color2[$sk]="#f9ba76";
           	// }
			// ########### user nerons per skill ###############
			// }
			// $data['user_response']=$data_val_user;
			// $data['avg_response']=$data_val;
			// $data['skills']=$data_val_skills;
			// $data['total_skills']=$total_neu_per;
			// $data['data_color1']=$data_color1;
			// $data['data_color2']=$data_color2;
			// $data['data_color3']=$data_color3;                              
			$mail = new PHPMailer();
			$to=$email;
			$uid=$this->session->userdata('mm_uid');
			$data_neurons=$this->Crud_modal->fetch_single_data("*", "neurons","u_id='$uid'");
			$data['neurons']=$data_neurons['neurons'];
			$subject = 'MondayMorning | Your Exercise report'; 
			$from = 'mondaymorning@mondaymorning.in';
			$date = date('Y-m-d');
			$date1=strtotime($date);
			$date2=date("F d, Y", $date1);
			$data['email']=$email;
			$data['name']=$name;
			$data['date']=$date2;
			$data['password']=$pass;
			$message=$this->load->view('mailer/demo-mailer',$data,true);
			$mail->IsSMTP();
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->Port = 587;
			$mail->Username = "mondaymorning@mondaymorning.in";
			$mail->Password = "mondaymorning2017";
			$mail->From = "mondaymorning@mondaymorning.in";
			$mail->FromName = $subject;
			$mail->AddAddress($email);
			$mail->IsHTML(true);
			$mail->Subject = $subject;
			$mail->Body = $message;
			if($mail->Send()){
				return 1;
			}

		}
		catch(Exception $e)
		{
			echo 'Caught exception: ',  $this->$e->getMessage(), "\n";
		}
	} 

public function eligible_job_mail($job_title,$job_id){			
			$mail = new PHPMailer();
			$to=$this->session->userdata('u_email');
			$subject = "MondayMorning: Apply on Job";
			$from = 'mondaymorning@mondaymorning.in';			
			$data['name']=$this->session->userdata('name_user');
			$data['date']=date("F d, Y ");
			$data['subject']=$subject;
			$data['job_title']=$job_title;
			$data['job_id']=$job_id;
			$message=$this->load->view('mailer/eligible_job_mail',$data,true);
			$mail->IsSMTP();
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->Port = 587;
			$mail->Username = "jobs@mondaymorning.in";
			$mail->Password = "mmJobs@123";
			$mail->From = "jobs@mondaymorning.in";
			$mail->FromName = $subject;
			$mail->AddAddress($to);
			$mail->AddCC('jobs@mondaymorning.in');
			$mail->IsHTML(true);
			$mail->Subject = $subject;
			$mail->Body = $message;
			if($mail->Send()){
				return 1;
			}			
	}	
	public function testmail($to,$subject,$message){    
        $mail = new PHPMailer();
        // $to='shafik.m@mondaymorning.in';    
        // $subject = 'test mail';
        // echo $to;
        // echo $message;
        $from = 'uexefm@gmail.com';
        // $message='hai';
        $mail->IsSMTP();
        $mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
		$mail->Port = 587;
		$mail->Username = "uexefm@gmail.com";
		$mail->Password = "voda4g@123";
		$mail->From = "uexefm@gmail.com";
        $mail->FromName = $subject;
        $mail->AddAddress($to);
        $mail->IsHTML(true);
        $mail->Subject = $subject; 
        $mail->Body = $message;
        if($mail->Send()){
            return 1;
        }else{
            return 0;
        }
        
    }

}

?>