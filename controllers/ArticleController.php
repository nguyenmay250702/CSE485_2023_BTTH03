
<?php

 use PHPUnit\Util\Filesystem;
 use Twig\Environment;
 use Twig\Loader\FilesystemLoader;
class ArticleController
{
    private $twig =null;
    private $twig_homes = null;
    public function __construct(){
        $this->twig = new Environment(new FilesystemLoader('views/admin'));
        $this->twig_homes = new Environment(new FilesystemLoader('views'));

    }
    public function index()
    { 
        $articleService = new ArticleService();
        $articles = $articleService->getAll('select * from baiviet ');
        echo $this->twig->render("articles/index.html",["articles"=>$articles]);

    }

    public function search(){
        $articleService = new ArticleService();
        if(isset($_POST['search'])){
            $nodungcantim = $_POST['nodungcantim'];
            $articles = $articleService->getAll("SELECT * FROM baiviet WHERE ten_bhat LIKE '%$nodungcantim%'");
            echo $this->twig_homes->render("homes/index.html",["articles"=>$articles]);
        }
    }
}

?>