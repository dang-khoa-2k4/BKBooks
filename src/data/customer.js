
export const customerHeader = [
    "Mã Khách Hàng",
    "Mã User",
    "Họ Tên",
    "Username",
    "Password",
    "Địa Chỉ",
    "SDT",
    ""
]

export const customerData = [
   {
        user_cusId:"QQEETT778899",
        user_id:"AABBCC123",
        user_cusName:"Trần Thị A",
        user_name:"def345",
        user_password:"123456",
        user_address:"123 Đường A",
        user_phone:"0123456789"
   }
]

export const customerModalAdd = [
    ["Mã User","user_id"],
    ["Họ Tên","user_cusName"],
    ["Username","user_name"],
    ["Password","user_password"],
    ["Địa Chỉ","user_address"],
    ["SDT","user_phone"]
]


// sample data for client
export const client = [
    {
        id:"1",
        name:"user1",
        password:"1"
    },
    {
        id:"2",
        name:"user2",
        password:"2"
    },
    {
        id:"3",
        name:"user3",
        password:"3"
    }
]

// sample data for client
export const clientCart = [
    {
        id:"1",
        book_order:[
            {
                id:"1",
                quantity:1
            },
            {
                id:"2",
                quantity:1
            }
            
        ]
    },
]
