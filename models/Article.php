<?php
class  Article{
private $ma_bviet;
private $ma_tgia;
private $ma_tloai;
private $tieu_de;
private $ten_bhat;
private $tomtat;
private $noidung;
private $ngayviet;
private $hinhanh;

public function __construct($ma_bviet,$tieu_de,$ten_bhat,$ma_tloai,$tomtat,$noidung,$ma_tgia,$ngayviet,$hinhanh){
    $this->ma_bviet= $ma_bviet;
    $this->ma_tgia = $ma_tgia;
    $this->ma_tloai = $ma_tloai;
    $this->tieu_de = $tieu_de;
    $this->ten_bhat = $ten_bhat;
    $this->tomtat = $tomtat;
    $this->noidung = $noidung;
    $this->ngayviet = $ngayviet;
    $this->hinhanh = $hinhanh;
}

public function getMaBViet(){
    return $this->ma_bviet;
}

public function getMaTGia(){
    return $this->ma_tgia;
}
public function getMaTLoai(){
    return $this->ma_tloai;
}

public function getTieuDe(){
    return $this->tieu_de;
}

public function setTieuDe($tieude_new){
    $this->tieu_de = $tieude_new;
}

public function getTenBHat(){
    return $this->ten_bhat;
}

public function setTenBHat($ten_bhat_new){
    $this->ten_bhat = $ten_bhat_new;
}
public function getTomTat(){
    return $this->tomtat;
}

public function setTomTat($tomtat_new){
    $this->tomtat = $tomtat_new;
}
public function getNoiDung(){
    return $this->noidung;
}
public function setNoiDung($noidung_new){
    $this->noidung=$noidung_new;
}
public function getNgayViet(){
    return $this->ngayviet;
}
public function setNgayViet($ngayviet_new){
    $this->ngayviet = $ngayviet_new;
}
public function getHinhAnh(){
    return $this->hinhanh;
}
public function setHinhAnh($hinhanh_new){
    $this->hinhanh = $hinhanh_new;
}
}
?>