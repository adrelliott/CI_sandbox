<?php

/*Extends the current form_helper file
 */

// ------------------------------------------------------------------------

/**
 * Text Input Field
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_input_custom'))
{
	function form_input_custom($fieldArray, $value = NULL)
    {
        //print_r($fieldArray);
        if($fieldArray['showField'])
        {
            $html =  $fieldArray['HTML_before'];        
            $html .= '<div class="clearfix ' . $fieldArray['cssClassDiv'] . '" id="' . $fieldArray['cssIdDiv'] . '">';
            $html .= '<label class="' . $fieldArray['cssClassLabel'] . '" id="' . $fieldArray['cssIdLabel'] . '">' . $fieldArray['label'] . '<label>';
            $html .= '<div class="input ' . $fieldArray['cssIdDiv'] . '" id="' . $fieldArray['cssIdDiv'] . '">';
             //start switch
            switch ($fieldArray['type'])
            {
                case 'text':
                    $html .= '<input class="' . $fieldArray['cssClassInput'] . '" id="' . $fieldArray['cssIdInput'] . '"  length="' . $fieldArray['length'] . '" type="' . $fieldArray['type'] . '" name="' . $fieldArray['name'] . '" value="' . $value . '" ' . $fieldArray['extraHTMLInput'] . ' />';
                    break;
                case 'textarea':
                    $html .= '<textarea class="' . $fieldArray['cssClassInput'] . '" id="' . $fieldArray['cssIdInput'] . '"  type="' . $fieldArray['type'] . '" name="' . $fieldArray['name'] . '" ' . $fieldArray['extraHTMLInput'] . ' />' . $value . '</textarea>';
                    break;
                case 'select':
                    $html .= '<select class="' . $fieldArray['cssClassInput'] . '" id="' . $fieldArray['cssIdInput'] . '" name="' . $fieldArray['name'] . '" ' . $fieldArray['extraHTMLInput'] . '>';
                    foreach ($fieldArray['options'] as $l => $v)
                    {
                        $html .= '<option class="' . $fieldArray['cssClassInput'] . '" id="' . $fieldArray['cssIdInput'] . '" value="' . $v . '" ';
                        if ($v == $value)
                        {
                            $html .= 'selected="selected"';
                        }
                        $html .= '>' . $l . '</option>';
                    }
                    $html .= '</select>';
                    break;
                case 'radio':
                      foreach ($fieldArray['options'] as $l => $v)
                        {
                            $html .= '<input class="' . $fieldArray['cssClassInput'] . '" id="' . $fieldArray['cssIdInput'] . '" type="' . $fieldArray['type'] . '" name="' . $fieldArray['name'] . '" value="' . $v . '" ';
                            if ($v == $value)
                            {
                                $html .= 'checked="checked"';
                            }
                            $html .= '>' . $l;
                        }
                    break;
                default:        
                   $html .= '<input class="' . $fieldArray['cssClassInput'] . '" id="' . $fieldArray['cssIdInput'] . '"  length="' . $fieldArray['length'] . '" type="' . $fieldArray['type'] . '" name="' . $fieldArray['name'] . '" value="' . $value . '" ' . $fieldArray['extraHTMLInput'] . ' />';
                   break;               
            }            
            //end switch
            $html .= '</div></div>';          
            $html .=  $fieldArray['HTML_after'];    

            return $html;
        }    
    }

}
