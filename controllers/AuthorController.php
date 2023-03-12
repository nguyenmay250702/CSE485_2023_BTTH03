<?php
use Twig\Environment;

use Twig\Loader\FilesystemLoader;

class AuthorController
{
    private $twig = null;
    public function __construct()
    {
        $this->twig = new Environment(new FilesystemLoader("views/admin"));
    }
    public function index()
    {
        $authorService = new AuthorService();
        $authors = $authorService->getAll('select * from tacgia');
        echo $this->twig->render("authors/index.html",["authors"=>$authors]);
    }

    public function add_author()
    {
        $authorService = new AuthorService();

        $ten_tgia = trim($_POST['ten_tgia'] ?? ""); //nếu $_POST['ten_tgia'] tồn tại thì $ten_tgia = $_POST['ten_tgia'] nếu không $ten_tgia = ""
        $hinh_tgia = $_FILES['hinh_tgia']['name'] ?? ""; //lấy ra tên file, vd: picachu.png
        $ext = pathinfo($hinh_tgia, PATHINFO_EXTENSION); // Get extension (lấy ra đuôi file), vd: .png, .jpg
        $extensions = ['png', 'jpg'];

        if (isset($_POST['btn'])) {
                $arguments['tentacgia'] = $ten_tgia;
                $arguments['hinhtacgia'] = $hinh_tgia;
                if (!empty($hinh_tgia)) {
                    if (in_array($ext, $extensions)) {
                        move_uploaded_file($_FILES['hinh_tgia']['tmp_name'], 'assets/images/songs/' . $hinh_tgia);

                        $authorService->insert($arguments);
                        header("location:?controller=author");
                    }
                    // } else {
                    //     $mess = "Hình ảnh chỉ nhận file: .png, .jpg";
                    //     header("location:?controller=author&action=add_author&mess=$mess");
                    // }
                } else {
                    $authorService->insert($arguments);
                    header("location:?controller=author");
                }
        }
        echo $this->twig->render("authors/add_author.html");
    }

    public function edit_author()
    {
        $authorService = new AuthorService();

        $ma_tgia = $_POST['ma_tgia'] ?? ""; //ở from sửa gửi sang
        $ten_tgia = trim($_POST['ten_tgia'] ?? ""); //nếu $_POST['ten_tgia'] tồn tại thì $ten_tgia = $_POST['ten_tgia'] nếu không $ten_tgia = ""
        $hinh_tgia = $_FILES['hinh_tgia']['name'] ?? ""; //lấy ra tên file, vd: picachu.png
        $ext = pathinfo($hinh_tgia, PATHINFO_EXTENSION); // Get extension (lấy ra đuôi file), vd: .png, .jpg
        $extensions = ['png', 'jpg'];
        // if (isset($_GET['id']))
        //     $arguments['matacgia'] = $_GET['id'];
        

        if (isset($_POST['btn'])) {

                $image = $hinh_tgia;
                if (empty($hinh_tgia)) {
                    $argument['matacgia'] = $ma_tgia;
                    $image = $authorService->getById($argument)->getHinhTGia();
                } else {
                    if (in_array($ext, $extensions)) {
                        move_uploaded_file($_FILES['hinh_tgia']['tmp_name'], 'assets/images/songs/' . $hinh_tgia);
                    } else {
                        $mess = "Hình ảnh chỉ nhận file: .png, .jpg";
                        header("location:?controller=author&action=edit_author&id=$ma_tgia&mess=$mess");
                        die();
                    }
                }

                $arguments['tentacgia'] = $ten_tgia;
                $arguments['hinhtacgia'] = $image;
                $arguments['matacgia'] = $ma_tgia;

                $authorService->update($arguments);
                header("location:?controller=author");
            } 
            
        
        $author = $authorService->getById(["matacgia" => $_GET['id']]);
        echo $this->twig->render("authors/edit_author.html",['author'=>$author, "mess" => $_GET["mess"] ?? ""]);
    }

    public function delete_author()
    {
        $authorService = new AuthorService();
        $articleService = new ArticleService();

        $list_id = "";
        $ma_tgia = $_GET['id'];
        $articles = $articleService->getAll("select * from baiviet where ma_tgia = '$ma_tgia'");
        if (isset($_POST['confirm'])) {
            if (count($articles) == 0) {    //nếu không có ràng buộc khóa ngoại với mục bài viết
                $arguments['matacgia'] = $ma_tgia;
                $authorService->delete($arguments);
                header("location:?controller=author");
            } else {
                // $list_id = "";
                foreach ($articles as $article) {
                    $list_id = $list_id . $article->getMaBViet() . "; ";
                }
                header("location:?controller=author&action=delete_author&id=$ma_tgia&list_id=$list_id");
            }
        }
        if($list_id != ""){
            $array['mess'] = "Bạn cần xóa các bài viết có mã là: $list_id trước khi xóa thể loại có mã = $ma_tgia";
            $array['display'] = false;
        }else{
            $array['mess'] = "Bạn có chắc chắn muốn xóa thể loại này không?";
            $array['display'] = true;
        }
        echo $this->twig->render("authors/delete_author.html",['array'=>$array]);
    }
}

?>