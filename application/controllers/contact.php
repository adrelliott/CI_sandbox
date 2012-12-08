<?php
/*
 * This is the contact page - ie the main page of the app. The methods here allow 
 * us to CRUD, as well as open other (usually modal) windows to 
 */

class Contact extends CI_Controller {

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
                   $this->contact_model->get_records($t,$fields[$t],$this->data['pageSetup']['dID']);
       }       
       
       //Use library/Template to load all the right files for this user 
       $this->data['pageSetup']['view'] = 'viewAllData';
       $this->data['pageSetup']['message'] = $message;
       
       $this->load->library('template',$this->data['pageSetup']);    //should this be here?
       $this->template->load_page($this->data);
//print_r($this->data);
   }  
    
    public function view($rID = NULL)
    {
       // echo "Looking at record $rID in the controller:" . $this->data['pageSetup']['controller'];      
        if (!isset($rID))
        {
            $this->index();
        }
        else
        {          
            $this->data['records']['contact'] = 
                $this->contact_model->getRecordById(
                    'contact',
                    array_keys(
                        $this->data['dataSetup']['recordSetup']['contact']
                    ),
                    $rID, 
                    $this->data['pageSetup']['dID']
                );            
        }
//print_r($this->data['records']['contact']);
        //if one record is loaded, then load the record view
        if (is_array($this->data['records']['contact']))
        {
            $this->data['pageSetup']['contactSection'] = '';
            foreach ($this->data['dataSetup']['recordSetup']['contact'] as $field => $array)
             {        
                 $this->data['pageSetup']['contactSection'] .= form_input_custom($array, $this->data['records']['contact'][$field]);
             } 
            $this->data['pageSetup']['view'] = 'viewRecord';
            $this->load->library('template',$this->data['pageSetup']);    //should this be here?
            $this->template->load_page($this->data);
        }
        else
        {
            $this->index("No records found!");
        }
        
        
        //But, if no record is loaded, then load the sorry view then the the index view
        
    }

        public function blank() //opens a new record with blank fields
    {
        echo "adding records via contact:";
        $this->data['pageSetup']['contactSection'] = '';
        foreach ($this->data['dataSetup']['recordSetup']['contact'] as $field => $array)
         {        
             $this->data['pageSetup']['contactSection'] .= form_input_custom($array, '');
         } 
        $this->data['pageSetup']['view'] = 'viewRecord';
        $this->load->library('template',$this->data['pageSetup']);    //should this be here?
        $this->template->load_page($this->data);        
    }
    
    public function update()
    {
        //add a record
        //is the ID set? if yes, then amend if no then create
        if (($this->input->post('Id')) == '')
        {
            $this->create();
        }
        else
        {
            echo "...updating a record....";
            if ($this->contact_model->update_record($this->input->post()))
            {
                echo "<h1>success! Record updated</h1>";
            }
            else
            {
                show_error('Record failed to be created. Dallas Matthews shoudl be told about this (don\'t worry - its nothing you did)');
            }
        }
        //print_r($this->input->post());
    }
    
    public function create()
    {
        //create a record
        //is the ID set? if yes, then amend if no then submit
         if (($this->input->post('Id')) != '')
        {
            $this->update();
        }
        else
        {
             echo "...Creating a record....";
        }
       
        print_r($this->input->post());
    }
  
    
}