<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    
    class Contact_model  extends CI_Model {

        function get_records($tableName = 'contact', $fields = '*', $dID)
        {
            if (!isset($dID))
            {
                show_error('No dID supplied! (this is an error that Dallas Matthews needs to know about!)');
            }
            else
            {
                $this->db->select($fields)->from($tableName)->where('_dID', $dID);
                $query = $this->db->get();
                return $query->result_array(); 
            }
        }
        
        function getRecordById($tableName, $fields, $rID, $dID)
        {
            $this->db->select($fields)->from($tableName)->where(array('_dID' => $dID, 'Id' => $rID));
            $query = $this->db->get();
            switch ($query->num_rows())
            {
                case 0:
                    $retval = "Sorry, No records found with ID $rID.";
                    break;
                case 1:
                    //$retval = $query->result_array();
                    $retval = $query->row_array();
                    break;
                default :
                    $retval = show_error('More than, or fewer than one record returned when searching by getRecordById (contact_method/getRecordById, no of rows = ' . $query->num_rows());;
            }
            return $retval;
        }
        
        function add_record($data)
        {
            $this->db->insert('contact', $data);
        }
        
        function update_record($post)
        {
            $rID = $post['Id'];
            foreach ($post as $key => $value)            
            {
                if (substr($key, 0, 1) == '@' || $key == 'submit' || $key == 'Id')
                {
                   unset($post[$key]);
                }
            }
            //$this->db->where('id', $this->input->post('Id'));
            //this->db->update('contact', $this->data);
        }
        
        function delete_row()
        {
            $this->db->where('id', $this->uri->segment(3));
            $this->db->delete('contact');
        }
    }
