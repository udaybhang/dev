<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Paging extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
 
        $this->load->library('pagination');
        $this->load->model('crud/Crud_modal');
    }
     
    public function index() 
    {
        
       
  $params = array();
        $limit_per_page = 8;
        $start_index = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $where="user_status=1";
        $total_records = $this->Crud_modal->check_numrow('user',$where);
 
        if ($total_records > 0) 
        {
            // get current page records
            $params["results"] = $this->Crud_modal->get_current_page_records('user',$limit_per_page, $start_index);
             
            $config['base_url'] = base_url() . 'pagination';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 2;
             
            $this->pagination->initialize($config);
             
            // build paging links
            $params["links"] = $this->pagination->create_links();
        }
         
        $this->load->view('user_listing', $params);
    }
     }
     ?>