<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *Store all custom functions here
 * (autoloaded in config/autoload.php
 */
















/*

function showField($fieldArray, $value = NULL)
    {
        //print_r($fieldArray);
        if($fieldArray['showField'])
        {
            $html =  $fieldArray['HTML_before'];        
            $html .= '<div class="clearfix ' . $fieldArray['cssClassDiv'] . '" id="' . $fieldArray['cssIdDiv'] . '">';
            $html .= '<label class="' . $fieldArray['cssClassLabel'] . '" id="' . $fieldArray['cssIdLabel'] . '">' . $fieldArray['label'] . '<label>';
            $html .= '<div class="input ' . $fieldArray['cssIdDiv'] . '" id="' . $fieldArray['cssIdDiv'] . '">';
            $html .= '<input class="' . $fieldArray['cssClassInput'] . '" id="' . $fieldArray['cssIdInput'] . '"  length="' . $fieldArray['length'] . '" type="' . $fieldArray['type'] . '" name="' . $fieldArray['name'] . '" value="' . $value . '" ' . $fieldArray['extraHTMLInput'] . ' />';
            $html .= '</div></div>';          
            $html .=  $fieldArray['HTML_after'];    

            return $html;
        }    
    }

*
 * 
 */