<?php 
/**
 * 
 */
class A_fetchfrombothtbl extends CI_controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('B_fetchfrombothtbl');
	}
	public function index()
	{
$data['user']=$this->B_fetchfrombothtbl->fetchfromtwotbl();

// Array ( [0] => Array ( [job_name] => php [job_description] => server site scripting language [employer_name] => ghanshyam [employer_comany] => google ) [1] => Array ( [job_name] => java [job_description] => server site programming language [employer_name] => ghanshyam [employer_comany] => google ) )
// SELECT `mm_job`.`job_name`, `mm_job`.`job_description`, `mm_employer`.`employer_name`, `mm_employer`.`employer_comany` FROM `mm_job` JOIN `mm_employer` ON `mm_job`.`employer_id` = `mm_employer`.`id`
$this->load->view('displayfrombothtbl', $data);
	}
}


 ?>