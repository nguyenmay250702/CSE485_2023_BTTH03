<?php
class ArticleService{

    public function getAll($sql){
        $database = new Database;
        $stmt = $database->runSQL($sql);
        $articles = [];
        while($row = $stmt->fetch()){
            $article = new Article($row['ma_bviet'],$row['tieude'],$row['ten_bhat'],$row['ma_tloai'],$row['tomtat'],$row['noidung'],$row['ma_tgia'],$row['ngayviet'],$row['hinhanh']);
            array_push($articles,$article);
        }
        return $articles;
    }

    public function getById(array $arguments){
        $database = new Database;
        $stmt = $database->runSQL("SELECT * FROM baiviet WHERE ma_bviet=:mabaiviet",$arguments);
        $row = $stmt->fetch();
        $article = new Article($row['ma_bviet'],$row['tieude'],$row['ten_bhat'],$row['ma_tloai'],$row['tomtat'],$row['noidung'],$row['ma_tgia'],$row['ngayviet'],$row['hinhanh']);
        return $article;
    }

    public function insert(array $arguments){
        $database = new Database;
        $database->runSQL("INSERT INTO `baiviet`(`tieude`,`ten_bhat`,`ma_tloai`,`tomtat`,`noidung`,`ma_tgia`, `hinhanh`) VALUES (:tieude,:tenbaihat,:matheloai,:tomtat,:noidung,:matacgia,:hinhanh)",$arguments);
    }

    public function update(array $arguments){
        $database = new Database;
        $database->runSQL("UPDATE `baiviet` SET `tieude`=:tieude, `ten_bhat`=:tenbaihat, `ma_tloai`=:matheloai, `tomtat`=:tomtat, `noidung`=:noidung, `ma_tgia`=:matacgia, `hinhanh`=:hinhanh WHERE ma_bviet=:mabaiviet",$arguments);
        // Database::runSQL();
    }

    public function delete(array $arguments){
        $database = new Database;
        $database->runSQL("DELETE from `baiviet`WHERE ma_bviet=:mabaiviet",$arguments);
    }
}
?>