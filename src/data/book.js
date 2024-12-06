
import image from "../Assert/image books/cart1.png"
import image1 from "../Assert/image books/1.png"
import image2 from "../Assert/image books/2.png"
import image3 from "../Assert/image books/3.png"
import image4 from "../Assert/image books/4.png"
import image5 from "../Assert/image books/5.png"
import image6 from "../Assert/image books/6.png"


export const bookHeader = [
    "Mã sách",
    "Tên Sách",
    "Nhà Xuất Bản",
    "Tác Giả",
    "Giá",
    "Mô tả",
    ""
]

// Sample data for admin(like user),but just select 5 fields
export const bookData = [
    {
        book_id:"1",
        book_name:"Sword Art Online Progressive Vol 7",
        book_publisher:"IPM, Thành phố hồ Chí Minh",
        book_author:"REKI KAWAHARA",
        book_price:"120000",
        book_description:"Dễ thấy Sword Art Online có không gian kể..."
    },
    {
        book_id:"2",
        book_name:"Sword Art Online Progressive Vol 7",
        book_publisher:"IPM, Hà Nội",
        book_author:"REKI KAWAHARA",
        book_price:"120000",
        book_description:"Dễ thấy Sword Art Online có không gian kể..."
    },
]

export const bookModalAdd = [
    ["Tên Sách","book_name"],
    ["Nhà Xuất Bản","book_publisher"],
    ["Tác Giả","book_author"],
    ["Giá","book_price"],
    ["Mô tả","book_description"]
]



// Sample data for client
export const book = [
    {
        book_id:"1",
        book_name:"Sword Art Online Progressive Vol 7",
        book_publisher:"IPM, Thành phố hồ Chí Minh",
        book_author:"REKI KAWAHARA",
        book_price:"30.00 $",
        book_description:"Dễ thấy Sword Art Online có không gian kể chuyện rất rộng, lại tỉ mỉ đi theo từng tầng, tạo cảm giác tận hưởng rõ rệt cho người chơi và cả người đọc. Câu chuyện hiện đã đến tầng 7, vẫn là tầng từng trải nghiệm trong giai đoạn chạy thử của SAO, nói cách khác, cho đến đây, Kirito vẫn biết nhiều hiểu rộng hơn Asuna. Thành ra theo thói quen, vừa tới nơi Asuna đã lập tức hỏi cậu xem chỗ ăn chỗ chơi nào ngon. So với các lần trước, lần này Kirito tỏ ra ngần ngừ rõ rệt. Không phải cậu không muốn cho cô biết, mà là tầng này đã để lại cho cậu dư vị cay đắng đến nỗi tiềm thức luôn muốn chối bỏ hết thông tin. Cho đến lúc sắp ra bãi săn bên ngoài, nhìn thấy có tận hai cổng để đi, Kirito mới khôi phục kí ức. Một cổng ốp phù điêu hình người sang trọng nâng ly rượu, mở ra con đường thênh thang phơi phới. Một cổng là người ăn mặc lam lũ gò mình đi dưới gió táp mưa sa, hứa hẹn hành trình gập ghềnh. Sau khi nghe giải thích, Asuna chọn đường gió táp mưa sa… Tập 7 chứa đựng đôi chút suy luận điều tra dựa trên một manh mối vô lý, gợi nhớ không khí tập làm thám tử của Kirito khi gặp án mạng trong khu vực an toàn ở Sword Art Online 008 “Early and Late”.",
        book_image:image,
        book_category:"education",
        book_start:5,
        book_review:345,
        book_discount:35,
        book_year:2024,
        book_language:"Tiếng Việt",

    },
    {
        book_id: "2", // Starting index from 2
        book_name: "The Lady Beauty Scarlett",
        book_publisher: "Armor Ramsey",
        book_author: "Armor Ramsey",
        book_price: "30.00 $",
        book_description: "A tale of beauty and love, a woman whose beauty transcends the ordinary.",
        book_image: image1,
        book_category: "management", // Explicitly set to "management"
        book_start: 5,
        book_review: 345,
        book_discount: 10,
        book_year:2024,
        book_language:"Tiếng Việt",

      },
      {
        book_id: "3", // Starting index from 2
        book_name: "Simple Way of Peace Life",
        book_publisher: "Armor Ramsey",
        book_author: "Armor Ramsey",
        book_price: "38.00 $",
        book_description: "A comprehensive guide to achieving inner peace and a balanced life.",
        book_image: image2,
        book_category: "finance", // Explicitly set to "finance"
        book_start: 4,
        book_review: 220,
        book_discount: 15,
        book_year:2024,
        book_language:"Tiếng Việt",

      },
      {
        book_id: "4", // Starting index from 2
        book_name: "Great Travel at Desert",
        book_publisher: "Armor Ramsey",
        book_author: "Armor Ramsey",
        book_price: "40.00 $",
        book_description: "An adventurous journey through the desert, uncovering ancient secrets.",
        book_image: image3,
        book_category: "engineer", // Explicitly set to "engineer"
        book_start: 4,
        book_review: 180,
        book_discount: 12,
        book_year:2024,
        book_language:"Tiếng Việt",

      },
      {
        book_id: "5", // Starting index from 2
        book_name: "Business Strategies for the Modern World",
        book_publisher: "Tech Publishing",
        book_author: "John Doe",
        book_price: "45.00 $",
        book_description: "A guide to modern business strategies for today's competitive world.",
        book_image: image4,
        book_category: "management", // Explicitly set to "management"
        book_start: 5,
        book_review: 245,
        book_discount: 18,
        book_year:2024,
        book_language:"Tiếng Việt",

      },
      {
        book_id: "6", // Starting index from 2
        book_name: "Mastering Finance Principles",
        book_publisher: "Finance Press",
        book_author: "Jane Smith",
        book_price: "42.00 $",
        book_description: "A comprehensive guide to mastering the fundamentals of finance.",
        book_image: "https://scontent.fsgn19-1.fna.fbcdn.net/v/t1.15752-9/467478088_1494048438650636_4641463616605546223_n.png?_nc_cat=101&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeHCbB3hx4OTqptw6md3NgOxeJcsahObz1p4lyxqE5vPWizn4PmtqqRYb1K5-l5DVll7uAfP5A2tRMWjD3P9wco6&_nc_ohc=LXR42I03lQ0Q7kNvgGZtcLi&_nc_zt=23&_nc_ht=scontent.fsgn19-1.fna&oh=03_Q7cD1QEUKpgR3hpdB86KoO0JQwEtLLQF54R9c4J9f7pTz-kI7A&oe=677432BE",
        book_category: "finance", // Explicitly set to "finance"
        book_start: 4,
        book_review: 310,
        book_discount: 20,
        book_year:2024,
        book_language:"Tiếng Việt",

      },
      {
        book_id: "7", // Starting index from 2
        book_name: "Chó xúc xích",
        book_publisher: "Engineering Press",
        book_author: "Tom Clark",
        book_price: "50.00 $",
        book_description: "Explore some of the world's most amazing engineering feats.",
        book_image: "https://scontent.fsgn19-1.fna.fbcdn.net/v/t1.15752-9/457233080_533687812438851_3662061376447174919_n.png?_nc_cat=100&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeFg0kHqlNPhYSRORw9TbZkb7n-np-SPQY_uf6en5I9Bj7OVWFpyf2QfnlniIb9aOIRMQIElmMWhykXThPKy4CDj&_nc_ohc=niNXFHPEnkkQ7kNvgHxYj7H&_nc_zt=23&_nc_ht=scontent.fsgn19-1.fna&oh=03_Q7cD1QEX-kkhnY_qjB661VUdAszmisDGSZ1BoqzsqsxH6QUVWQ&oe=6773FB72",
        book_category: "engineer", // Explicitly set to "engineer"
        book_start: 3,
        book_review: 400,
        book_discount: 22,
        book_year:2024,
        book_language:"Tiếng Việt"
      }
]


// Sample data for client
export const book_comment = [
  {
    book_id:"1",
    user_id:"1",
    content:"Sword Art Online tập 10 là phần thứ hai của Alicization arc, Alicization Running. Arc này liên tục làm mình thích thú vì nó rất khác biệt so với những arc trước đó. Phần đầu của tập 10 có rất nhiều phần giải thích. Ai đó có thể coi nó là một lỗ hổng hoặc gây nhàm chán, nhưng đối với bản thân mình, mình thích những lời giải thích vì nó là nền móng của Underworld và cũng đem người đọc vào nó. Không chỉ như vậy,sau khi xây dựng thế giới, trong tập 10 này ta còn thấy trung tâm của câu chuyện và cả sự tiến bộ của Eugeo và Kirito trong Underworld. Khởi đầu thì chậm chạp nhưng khi bắt đầu tập trung thì sẽ thấy rất cuốn hút. Quá ngắn, không thể không đợi tập 11 được !",
    start:4,
    data:new Date()
  }
]
