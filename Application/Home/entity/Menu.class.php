<?php
namespace  Home\entity;
class Menu{
    public  $menuid;
    public  $name;
    //菜单点击之后要发送的超链接地址 如果此菜单不是最低级别  则此菜单不是最低几级别  则 此列的值为null
    public  $url;
    //parentid表示此菜单父级菜单的主键id 如果此菜单已经是最顶级菜单  则此列的值为-1
    public  $parentid;
    //表示是否在首页左边的树形菜单中展示     1表示展示
    public  $isshow;
    
    //如果此菜单是二级菜单  将他的所有子菜单放入$children的数组中  
    //如果此菜单是一个最低级别菜单  则$children为null
    public $children;
    /**
     * @return $children
     */
    public function getChildren()
    {
        return $this->children;
    }
    public  static function getInsall($menuid,$name,$url,$parentid,$isshow){
        $m = new Menu();
        $m->setName($name);
        $m->setMenuid($menuid);
        $m->setUrl($url);
        $m->setParentid($parentid);
        $m->setIsshow($isshow);
        return $m;
    }
    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setChildren(array $children)
    {
        $this->children = $children;
    }

    /**
     * @return $useid
 
     */
    /**
     * @return $menuid
     */
    public function getMenuid()
    {
        return $this->menuid;
    }

    /**
     * @return $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return $url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return $parentid
     */
    public function getParentid()
    {
        return $this->parentid;
    }

    /**
     * @return $isshow
     */
    public function getIsshow()
    {
        return $this->isshow;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setMenuid($menuid)
    {
        $this->menuid = $menuid;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setParentid($parentid)
    {
        $this->parentid = $parentid;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setIsshow($isshow)
    {
        $this->isshow = $isshow;
    }

  
}
?>