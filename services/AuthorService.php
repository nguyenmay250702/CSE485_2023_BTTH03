<?php
class AuthorService{

    public function getAll($sql){
        $database = new Database;
        $stmt = $database->runSQL($sql);

        $authors = [];
        while($row = $stmt->fetch()){
            $author = new Author($row['ma_tgia'],$row['ten_tgia'],$row['hinh_tgia']);
            array_push($authors,$author);
        }
        return $authors;
    }

    public function getById(array $arguments){
        $database = new Database;
        $stmt = $database->runSQL('SELECT * FROM tacgia WHERE ma_tgia=:matacgia', $arguments);
        $row = $stmt->fetch();
        $author = new Author($row['ma_tgia'],$row['ten_tgia'],$row['hinh_tgia']);
        return $author;
    }

    public function insert(array $arguments){
        $database = new Database;
        $database->runSQL("INSERT INTO `tacgia`(`ten_tgia`,`hinh_tgia`) VALUES (:tentacgia,:hinhtacgia)",$arguments);
    }

    public function update(array $arguments){
        $database = new Database;
        $database->runSQL("UPDATE `tacgia` SET `ten_tgia`=:tentacgia, `hinh_tgia`=:hinhtacgia WHERE ma_tgia=:matacgia",$arguments);
    }

    public function delete(array $arguments){
        $database = new Database;
        $database->runSQL("DELETE from `tacgia`WHERE ma_tgia=:matacgia",$arguments);
    }
}
?>