
import { Link } from "react-router-dom";
import image from "../../Assert/image books/detail1.png"
import { useState } from "react";
import { useAuth } from "../../Wrapper App";

const DetailBook = ({book}) => {

    const[isBuy,setIsBuy] = useState(false)
    const {setCart} = useAuth()    

    const handleBuy = (id) => {
        // Toggle the `isBuy` state to simulate adding/removing from the cart
        setIsBuy(prevState => !prevState);
        if (!isBuy) {
            // Nếu sản phẩm chưa được thêm vào giỏ hàng, thêm sản phẩm vào giỏ
            setCart(prevCart => ({
                ...prevCart,
                book_order: [
                    ...prevCart.book_order,
                    { id: id, quantity: 1}
                ]
            }));
        } else {
            // Nếu sản phẩm đã có trong giỏ hàng, xóa sản phẩm khỏi giỏ
            setCart(prevCart => ({
                ...prevCart,
                book_order: prevCart.book_order.filter(item => item.id !== id)
            }));
        }
    }


    return (
        <div class="grid grid-cols-5 gap-4 bg-white">
                <div class="col-span-2 p-4 flex justify-end">
                    <img class="h-auto max-w-full" src={book.book_image} alt="image description" />
                </div>
                    
                <div class="col-span-3 p-4">
                    <h2
                        class="text-2xl font-semibold text-gray-900 sm:text-2xl dark:text-white "
                        style={{color:"#000"}}
                    >
                        {book.book_name}
                    </h2>
                    <div className="flex">
                        <p class="text-black dark:text-gray-400 mt-5 mr-2">
                            Nhà Xuất Bản:
                        </p>
                        <p class="text-blue-500 dark:text-gray-400 mt-5">
                            {book.book_publisher}
                        </p>
                    </div>
                    <div className="flex">
                        <p class="text-black dark:text-gray-400 mt-5 mr-2">
                            Tác Giả:
                        </p>
                        <p class="text-blue-500 dark:text-gray-400 mt-5">
                            {book.book_author}
                        </p>
                    </div>
                    
                    <div class="flex items-center my-5">
                        <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                        </svg>

                        <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                        </svg>

                        <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                        </svg>

                        <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                        </svg>

                        <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                        </svg>
                        <span className="text-black">{`(${book.book_review} Reviewers)`}</span>
                    </div>

                    <a href="#" style={{color:"#393280"}} class="text-3xl font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{book.book_price}</a>

                    {/* <div className="flex items center mt-5">
                        <div>
                            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">-</button>
                        </div>
                        <input class="w-[50px] h-[40px] border border-gray-200 p-2 rounded mr-2" type="text" placeholder="1" />
                        <div>
                            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">+</button>
                        </div>
                    </div> */}
                    
                    <div class="grid grid-cols-4 gap-4 pr-20 mt-10">
                       <div className="col-span-2 flex items-center">
                            <div class="mr-10">
                                <Link to={`/payment/${book.book_id}`} type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Mua Ngay</Link>
                            </div>
                            <div class="mr-10 mt-1">
                                {!isBuy ?
                                <button onClick={() =>handleBuy(book.book_id)} type="button" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Thêm Giỏ Hàng </button>
                                :
                                <button onClick={() => handleBuy(book.book_id)} type="button" class="flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-green-300 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                                }
                            </div>
                       </div>
                       <div className="col-span-2">
                            
                       </div>
                    </div>
                </div>
            </div>

    );
}

export default DetailBook;
