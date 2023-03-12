<?php
class UserService{

    public function getAll($sql){
        $database = new Database;
        $stmt = $database->runSql($sql);
        $users = [];
        while($row = $stmt->fetch()){
            $user = new User($row['ma_ndung'],$row['username'],$row['password']);
            array_push($users,$user);
        }
        return $users;
    }

    public function getById($arguments){
        $database = new Database;
        $stmt = $database->runSql('SELECT * FROM nguoidung WHERE ma_ndung = :manguoidung',$arguments);
        $row = $stmt->fetch();
        $user = new User($row['ma_ndung'],$row['username'],$row['password']);
        return $user;
    }

    public function insert(array $arguments){
        $database = new Database;
        $database->runSql("INSERT INTO `nguoidung`(`ma_ndung`, `username`, `password`) VALUES (null,:user,:pass)",$arguments);
    }

    public function update(array $arguments){
        $database = new Database;
        $database->runSql("UPDATE `nguoidung` SET  `username`=:user, `password`=:pass WHERE ma_ndung=:id_user",$arguments);
    }

    public function delete(array $arguments){
        $database = new Database;
        $database->runSql("DELETE FROM `nguoidung`WHERE ma_ndung=:id_user",$arguments);
    }
}
?>