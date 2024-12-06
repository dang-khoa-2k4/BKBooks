

import HeaderUser from "../../components/Header user";
import image1 from "../../Assert/Image pay/1.png"
import image2 from "../../Assert/Image pay/2.png"
import image3 from "../../Assert/Image pay/3.png"
import image4 from "../../Assert/Image pay/4.png"
import image5 from "../../Assert/Image pay/5.png"
import image6 from "../../Assert/Image pay/6.png"
import image7 from "../../Assert/Image pay/7.png"
import cartImage from "../../Assert/image books/cart1.png"


import { useParams } from 'react-router-dom';
import {book} from "../../data/book"

const filterBooksByID = (id,books) => {
    return books.filter(book => book.book_id === id);
};

const PaymentInput = ({title}) => {
    return(
        <>
             <div className="grid grid-cols-3 gap-4 py-5 items-center">
                {/* Second h2 takes 1 column */}
                <h2 className="text-black p-2 col-span-1">{title}</h2>

                {/* Form takes 2 columns */}
                <form className="w-full col-span-2">
                    <label
                        for="default-search"
                        className="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white"
                    >
                        Search
                    </label>
                    <div className="relative pr-10">
                        <input
                            type="search"
                            id="default-search"
                            className="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300  bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder={`Nhập ${title}`}
                        />
                    </div>
                </form>
            </div>
        </>
    )
}

const Payer = ({image,title}) => {
    return(
        <>
            <div className="p-2 flex items-center">
                <div class="">
                    <input  type="checkbox" value="" class="mr-10 w-8 h-8 text-blue-600 bg-gray-100 border-gray-900 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                </div>

                <div className="flex items-center">
                    {image && <img src={image} />}
                    <h2 className="text-black text-xl ml-10 ">
                        {title}
                    </h2> 
                </div>
            </div>
        </>
    )
}

const Payment = () => {

    const { id } = useParams();
    const bookDetail = filterBooksByID(id,book)[0]

    return (
        <div className="flex flex-col ">
            <HeaderUser />

            <div className="grid grid-cols-5 gap-4 mt-10">
                <div className="col-span-1 p-4"></div>

                <div className="col-span-3 p-4">
                    {/* First h2 takes full row */}
                    <div className="bg-gray-100">
                        <h2 className="text-black text-xl border-b border-gray-300 font-bold p-2 col-span-5">
                            ĐỊA CHỈ GIAO HÀNG
                        </h2>

                        {/* Second row with 2 columns */}
                        <PaymentInput title={"Họ và tên người nhận"} />
                        <PaymentInput title={"Email"} />
                        <PaymentInput title={"Tỉnh/Thành phố"} />
                        <PaymentInput title={"Số điện thoại"} />
                        <PaymentInput title={"Quốc gia"} />
                        <PaymentInput title={"Phường/Xã"} />
                        <PaymentInput title={"Địa chỉ nhận hàng"} />
                    </div>

                    <div className="bg-gray-100 mt-10">
                        <h2 className="text-black text-xl border-b border-gray-300 font-bold p-2 col-span-5">
                            MÃ KHUYẾN MÃI/MÃ QUÀ TẶNG
                        </h2>
                        <div className="grid grid-cols-1 gap-4 py-5 items-center">
                        
                            <div className="p-2 flex items-center">
                                <i class="text-5xl text-gray-500 fa-regular fa-square-check mr-10"></i>
                                <div>
                                    <h2 className="text-black text-xl font-bold">
                                        Giao hàng tiêu chuẩn: 22.000 Đ
                                    </h2> 
                                    <span className="text-gray-500">Dự kiến giao hàng: Thứ sáu 23/12</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div className="bg-gray-100 mt-10">
                        <h2 className="text-black text-xl border-b border-gray-300 font-bold p-2 col-span-5">
                             PHƯƠNG THỨC THANH TOÁN
                        </h2>
                        <div className="grid grid-cols-1 gap-4 py-5 items-center">
                            <Payer image={image1} title={"Ví ZaloPay"} />
                            <Payer image={image2} title={"Ví Moca trên ứng dụng Grab"} />
                            <Payer image={image3} title={"Ví ShopeePay"} />
                            <Payer image={image4} title={"Ví VNPay"} />
                            <Payer image={image5} title={"Ví Momo"} />
                            <Payer image={image6} title={"ATM / Internet Banking"} />
                            <Payer image={image7} title={"Thanh toán bằng tiền mặt khi nhận hàng"} />
                        </div>
                    </div>


                    <div className="bg-gray-100 mt-10">
                        <h2 className="text-black text-xl border-b border-gray-300 font-bold p-2 col-span-5">
                            THÔNG TIN KHÁC
                        </h2>
                        <div className="grid grid-cols-1 gap-4 py-5 items-center">
                            <Payer title={"Ghi chú"} />
                            <Payer  title={"Xuất hóa đơn GTGT"} />
                            <Payer  title={"Bằng việc tiến hành đặt mua, khách hàng đồng ý với các Điều Kiện GIao Dịch Chung được ban hành bởi BKboooks"} />
                        </div>
                    </div>


                    <div className="bg-gray-100 mt-10">
                        <h2 className="text-black text-xl border-b border-gray-300 font-bold p-2 col-span-5">
                            KIỂM TRA LẠI ĐƠN HÀNG
                        </h2>

                        <div className="grid grid-cols-5 gap-4 mt-5 ">
                            <div className=" p-4">
                                <p className="text-black"></p>
                            </div>

                            <div className=" p-4">
                                <p className="text-black">Tên sản phẩm</p>
                            </div>

                            <div className=" p-4">
                                <p className="text-black text-center">Số lượng</p>
                            </div>

                            <div className=" p-4">
                                <p className="text-black text-center">Giá sản phẩm</p>
                            </div>

                            <div className=" p-4">
                                <p className="text-black text-center">Thành tiền</p>
                            </div>
                        </div>
                        <div className="grid grid-cols-5 gap-4 mt-5 ">
                            <div className=" p-4">
                                <img src={bookDetail.book_image} />
                            </div>

                            <div className="p-4 flex items-center justify-center">
                                <p className="text-black">{bookDetail.book_name}</p>
                            </div>

                            <div className="p-4 flex items-center justify-center">
                                <p className="text-black">{bookDetail.book_price}</p>
                            </div>


                            <div className="p-4 flex items-center justify-center">
                                <p className="text-black">1</p>
                            </div>


                            <div className="p-4 flex items-center justify-center">
                                <p className="text-black">120.000 Đ</p>
                            </div>

                        </div>
                    </div>

                    <div className="mt-10 flex justify-end pt-10 pr-2 border-b border-black">
                        <div>
                            <div className="flex justify-between">
                                <span className="text-black">Thành tiền</span>
                                <span className="text-black" >120.000 Đ</span>
                            </div>
                            <div className="flex justify-between">
                                <span className="text-black">Phí vận chuyển (Giao hàng tiêu chuẩn) </span>
                                <span className="text-black">120.000 Đ</span>
                            </div>
                            <div className="flex justify-between">
                                <span className="text-bold text-black" > Tổng số tiền (gồm VAT) </span>
                                <span className="text-black">120.000 Đ</span>
                            </div>
                        </div>
                    </div>


                    <div className="bg-gray-100 mt-10 p-3 flex justify-between items-center">
                        <div>
                            <i class="fa-solid fa-arrow-left"></i>
                            <span className="text-black ml-1">Quay về đơn hàng</span>
                        </div>
                        <div>
                            <button type="button" class="w-72 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Thanh toán</button>
                        </div>
                    </div>

                </div>
                
                <div className="col-span-1  p-4"> </div>
            </div>
        </div>
    );
}

export default Payment;
