
<?php

 use PHPUnit\Util\Filesystem;
 use Twig\Environment;
 use Twig\Loader\FilesystemLoader;
class ArticleController
{
    private $twig =null;
    public function __construct(){
        $this->twig = new Environment(new FilesystemLoader('views/admin'));
    }
    public function index()
    { 
        $articleService = new ArticleService();
        $articles = $articleService->getAll('select * from baiviet ');
        echo $this->twig->render("articles/index.html",["articles"=>$articles]);

    }

    
}

?>