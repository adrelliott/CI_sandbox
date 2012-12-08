<?php
/*
 * This is the contact page - ie the main page of the app. The methods here allow 
 * us to CRUD, as well as open other (usually modal) windows to 
 */

class Contact extends CI_Controller {

       public function __construct()    {
         parent::__construct();
         //Set up basic info here
         $this->data = array
            (
             'dID' => 22222,    //This needs to come from a PHP session somehow
             'controller' => $this->uri->segment(1, 'dashboard'),   //defaults to dashboard            
             );
         $this->config->load($this->data['dID'] . '_config'); //Load the config array    
         $this->data['navbarSetup'] = $this->config->item('navbarSetup'); 
         $this->data['dataSetup'] = $this->config->item($this->data['controller']);  
            //This line (above) gets the settings for this page out of config file
         $this->load->model($this->data['controller'] . '_model');
        print_r($this->data);
    }
    
   public function index() {         
       //Get all the records required for the view
       //$this->load->model($this->data['controller'] . '_model');       
       foreach ($this->data['pageSetup']['tablesetup'] as $t => $valuePair)
       {          
           foreach ($valuePair as $field => $niceName)
           {
               $fields[$t][] = $field;
               $this->data['tableHeadings'][$t][] = $niceName;
           }
           $this->data['records'][$t]= $this->contact_model->get_records($t,$fields[$t],$this->data['dID']);
       }       
       
       //Fetch, then run, our custom template library. This outputs the header, 
       // navbar, {body} and footer. NOTE: {body} is the view referenced in $this->uri->segment(1) 
       // If no value exists we send dashboard to take us back to the index page
       //Get the data required for this view       
       $this->data['view'] = 'viewAllData';
       $this->load->library('template',$this->data);    //should this be here?
       $this->template->load_page($this->data);
   }  
    
    public function view($rID)
    {
echo "Looking at record $rID in the controller:" . $this->data['controller'];
       //Load the record
       //do a foreach here  getRecordById($tableName, $fields, $rID, $dID)
       $fields = $this->data['pageSetup']['recordsetup']['contact']; 
       print_r($fields);
       foreach ($fields as $field => $niceName)
           {
               $fields[] = $field;
               $this->data['tableHeadings'][$t][] = $niceName;
           }
       $this->data['records']['contact']= $this->contact_model->getRecordById('contact',$fields,18479,$this->data['dID']);
       $this->data['view'] = 'viewRecord';
       $this->load->library('template',$this->data);    //should this be here?
       $this->template->load_page($this->data);
    }

        public function add()
    {
        echo "adding records via contact:";
        
    }
    
   
    
}