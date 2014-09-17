<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 9/17/14
 * Time: 9:12 AM
 */
class SM_Featured_Model_Showhandle{
    public function showHandle($o)
    {
        $Handle = $o->getLayout()->getUpdate()->getHandles();
        echo "<pre>";
        var_dump( $Handle);
        echo Mage::helper('core/url')->getCurrentUrl();
        echo Mage::registry('current_category')->getId();
        Mage::getModel('catalog/layer')->getCurrentCategory()->getId();
//        die();
        echo "</pre>";
        return true;
        echo __METHOD__;
        $lay = $o->getLayout()->getUpdate();
        echo "<pre>";
        echo "<textarea>";
        var_dump($lay);
        echo "</textarea>";
        $req  = Mage::app()->getRequest();
//        echo "<pre>";
//        var_dump($o->getLayout()->getUpdate()->asString());
        $info = sprintf(
            "\nRequest: %s\nFull Action Name: %s_%s_%s\nHandles:\n\t%s\nUpdate XML:\n%s",
            $req->getRouteName(),
            $req->getRequestedRouteName(),      //full action name 1/3
            $req->getRequestedControllerName(), //full action name 2/3
            $req->getRequestedActionName(),     //full action name 3/3
            implode("\n\t",$o->getLayout()->getUpdate()->getHandles()),
            $o->getLayout()->getUpdate()->asString()
        );
//        echo $info;
        // Force logging to var/log/layout.log
        Mage::log($info, Zend_Log::INFO, 'layout.log', true);
//        return FALSE;
    }
}