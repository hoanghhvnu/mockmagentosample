<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 9/15/14
 * Time: 4:38 PM
 */
class SM_Featured_Model_Featuredtype{
    public function toOptionArray(){
        $optionArray = array(
            array('label' => 'Yes', 'value' => '1'),
            array('label' => 'No', 'value' => '2')
        );
        return $optionArray;
    }
}