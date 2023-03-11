<?php
class Category{
private $ma_tloai;
private $ten_tloai;

public function __construct($ma_tloai,$ten_tloai){
    $this->ma_tloai= $ma_tloai;
    $this->ten_tloai = $ten_tloai;
}

public function getMaTheLoai(){
    return $this->ma_tloai;
}

public function getTenTheLoai(){
    return $this->ten_tloai;
}

public function setTenTheLoai($ten_tloai_new){
    $this->ten_tloai = $ten_tloai_new;
}

}
?>