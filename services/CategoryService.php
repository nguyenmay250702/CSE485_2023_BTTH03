<?php
class CategoryService{

    public function getAll($sql){
        $database = new Database;
        $stmt = $database->runSQL($sql);

        $categories = [];
        while($row = $stmt->fetch()){
            $category = new Category($row['ma_tloai'],$row['ten_tloai']);
            array_push($categories,$category);
        }
        return $categories;
    }

    public function getById(array $arguments){
        $database = new Database;
        $stmt = $database->runSQL('SELECT * FROM theloai WHERE ma_tloai=:matheloai',$arguments);
        $row = $stmt->fetch();
        $category = new Category($row['ma_tloai'],$row['ten_tloai']);
        return $category;
    }

    public function insert(array $arguments){
        $database = new Database;
        $database->runSQL("INSERT INTO `theloai`(`ma_tloai`, `ten_tloai`) VALUES (null,:tentheloai)",$arguments);
    }

    public function update(array $arguments){
        $database = new Database;
        $database->runSQL("UPDATE `theloai` SET `ten_tloai`=:tentheloai WHERE ma_tloai=:matheloai",$arguments);
    }

    public function delete(array $arguments){
        $database = new Database;
        $database->runSQL("DELETE from `theloai`WHERE ma_tloai=:matheloai",$arguments);
    }
}
?>