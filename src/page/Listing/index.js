
import HeaderUser from "../../components/Header user";
import widget from "../../Assert/images/Vector.png"
import { useLocation } from 'react-router-dom';

import {book} from "../../data/book"

import { Link } from "react-router-dom";

const BookCard1 = ({img,title,author,price,id}) => {
    return(
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="h-56 w-full">
            <Link to={`/book-detail/${id}`}>
                <img class="mx-auto h-60 dark:hidden w-40" src={img} alt="" />
            </Link>
            </div>
            <div class="pt-6">
            <div class="mb-4 flex items-center justify-between gap-4">
                <span class="me-2 rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300"> Up to 35% off </span>

                <div class="flex items-center justify-end gap-1">
                <button type="button" data-tooltip-target="tooltip-quick-look" class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <span class="sr-only"> Quick look </span>
                    <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </button>
                <div id="tooltip-quick-look" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700" data-popper-placement="top">
                    Quick look
                    <div class="tooltip-arrow" data-popper-arrow=""></div>
                </div>

                <button type="button" data-tooltip-target="tooltip-add-to-favorites" class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <span class="sr-only"> Add to Favorites </span>
                    <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z" />
                    </svg>
                </button>
                <div id="tooltip-add-to-favorites" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700" data-popper-placement="top">
                    Add to favorites
                    <div class="tooltip-arrow" data-popper-arrow=""></div>
                </div>
                </div>
            </div>

            

            <a href="#" class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{title}</a>

            <div class="mt-2 flex items-center gap-2">
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

            </div>

            <ul class="mt-2 flex items-center gap-4">
                <li class="flex items-center gap-2">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{author}</p>
                </li>
            </ul>
            
            <h2
            class="mt-5 text-2xl font-semibold text-orange-500 sm:text-2xl dark:text-white"
          > 
            $ {price}
          </h2>

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


const Listing = () => {


    const location = useLocation();
    const queryParams = new URLSearchParams(location.search);
    const value = queryParams.get('category');

    const books = filterBooksByCategory(value,book)

    return(
        <div className="flex flex-col">
        
            <HeaderUser />


            <div className="bg-pink-100 p-4">
                <h2 className="text-xl text-center" style={{color:"#393280"}}>HOME  /  PRODUCTS</h2>
            </div>

            <div class="grid grid-cols-4 gap-4 justify-between p-5 mt-5">
                <div  style={{color:"#393280"}} className="flex justify-between items-center px-3 border-b border-solid border-gray-300">
                    <span  style={{color:"#393280"}}>Price</span>
                    <i class="fa-solid fa-minus"></i>
                </div>
                <div  style={{color:"#393280"}} className="flex justify-between items-center px-3">
                    <span  style={{color:"#393280"}}>Sort by : Alphabetically, A-Z</span>
                    <i class="fa-solid fa-caret-down"></i>
                </div>
                <div  style={{color:"#393280"}} className="flex justify-between items-center px-3">
                    <span  style={{color:"#393280"}}>{`Showing ${books.length} of ${book.length}`}</span>
                </div>
                <div  style={{color:"#393280"}}className="flex justify-between items-center px-3" >
                    <div>
                        <span  style={{color:"#393280"}}>Price</span>
                        <i class="fa-solid fa-caret-down ml-5"></i>
                    </div>
                    <div className="flex items-center">
                        <img src={widget} className="h-5 w-5"/>
                        <i class="fa-solid fa-bars text-2xl ml-3"></i>
                    </div>
                </div>
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
                    <div class="grid grid-cols-3 gap-4">
                    {books.map((book) => (
                        <div key={book.book_id} className="p-4">
                            <BookCard1
                            img={book.book_image}
                            title={book.book_name}
                            author={book.book_author}
                            price={book.book_price}
                            id={book.book_id}
                            />
                        </div>
                    ))}
                    </div>
                </div>

             </div>
        </div>  
    )
}

export default Listing