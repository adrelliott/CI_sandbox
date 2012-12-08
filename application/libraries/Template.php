<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
   
/*
 * This class is designed to generate a var ($html) that is a concatenation of all
 * the views every up for the header, navbar, {body} and footer. {body} is taken from
 * $this->data['controller'] and allows us to use this same class to load all of our views.
 * We simply pass the main view's name via $this->data['controller'] and this tempate will 
 * hunt for it and insert it inot the resulting HTML.
 * 
 * NOTE: The app directory structure dictates that we first look for the view in
 * the 'views/custom/XXXX' directory (where 'XXXX' is the dID of the data owner),
 * and we must always have a directory named the controller that contains the file
 * e.g. filename.php is kept in /views/custom/XXXX/{controller_name}/filename.php
 */

class Template  {
        var $CI;
        var $data;
        
        public function __construct($data)
        {
            $this->CI =& get_instance();     //allows us to use CI functionality       
            $this->data = $data;    //grabs data from controller
            //print_r($this->data);
        }
   
      private function gen_navbar() //returns an array of ready-to-use links
      {
          $retval = array(); 
          $n = $this->data['navbarSetup'];
          //Loop through each of the navbar setup properties and generate html <li>
          foreach ( $n as $v => $array )
            {
              if ($n[$v]['controller'] == $this->data['controller'])
              {
                  $n[$v]['css'] = $n[$v]['css'] . ' active';    //Sets CSS for current page
              }
              $li = '<li class="' .$n[$v]['css'] . ' ">';
              $retval[] = $li . '<a href="/' . $n[$v]['controller'] . '">
                        <span>' . $n[$v]['icon'] . $n[$v]['controller'] . '</span></a></li>';
            } 
           return $retval;  //This is sent to the Navbar.php view 
      }

      
      public function load_page($data)
      {          
          $this->data['navbarHTML'] = $this->gen_navbar();
          $dID = $data['pageSetup']['dID'];
          $pageElements = Array ('@@header', '@@navbar', $data['pageSetup']['view'], '@@footer');
          $html = '';
          foreach ($pageElements as $n) //$n = page element/filename
          {
              if ( substr($n, 0, 2) != '@@' )   //i.e. if its $data['view']
              {
                  $path_filename = $this->data['controller'] . '/' . $n . '.php';
              }
              else
              {
                  if ( isset($this->data['modal']) )   //test for modal
                  {
                      $n = substr($n, 2) . '_modal';
                  }
                  else
                  {
                      $n = substr($n, 2);
                  }
                  $path_filename = 'common/' . $n . '.php';
              }
          
              //Now check for the file and return the file from the custom folder, if its exists, 
              //or default folder if it does not. Throws error if it cannot find either
              if ( file_exists( APPPATH . 'views/customviews/' . $dID . '/' . $path_filename ) )
              {
                  $page_paths[$n] = '/customviews/' . $dID . '/' . $path_filename;
              }
              elseif( file_exists( APPPATH . 'views/defaultviews/' . $path_filename ) )
              {
                  $page_paths[$n] = '/defaultviews/' . $path_filename;
              }
              else
              {
                   show_error('Unable to load the requested file: ' .  $path_filename);
              }
              //Now load each view a string to create an $html ready for outputting
              $html .= $this->CI->load->view($page_paths[$n], $this->data, TRUE);
          }          
          echo $html;
          //print_r($data);
      }
}