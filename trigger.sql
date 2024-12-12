-- Active: 1733306067549@@mysql-1e3f33b2-bk-book.e.aivencloud.com@28408@bkbook
DROP TRIGGER IF EXISTS over_book_quantity;

CREATE TRIGGER over_book_quantity
BEFORE INSERT ON cart
FOR EACH ROW
BEGIN
    DECLARE bookquantity INT;

    -- Lấy số lượng sách từ bảng book
    SELECT `Quantity` INTO bookquantity 
    FROM book 
    WHERE id = NEW.BookID;

    -- Kiểm tra nếu số lượng trong cart lớn hơn số lượng có sẵn
    IF NEW.quantity > bookquantity THEN
        -- Cập nhật số lượng trong cart nếu số lượng vượt quá
        SET NEW.Quantity = bookquantity;
    END IF;
END;


DROP TRIGGER IF EXISTS decrease_book_quantity;
CREATE TRIGGER decrease_book_quantity
AFTER INSERT ON contain
FOR EACH ROW
BEGIN
    DECLARE bookquantity INT;
    DECLARE md INT;
    -- Lấy số lượng sách từ bảng book
    SELECT `Quantity` INTO bookquantity 
    FROM book 
    WHERE id = NEW.BookID;

    -- Cập nhật số lượng sách trong bảng book
    UPDATE book
    SET `Quantity` = bookquantity - NEW.Quantity
    WHERE id = NEW.BookID;


    SELECT MemberID INTO md
    FROM `order`
    WHERE ID = NEW.OrderID;

    -- IF memberID IS NULL THEN
    -- -- Insert a debug message into the debug_log table
    -- INSERT INTO debug_log (log_message) 
    -- VALUES ('No member found with order ID 63');
    -- ELSE
    -- -- Insert a debug message into the debug_log table
    -- INSERT INTO debug_log (log_message) 
    -- VALUES ('No member found with order ID 63');
    -- -- VALUES (CONCAT('Decrease book quantity for book ', NEW.BookID, ' by ', NEW.Quantity, ' for member ', memberID));
    -- END IF;
    -- -- Insert a debug message into the debug_log table
    -- INSERT INTO debug_log (log_message) 
    -- VALUES (CONCAT('Decrease book quantity for book ', NEW.BookID, ' by ', NEW.Quantity, ' for member ', md));


    -- Loại bỏ sách ra khỏi giỏ hàng
    DELETE FROM cart
    WHERE BookID = NEW.BookID AND MemberID = md;
END;


DROP TRIGGER IF EXISTS check_cart_after_update_book_qty;
CREATE TRIGGER check_cart_after_update_book_qty
AFTER UPDATE ON book
FOR EACH ROW
BEGIN
    -- Kiểm tra tất cả các dòng trong cart có cùng BookID với sách vừa được cập nhật
    DECLARE cart_quantity INT;
    DECLARE done INT DEFAULT FALSE;
    
    -- Con trỏ để duyệt qua từng dòng trong bảng cart có BookID tương ứng
    DECLARE cur CURSOR FOR
        SELECT Quantity
        FROM cart
        WHERE BookID = NEW.id;
    
    -- Handlers cho trường hợp kết thúc con trỏ
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    -- Mở con trỏ
    OPEN cur;

    -- Lặp qua từng dòng của cart có BookID tương ứng
    read_loop: LOOP
        FETCH cur INTO cart_quantity;

        -- Kiểm tra nếu đã duyệt hết các dòng (done = TRUE)
        IF done THEN
            LEAVE read_loop;
        END IF;

        -- Kiểm tra nếu số lượng trong cart lớn hơn số lượng sách hiện có trong book
        IF cart_quantity > NEW.Quantity THEN
            -- Cập nhật trạng thái của dòng này trong cart
            UPDATE cart
            SET Status = 'not enough'
            WHERE BookID = NEW.id AND Quantity = cart_quantity;
        ELSE
            -- Nếu có đủ số lượng, có thể cập nhật lại trạng thái về 'available' (nếu cần)
            UPDATE cart
            SET Status = 'available'
            WHERE BookID = NEW.id AND Quantity = cart_quantity AND Status != 'not enough';
        END IF;
    END LOOP;

    -- Đóng con trỏ
    CLOSE cur;
END; //



CREATE TABLE debug_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    log_message VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TRIGGER IF EXISTS return_books_on_status_change;
CREATE TRIGGER return_books_on_status_change
AFTER UPDATE ON `order`
FOR EACH ROW
BEGIN
    DECLARE bd INT;
    DECLARE qt INT;
    DECLARE done INT DEFAULT 0;
    DECLARE cur CURSOR FOR 
        SELECT BookID, Quantity 
        FROM contain 
        WHERE OrderID = NEW.ID;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
    IF OLD.Status = 'Pending' AND (NEW.Status = 'Cancelled' OR NEW.Status = 'Rejected') THEN


        OPEN cur;
        read_loop: LOOP
            FETCH cur INTO bd, qt;
            IF done THEN
                LEAVE read_loop;
            END IF;
            -- Update the book quantity
            UPDATE book
            SET `Quantity` = `Quantity` + qt
            WHERE id = bd;
        END LOOP;
        CLOSE cur;
    END IF;
END ;


