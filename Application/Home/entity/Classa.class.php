<?php
namespace entity;
class Classa{
    public  $cid;
    public  $name;
    public  $classType;
    public  $createTime;
    public  $beginTime;
    public  $endTime;
    public  $headerid;
    public  $manageid;
    public  $stucount;
    public  $remark;
    public  $status;
    /**
     * @return $cid
     */
    public function getCid()
    {
        return $this->cid;
    }

    /**
     * @return $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return $classType
     */
    public function getClassType()
    {
        return $this->classType;
    }

    /**
     * @return $createTime
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * @return $beginTime
     */
    public function getBeginTime()
    {
        return $this->beginTime;
    }

    /**
     * @return $endTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @return $headerid
     */
    public function getHeaderid()
    {
        return $this->headerid;
    }

    /**
     * @return $manageid
     */
    public function getManageid()
    {
        return $this->manageid;
    }

    /**
     * @return $stucount
     */
    public function getStucount()
    {
        return $this->stucount;
    }

    /**
     * @return $remark
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * @return $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setCid($cid)
    {
        $this->cid = $cid;
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
    public function setClassType($classType)
    {
        $this->classType = $classType;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setBeginTime($beginTime)
    {
        $this->beginTime = $beginTime;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setHeaderid($headerid)
    {
        $this->headerid = $headerid;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setManageid($manageid)
    {
        $this->manageid = $manageid;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setStucount($stucount)
    {
        $this->stucount = $stucount;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    
}

?>