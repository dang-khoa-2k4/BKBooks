

import React from 'react';
import { NavLink } from "react-router-dom";

const Sidebar = () => {
    return (
       <div>
         <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                </svg>
        </button>
        <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
            <div class="h-full px-3 py-4 overflow-y-auto sidebar justify-between flex flex-col">
                <div>
                    <h3>Trang Quản Lý</h3>
                    <ul class="space-y-2 font-medium border-bottom-list">
                        <li>
                            <NavLink to="view">
                                <div className='class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"'>
                                <i class="fa-solid fa-book-open text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                                <span class="ms-3">Quản Lý Sách</span>
                                </div>
                            </NavLink>    
                        </li>
                        <li>
                            <NavLink to="employee">
                                <div className='class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"'>
                                    <i class="fa-solid fa-people-group text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                                    <span class="flex-1 ms-3 whitespace-nowrap">Quản Lý Nhân Viên</span>
                                </div>
                            </NavLink>    
                        </li>
                        <li>
                            <NavLink to="customer">
                                <div className='class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"'>
                                    <i class="fa-solid fa-user text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                                    <span class="flex-1 ms-3 whitespace-nowrap">Quản Lý Khách Hàng</span>
                                </div>
                            </NavLink>    
                        </li>
                        <li>
                            <NavLink to="invoice">
                                <div className='class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"'>
                                    <i class="fa-solid fa-note-sticky text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                                    <span class="flex-1 ms-3 whitespace-nowrap">Quản Lý Hóa Đơn</span>
                                </div>
                            </NavLink>    
                        </li>
                        <li>
                            <NavLink to="warehouse">
                                <div className='class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"'>
                                    <i class="fa-solid fa-box text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                                    <span class="flex-1 ms-3 whitespace-nowrap">Quản Lý Kho</span>
                                </div>
                            </NavLink>    
                        </li>
                    </ul>
                    <a href="#" class="mt-3 flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group font-medium">
                        <i class="fa-solid fa-gear text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Cài Đặt</span>
                    </a>
                </div>
                <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white justify-center">
                    <img class="w-36 h-20 mr-2" src="https://hcmut.edu.vn/img/nhanDienThuongHieu/01_logobachkhoatoi.png" alt="logo" />
                </a>
            </div>
        </aside>
       </div>
    );
}

export default Sidebar;
