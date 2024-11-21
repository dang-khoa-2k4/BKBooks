


import React from 'react';

const Dashboard = () => {
    return (
        <div>
            <div class="flex space-x-4 justify-between">
                <div class="flex flex-col items-center justify-center w-48 h-40 border border-gray-200 rounded-lg text-center hover:shadow-lg">
                    <span class="text-gray-500 font-bold text-xl">Chưa giải quyết</span>
                    <span class="text-2xl font-semibold text-gray-800 text-3xl">60</span>
                </div>

                <div class="flex flex-col items-center justify-center w-48 h-38 border-2 border-blue-500 rounded-lg text-center hover:shadow-lg cursor-pointer">
                    <span class="text-blue-600 font-bold text-xl">Quá hạn</span>
                    <span class="text-2xl font-semibold text-blue-600 text-3xl">16</span>
                </div>

                <div class="flex flex-col items-center justify-center w-48 h-38 border border-gray-200 rounded-lg text-center hover:shadow-lg">
                    <span class="text-gray-500 font-bold text-xl">Đang làm</span>
                    <span class="text-2xl font-semibold text-gray-800 text-3xl">43</span>
                </div>

                <div class="flex flex-col items-center justify-center w-48 h-38 border border-gray-200 rounded-lg text-center hover:shadow-lg">
                    <span class="text-gray-500 font-bold text-xl">Chờ duyệt</span>
                    <span class="text-2xl font-semibold text-gray-800 text-3xl">64</span>
                </div>
            </div>

            <div className='flex justify-around	mt-10 px-2'>
                <div class="w-1/2 p-4 border border-gray-200 rounded-lg mx-2">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Yêu cầu chưa giải quyết</h2>
                        <a href="#" class="text-blue-500 text-sm hover:underline">Xem chi tiết</a>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between items-center py-2 border-t border-gray-200">
                        <span class="text-gray-700">Chờ giải quyết</span>
                        <span class="text-gray-600 font-medium">4238</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-t border-gray-200">
                        <span class="text-gray-700">Báo lỗi từ khách hàng</span>
                        <span class="text-gray-600 font-medium">1005</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-t border-gray-200">
                        <span class="text-gray-700">Chờ fix từ dev</span>
                        <span class="text-gray-600 font-medium">914</span>
                        </div>

                        <div class="flex justify-between items-center py-2 border-t border-gray-200">
                        <span class="text-gray-700">Chờ duyệt</span>
                        <span class="text-gray-600 font-medium">281</span>
                        </div>
                    </div>
                </div>


                <div class="w-1/2  p-4 border border-gray-200 rounded-lg mx-2">
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="text-lg font-semibold text-gray-800">Công việc</h2>
                        <a href="#" class="text-blue-500 text-sm hover:underline">Xem tất cả</a>
                    </div>
                    <p class="text-gray-400 text-sm mb-4">Hôm nay</p>

                    <div class="flex justify-between items-center text-gray-300 mb-4">
                        <span class="text-sm">Tạo công việc mới</span>
                        <button class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"/>
                        </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between border-t border-gray-200 pt-2">
                        <div class="flex items-center">
                            <span class="w-4 h-4 border-2 border-gray-300 rounded-full mr-2"></span>
                            <span class="text-gray-800">Duyệt yêu cầu sửa lỗi</span>
                        </div>
                        </div>

                        <div class="flex items-center justify-between border-t border-gray-200 pt-2">
                        <div class="flex items-center">
                            <span class="w-4 h-4 border-2 border-gray-300 rounded-full mr-2"></span>
                            <span class="text-gray-800">Fix lỗi</span>
                        </div>
                        </div>

                        
                        <div class="flex items-center justify-between border-t border-gray-200 pt-2">
                        <div class="flex items-center">
                            <span class="w-4 h-4 bg-blue-500 rounded-full flex items-center justify-center mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5 w-2.5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                            </span>
                            <span class="text-gray-800">Giải quyết lỗi giao diện</span>
                        </div>
                        <span class="bg-gray-100 text-gray-400 text-xs font-semibold px-2 py-1 rounded-full">DEFAULT</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    );
}

export default Dashboard;
