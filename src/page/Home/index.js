
import "./style.css"
import Carousel from "../../components/Carousel";
import imageHome from "../../Assert/images/Frame 216.png"
import BookInfo from "../../components/Book info";
import BookList from "../../components/Book list";
import HeaderUser from "../../components/Header user";
import Footer from "../../components/Footer";
import { Link } from "react-router-dom";

import {book} from "../../data/book"
import { useEffect } from "react";

const Home = () => {
    console.log(book)

    return (
        <div className="flex flex-col">
            
            <HeaderUser />

            <div className="flex-grow  flex justify-between ">
                <div className="bg-gradient-to-r from-red-100 to-white w-1/3 flex flex-col items-center justify-center">
                    <h2 className="text-color text-5xl font-bold mb-5">Ipsum Dolor Si</h2>

                    <span className="inline-block max-w-[450px] break-words text-color text-xl">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu feugiat amet, libero ipsum enim pharetra hac. Urna commodo, lacus ut magna velit eleifend. Amet, quis urna, a eu.
                    </span>
                    
                    <Link to="/listing?category=all" class="mt-5 relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-blue-500 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                        <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                            READ MORE 
                            <i class="fa-solid fa-arrow-right ml-2"></i>
                        </span>
                    </Link>

                    <div className="flex">
                        <button className="m-2 flex flex-col items-center justify-center space-y-1 p-2 border-2 border-orange-500 rounded-full">
                            <span className="w-2 h-2 bg-orange-500 rounded-full"></span>
                        </button>
                        <button className="m-2 flex flex-col items-center justify-center space-y-1">
                            <span className="w-2 h-2 bg-gray-500 rounded-full"></span>
                        </button>
                        <button className="m-2 flex flex-col items-center justify-center space-y-1">
                            <span className="w-2 h-2 bg-gray-500 rounded-full"></span>
                        </button>
                        <button className="m-2 flex flex-col items-center justify-center space-y-1">
                            <span className="w-2 h-2 bg-gray-500 rounded-full"></span>
                        </button>
                    </div>
                
                </div>
                <div className="">
                    <img src={imageHome} />
                </div>
            </div>
            
            <Carousel />
            
            <BookInfo />

            <BookList />

            <Footer />
        </div>  
    );
}

export default Home;
