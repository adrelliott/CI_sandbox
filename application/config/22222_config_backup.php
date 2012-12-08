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
        'tablesetup' => array
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
        'tablesetup' => array
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
        'recordsetup' => array
        (
           'contact' => array
           (
               'Id' => array
               (
                   'niceName' => 'Idnicename',
                   'cssDiv' => '',
                   'cssLabel' => '',
                   'cssInput' => '',
                   'helpText' => '',
                   'lenght' => '',
                   'HTML_before' => '',
                   'HTML_after' => '',
                   
                   
               ),                
           ),           
        ),
    );
