<?php

class SM_Bestseller_Block_Adminhtml_Bestseller_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
//      $this->getSortedCategory();
//      die();
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('bestseller_form', array('legend'=>Mage::helper('bestseller')->__('Bestseller information')));


      $fieldset->addField('datefrom', 'date', array(
          'label' => Mage::helper('bestseller')->__('From'),
          'after_element_html' => 'Date',
          'class'     => 'required-entry',
          'required'  => true,
          'image' => $this->getSkinUrl('images/grid-cal.gif'),
          'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM)
      ));

      $fieldset->addField('dateto', 'date', array(
          'label' => Mage::helper('bestseller')->__('To'),
          'after_element_html' => 'Date',
          'class'     => 'required-entry',
          'required'  => true,
          'image' => $this->getSkinUrl('images/grid-cal.gif'),
          'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM)
      ));




      return parent::_prepareForm();
  }

  public function getListStaticBlock(){
      // get all cms/block
      $collection = Mage::getModel('cms/block')
          ->getCollection()
          ->addFieldToSelect('block_id')
          ->addFieldToSelect('title')
          ->addFieldToSelect('identifier');
      $ListStaticBlock = array();
      foreach ($collection as $block){
          $ListStaticBlock[] = array(
              'value' => $block->getBlockId(),
              'label' => $block->getTitle() . " (identifier: " . $block->getIdentifier() . ")",
          );
      } // end foreach $collection
      return $ListStaticBlock;
  } // end method gitListStaticBlock()


    public function getCategoryForForm(){
        $raw = $this->getCategory();
        $list = array();
        foreach ($raw as $cate){
            $list[] = array(
                'value' => $cate['cate_id'],
                'label' => $cate['cate_name'],
            );
        }
        return $list;
    }
    public function getRawCategory(){
        $catecollection = Mage::getModel('catalog/category')
            ->getCollection()
            ->addAttributeToSelect('name')
        ;
        $ListCate = array();
        foreach ($catecollection as $cate){
            $ListCate[] = array(
                'cate_id' =>  $cate->getId(),
                'cate_name' =>  $cate->getName(),
                'cate_parent' =>  $cate->getParentId(),
                'cate_order' =>  $cate->getPosition(),
            );
        } // end forearch
        return $ListCate;
    } // end method getCategory()

    private function getCategory($LevelSign = ""){
       $SequenceList = $this->getRawCategory();
        if( empty($SequenceList)){
            echo "Have no category!";
        } else{
            // get Category level 0, ParentId = 0;
            $strLevel = "";
            $SortedList = $this->recursive(0, $SequenceList, $strLevel);
            return $SortedList;
        } // end if empty
    } // end getCategory


    /**
     * written by HoangHH
     * Use to get sub-level category, support for listcate() method
     * @param  [type] $ParentId
     * @param  [type] $List
     * @param  [type] $strLevel
     * @return [type]
     */
    private function recursive($ParentId, &$List, $strLevel){
        if( ! empty($List)){
            if( $ParentId != 0 ){
                $strLevel .= "____";
            } else{
                // $strLevel = "";
            }

            $LevelList = array();

            foreach ($List as $key => $CateDetail) {
                if($ParentId == $CateDetail['cate_parent']){
                    $temp = array(
                        'cate_id' => $CateDetail ['cate_id'],
                        'cate_name' => $strLevel . $CateDetail ['cate_name'],
                        'cate_parent' => $CateDetail ['cate_parent'],
                        'cate_order' => $strLevel . $CateDetail ['cate_order']
                    );
                    $LevelList[$key] = $temp;
                    // $LevelList[$key] = $CateDetail;
                    unset($List[$key]);
                } // end if ParentId
            } // end foreach $List



            if( ! empty($LevelList)){
                $LevelSortByOrder = array();
                foreach ($LevelList as $key => $LevelCateDetail) {
                    $LevelKeyOrder[$key] = $LevelCateDetail['cate_order'];
                }

                asort($LevelKeyOrder);

                $LevelSorted = array();
                foreach ($LevelKeyOrder as $key => $CateOrder) {
                    $LevelSorted[$key] = $LevelList[$key];
                }

                $LevelAndSub = array();
                foreach ($LevelSorted as $key => $LevelCateDetail) {
                    $LevelAndSub[] = $LevelCateDetail;
                    $SubLevel = $this->recursive($LevelCateDetail['cate_id'], $List, $strLevel);
                    if ( ! empty($SubLevel)){
                        foreach ($SubLevel as $key => $SubLevelCateDetail) {
                            $LevelAndSub[] = $SubLevelCateDetail;
                        }
                    } // end if SubLevel
                } // end foreach LevelSorted
                return $LevelAndSub;
            } // end if empty $Level
        } // end if ! empty()
    } // end recursive()

    protected function getSortedCategory(){
        $Categories = Mage::getModel('catalog/category')
            ->getCollection()
            ->addAttributeToSelect('name')
//            ->addAttributeToFilter('level',array('eq'=>'0'))
//            ->setOrder('position','ASC')
        ;
//        Zend_Debug::dump($ListCateLevel0->getData());
        $SortedArray = array();
        foreach($Categories as $Category){
            $SortedArray[] = array(
                'label' => $this->_separateCategoryLevelSign($Category->getLevel(), '--')
                         . $Category->getName(),
                'value' => $Category->getId(),
            );
            $this->listSortedChildreenByCategoryId($Category->getId());
//            if($Cate->hasChildren()){
////                Zend_Debug::dump($Cate->getAllChildren());
//                $ChildrenArray = explode(',',$Cate->getChildren());
////                Zend_Debug::dump($ChildrenArray);
//
//                foreach ($ChildrenArray as $CateChild){
//                    $SortedArray[] = array(
//                        'label' => $this->_separateCategoryLevelSign($CateChild->getLevel(), '--')
//                                .  $CateChild->getName(),
//                        'value' => $CateChild->getId(),
//                    );
//                } // end foreach
////                Zend_debug::dump($ChildrenArray);
//            }
        }// end forearch
        Zend_Debug::dump($SortedArray);
    } // end method getSortedCategory

    public function listSortedChildrenByCategoryId($CategoryId = ''){
        if (! $CategoryId  || ! ctype_digit($CategoryId)) {
            return FALSE;
        }
        $CateAndChilden = array();
        $Cate = Mage::getModel('catalog/category')
            ->load($CategoryId)
        ;
        $CateAndChilden[] = array(
            'label' => $this->_separateCategoryLevelSign($Cate->getLevel(), '--')
                    . $Cate->getName(),
            'value' => $Cate->getId(),
        );
        if($Cate->hasChildren()){
            $ChildrenArray = explode(',',$Cate->getChildren());
            foreach ($ChildrenArray as $CateChild){
                $CateAndChilden[] = array(
                    'label' => $this->_separateCategoryLevelSign($CateChild->getLevel(), '--')
                        .  $CateChild->getName(),
                    'value' => $CateChild->getId(),
                );
                $this->listSortedChildrenByCategoryId($CateChild->getId());
            } // end foreach
//                Zend_debug::dump($ChildrenArray);
        } // end if
        return $CateAndChilden;
    } // end method listSortedChildernByCategoryId

    protected function _separateCategoryLevelSign($Level='',$Sign = '' ){
        $Result = '';
        if ($Level && ctype_digit($Level) && ($Level > 0) && $Sign ) {
            for ($i = 0; $i < $Level; $i++) {
                $Result .= $Sign;
            }
        }
        return $Result;
    } // end method separateLevelSign
} // end class
// end file