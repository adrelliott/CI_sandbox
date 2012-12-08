<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    //This model does this:
    class Dashboard_model  extends CI_Model {

        function get_records($tableName = 'contact', $fields = '*', $dID)
        {
            if (!isset($dID))
            {
                show_error('No dID supplied! (this is an error that Dallas Matthews needs to know about!)');
            }
            else
            {
                $this->db->select($fields)->from($tableName)->where(array('_dID' => $dID));
                $query = $this->db->get();
                return $query->result_array(); 
            }
        }        
       
    }
