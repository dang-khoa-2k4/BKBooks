
import userimage from "../../Assert/images/User.png"  

import { Link } from "react-router-dom";

import { useAuth } from "../../Wrapper App";

import { client } from "../../data/customer";

import { useNavigate } from "react-router-dom";
import { baseURL } from "../../Config/API";
import { toast } from "react-toastify";
import { useState } from "react";
const HeaderUser = () => {
    const navigate = useNavigate()
    const {isLoggedIn,userId,logout,setCart,cart} = useAuth()

    console.log(userId)
    const nameUser = userId?.name
    const id = userId?.id
    const token = userId?.token
    console.log(nameUser)
    const handleLogout = () => {
        logout();  // Clear the user data and set logged in state to false
        navigate('/login');  // Redirect to login page after logout
    };

    // if(nameUser){
    //     console.log(nameUser)
    // }
    const [content,setContent] = useState("Thêm vào giỏ hàng")
    const handleClick = async () => {
        try {
            const dataToSend = JSON.stringify({
                customerID:id,
                productID:cart
            })
            
            console.log(dataToSend)
            console.log(token)
            const response = await fetch(baseURL + '/customer/orders/create', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
              },
              body: dataToSend
            });
            console.log(cart)
            const result = await response.json();
            console.log(result)
            toast.success('Tạo vỏ hàng thành công rồi nha ní !'); // Show success toast
            // setContent("Đã thêm vào giỏ hàng")
            // if (response.ok) {   
            //   setMessage(`Order created successfully! Order ID: ${result.order.orderID}`);
            // } else {
            //   setMessage(`Error: ${result.message}`);
            // }
          } catch (error) {
            // setMessage(`Error: ${error.message}`);
          } finally {
            // setLoading(false);
          }
    }

    return (
        <div>
            <div class="px-10">
                <div className="space-y-1 flex justify-between p-3 border-b header">
                    <div class="flex items-center space-x-2 text-color">
                        <i class="fa-solid fa-phone"></i>
                        <span class="text-lg text-color font-semibold	">+91 8374902234</span>
                    </div>
                    <div>
                        <ul class="flex space-x-4 text-color">
                            <li><i class="fa-brands fa-facebook text-xl"></i></li>
                            <li><i class="fa-brands fa-instagram text-xl"></i></li>
                            <li><i class="fa-brands fa-linkedin text-xl"></i></li>
                            <li><i class="fa-brands fa-twitter text-xl"></i></li>
                            <li><i class="fa-brands fa-blogger-b"></i></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div className="flex items-center	 justify-around mt-2">

                <img class="rounded-full h-20 w-20" src={userimage} alt="image description" />

                <div class="relative">
                    <input 
                        type="text" 
                        class="w-96 py-2 pl-10 pr-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-100"
                        placeholder="Search..."
                    />
                    <i class="fa-solid fa-search absolute right-4 icon-search transform  text-gray-500"></i>
                </div>

                {isLoggedIn ? 
                    <div className="flex ">
                        <Link to="/">
                            <i class="fa-regular fa-user mx-2"></i>
                            <span className="text-color font-bold text-sm">{nameUser}</span>
                        </Link>
                        <button className="ml-3 border-l-2 border-solid border-[#173F5F]" onClick={handleLogout}>
                            <i class="fa-solid fa-right-from-bracket mx-2"></i>
                            <span className="text-color font-bold text-sm">Đăng xuất</span>
                        </button>
                    </div>
                :
                    <>
                        <div className="flex ">
                            <Link to="/login">
                                <i class="fa-regular fa-user mx-2"></i>
                                <span className="text-color font-bold text-sm">ĐĂNG NHẬP</span>
                            </Link>
                            <Link className="ml-3 border-l-2 border-solid border-[#173F5F]" to="/register">
                                <i class="fa-solid fa-lock mx-2"></i>
                                <span className="text-color font-bold text-sm">ĐĂNG KÍ</span>
                            </Link>
                        </div>
                    </>
                }
            </div>


            <div className="">
                <ul className="text-white flex justify-center text-sm bg-blue-900 py-2">
                    <li className="py-2 px-5 font-bold first:border-l-0 last:border-r-0 border-l-2 border-r-2 border-solid border-[#fff]">
                        <Link to={"/"}>Trang chủ</Link>
                    </li>
                    <li className="py-2 px-5 border-1-2 border-r-2 border-solid border-[#fff]">
                        <Link to={"/listing"}>Sản phẩm</Link>
                    </li>
                    <li className="py-2 px-5 border-1-2 border-r-2 border-solid border-[#fff]">
                        <Link to={"/myproduct"}>Sản phẩm đã mua</Link>
                    </li>
                    <li className="py-2  px-5 border-1-2 border-r-2 border-solid border-[#fff]">
                        <Link to={`/mycart`}>Giỏ hàng</Link >
                    </li>
                    {/* <li className="py-2  px-5 border-1-2">
                        <Link to={`/myfarmer`}>Nông dân</Link >
                    </li> */}
                    <li className="cursor-pointer py-2 bg-red-500  px-5 border-1-2 ml-2" onClick={handleClick}>
                        Tạo đơn hàng mới
                    </li>
                </ul>
            </div>
        </div>
    );
}

export default HeaderUser;
