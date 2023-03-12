<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class HomeController
{
    private $twig=null;

    public function __construct()
    {
        $this->twig = new Environment(new FilesystemLoader('views'));
    }
    public function index()
    {
        $articleService = new ArticleService();
        $categoryService = new CategoryService();

        $articles = $articleService->getAll('select * from baiviet');
        echo $this->twig->render('homes/index.html', ["articles" => $articles, "categoryService" => $categoryService]);
    }

    public function login()
    {
        $userService = new UserService();
        session_start();

        if (isset($_POST['btn'])) {
            $user = $_POST["user"];
            $pass = $_POST["pass"];

            $result = $userService->getAll('select * from nguoidung where username ="' . $user . '" and password = "' . $pass . '"');

            if (count($result) > 0) {
                if (isset($_POST['save_pass'])) {
                    setcookie('tennguoidung', $user, time() + 3600, '/', '', 0, 0);
                    setcookie('matkhau', $pass, time() + 3600, '/', '', 0, 0);
                }
                $_SESSION['login'] = $user;
                header("location:?action=admin");
            } else {
                $mess = "tài khoản không tồn tại. Vui lòng kiểm tra lại thông tin đăng nhập";
                header("location:?action=login&notification=" . $mess);
            }
        }

        $information["cookie_username"] = $_COOKIE['tennguoidung'] ?? "";
        $information["cookie_password"] = $_COOKIE['matkhau'] ?? "";
        $information["mess"] = $_GET['notification'] ?? "";
        if (isset($_COOKIE['tennguoidung']))
            $information["checked"] = "checked";

        echo $this->twig->render("homes/login.html", ["information" => $information]);
    }

    public function register()
    {
        $userService = new UserService();

        if (isset($_POST['btn'])) {
            $arguments['user'] = $_POST["user"];
            $arguments['pass'] = $_POST["pass"];

            $userService->insert($arguments);
            header("location:?action=login");
        }
        echo $this->twig->render("homes/register.html");
    }

    public function admin()
    {
        $articleService = new ArticleService();
        $categoryService = new CategoryService();
        $authorService = new AuthorService();
        $userService = new UserService();
        session_start();

        if (!isset($_SESSION['login']))
            header('location:?action=login');
        $array['soLuongBV'] = count($articleService->getAll("select *from baiviet"));
        $array['soLuongTL'] = count($categoryService->getAll("select *from theloai"));
        $array['soLuongTG'] = count($authorService->getAll("select *from tacgia"));
        $array['soLuongND'] = count($userService->getAll("select *from nguoidung"));

        echo $this->twig->render("admin/index.html",["array"=>$array]);
    }

    public function detail()
    {
        $articleService = new ArticleService();
        $categoryService = new CategoryService();
        $authorService = new AuthorService();

        $article = $articleService->getById(["mabaiviet" => $_GET['id_article']]);
        $ten_tgia = $authorService->getById(["matacgia" => $article->getMaTGia()])->getTenTGia();
        $ten_tloai = $categoryService->getById(["matheloai" => $article->getMaTLoai()])->getTenTheLoai();

        echo $this->twig->render('homes/detail.html', ["article" => $article, "ten_tgia" => $ten_tgia, "ten_tloai" => $ten_tloai]);
    }
}
?>