<?php
class User
{
    private $ma_ndung;
    private $username;
    private $password;

    public function __construct($ma_ndung, $username, $password)
    {
        $this->ma_ndung = $ma_ndung;
        $this->username = $username;
        $this->password = $password;
    }

    public function getMaNDung()
    {
        return $this->ma_ndung;
    }
    public function getUserName()
    {
        return $this->username;
    }
    public function setUserName($username_new)
    {
        $this->username = $username_new;
    }
    public function getPassWord()
    {
        return $this->password;
    }
    public function setPassWord($password_new)
    {
        $this->password = $password_new;
    }

}
?>