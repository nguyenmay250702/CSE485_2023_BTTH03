
-- 1.Liệt kê các bài viết về các bài hát thuộc thể loại Nhạc trữ tình
SELECT baiviet.ma_bviet, baiviet.tieude, baiviet.ten_bhat, baiviet.ma_tloai, theloai.ten_tloai 
FROM baiviet,theloai 
WHERE baiviet.ma_tloai=theloai.ma_tloai and theloai.ten_tloai="Nhạc trữ tình";

-- 2.Liệt kê các bài viết của tác giả “Nhacvietplus”
SELECT baiviet.ma_bviet,baiviet.tieude,baiviet.ten_bhat,baiviet.ma_tgia,tacgia.ten_tgia 
FROM baiviet,tacgia 
WHERE baiviet.ma_tgia=tacgia.ma_tgia and tacgia.ten_tgia="Nhacvietplus";

--3. Liệt kê các thể loại nhạc chưa có bài viết cảm nhận nào
SELECT ten_tloai FROM theloai WHERE ma_tloai Not IN (SELECT ma_tloai FROM baiviet);

--4. Liệt kê các bài viết với các thông tin sau: mã bài viết, tên bài viết, tên bài hát, tên tác giả, tên thể loại, ngày viết
SELECT baiviet.ma_bviet,baiviet.tieude,baiviet.ten_bhat,tacgia.ten_tgia,theloai.ten_tloai,baiviet.ngayviet 
FROM baiviet,tacgia,theloai 
WHERE baiviet.ma_tloai=theloai.ma_tloai and baiviet.ma_tgia=tacgia.ma_tgia;

--5. Tìm thể loại có số bài viết nhiều nhất
SELECT theloai.ten_tloai FROM theloai
INNER JOIN baiviet on baiviet.ma_tloai = theloai.ma_tloai
GROUP BY baiviet.ma_tloai
ORDER BY COUNT(baiviet.ma_tloai) DESC LIMIT 1;

--6. Liệt kê 2 tác giả có số bài viết nhiều nhất
SELECT tacgia.ma_tgia,tacgia.ten_tgia from baiviet,tacgia
WHERE tacgia.ma_tgia = baiviet.ma_tgia 
GROUP BY baiviet.ma_tgia
ORDER BY COUNT(baiviet.ma_tgia) DESC LIMIT 2;

--7. Liệt kê các bài viết về các bài hát có tựa bài hát chứa 1 trong các từ “yêu”, “thương”, “anh”, “em”
SELECT * 
FROM `baiviet` 
WHERE ten_bhat LIKE '%yêu%' or ten_bhat LIKE '%thương%' or ten_bhat LIKE '%anh%' or ten_bhat LIKE '%em%';

--8. Liệt kê các bài viết về các bài hát có tiêu đề bài viết hoặc tựa bài hát chứa 1 trong các từ “yêu”, “thương”, “anh”, “em”
SELECT * 
FROM `baiviet` 
WHERE tieude LIKE '%yêu%' or tieude LIKE'%thương%' or tieude LIKE '%anh%' or tieude LIKE '%em%' or ten_bhat LIKE '%yêu%' or ten_bhat LIKE'%thương%' or ten_bhat LIKE '%anh%' or ten_bhat LIKE '%em%';

--9. Tạo 1 view có tên vw_Music để hiển thị thông tin về Danh sách các bài viết kèm theo Tên thể loại và tên tác giả 
CREATE VIEW vw_Music as 
SELECT baiviet.ma_bviet,baiviet.tieude,theloai.ten_tloai,tacgia.ten_tgia 
FROM baiviet,theloai,tacgia 
WHERE baiviet.ma_tloai=theloai.ma_tloai and baiviet.ma_tgia=tacgia.ma_tgia;

--10. Tạo 1 thủ tục có tên sp_DSBaiViet với tham số truyền vào là Tên thể loại và trả về danh sách Bài viết của thể loại đó. Nếu thể loại không tồn tại thì hiển thị thông báo lỗi
CREATE PROCEDURE `sp_DSBaiViet`(IN `ten_the_loai` VARCHAR(50)) NOT DETERMINISTIC CONTAINS SQL SQL SECURITY DEFINER BEGIN if(EXISTS(SELECT * FROM baiviet,theloai WHERE baiviet.ma_tloai = theloai.ma_tloai AND theloai.ten_tloai=ten_the_loai)) THEN SELECT baiviet.ma_bviet,baiviet.tieude,baiviet.ten_bhat,baiviet.ma_tloai,theloai.ten_tloai FROM baiviet,theloai WHERE baiviet.ma_tloai = theloai.ma_tloai AND theloai.ten_tloai=ten_the_loai; ELSE SELECT concat('Chưa có bài viết cho thể loại: ',ten_the_loai) AS 'MESSAGE'; END IF; END

--11. Thêm mới cột SLBaiViet vào trong bảng theloai. Tạo 1 trigger có tên tg_CapNhatTheLoai để khi thêm/sửa/xóa bài viết thì số lượng bài viết trong bảng theloai được cập nhật theo


--12. Bổ sung thêm bảng Users để lưu thông tin Tài khoản đăng nhập và sử dụng cho chức năng Đăng nhập/Quản trị trang web.
CREATE TABLE `nguoidung` (
  `ma_ndung` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `nguoidung` (`ma_ndung`, `username`, `password`) VALUES
(1, 'nguyenmay', '250702'),
(4, 'nguyennhi', '2911'),
(5, 'nguyentuoi', '06012002'),
(6, 'vuthanh', '201101');


