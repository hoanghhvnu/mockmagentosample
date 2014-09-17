<?php
class SM_Megamenu_Block_Megamenu extends Mage_Core_Block_Template
{
    public function __construct(){
//        echo __METHOD__;
        return parent::__construct();
    }
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    


    public function getMegaItem(){
        $megacollection = Mage::getModel('megamenu/megamenu')
        ->getCollection()->getData()
        ;
        $ListItem = array();
        foreach ($megacollection as $item){
            $status = $item['status'];
            if($status == 2){
                continue;
            }
            $title = $item['title'];
            $type = $item['type'];
            $position = $item['position'];
            switch($type){
                case 1:
                    $ItemValue = $item['category_id'];
                    break;
                case 2:
                    $ItemValue = $item['link'];
                    break;
                case 3:
                    $ItemValue = $item['static_block_id'];
            } // end switch

            $temp = array(
                'title' => $title,
                'type' => $type,
                'value' => $ItemValue,
                'position' => $position,
            );
            $ListItem[] = $temp;
        }
        $this->myAsortObject($ListItem, 'position');
        return $ListItem;
    } // end getMegaItem

    public function myAsortObject(&$object, $property){
        $arrayKeyValue = array();
        foreach ($object as $key => $item){
            $arrayKeyValue[$key] = $item[$property];
        }
        asort($arrayKeyValue);
        $Sorted = array();
        foreach ($arrayKeyValue as $key => $value){
            $Sorted[] = $object[$key];
        }
        $object = $Sorted;
    } // end myAsortObject

    public function showCategory($CategoryId='', $isRoot=''){
        $CateDetail = Mage::getModel('catalog/category')
            ->load($CategoryId);
        $result = '';

        if($isRoot != TRUE){
            $result .= "<li>" . "<a href='" . Mage::getBaseUrl() .  $CateDetail['url_path'] . "'>"
                .$CategoryId . $CateDetail['name'] . "</a>";
        }


        if ($CateDetail->hasChildren() === TRUE){
            if($isRoot != TRUE){
                $result .= "<ul>";
            }

            $ChildIdString = $CateDetail->getChildren();
            $ChildIdArray = explode(',', $ChildIdString);
            foreach ($ChildIdArray as $ChildId){
                $result .= $this->showCategory($ChildId);
            }
            if($isRoot != TRUE){
                $result .= "</ul>";
            }

        }
        if($isRoot != TRUE){
            $result .= "</li>";
        }

        return $result;
    } // end showCategory()

    public function createCustomLink($Title = "", $Link=''){
        $link = '';
        if($Title && $Link){
            $link .= "<a href='" . $Link . "'>";
            $link .= $Title;
            $link .= "</a>";
        } // end if
        return $link;
    } // end createCustomLink

    public function createBlockLink($Title='', $BlockId=''){
        $link = '';
        if($Title && $BlockId){
            $BlockModel = Mage::getModel('cms/block')
                ->load($BlockId)
            ;
//            $link .= "<a href='#'>";
            $link .= $Title;
            $link .= "<ul>";
            $link .= "<li>";
            $link .= $BlockModel->getContent();
            $link .= "</li>";
            $link .= "</ul>";
//            $link .= "</a>";
            return $link;
        }
        return FALSE;
    } // end createCategoryLink

    public function createCategoryLink($Title='', $CategoryId=''){
        $CateDetail = Mage::getModel('catalog/category')
            ->load($CategoryId);
        $link = '';
        if($Title && $CategoryId){
            $link .= "<a href='" . Mage::getBaseUrl() . $CateDetail['url_path'] ."'>";
            $link .= "(" . $CategoryId .  ")";
            $link .= $Title;
            $link .= "</a>";
            $link .= "<ul id = 'catelink'>";
//            $link .= $this->showCategory($CategoryId, TRUE);
            $link .= $this->showCategory($CategoryId, TRUE);
            $link .= "</ul>";
            return $link;

        }
    } // end createCategoryLink

    public function getRawCategory(){
        // get category
        $catecollection = Mage::getModel('catalog/category')
//            ->load(4);
            ->getCollection()
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('url_path')
//        ->addAttributeToSelect('name')
        ;
//        echo "<pre>";
//        print_r($catecollection
//            ->getData()
//        );
        $ListCate = array();
        foreach ($catecollection as $cate){
//            var_dump($cate->getData());
            $id = $cate->getId();
            $parent = $cate->getParentId();
            $position = $cate->getPosition();
            $name = $cate->getName();
            $path = $cate->getUrlPath();
//            var_dump($path);
            $item = array();
            $item['cate_id'] = $id;
            $item['cate_name'] = $name;
            $item['cate_parent'] = $parent;
            $item['cate_order'] = $position;
            $item['url_path'] = $path;
            $ListCate[] = $item;
        }

//        echo "<pre>";
//        var_dump($ListCate);
//        die();
        return $ListCate;

    } // end method getCategory()

    public function getCategory($LevelSign = ""){
//        $SequenceList = $this->cate_model->getAll();
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
//                $strLevel .= "____";
                $strLevel = "";
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
                        'cate_order' => $strLevel . $CateDetail ['cate_order'],
                        'url_path' => $CateDetail['url_path']
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
}