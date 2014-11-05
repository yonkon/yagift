<?php
/**
 * Created by PhpStorm.
 * User: shikon
 * Date: 05.11.14
 * Time: 4:20
 */

class giftokPager extends CLinkPager {
  /**
   * Initializes the pager by setting some default property values.
   */
  public function init()
  {
    if($this->nextPageLabel===null)
      $this->nextPageLabel=Yii::t('components','Next &gt;');
    if($this->prevPageLabel===null)
      $this->prevPageLabel=Yii::t('components','&lt; Previous');
    if($this->firstPageLabel===null)
      $this->firstPageLabel=Yii::t('components','&lt;&lt; First');
    if($this->lastPageLabel===null)
      $this->lastPageLabel=Yii::t('components','Last &gt;&gt;');
    if($this->header===null)
      $this->header='<span class="pager-header">' . Yii::t('components','Pages') . '</span>';
    parent::init();
  }

  /**
   * Creates the page buttons.
   * @return array a list of page buttons (in HTML code).
   */
  protected function createPageButtons()
  {
    if(($pageCount=$this->getPageCount())<=1)
      return array();

    list($beginPage,$endPage)=$this->getPageRange();
    $currentPage=$this->getCurrentPage(false); // currentPage is calculated in getPageRange()
    $buttons=array();

    // first page
//    $buttons[]=$this->createPageButton($this->firstPageLabel,0,$this->firstPageCssClass,$currentPage<=0,false);

    // prev page
    if(($page=$currentPage-1)<0)
      $page=0;
    $buttons[]=$this->createPageButton($this->prevPageLabel,$page,$this->previousPageCssClass,$currentPage<=0,false);

    // next page
    if(($page=$currentPage+1)>=$pageCount-1)
      $page=$pageCount-1;
    $buttons[]=$this->createPageButton($this->nextPageLabel,$page,$this->nextPageCssClass,$currentPage>=$pageCount-1,false);

    $buttons[] = '<div class="clr padding-v-05">&nbsp;</div>';

    // internal pages
    for($i=$beginPage;$i<=$endPage;++$i) {
      $lbl = $i+1;
      if (
        ($i == $beginPage && $beginPage > 0) ||
        ($i == $endPage && $endPage < $pageCount-1)
      ) {
        $lbl = '...';
      }
      $buttons[]=$this->createPageButton($lbl,$i,$this->internalPageCssClass,false,$i==$currentPage);
    }
    // last page
//    $buttons[]=$this->createPageButton($this->lastPageLabel,$pageCount-1,$this->lastPageCssClass,$currentPage>=$pageCount-1,false);

    return $buttons;
  }


} 