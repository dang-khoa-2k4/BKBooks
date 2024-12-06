import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../../Wrapper App';
import { baseURL } from '../../Config/API';
import { toast } from 'react-toastify'; // Import toastify

const LoginUser = () => {
  const navigate = useNavigate();
  const {login} = useAuth()
  const [formData, setFormData] = useState({
    username: '',
    password: ''
  });

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    console.log(formData)
    try {
      const response = await fetch(`${baseURL}/auth/login/customer`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          username: formData.username,
          password: formData.password,
        }),
      });
      
      const data = await response.json();
      console.log(data)
      if (data.status == 200) {
        // If login is successful, save user info and navigate
        console.log("Sau khi dang nhap thanh cong",data.data)
        login(data.data)
        console.log(data?.data)
        toast.success('Đăng nhập thành công!'); // Show success toast
        navigate("/listing"); 
      } else {
        // Show error message if login fails
        toast.error(data.message || 'Đăng nhập không thành công!'); // Show error toast
      }
    } catch (error) {
      console.error("Lỗi kết nối API:", error);
      toast.error("Có lỗi xảy ra. Vui lòng thử lại."); // Show generic error toast
    }
  };

  return (
    <div className="font-[sans-serif]">
      <div className="min-h-screen flex flex-col items-center justify-center py-6 px-4">
        <div className="grid md:grid-cols-2 items-center gap-4 max-w-6xl w-full">
          {/* Form Section */}
          <div className="border border-gray-300 rounded-lg p-6 max-w-md shadow-[0_2px_22px_-4px_rgba(93,96,127,0.2)] max-md:mx-auto">
            <form onSubmit={handleSubmit} className="space-y-4">
              <div className="mb-8">
                <h3 className="text-gray-800 text-3xl font-extrabold">Sign in</h3>
                <p className="text-gray-500 text-sm mt-4 leading-relaxed">Sign in to your account and explore a world of possibilities. Your journey begins here.</p>
              </div>

              {/* Username Input */}
              <div>
                <label className="text-gray-800 text-sm mb-2 block">User name</label>
                <div className="relative flex items-center">
                  <input
                    name="username"
                    type="text"
                    value={formData.username}
                    onChange={handleChange}
                    required
                    className="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg outline-blue-600"
                    placeholder="Enter user name"
                  />
                </div>
              </div>

              {/* Password Input */}
              <div>
                <label className="text-gray-800 text-sm mb-2 block">Password</label>
                <div className="relative flex items-center">
                  <input
                    name="password"
                    type="password"
                    value={formData.password}
                    onChange={handleChange}
                    required
                    className="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg outline-blue-600"
                    placeholder="Enter password"
                  />
                </div>
              </div>

              {/* Remember Me and Forgot Password Links */}
              <div className="flex flex-wrap items-center justify-between gap-4">
                <div className="flex items-center">
                  <input
                    id="remember-me"
                    name="remember-me"
                    type="checkbox"
                    className="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                  />
                  <label htmlFor="remember-me" className="ml-3 block text-sm text-gray-800">
                    Remember me
                  </label>
                </div>

              </div>

              {/* Submit Button */}
              <div className="!mt-8">
                <button
                  type="submit"
                  className="w-full shadow-xl py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none"
                >
                  Log in
                </button>
              </div>

              {/* Register Link */}
              <p className="text-sm !mt-8 text-center text-gray-800">
                Don't have an account?{' '}
                <Link to="/register" className="text-blue-600 font-semibold hover:underline ml-1 whitespace-nowrap">
                  Register here
                </Link>
              </p>
            </form>
          </div>

          {/* Image Section */}
          <div className="lg:h-[400px] md:h-[300px] max-md:mt-8">
            <img
              src="https://readymadeui.com/login-image.webp"
              className="w-full h-full max-md:w-4/5 mx-auto block object-cover"
              alt="Dining Experience"
            />
          </div>
        </div>
      </div>
    </div>
  );
};

export default LoginUser;
