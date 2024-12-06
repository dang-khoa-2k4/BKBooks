


import React from 'react';
import image from "../../Assert/images/book.png"
import { Link } from 'react-router-dom';

const BookInfo = () => {
    return (
        <section class="py-4 bg-gray-100 md:py-8 dark:bg-gray-900 antialiased">
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
      <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
        <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
          <img class="w-full dark:hidden" src={image} alt="" />
        </div>

        <div class="mt-10 sm:mt-10 lg:mt-16">
          <h1
            class="text-4xl font-semibold text-gray-900 sm:text-4xl dark:text-white"
            style={{color:"#393280"}}
          >
            Featured book
          </h1>
          <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
            
            <div class="flex items-center gap-2 mt-2 sm:mt-0">
              <div class="flex items-center gap-1">
                <svg
                  class="w-4 h-4 text-yellow-300"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  fill="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"
                  />
                </svg>
                <svg
                  class="w-4 h-4 text-yellow-300"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  fill="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"
                  />
                </svg>
                <svg
                  class="w-4 h-4 text-yellow-300"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  fill="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"
                  />
                </svg>
                <svg
                  class="w-4 h-4 text-yellow-300"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  fill="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"
                  />
                </svg>
                <svg
                  class="w-4 h-4 text-yellow-300"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  fill="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"
                  />
                </svg>
              </div>
              <p
                class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400"
              >
                (5.0)
              </p>
              <a
                href="#"
                class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline dark:text-white"
              >
                345 Reviews
              </a>
            </div>
          </div>

          <hr class="my-6 md:my-8 border-orange-500 dark:border-gray-800" />

          <p class="mb-6 text-gray-500 dark:text-gray-400">
            By Timbur Hood
          </p>

          <h2
            class="text-2xl font-semibold text-gray-900 sm:text-2xl dark:text-white"
            style={{color:"#393280"}}
          >
            Birds gonna be happy
          </h2>
          <p class="text-gray-500 dark:text-gray-400 mt-5">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu feugiat amet, libero ipsum enim pharetra hac.
          </p>

          <h2
            class="mt-5 text-2xl font-semibold text-orange-500 sm:text-2xl dark:text-white"
          > 
            $ 45.00
          </h2>

            <Link to="/book-detail" class="mt-5 relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-blue-500 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    READ MORE 
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </span>
            </Link>
            
        </div>
      </div>
      <div className="flex justify-center">
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
  </section>
    );
}

export default BookInfo;
