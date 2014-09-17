<?php
class SM_Slider_Block_Slider extends Mage_Core_Block_Template
//class SM_Slider_Block_Slider extends Mage_Page_Block_Html_Head
{
    public function __construct(){
//        echo __METHOD__;
        return parent::__construct();
    }
	public function _prepareLayout()
    {
        
//        echo __METHOD__;
        $SliderStatus = Mage::getStoreConfig('sm_slider/sm_slider/show');

        if($SliderStatus == 1){
            $BlockHead = Mage::app()->getLayout()->getBlock('head');
            Mage::app()->getLayout()->getBlock('head')->addItem('skin_css', 'css/slider/lib/idangerous.swiper.css');
            $this->getLayout()->getBlock('head')->addItem('skin_js', 'js/slider/lib/idangerous.swiper.js');
//            $BlockHead->addItem('skin_js','js/runslider.js','defer');
        }

		return parent::_prepareLayout();
    } // end _prepareLayout()




    /**
     * get Array image for slider will be show
     * @return array
     */
    public function getSliderInfo(){
        $SliderCollection = Mage::getModel('slider/slider')
            ->getCollection()
        ;
        $FinalSlider = array();
        foreach ($SliderCollection as $Slider){
            if($Slider['status'] == 2){ // if it's Disable
                continue;
            }
            if($Slider['status'] == 1){
                $FinalSlider = $Slider;
                break;
            }
        } // end foreach $SliderCollection

        $ImageCollection = Mage::getModel('slider/imageslider')
            ->getCollection()
        ;
        $ImageArray = array();
        foreach ($ImageCollection as $Image ){
            if($Image['slider_id'] == $FinalSlider['slider_id']
            && $Image['status'] == 1){
                $ImageArray[] = $Image->getData();
            } // end if valid image
        }  // end foreach

        // Order by sort_order field
        $tempArray = array();
        foreach ($ImageArray as $key => $value){
            $tempArray[$key] = $value['sortorder'];
        }
        asort($tempArray);
//        var_dump($tempArray);
//        die();
        $SortedImageArray = array();
        foreach ($tempArray as $key => $value){
            $SortedImageArray[] = $ImageArray[$key];
        }
        return $SortedImageArray;
//        return $ImageArray;
    } // end method getSliderInfo


} // end class

/**
 * some method to add js but it's still not work
 */
//    public function myaddItem( $type, $name){
//        $name = trim($name);
//        if($name == ''){
//            return FALSE;
//        }
////        echo "<pre>";
////        var_dump($name);
//        if(gettype($name) == 'array'){
//            $this->addMultiItem($type, $name);
//        } else if (gettype($name) == 'string'){
//            $this->addSingleItem($type, $name);
//        } // end if gettype
////        die();
//    } // end method addSkinJs()
//
//    public function addSingleItem($type = NULL, $name = NULL){
//        echo __METHOD__;
//        if($name == NULL){
//            return FALSE;
//        }
////        $ItemBlock = Mage::app()->getLayout()
//        $this->getLayout()
//            ->getBlock('head')
////            ->createBlock('Mage_Page_Block_Html_Head')
////            ->addItem($type,$name)
//            ->addItem('skin_css', 'css/idangerous.swiper.css');
//        ;
////        var_dump($ItemBlock);
////        die();
////        $this->getLayout()
////            ->getBlock('head')
////            ->append($ItemBlock);
//    } // end method addSingleSkinItem
//
//    public function addMultiItem($type = NULL, $name = array()){
//        if( empty($name)){
//            return FALSE;
//        }
//        $ItemBlock = Mage::app()->getLayout()
//            ->getBlock('head')
////            ->createBlock('Mage_Page_Block_Html_Head')
//        ;
//        foreach ($name as $item){
//            if($item != ''){
//                $ItemBlock->addItem($type,$item);
//            }
//        } // end foreach
//        ;
//        $this->getLayout()
//            ->getBlock('head')
//            ->append($ItemBlock);
//    } // end method addMultiSkinItem



// end file