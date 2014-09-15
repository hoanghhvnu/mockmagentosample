<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 9/12/14
 * Time: 4:56 PM
 */
class SM_Slider_Helper_Template{
    public function choose(){
        $SliderType = Mage::getStoreConfig('sm_slider/sm_slider/type');
//        var_dump($SliderType);
//        die();
        if($SliderType == ''){
            return FALSE;
        }
        switch($SliderType){
            case 'dynamic' :
//                $this->mysetTemplate('slider/showslider.phtml');
                return 'slider/showslider.phtml';
                break;
            case 'activecenter':
                return 'slider/centeractiveslider.phtml';
//                $this->mysetTemplate('slider/centeractiveslider.phtml');
                break;

        }
    } // end choose

    public function mysetTemplate($path){
//        die('myset');
        Mage::app()->getLayout()
            ->getBlock('show.slider')
            ->setTemplate($path)
        ;
    }
}