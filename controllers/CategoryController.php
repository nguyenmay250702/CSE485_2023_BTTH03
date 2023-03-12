<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class CategoryController
{
    private $twig = null;
    public function __construct(){
        $this->twig = new Environment(new FilesystemLoader('views/admin'));
    }
    public function index()
    {
        $categoryService = new CategoryService();
        $categories = $categoryService->getAll('select *from theloai');
        echo $this->twig->render("categories/index.html",["categories"=>$categories]);
    }

    public function add_category()
    {
        $categoryService = new CategoryService();

        if (isset($_POST['btn'])) {
            $arguments['tentheloai'] = trim($_POST['ten_tloai']);
            $categoryService->insert($arguments);
            header("location:?controller=category");
        }
        echo $this->twig->render("categories/add_category.html");
    }

    public function edit_category()
    {
        $categoryService = new CategoryService();

        //lấy ra thông tin cần sửa
        if (isset($_GET['id']))
            $arguments['matheloai'] = $_GET['id'];
            $category = $categoryService->getById($arguments);

        //nếu nhấn submit thì sẽ tiến hành kiểm tra và sửa thông tin nếu thỏa mãn đk
        if (isset($_POST['btn'])) {
                $arguments['tentheloai'] = trim($_POST['ten_tloai']);
                $arguments['matheloai'] = $_POST['ma_tloai'];

                $categoryService->update($arguments);
                header("location:?controller=category");            
        }
        
        echo $this->twig->render("categories/edit_category.html",["category"=>$category]);
    }

    public function delete_category()
    {
        $categoryService = new CategoryService();
        $articleService = new ArticleService();

        $list_id = "";
        $ma_tloai = $_GET['id'];
        $articles = $articleService->getAll("select * from baiviet where ma_tloai = '$ma_tloai'");
        if (count($articles) == 0) { //nếu không có ràng buộc khóa ngoại với mục bài viết
            $arguments['matheloai'] = $ma_tloai;
            if(isset($_POST['confirm'])){
                $categoryService->delete($arguments);
                header("location:?controller=category");
            }            
        } else {
            foreach ($articles as $article) {
                $list_id = $list_id . $article->getMaBViet() . "; ";
            }         
        }

        if($list_id != ""){
            $array['mess'] = "Bạn cần xóa các bài viết có mã là: $list_id trước khi xóa thể loại có mã = $ma_tloai";
            $array['display'] = false;
        }else{
            $array['mess'] = "Bạn có chắc chắn muốn xóa thể loại này không?";
            $array['display'] = true;
        }
        
        echo $this->twig->render("categories/delete_category.html",["array"=>$array]);
    }
}

?>