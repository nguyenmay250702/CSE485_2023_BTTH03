<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class UserController
{
    private $twig_user = null;
    public function __construct()
    {
        $this->twig_user = new Environment(new FilesystemLoader("views/admin"));
    }
    public function index()
    {
        $userService = new UserService();
        echo $this->twig_user->render("users/index.html", ["userService" => $userService]);
    }

    public function add_user()
    {
        $userService = new UserService();

        if (isset($_POST['btn'])) {

            $arguments['user'] = trim($_POST['user']);
            $arguments['pass'] = trim($_POST['pass']);

            $userService->insert($arguments);
            header("location:?controller=user");
        }
        echo $this->twig_user->render("users/add_user.html");
    }

    public function edit_user()
    {
        $userService = new UserService();

        if (isset($_GET['id'])) {
            $id_user = $_GET['id'];
            $user = $userService->getById(['manguoidung' => $id_user]);

            if (isset($_POST['btn'])) {
                $arguments['user'] = trim($_POST['user']);
                $arguments['pass'] = trim($_POST['pass']);
                $arguments['id_user'] = $_POST['id_user'];

                $userService->update($arguments);
                header("location:?controller=user");
            }
            $user_old['id_user'] = $id_user;
            $user_old['username'] = $user->getUserName() ?? "";
            $user_old['password'] = $user->getPassWord() ?? "";
    
            echo $this->twig_user->render("users/edit_user.html", ["user_old" => $user_old]);
        }
    }

    public function delete_user()
    {
        $userService = new UserService();

        if (isset($_POST['confirm'])) {
            $argument['id_user'] = $_GET['id'];
            $userService->delete($argument);
            header("location:?controller=user");
        }

        echo $this->twig_user->render("users/delete_user.html");
    }
}

?>