<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * This is the dashboard page - ie the homepage of the app. There are very few
 * methods here as most of the actions take us to other contexts/controllers
 */

class Dashboard extends CI_Controller {

    public function __construct()    {
         parent::__construct();
         $dID = 22222;  // ******* THIS NEEDS TO COME FROM THE php SESSION ***!!!!!
         
         $this->config->load($dID . '_config'); //Load the config array           
            //Set up basic info here
         $this->data['pageSetup'] = array
         (
            'dID' => $dID,    //This needs to come from a PHP session somehow
            'controller' => $this->uri->segment(1, 'dashboard'),   //defaults to dashboard
            'navbarSetup' => $this->config->item('navbarSetup'),
            'view' => '',
         );
            //set up info for the data here (grab from this users conig file)
         $this->data['dataSetup'] = $this->config->item($this->data['pageSetup']['controller']);  
             //Now load the model for this page
         $this->load->model($this->data['pageSetup']['controller'] . '_model');
         //print_r($this->data);
    }
    
  public function index($message = NULL) {         
       //Get all the records required for the view
       //$this->load->model($this->data['controller'] . '_model');       
       foreach ($this->data['dataSetup']['tableSetup'] as $t => $valuePair)
       {          
           foreach ($valuePair as $field => $niceName)
           {
               $fields[$t][] = $field;
               $this->data['dataSetup']['tableHeadings'][$t][] = $niceName;
           }
           $this->data['records'][$t]= 
                   $this->dashboard_model->get_records($t,$fields[$t],$this->data['pageSetup']['dID']);
       }       
       
       //Use library/Template to load all the right files for this user 
       $this->data['pageSetup']['view'] = 'viewAllData';
       $this->data['pageSetup']['message'] = $message;
       
       $this->load->library('template',$this->data['pageSetup']);    //should this be here?
       $this->template->load_page($this->data);
//print_r($this->data);
   }  
    
   
    
    

    
}