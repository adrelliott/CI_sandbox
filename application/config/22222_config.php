<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| log in details
|--------------------------------------------------------------------------
|
| Use a different key for each user. The key is the username.
|
*/
$config['usernames'] = array 
(
    'admin' => array    //This is username
    (
        'password' => 'password', 
        'suspend' => 0,                 
        'login_details' => array
        (
            'userID' => 001, 
            'companyName' => 'Admin', 
            'firstName' => 'Al', 
            'lastName' => 'Elliott', 
            'debug' => 0, 
            'version' => '', 
            'adminLevel' => 3
        ),
    ),
);

/*
|--------------------------------------------------------------------------
| Nav Bar items
|--------------------------------------------------------------------------
|
| Select which nav bar items will go here
|
*/
$config['navbarSetup'] = Array
    (
        'index' => Array	
        (
            'pagename' => 'Dashboard',
            'controller' => 'dashboard',
            'method' => '',
            'param' => '',
            'icon'	=> '<img src="/front_end/assets/images/header/icon_dashboard.png" /> ',
            'css'	=> ' iconed',
            'view' => '',						
        ),
        'contact' => Array	//do not change this value - this is what the directory should be called too
        (
            'pagename' => 'Contacts',
            'controller' => 'contact',
            'method' => '',
            'param' => '',
            'icon'	=> '',
            'css'	=> '',
            'view' => '@viewtable',			
        ),   
        'campaign' => Array	//do not change this value - this is what the directory should be called too
        (
            'pagename' => 'Campaigns',
            'controller' => 'campaign',
            'method' => '',
            'param' => '',
            'icon'	=> '',
            'css'	=> '',	
            'view' => '@viewtable',				
        ),
        'report' => Array	//do not change this value - this is what the directory should be called too
        (
            'pagename' => 'Reports',
            'controller' => 'report',
            'method' => '',
            'param' => '',
            'icon'	=> '',
            'css'	=> '',	
            'view' => '@viewtable',				
         ),        
        //ADDING MORE PAGES? Read this...
            //You can add pages here, but you MUST follow the structure above,
    );

/*
|--------------------------------------------------------------------------
| Fields for each context
|--------------------------------------------------------------------------
|
| Select which nav bar items will go here
|
*/
$config['dashboard'] = Array
    (
        'tableSetup' => array
        (
           'contact' => array
           (
               'Id' => 'Id *', 
               'FirstName' => 'First Name *', 
               'LastName' => 'Last name *',
           ),
           'contactAction' => array
           (
               'Id' => 'Id *', 
               'ActionDescription' => 'Description *', 
               'CreationNotes' => 'NBotes *',
           ),
           'contactjoin' => array
           (
               'Id' => 'Id*', 
               'ContactId' => 'Person 1*', 
               'ContactId2' => 'Person 2*', 
               'Reason' => 'Reason*'
           ),
        ),
    );

$config['contact'] = Array
    (
        'tableSetup' => array
        (
           'contact' => array
           (
               'Id' => 'Id *', 
               'FirstName' => 'First Name *', 
               'LastName' => 'Last name *',
           ),
           'contactAction' => array
           (
               'Id' => 'Id *', 
               'ActionDescription' => 'Description *', 
               'CreationNotes' => 'NBotes *',
           ),
           'contactjoin' => array
           (
               'Id' => 'Id*', 
               'ContactId' => 'Person 1*', 
               'ContactId2' => 'Person 2*', 
               'Reason' => 'Reasonxxxxx*'
           ),
        ),
        'recordSetup' => array
        (
           'contact' => array   //The fields are displayed in the order defiend below:
                                //move them around to display in a different order
           (
               'Id' => array
               (
                   'showField' => TRUE,    //TRUE or FALSE (no quotes rqd)
                   'name' => 'Id',
                   'cssClassDiv' => '',
                   'cssIdDiv' => '',
                   'cssClassLabel' => '',
                   'cssIdLabel' => '',
                   'label' => 'Idnicename',                   
                   'cssClassInput' => '',
                   'cssIdInput' => '',
                   'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                   'type' => 'text',
                   'helpText' => '',
                   'length' => '',
                   'HTML_before' => '<hr />',
                   'HTML_after' => '', 
               ),
               'FirstName' => array
               (
                   'showField' => TRUE,
                   'name' => 'FirstName',
                   'cssClassDiv' => '',
                   'cssIdDiv' => '',
                   'cssClassLabel' => '',
                   'cssIdLabel' => '',
                   'label' => 'First Name',                   
                   'cssClassInput' => '',
                   'cssIdInput' => '',
                   'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                   'type' => 'text',
                   'helpText' => '',
                   'length' => '',
                   'HTML_before' => '',
                   'HTML_after' => '',
               ),
                 'LastName' => array
               (
                   'showField' => TRUE,
                   'name' => 'LastName',
                   'cssClassDiv' => '',
                   'cssIdDiv' => '',
                   'cssClassLabel' => '',
                   'cssIdLabel' => '',
                   'label' => 'Last Name',                   
                   'cssClassInput' => '',
                   'cssIdInput' => '',
                   'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                   'type' => 'text',
                   'helpText' => '',
                   'length' => '',
                   'HTML_before' => '',
                   'HTML_after' => '',
               ),
               'Title' => array
               (
                   'showField' => TRUE,    //TRUE or FALSE (no quotes rqd)
                   'name' => 'Title',
                   'cssClassDiv' => '',
                   'cssIdDiv' => '',
                   'cssClassLabel' => '',
                   'cssIdLabel' => '',
                   'label' => 'title',                   
                   'cssClassInput' => '',
                   'cssIdInput' => '',
                   'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips" or Javascript
                   'type' => 'select',
                   'helpText' => '',
                   'length' => '',
                   'options' => array
                   (
                       '' => '',    //label => value
                       'Mr' => 'Mr',
                       'Mrs' => 'Mrs',
                       'Miss' => 'Miss',
                       'Ms' => 'Ms',
                       'Lord' => 'Lord',
                   ),
                   'HTML_before' => '<hr />',
                   'HTML_after' => '', 
               ),
                'ContactNotes' => array
               (
                   'showField' => TRUE,
                   'name' => 'ContactNotes',
                   'cssClassDiv' => '',
                   'cssIdDiv' => '',
                   'cssClassLabel' => '',
                   'cssIdLabel' => '',
                   'label' => 'Notes',                   
                   'cssClassInput' => '',
                   'cssIdInput' => '',
                   'extraHTMLInput' => 'rows="20"',  //eg. title="tooltip" rel="tooltips"
                   'type' => 'textarea',
                   'helpText' => '',
                   'length' => '',
                   'HTML_before' => '',
                   'HTML_after' => '',
               ),               
               'Gender' => array
               (
                   'showField' => TRUE,    //TRUE or FALSE (no quotes rqd)
                   'name' => 'Gender',
                   'cssClassDiv' => '',
                   'cssIdDiv' => '',
                   'cssClassLabel' => '',
                   'cssIdLabel' => '',
                   'label' => '',                   
                   'cssClassInput' => '',
                   'cssIdInput' => '',
                   'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips" or Javascript, or rows="20" or readonly
                   'type' => 'radio',
                   'helpText' => '',
                   'length' => '',
                   'options' => array
                   (
                       'Male' => 'Male',    //label => value
                       'Female' => 'Female',
                   ),
                   'HTML_before' => '<hr />',
                   'HTML_after' => '', 
               ),
               
           ),           
        ),
    );
