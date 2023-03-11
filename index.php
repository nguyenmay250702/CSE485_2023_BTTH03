<?php
require_once 'vendor/autoload.php';
require_once('config/database.php');

//tự động load class khi cần sd
function loader($className)
{
    $fullpath_1 = "services/" . $className . ".php";
    $fullpath = "models/" . $className . ".php";

    if (file_exists($fullpath_1)){
        require_once($fullpath_1);
        return;
    }
    require_once($fullpath);
};

spl_autoload_register('loader');

//lấy ra controller=tên file controller
$controller = ucfirst(isset($_GET['controller'])? $_GET['controller']:'home').'Controller';

//lấy ra action=tên hàm muốn thực thi
$action = isset($_GET['action'])? $_GET['action']:'index';

//đường dẫn đến file controller
$controllerPath = 'controllers/'.$controller.'.php';

//nếu file ...controller.php không tồn tại tệp trong thư mục controller thì dừng và đưa ra thông báo
if(!file_exists($controllerPath)){
    die('Tệp tin không tồn tại');
}

//nếu có tồn tại tệp trong controller thì thực hiện nhúng file
require_once($controllerPath);

//khởi tạo ra đối tượng controller và gọi đến phương thức tương ứng với giá trị của acction
$myObj = new $controller();
$myObj->$action();
?>