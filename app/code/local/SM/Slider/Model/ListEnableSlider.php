<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 9/10/14
 * Time: 4:55 PM
 */
class SM_Slider_Model_ListEnableSlider{
    public function getListSlider(){
        $SliderCollection = Mage::getModel('slider/slider')
            ->getCollection()
        ;
        $SliderArray = array();
        foreach ($SliderCollection as $Slider){
            if($Slider['status'] == 2){ // if it's Disable
                continue;
            }
            if($Slider['status'] == 1){
                $temp = array(
                    'label' => $Slider['title'],
                    'value' => $Slider['slider_id']
                );
                $SliderArray[] = $temp;
            } // end if
        } // end foreach $SliderCollection
        return $SliderArray;
    } // end method getListSlider

    public function toOptionArray(){
        return $this->getListSlider();
    }
}