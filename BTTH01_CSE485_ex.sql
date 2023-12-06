
#a
SELECT baiviet.ma_bviet, baiviet.tieude, baiviet.ten_bhat, baiviet.tomtat, baiviet.noidung, baiviet.ngayviet, baiviet.hinhanh
FROM baiviet
JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
WHERE theloai.ten_tloai = 'Nhạc trữ tình';

#b
SELECT baiviet.ma_bviet, baiviet.tieude, baiviet.ten_bhat, baiviet.tomtat, baiviet.noidung, baiviet.ngayviet, baiviet.hinhanh
FROM baiviet
JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
WHERE tacgia.ten_tgia = 'Nhacvietplus';

#c
SELECT theloai.ma_tloai, theloai.ten_tloai
FROM theloai
LEFT JOIN baiviet ON theloai.ma_tloai = baiviet.ma_tloai
WHERE baiviet.ma_bviet IS NULL;

#d
SELECT baiviet.ma_bviet, baiviet.tieude, baiviet.ten_bhat, tacgia.ten_tgia, theloai.ten_tloai, baiviet.ngayviet
FROM baiviet
JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai;

#e
SELECT theloai.ma_tloai, theloai.ten_tloai, COUNT(baiviet.ma_bviet) AS so_bai_viet
FROM theloai
LEFT JOIN baiviet ON theloai.ma_tloai = baiviet.ma_tloai
GROUP BY theloai.ma_tloai, theloai.ten_tloai
ORDER BY so_bai_viet DESC
LIMIT 1;

#f
SELECT tacgia.ma_tgia, tacgia.ten_tgia, COUNT(baiviet.ma_bviet) AS so_bai_viet
FROM tacgia
LEFT JOIN baiviet ON tacgia.ma_tgia = baiviet.ma_tgia
GROUP BY tacgia.ma_tgia, tacgia.ten_tgia
ORDER BY so_bai_viet DESC
LIMIT 2;

#g
SELECT ma_bviet, tieude, ten_bhat, tomtat, noidung, ngayviet, hinhanh
FROM baiviet
WHERE ten_bhat LIKE '%yêu%'
    OR ten_bhat LIKE '%thương%'
    OR ten_bhat LIKE '%anh%'
    OR ten_bhat LIKE '%em%';

#h
SELECT ma_bviet, tieude, ten_bhat, tomtat, noidung, ngayviet, hinhanh
FROM baiviet
WHERE tieude LIKE '%yêu%'
    OR ten_bhat LIKE '%yêu%'
    OR tieude LIKE '%thương%'
    OR ten_bhat LIKE '%thương%'
    OR tieude LIKE '%anh%'
    OR ten_bhat LIKE '%anh%'
    OR tieude LIKE '%em%'
    OR ten_bhat LIKE '%em%';

#i
CREATE VIEW vw_Music AS
SELECT
    baiviet.ma_bviet,
    baiviet.tieude,
    baiviet.ten_bhat,
    theloai.ten_tloai AS ten_the_loai,
    tacgia.ten_tgia AS ten_tac_gia,
    baiviet.ngayviet
FROM
    baiviet
JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia;

#j
DELIMITER //

CREATE PROCEDURE sp_DSBaiViet(IN p_ten_tloai VARCHAR(50))
BEGIN
    DECLARE v_tloai_id INT;

    SELECT ma_tloai INTO v_tloai_id FROM theloai WHERE ten_tloai = p_ten_tloai;

    IF v_tloai_id IS NOT NULL THEN
        
        SELECT baiviet.ma_bviet, baiviet.tieude, baiviet.ten_bhat, baiviet.tomtat, baiviet.noidung, baiviet.ngayviet, baiviet.hinhanh
        FROM baiviet
        WHERE baiviet.ma_tloai = v_tloai_id;
    ELSE
        
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Thể loại không tồn tại';
    END IF;
END //

DELIMITER ;

#k
ALTER TABLE theloai
ADD COLUMN SLBaiViet INT DEFAULT 0;

DELIMITER //

CREATE TRIGGER tg_CapNhatTheLoai
AFTER INSERT ON baiviet
FOR EACH ROW
BEGIN

    UPDATE theloai
    SET SLBaiViet = SLBaiViet + 1
    WHERE ma_tloai = NEW.ma_tloai;
END //

DELIMITER ;

#l
CREATE TABLE Users (
    user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
