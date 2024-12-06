

import React from 'react';

const Header = () => {


    return (
        <div class="flex items-center justify-between p-2 p-4 sm:ml-64">
            <div class="text-black font-semibold text-2xl">
                Quản Lý Sách
            </div>

            <div class="flex items-center space-x-4 ">
                <ul className="flex alert mr-2 pr-3 alert">
                    <li className="mx-2 text-base text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </li>
                    <li className="mx-2 text-base text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white  ">
                    < i class="fa-regular fa-bell"></i>
                    </li>
                </ul>
                <a className="text-lg ml-3">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>

                <div class="flex items-center space-x-2">
                    <span class="block text-black text-sm mr-3">Baka</span>
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzwj_XRVmUMVKR3ebUAyNXdAgtZuGrx7u8Kg&s" alt="User Avatar" class="h-8 w-8 rounded-full border border-gray-200" />
                </div>
            </div>
        </div>
    );
}

export default Header;
