
import HeaderUser from "../../components/Header user";
import widget from "../../Assert/images/Vector.png"
import { useLocation } from 'react-router-dom';

import {book} from "../../data/book"

import { Link } from "react-router-dom";

import { baseURL } from "../../Config/API";

import { getMyOrder } from "../../Services/product";
import { useEffect,useState } from "react";
import { token } from "../../Config/API";
import { useAuth } from "../../Wrapper App";



const StatusBadge = ({ status }) => {
    // Conditional class names based on the status
    const badgeClasses = status === "accepted"
      ? "bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300"
      : status === "unpaid"
      ? "bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300"
      : "bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300"; // Default color for other statuses
  
    return (
      <span className={`text-xs font-medium me-2 px-2.5 py-0.5 rounded ${badgeClasses}`}>
        Status: {status}
      </span>
    );
  };
  

const BookCard1 = ({img,title,author,price,id,gentype,status,farmer,time_start,time_end}) => {
    return(
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="h-56 w-full">
            <Link to={`/book-detail/${id}/${gentype}`}>
                <img class="mx-auto h-60 dark:hidden w-40" src="https://static.thenounproject.com/png/13643-200.png" alt="" />
            </Link>
            </div>
            <div class="pt-6">
           

            

            <div href="#" class="text-xs font-semibold leading-tight text-gray-900 hover:underline dark:text-white">Product ID: {id}</div>
            <div href="#" class="text-xs font-semibold leading-tight text-gray-900 hover:underline dark:text-white">Time create: {time_start}</div>
            <div href="#" class="text-xs font-semibold leading-tight text-gray-900 hover:underline dark:text-white">Time sold:{time_end}</div>
            <div href="#" class="text-xs font-semibold leading-tight text-gray-900 hover:underline dark:text-white">Famer: {farmer}</div>

            {/* <div class="mt-2 flex items-center gap-2">
                <div class="flex items-center">
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
                </div>

            </div> */}

                <StatusBadge status={status} />

            </div>
        </div>
    )
}

const filterBooksByCategory = (category,books) => {
    if(category == "all"){
        return books;
    }
    return books.filter(book => book.book_category === category);
};


const ProductOrders = () => {

    const [product,setProduct] = useState([])
    const [loading, setLoading] = useState(true); // Loading state
    const [totalPages, setTotalPages] = useState(0);
    const {userId} = useAuth()
    console.log("dit me",userId)
    const [pagination, setPagination] = useState({
        currentPage: 1,  // Trang hiện tại
        itemPerPage: 10,
        sort:0  // Số lượng sản phẩm mỗi trang
    });
    console.log("Đây là user",userId?.userId)
    useEffect(() => {
        console.log(pagination)
        setLoading(true);
        const fetchData = async () => {
            const result = await getMyOrder(pagination.currentPage, pagination.itemPerPage,pagination.sort,userId?.id,userId?.token);
            console.log("This is result",result)
            setProduct(result);
            setTotalPages(result.metaInfo.totalPages);

        };
    
        fetchData();
        setTimeout(() => {
            setLoading(false); // End loading
        },1500)
    
    },[pagination])


    const location = useLocation();
    const queryParams = new URLSearchParams(location.search);
    const value = queryParams.get('category');

    const books = filterBooksByCategory(value,book)

    const handlePageChange = (newPage) => {
        if (newPage > 0 && newPage <= totalPages) {
            setPagination({ ...pagination, currentPage: newPage });
        }
    };

    const handleItemsPerPageChange = (e) => {
        const items = parseInt(e.target.value, 10);
        console.log(items)
        setPagination((prev) => ({ ...prev, itemPerPage: items, currentPage: 1 })); // Reset to page 1 when items per page changes
    };

    const handlePrice = (e) => {
        const items = parseInt(e.target.value, 10);
        console.log(items)
        setPagination((prev) => ({ ...prev, sort: items, currentPage: 1 })); // Reset to page 1 when items per page changes
    };

    console.log("This is product",product?.data)

    return(
        <div className="flex flex-col">
        
            <HeaderUser />


            <div className="bg-pink-100 p-4">
                <h2 className="text-xl text-center" style={{color:"#393280"}}>HOME  /  ORDERS</h2>
            </div>

            <div class="grid grid-cols-4 gap-4 justify-between p-5 mt-5">
                <div  style={{color:"#393280"}} className="flex justify-between items-center px-3 border-b border-solid border-gray-300">
                    <span  style={{color:"#393280"}}>Price</span>
                    <i class="fa-solid fa-minus"></i>
                </div>
                <div  style={{color:"#393280"}} className="flex justify-between items-center px-3">
                    <form class="max-w-sm mx-auto">
                        <label for="underline_select" class="sr-only">Underline select</label>
                        <select
                            id="underline_select"
                            value={pagination?.itemPerPage}
                            onChange={handleItemsPerPageChange}
                            className="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"
                        >
                            <option value={10}>10 trang</option>
                            <option value={20}>20 trang</option>
                            <option value={50}>50 trang</option>
                            <option value={100}>100 trang</option>
                            <option value={500}>500 trang</option>
                        </select>
                    </form>
                </div>
                <div  style={{color:"#393280"}} className="flex justify-between items-center px-3">
                    <span  style={{color:"#393280"}}>{`Showing ${product?.metaInfo?.perPage} of ${product?.metaInfo?.total}`}</span>
                </div>
                {/* <div  style={{color:"#393280"}}className="flex justify-between items-center px-3" >
                         <select
                            id="underline_select"
                            value={pagination?.sort}
                            onChange={handlePrice}
                            className="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"
                        >
                            <option value={0}>Không sắp xếp</option>
                            <option value={1}>Giá tăng</option>
                            <option value={2}>Giá giảm</option>
                        </select>
                </div> */}
            </div>

            <div class="grid grid-cols-4 gap-4 px-5">
                <div class="col-span-1 p-4">
                    <div className="flex justify-between items-center">
                        <div>
                            <i class="fa-solid fa-dollar-sign mr-5"></i>
                            <input class="w-[80px] border border-gray-200 p-2" type="text" placeholder="" />
                        </div>
                        <span>To</span>
                        <div>
                            <i class="fa-solid fa-dollar-sign mr-5"></i>
                            <input class="w-[80px] border border-gray-200 p-2" type="text" placeholder="" />
                        </div>
                    </div>

                    <div className="w-full mt-5">
                         <button type="button" class="w-full text-white bg-purple-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium  text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Filter</button>
                    </div>

                    <ul>
                        <li className="flex justify-between items-center my-5 border-b border-solid border-gray-300 py-2">
                            <span style={{color:"#393280"}}>Product type</span>
                            <i class="fa-solid fa-plus"></i>
                        </li>
                        <li className="flex justify-between items-center my-5 border-b border-solid border-gray-300 py-2">
                            <span style={{color:"#393280"}}>Availability</span>
                            <i class="fa-solid fa-plus"></i>
                        </li>
                        <li className="flex justify-between items-center my-5 border-b border-solid border-gray-300 py-2">
                            <span style={{color:"#393280"}}>Brand</span>
                            <i class="fa-solid fa-plus"></i>
                        </li>
                        <li className="flex justify-between items-center my-5 border-b border-solid border-gray-300 py-2">
                            <span style={{color:"#393280"}}>Color</span>
                            <i class="fa-solid fa-plus"></i>
                        </li>
                        <li className="flex justify-between items-center my-5 py-2">
                            <span style={{color:"#393280"}}>Material</span>
                            <i class="fa-solid fa-plus"></i>
                        </li>
                    </ul>
                </div>

                <div class="col-span-3 p-4">
                {loading ? (
                        <div className="flex flex-col justify-center items-center h-96">
                            <div className="flex flex-col justify-center items-center h-96">
                                <div className="spinner-border animate-spin inline-block w-8 h-8 border-4 rounded-full border-gray-300 border-t-4 border-t-red-500" role="status">
                                    <span className="sr-only">.</span>
                                </div>
                                <h2 className="font-bold text-xl text-black mt-4">Đang tải sản phẩm...</h2>
                            </div>
                        </div>
                    ) : (
                        <>
                         <ul class="flex items-center -space-x-px h-8 text-sm justify-center">
                            <li>
                                <button onClick={() => handlePageChange(pagination.currentPage - 1)} class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <span class="sr-only">Previous</span>
                                    <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                    </svg>
                                </button>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{product.metaInfo.current}</a>
                            </li>
                            <li>
                                <button onClick={() => handlePageChange(pagination.currentPage + 1)}  class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <span class="sr-only">Next</span>
                                    <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                </button>
                            </li>
                        </ul>
                        <div className="grid grid-cols-3 gap-4">
                            {product?.data?.length > 0 && product?.data?.map((book, index) => (
                                <div key={index} className="p-4">
                                    <BookCard1
                                        title={book.Breed}
                                        // author={book.book_author}
                                        price={book.Price}
                                        id={book.ID}
                                        gentype={book.gen_type}
                                        status={book.Status}
                                        farmer={book.Farmer_ID}
                                        time_start={book.Time_created}
                                        time_end={book.Time_sold}

                                    />
                                </div>
                            ))}
                        </div>
                        <div class="grid col-span-3 gap-4 flex justify-center">
                       
                    </div>
                    </>
                    )}


                    
                </div>
                
             </div>
        </div>  
    )
}

export default ProductOrders