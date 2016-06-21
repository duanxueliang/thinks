<?php
namespace Application\Home\Controller;
use Think\Controller;
class EmptyController extends Controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        echo "不存在";
    }
}

?>