<?php
class Author{
private $ma_tgia;
private $ten_tgia;
private $hinh_tgia;

public function __construct($ma_tgia,$ten_tgia,$hinh_tgia){
    $this->ma_tgia = $ma_tgia;
    $this->ten_tgia = $ten_tgia;
    $this->hinh_tgia = $hinh_tgia;
}

public function getMaTGia(){
    return $this->ma_tgia;
}
public function getTenTGia(){
    return $this->ten_tgia;
}
public function setTenTGia($ten_tgia_new){
    $this->ten_tgia = $ten_tgia_new;
}

public function getHinhTGia(){
    return $this->hinh_tgia;
}

public function setHinhTGia($hinh_tgia_new){
    $this->hinh_tgia = $hinh_tgia_new;
}
}
?>