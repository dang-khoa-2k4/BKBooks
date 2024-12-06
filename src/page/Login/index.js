import React from 'react';
import { user } from '../../data/user';
import { useNavigate } from 'react-router-dom';
import Loading from '../../components/Loading';

const Login = () => {
    const navigate = useNavigate();
    const [formData, setFormData] = React.useState({
        username: '',
        password: ''
    });
    const [isLoading,setIsLoading] = React.useState(false)

    // Hàm xử lý thay đổi giá trị của các trường nhập liệu
    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData({
            ...formData,
            [name]: value
        });
    };

    const handleSubmit =(e) => {
        e.preventDefault()
        
        setIsLoading(true);
        const isValidUser = user.some(
            (u) => u.username === formData.username && u.password === formData.password
        );

        setTimeout(() => {
            const isValidUser = user.some(
                (u) => u.username === formData.username && u.password === formData.password
            );

            if (isValidUser) {
                navigate('/admin/book/view'); // Điều hướng đến /book/view
            } else {
                alert('Tên tài khoản hoặc mật khẩu không đúng!');
            }
            setIsLoading(false); // Tắt trạng thái tải
        }, 1000); // Mô phỏng thời gian xử lý 1 giây
    }
    return (
        <section class="bg-gray-50 dark:bg-gray-900">
            {isLoading == false ?    
                <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                    <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                        <img class="w-16 h-16 mr-2" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRmMiyNm0-af3xQ5CPPwsVinkTyy0oc_MsvxQ&s" alt="logo" />
                        
                    </a>
                    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center">
                                Đăng nhập
                            </h1>
                            <form class="space-y-4 md:space-y-6" action="#" onSubmit={handleSubmit}>
                                <div>
                                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên tài khoản</label>
                                    <input type="username" name="username" id="username" onChange={handleChange} value={formData.username} class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nhập tài khoản" required="" />
                                </div>
                                <div>
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mật khẩu</label>
                                    <input type="password" name="password" id="password" onChange={handleChange} value={formData.password} placeholder="Nhập mật khẩu" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="" />
                                </div>
                                <div className='flex justify-end'>
                                    <button type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Về trang chủ</button>
                                    <button type="submit" class="text-white bg-[#3b5998] hover:bg-[#3b5998]/90 focus:ring-4 focus:outline-none focus:ring-[#3b5998]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55 me-2 mb-2">
                                        Đăng nhập
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                :
                <Loading />
            }
        </section>
    );
}

export default Login;
