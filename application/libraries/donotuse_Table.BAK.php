<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This extends the core Table library
 */

// ------------------------------------------------------------------------

/**
 * HTML Table Generating Class
 *
 * Lets you create tables manually or from database result objects, or arrays.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	HTML Tables
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/uri.html
 */
class MY_Table extends CI_Table{

	var $data;

	public function __construct()
	{
		parent::__construct();
                $data = $this->data;
	}

	
	// --------------------------------------------------------------------

	/**
	 * Generate the table
	 *
	 * @access	public
	 * @param	mixed
	 * @return	string
	 */
	function generate_linked($table_data = NULL)
	{
		
                // The table data can optionally be passed to this function
		// either as a database result object or an array
		if ( ! is_null($table_data))
		{
			if (is_object($table_data))
			{
				$this->_set_from_object($table_data);
			}
			elseif (is_array($table_data))
			{
				$set_heading = (count($this->heading) == 0 AND $this->auto_heading == FALSE) ? FALSE : TRUE;
				$this->_set_from_array($table_data, $set_heading);
			}
		}

		// Is there anything to display?  No?  Smite them!
		if (count($this->heading) == 0 AND count($this->rows) == 0)
		{
			return 'Undefined table data';
		}

		// Compile and validate the template date
		$this->_compile_template();

		// set a custom cell manipulation function to a locally scoped variable so its callable
		$function = $this->function;

		// Build the table!

		$out = $this->template['table_open'];
		$out .= $this->newline;

		// Add any caption here
		if ($this->caption)
		{
			$out .= $this->newline;
			$out .= '<caption>' . $this->caption . '</caption>';
			$out .= $this->newline;
		}

		// Is there a table heading to display?
		if (count($this->heading) > 0)
		{
			$out .= $this->template['thead_open'];
			$out .= $this->newline;
			$out .= $this->template['heading_row_start'];
			$out .= $this->newline;

			foreach ($this->heading as $heading)
			{
				$temp = $this->template['heading_cell_start'];

				foreach ($heading as $key => $val)
				{
					if ($key != 'data')
					{
						$temp = str_replace('<th', "<th $key='$val'", $temp);
					}
				}

				$out .= $temp;
				$out .= isset($heading['data']) ? $heading['data'] : '';
				$out .= $this->template['heading_cell_end'];
			}

			$out .= $this->template['heading_row_end'];
			$out .= $this->newline;
			$out .= $this->template['thead_close'];
			$out .= $this->newline;
		}

		// Build the table rows
		if (count($this->rows) > 0)
		{
			$out .= $this->template['tbody_open'];
			$out .= $this->newline;

			$i = 1;
			foreach ($this->rows as $row)
			{
				if ( ! is_array($row))
				{
					break;
				}

				// We use modulus to alternate the row colors
				$name = (fmod($i++, 2)) ? '' : 'alt_';

				$out .= $this->template['row_'.$name.'start'];
				$out .= $this->newline;

				foreach ($row as $cell)
				{
					$temp = $this->template['cell_'.$name.'start'];

					foreach ($cell as $key => $val)
					{
						if ($key != 'data')
						{
							$temp = str_replace('<td', "<td $key='$val'", $temp);
						}
					}

					$cell = isset($cell['data']) ? $cell['data'] : '';
					 
                                        $out .= $temp;

					if ($cell === "" OR $cell === NULL)
					{
						$out .= $this->empty_cells;
					}
					else
					{
						if ($function !== FALSE && is_callable($function))
						{
							$out .= call_user_func($function, $cell);
						}
						else
						{
							$out .= $cell;
						}
					}

					$out .= $this->template['cell_'.$name.'end'];
				}

				$out .= $this->template['row_'.$name.'end'];
				$out .= $this->newline;
			}

			$out .= $this->template['tbody_close'];
			$out .= $this->newline;
		}

		$out .= $this->template['table_close'];

		// Clear table class properties before generating the table
		$this->clear();

		return $out;
	}

	
	// --------------------------------------------------------------------

	/**
	 * Set table data from a database result object
	 *
	 * @access	public
	 * @param	object
	 * @return	void
	 */
	function _set_from_object($query)
	{
		if ( ! is_object($query))
		{
			return FALSE;
		}

		// First generate the headings from the table column names
		if (count($this->heading) == 0)
		{
			if ( ! method_exists($query, 'list_fields'))
			{
				return FALSE;
			}

			$this->heading = $this->_prep_args($query->list_fields());
		}

		// Next blast through the result array and build out the rows

		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$this->rows[] = $this->_prep_args($row);
			}
		}
	}

        function _replace_placeholders($var)
        {
            $this->load->library('parser');
            $this->parser->set_delimiters('##', '##');
            $replacements = array
            (
                'CONTROLLER' => 'thisiscontroller',
                'rID' => 11111,
                'LINKCLASS' => 'mylinkclass'
            );
            
            return $this->parser->parse_string($var, $replacements, TRUE);
        }

// --------------------------------------------------------------------

	/**
	 * Set table data from an array
	 *
	 * @access	public
	 * @param	array
	 * @return	void
	 */
	function _set_from_array($data, $set_heading = TRUE)
	{
		if ( ! is_array($data) OR count($data) == 0)
		{
			return FALSE;
		}

		$i = 0;
		foreach ($data as $row)
		{
			// If a heading hasn't already been set we'll use the first row of the array as the heading
			if ($i == 0 AND count($data) > 1 AND count($this->heading) == 0 AND $set_heading == TRUE)
			{
				$this->heading = $this->_prep_args($row);
			}
			else
			{
				$this->rows[] = $this->_prep_args($row);
			}

			$i++;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Compile Template
	 *
	 * @access	private
	 * @return	void
	 */
	function _compile_template()
	{
		if ($this->template == NULL)
		{
			$this->template = $this->_default_linked_template();
			return;
		}

		$this->temp = $this->_default_linked_template();
		foreach (array('table_open', 'thead_open', 'thead_close', 'heading_row_start', 'heading_row_end', 'heading_cell_start', 'heading_cell_end', 'tbody_open', 'tbody_close', 'row_start', 'row_end', 'cell_start', 'cell_end', 'row_alt_start', 'row_alt_end', 'cell_alt_start', 'cell_alt_end', 'table_close') as $val)
		{
			if ( ! isset($this->template[$val]))
			{
				$this->template[$val] = $this->temp[$val];
			}
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Default Template
	 *
	 * @access	private
	 * @return	void
	 */
	function _default_linked_template()
	{
		return  array (
						'table_open'			=> '<table class="dataTable">',
                                                'link_controller'		=> 'contact',

						'thead_open'			=> '<thead>',
						'thead_close'			=> '</thead>',

						'heading_row_start'		=> '<tr>',
						'heading_row_end'		=> '</tr>',
						'heading_cell_start'	=> '<th class="align-left">',
						'heading_cell_end'		=> '</th>',

						'tbody_open'			=> '<tbody>',
						'tbody_close'			=> '</tbody>',

						'row_start'				=> '<tr>',
						'row_end'				=> '</tr>',
						'cell_start'			=> '<td><a href="##CONTROLLER##/##rID##" class="##LINKCLASS##">',
						'cell_end'				=> '<a/></td>',

						'row_alt_start'		=> '<tr>',
						'row_alt_end'			=> '</tr>',
						'cell_alt_start'		=> '<td><a href="##CONTROLLER##/##rID##" class="##LINKCLASS##">',
						'cell_alt_end'			=> '</a></td>',

						'table_close'			=> '</table>'
					);
	}


}


/* End of file Table.php */
/* Location: ./system/libraries/Table.php */