<?php
/*
 * This is the contact page - ie the main page of the app. The methods here allow 
 * us to CRUD, as well as open other (usually modal) windows to 
 */

class Contact_action extends CI_Controller {

    public function __construct()    {
         parent::__construct();
         //Set up basic info here
         $this->data = array
            (
             'dID' => 22222,    //This needs to come from a PHP session somehow
             'controller' => $this->uri->segment(1, 'contact_action'),
             'view' => 'contact_action',
             );
         $this->config->load($this->data['dID'] . '_config');         
         $this->data['navbarSetup'] = $this->config->item('navbarSetup');       
         //print_r($this->data);
    }
    
   public function index() {         
       //Fetch, then run, our custom template library. This outputs the header, 
       // navbar, {body} and footer. NOTE: {body} is the view referenced in $this->uri->segment(1) 
       // If no value exists we send dashboard to take us back to the index page
       $this->data['modal'] = TRUE;
       $this->load->library('template',$this->data);
       $this->template->load_page($this->data);
    }
    
    public function test() {
        echo "Hello - i am test!";
    }
}