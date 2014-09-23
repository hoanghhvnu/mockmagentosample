<?php
class SM_Slider_Block_Slider extends Mage_Core_Block_Template
//class SM_Slider_Block_Slider extends Mage_Page_Block_Html_Head
{
    public function __construct() {
//        echo __METHOD__;
        return parent::__construct();
    }
	public function _prepareLayout()
    {
        
//        echo __METHOD__;
        $SliderStatus = Mage::getStoreConfig('sm_slider/sm_slider/show');

        if ($SliderStatus == 1) {
            $BlockHead = Mage::app()->getLayout()->getBlock('head');
            Mage::app()->getLayout()->getBlock('head')->addItem('skin_css', 'css/slider/lib/idangerous.swiper.css');
            $this->getLayout()->getBlock('head')->addItem('skin_js', 'js/slider/lib/idangerous.swiper.js');
//            $BlockHead->addItem('skin_js','js/runslider.js','defer');
        }

		return parent::_prepareLayout();
    } // end _prepareLayout()


    /**
     * show only one slider, so must choose one to show
     * @return False if not config or not valid
     * @return int id if it's valid
     */
    public function getActiveSliderId() {
        $ActiveSliderId = Mage::getStoreConfig('sm_slider/sm_slider/active_slider');
        if ($ActiveSliderId == NULL || ! ctype_digit($ActiveSliderId)) {
            return FALSE;
        } // end if
        return $ActiveSliderId;
    } // end method getActiveSliderId()

    /**
     * get Array image for slider will be show
     * @return array
     */
    public function getImagesForSlider() {
        $SliderId = $this->getActiveSliderId();
        if ($SliderId == NULL) {
            return FALSE;
        }
        $ImageCollection = Mage::getModel('slider/imageslider')
            ->getCollection()
            ->addFieldToFilter('slider_id',array('eq'=> $SliderId))
            ->setOrder('sortorder','ASC');
        ;
        return $ImageCollection;
    } // end method getSliderInfo

} // end class
// end file