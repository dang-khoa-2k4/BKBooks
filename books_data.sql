-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2024 at 09:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csv_db 6`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `genre` varchar(19) DEFAULT NULL,
  `name` varchar(147) DEFAULT NULL,
  `publisher` varchar(27) DEFAULT NULL,
  `price` varchar(8) DEFAULT NULL,
  `author` varchar(47) DEFAULT NULL,
  `img` varchar(80) DEFAULT NULL,
  `des` varchar(819) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `genre`, `name`, `publisher`, `price`, `author`, `img`, `des`) VALUES
(1, 'Kỹ thuật', 'Quản lý năng suất và chất lượng', 'NXB Đại học Quốc gia TP.HCM', '75.000', 'Trần Thiên Phúc, Phạm Ngọc Tuấn (Đồng chủ biên)', 'https://images.vnuhcmpress.edu.vn/Picture/2024/9/26/image-20240926104859914.jpg', 'Tổng cục Tiêu chuẩn Đo lường Chất lượng đã tạo điều kiện để Trường Đại học Bách Khoa - ĐHQG TP.HCM chủ trì thực hiện đề tài nghiên cứu khoa học cấp quốc gia: \"Nghiên cứu phát triển chương trình đào tạo và triển khai đào tạo năng suất và chất lượng cho sinh viên các trường đại học khu vực phía Nam\".\n Giáo trình Quản lý năng suất và chất lượng là sản phẩm chính của đề tài, được biên soạn nhằm phục vụ việc giảng dạy học phần \"Quản lý năng suất và chất lượng\" trong các trường thành viên của ĐHQG TP.HCM.'),
(2, 'Kỹ thuật', 'Vật lý đại cương B', 'NXB Đại học Quốc gia TP.HCM', '80.000', 'Hồ Xuân Huy', 'https://images.vnuhcmpress.edu.vn/Picture/2024/8/14/image-20240814104459004.jpg', 'Quyển sách Vật lý đại cương B được nhóm tác giả Hồ Xuân Huy, Ngô Tú Trinh, Huỳnh Tất Thành là các giảng viên của Trường ĐH An Giang (ĐHQG-HCM) thực hiện biên soạn và chỉnh lý theo nội dung của chương trình đào tạo chuyên ngành Công nghệ Thực Phẩm trình độ Đại học chính quy đối với học phần Vật lý đại cương B/General Physics (PHY 103) của Trường đại học An Giang.'),
(3, 'Kỹ thuật', 'Các mô hình học sâu nâng cao', 'NXB Đại học Quốc gia TP.HCM', '50.000', 'Quản Thành Thơ', 'https://images.vnuhcmpress.edu.vn/Picture/2024/5/27/image-20240527111602257.jpg', ''),
(4, 'Kỹ thuật', 'Truyền thông không dây: Phân tích và mô phỏng', 'NXB Đại học Quốc gia TP.HCM', '66.000', '', 'https://images.vnuhcmpress.edu.vn/Picture/2024/5/22/image-20240522093220627.jpg', 'Sách chuyên khảo gồm bốn chương mà tập trung vào các khối cơ bản hình thành nên hệ thống truyền thông không dây'),
(5, 'Kỹ thuật', 'Exercises of Mechanics of Structures', 'NXB Đại học Quốc gia TP.HCM', '113.000', 'Vui Van Cao', 'https://images.vnuhcmpress.edu.vn/Picture/2024/5/22/image-2024052209455739.jpg', 'Preface Mechanics of Structures is an important engineering subject in civil engineering. Along with the theory, Exercises of Mechanics of Structures is an essential part, providing a platform for students to practice and improve their knowledge of the subject. This exercise book can assist students in overcoming difficulties and successfully studying the subject. This book has been written closely based on the course syllabus of the subject used at Ho Chi Minh City University of Technology (HCMUT) – Viet Nam National University Ho Chi Minh City (VNUHCM).'),
(6, 'Xã hội', 'Sự phát triển của kinh tế tư nhân ở Việt Nam (1991 - 2021)', 'NXB Đại học Quốc gia TP.HCM', '115.000', 'TS. Hoàng Xuân Sơn', 'https://images.vnuhcmpress.edu.vn/Picture/2024/10/29/image-2024102909245452.jpg', 'Sách chuyên khảo bao gồm 03 chương:\r\n\r\nChương 1: Quá trình phát triển của kinh tế tư nhân ở Việt Nam trong giai đoạn 1991 - 2005\r\nChương 2: Quá trình phát triển của kinh tế tư nhân ở Việt Nam trong giai đoạn 2006 - 2021\r\nChương 3: Nhận xét về quá trình phát triển của kinh tế tư nhân ở Việt Nam từ 1991 đến 2021'),
(7, 'Xã hội', 'Các bình diện của ngôn ngữ học ứng dụng, Sách tham khảo', 'NXB Đại học Quốc gia TP.HCM', '50.000', 'Phan Tuấn Ly', 'https://images.vnuhcmpress.edu.vn/Picture/2024/10/28/image-20241028145604673.jpg', 'Khoa Ngoại ngữ pháp lý, Trường Đại học Luật TP.HCM đã tổ chức hội thảo khoa học mang tên Ngôn ngữ học ứng dụng và giảng dạy ngoại ngữ chuyên ngành nhằm tạo ra cơ hội để cá giảng viên, các nhà quản lý, nhà nghiên cứu,.. giao lưu, chia sẻ, học hỏi, tăng cường kiến thức chuyên môn về lý luận, phương pháp và cập nhật những mô hình giảng dạy, các lý thuyết ngôn ngữ cũng như các nghiên cứu về ngôn ngữ học, ngôn ngữ học ứng dụng. Quyển sách này ra đời dựa trên sự tuyển chọn và tổng hợp các bài viết có chất lượng tốt liên quan đến 4 khía cạnh: \r\n\r\n(1) ứng dụng các lý thuyết ngôn ngữ học hiện đại\r\n\r\n(2) các nghiên cứu liên quan đến ngôn ngữ học thuộc các ngôn ngữ khác nhau\r\n\r\n(3) các nghiên cứu ghi nhận thực tiễn giảng dạy ngoại ngữ tại miền nam Việt Nam\r\n\r\n(4) các nghiên cứu khác có liên quan đến hoạt động giảng dạy'),
(8, 'Xã hội', 'Tiếng Việt cho người nước ngoài 3', 'NXB Đại học Quốc gia TP.HCM', '260.000', 'Lê Thị Minh Hằng', 'https://images.vnuhcmpress.edu.vn/Picture/2024/10/10/image-20241010101115561.jpg', 'Đây là cuốn “Giáo trình Tiếng Việt 3” trong bộ giáo trình được sử dụng chính thức ở Khoa Việt Nam học - Trường Đại học Khoa học xã hội và Nhân văn, ĐHQG-HCM để giảng dạy cho người nước ngoài.'),
(9, 'Xã hội', 'Kỹ năng tham mưu trong hoạt động văn phòng', 'NXB Đại học Quốc gia TP.HCM', '70.000', 'TS. Trần Văn Trung', 'https://images.vnuhcmpress.edu.vn/Picture/2024/10/10/image-20241010093924536.jpg', 'Giáo trình “Kỹ năng tham mưu trong hoạt động văn phòng” được biên soạn với mục đích làm tài liệu phục vụ nghiên cứu và học tập môn học tương đương trong chương trình đào tạo ngành Quản trị văn phòng nhằm đáp ứng chuẩn đầu ra của môn học và của chương trình đào tạo.'),
(10, 'Xã hội', 'Thể loại Văn học trung đại Việt Nam', 'NXB Đại học Quốc gia TP.HCM', '50.000', 'Nguyễn Cảnh Chương', 'https://images.vnuhcmpress.edu.vn/Picture/2024/9/26/image-20240926103531796.jpg', 'Trong quá trình giảng dạy Văn học trung đại Việt Nam, tác giả nhận thấy thể loại là vấn đề quan trọng cần được chia sẻ và hướng đến. Bởi vậy tác giả biên soạn tập sách này như một tài liệu cơ bản cho sinh viên ngành Ngữ Văn.'),
(11, 'KHTN', 'Thí nghiệm Vật lý đại cương B', 'NXB Đại học Quốc gia TP.HCM', '10.000', 'Nguyễn Hồng Hải,...', 'https://images.vnuhcmpress.edu.vn/Picture/2024/10/16/image-20241016103509069.jpg', 'Quyển sách Thí nghiệm Vật lý đại cương B được TS. Nguyễn Hồng Hải và ThS. Hồ Xuân Huy thực hiện biên soạn và chỉnh lý theo chương trình đào tạo hệ chính quy học phần Vật lý đại cương B ở bậc Đại học (PHY103); và là giáo trình giảng dạy trong nhiều năm qua ở Trường Đại học An Giang, Đại học Quốc gia Thành phố Hồ Chí Minh (ĐHQG-HCM).'),
(12, 'KHTN', 'Giáo trình Vi xử lý', 'NXB Đại học Quốc gia TP.HCM', '299.000₫', 'Nguyễn Hồng Hải, Hồ...', 'https://images.vnuhcmpress.edu.vn/Picture/2024/10/10/image-20241010092923272.jpg', '- Giáo trình Vi xử lý được biên soạn dựa trên họ MCU AVR 8 bit, tiêu biểu là MCU Atmega324P, là họ MCU 8 bit có cấu hình chuẩn rất thông dụng, phù hợp cho sinh viên tiếp cận bước đầu.\r\n- Nội dung giáo trình gồm 11 chương và phần phụ lục, được biên soạn chi tiết từ các khái niệm căn bản dẫn đến phân tích chi tiết cấu hình và hoạt động, cách giao tiếp phần cứng và giải thuật lập trình cho các khối phần cứng chức năng của MCU.\r\n- Người học có thể tự tham khảo từ kiến thức cơ bản đến nâng cao, nắm vững thiết kế họ MCU AVR, qua đó có thể tự tìm hiểu nghiên cứu các họ MCU khác'),
(13, 'KHTN', 'Giáo trình toán rời rạc', 'NXB Đại học Quốc gia TP.HCM', '8.000₫', 'Hoàng Trang', 'https://images.vnuhcmpress.edu.vn/Picture/2024/8/22/image-20240822143027869.jpg', 'Giáo trình Toán rời rạc được biên soạn nhằm giới thiệu các kiến thức cơ bản trong ba lĩnh vực có nhiều ứng dụng của toán rời rạc. Lĩnh vực thứ nhất tập trung nghiên cứu về thuật toán, độ phức tạp của thuật toán, công thức truy hồi, quy nạp toán học, lý thuyết tổ hợp, các nguyên lý trong tổ hợp, các bài toán đếm, các bài toán tồn tại và các bài toán liệt kê. \r\n\r\nLĩnh vực thứ hai tập trung nghiên cứu về hàm đại số logic, đại số Boole, biểu diễn hàm Boole, xây dựng các mạch tổ hợp cũng như cực tiểu hóa các mạch tổ hợp để thiết kế được các mạch tổ hợp. \r\n\r\nLĩnh vực thứ ba là lý thuyết đồ thị tập trung nghiên cứu về các khái niệm đồ thị, biểu diễn đồ thị, đồ thị Hamilton, đồ thị Euler, các bài toán về đường đi và các bài toán về cây phủ,…'),
(14, 'KHTN', 'Giáo trình Các phương pháp phân tích hóa lý', 'NXB Đại học Quốc gia TP.HCM', '11.900₫', 'TS. Nguyễn Đình Lầu...', 'https://images.vnuhcmpress.edu.vn/Picture/2024/8/22/image-20240822141615837.jpg', 'Giáo trình cung cấp cho người học các kiến thức chuyên sâu về các phương pháp phân tích hóa lý hiện đại được sử dụng rộng rãi hiện nay bao gồm: các phương pháp quang phổ, các phương pháp điện hóa hiện đại và các phương pháp tách sắc ký – điện di mao quản để áp dụng trong thực tiễn cũng như vận dụng trong nghiên cứu khoa học. \r\n\r\nGiáo trình cũng nhằm mục tiêu giúp người học có nền tảng vững chắc về phân tích để học tập các học phần khác trong chương trình đào tạo bậc học sau đại học.'),
(15, 'KHTN', 'Giáo trình Lập trình Python', 'NXB Đại học Quốc gia TP.HCM', '132.000₫', 'Bùi Xuân Vững (Chủ...', 'https://images.vnuhcmpress.edu.vn/Picture/2024/8/16/image-20240816143943163.jpg', 'Giáo trình Lập trình Python giới thiệu tổng quan và toàn diện về ngôn ngữ lập trình python từ cơ bản đến nâng cao. Mục tiêu là giúp người học nắm vững nguyên tắc cơ bản lập trình python để có thể vận dụng vào phát triển lập trình mạng, lập trình ứng dụng web, lập trình game, xây dựng phần mềm, khoa học và tính toán hay các lĩnh vực nghiên cứu như Máy học, Trí tuệ nhân tạo, Thị giác máy tính,…'),
(16, 'KHTN', 'Toán A3 (Đại số tuyến tính)', 'NXB Đại học Quốc gia TP.HCM', '120.000₫', 'ThS. Nguyễn Minh Tân...', 'https://images.vnuhcmpress.edu.vn/Picture/2024/8/15/image-20240815143209252.jpg', ''),
(17, 'KHTN', 'Vật lý đại cương B', 'NXB Đại học Quốc gia TP.HCM', '130.000₫', 'Trần Thị Ngọc Giàu...', 'https://images.vnuhcmpress.edu.vn/Picture/2024/8/14/image-20240814104459004.jpg', 'Quyển sách Vật lý đại cương B được nhóm tác giả Hồ Xuân Huy, Ngô Tú Trinh, Huỳnh Tất Thành là các giảng viên của Trường ĐH An Giang (ĐHQG-HCM) thực hiện biên soạn và chỉnh lý theo nội dung của chương trình đào tạo chuyên ngành Công nghệ Thực Phẩm trình độ Đại học chính quy đối với học phần Vật lý đại cương B/General Physics (PHY 103) của Trường đại học An Giang.'),
(18, 'KHTN', 'Giáo trình Dao động và sóng', 'NXB Đại học Quốc gia TP.HCM', '7.500₫', 'Hồ Xuân Huy', 'https://images.vnuhcmpress.edu.vn/Picture/2024/7/4/image-20240704110037898.jpg', 'Giáo trình Dao động và sóng được nhóm biên soạn thực hiện để đáp ứng nhu cầu về tài liệu trong quá trình dạy và học cho sinh viên chuyên ngành Vật lí (Cử nhân Sư phạm Vật lí, Cử nhân Vật lí kĩ thuật của Khoa Vật lí). Bên cạnh đó, giáo trình còn có thể được sử dụng làm tài liệu tham khảo cho sinh viên các ngành kĩ thuật của các trường đại học khác có học vật lí. '),
(19, 'Tài chính & Kinh tế', 'Giáo trình Quản trị doanh nghiệp', 'NXB Đại học Quốc gia TP.HCM', '94.000₫', 'Nguyễn Thị Thu An,...', 'https://images.vnuhcmpress.edu.vn/Picture/2024/10/29/image-20241029101913618.jpg', 'Giáo trình Quản trị doanh nghiệp để phục vụ giảng dạy của giảng viên và học tập của sinh viên thuộc khối ngành kinh tế - kỹ thuật ở bậc đại học là cần thiết.\r\n\r\nNội dung của Giáo trình được thiết kế thành 06 chương:\r\n\r\nChương 1: Tổng quan về doanh nghiệp\r\nChương 2: Khái quát về hoạt động quản trị trong doanh nghiệp\r\nChương 3: Quản trị nguồn nhân lực, tiền lương và kỹ thuật, công nghệ trong doanh nghiệp\r\nChương 4: Quản trị vật tư và Quản trị tồn kho\r\nChương 5: Quản trị chi phí và kết quả sản suất kinh doanh trong doanh nghiệp\r\nChương 6: Quản trị kinh doanh quốc tế'),
(20, 'Tài chính & Kinh tế', 'Thanh toán quốc tế', 'NXB Đại học Quốc gia TP.HCM', '149.000₫', 'TS. Đặng Hùng Vũ', 'https://images.vnuhcmpress.edu.vn/Picture/2024/10/28/image-20241028151315084.jpg', ''),
(21, 'Tài chính & Kinh tế', 'Kỷ yếu Diễn đàn Logistics Thành Phố Hồ Chí Minh - Nâng cao năng lực cạnh tranh Logistics của TP.HCM, Thành phố Hồ Chí Minh ngày 30 tháng 5 năm 2024', 'NXB Đại học Quốc gia TP.HCM', '10.000₫', 'Hoa Sen University,...', 'https://images.vnuhcmpress.edu.vn/Picture/2024/9/23/image-20240923113958178.jpg', 'Diễn đàn Logistics “Nâng cao năng lực cạnh tranh Logistics của Thành phố Hồ Chí Minh” là diễn đàn chuyên ngành nhằm tạo môi trường học thuật để lắng nghe những chia sẻ, đóng góp chuyên môn quý giá của các chuyên gia và doanh nghiệp trong lĩnh vực Logistics.\r\nCuốn kỷ yếu này bao gồm các bài tham luận liên quan đến chủ đề của diễn đàn. Các bài viết trong kỷ yếu không chỉ có giá trị khoa học, mà còn là tài liệu tham khảo quý giá cho việc nghiên cứu và giảng dạy chuyên ngành Thương mại quốc tế và Logistics. Đồng thời, cuốn kỷ yếu cũng là nguồn tham khảo hữu ích cho các nhà hoạch định chính sách trong lĩnh vực này.'),
(22, 'Tài chính & Kinh tế', 'Sách chuyên khảo Quản trị rủi ro chuỗi cung ứng theo hướng tiếp cận cấu trúc năng động', 'NXB Đại học Quốc gia TP.HCM', '190.000₫', 'TS. Nguyễn Văn Thích -...', 'https://images.vnuhcmpress.edu.vn/Picture/2024/6/19/image-20240619103304579.jpg', ''),
(23, 'Tài chính & Kinh tế', 'Quản trị dự án (Tái bản lần thứ 5)', 'NXB Đại học Quốc gia TP.HCM', '129.000₫', 'Trịnh Thùy Anh', 'https://images.vnuhcmpress.edu.vn/Picture/2024/6/3/image-20240603144127502.jpg', 'Cuốn sách Quản trị dự án sẽ giúp các bạn tự nghiên cứu môn học với các kiến thức cốt lõi nhất, cơ bản nhất mà một nhà quản trị cần phải biết về các vấn đề liên quan đến dự án.'),
(24, 'Tài chính & Kinh tế', 'Kỹ năng vận dụng pháp luật lao động tại doanh nghiệp', 'NXB Đại học Quốc gia TP.HCM', '180.000₫', 'ThS. Nguyễn Thị Hồng', 'https://images.vnuhcmpress.edu.vn/Picture/2024/3/29/image-20240329090511496.jpg', 'Quý bạn đọc đang cầm trên tay cuốn sách “Kỹ năng vận dụng pháp luật lao động tại doanh nghiệp”. Cuốn sách này là kết quả đúc kết ngắn gọn của tác giả qua quá trình 15 năm làm việc, tư vấn, kiểm tra pháp luật lao động và tham gia giải quyết nhiều vụ án, tranh chấp lao động cá nhân và tập thể.\r\n\r\nĐây là cuốn sách phù hợp và cần thiết cho các bạn là Chủ doanh nghiệp - Pháp chế - Nhân sự và các bạn sinh viên Luật muốn tìm hiểu về pháp luật lao động một cách thực tiễn nhất.'),
(25, 'Tài chính & Kinh tế', 'Phân tích định lượng trong quản trị', 'NXB Đại học Quốc gia TP.HCM', '153.000₫', 'Trần Tuấn Anh', 'https://images.vnuhcmpress.edu.vn/Picture/2024/3/29/image-20240329093704092.jpg', 'Nội dung của quyển sách này giới thiệu một số kiến thức nền tảng của môn học Phân tích định lượng trong quản trị và giúp người đọc từng bước ứng dụng các phần mềm để giải quyết một số vấn đề cơ bản thường gặp trong thực tiễn.\r\n\r\nCuốn sách này cần thiết cho các bạn sinh viên học ngành Quản trị kinh doanh và các ngành như: Kinh doanh quốc tế, Marketing, Quản trị nhân lực, Du lịch, Logistics và quản lý chuỗi cung ứng và một số ngành có liên quan.\r\n\r\nSách cũng có thể được dùng làm tài liệu tham khảo bổ ích cho các nhà quản trị muốn trau dồi kiến thức và kỹ năng phân tích định lượng trong quản trị.'),
(26, 'Tài chính & Kinh tế', 'Phát triển tài chính, cấu trúc tài chính và tăng trưởng kinh tế, Sách chuyên khảo', 'NXB Đại học Quốc gia TP.HCM', '150.000₫', 'TS. Huỳnh Thị Thúy Vy', 'https://images.vnuhcmpress.edu.vn/Picture/2024/3/26/image-20240326145809777.jpg', 'Sách chuyên khảo này là kết quả từ Luận án Tiến sỹ chuyên ngành Tài chính - Ngân hàng của tác giả, đã bảo vệ thành công vào năm 2023 tại Trường Đại học Kinh tế TPHCM.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
