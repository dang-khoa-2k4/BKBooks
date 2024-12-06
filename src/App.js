import React from "react";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import { ToastContainer } from 'react-toastify'; // Import ToastContainer
import 'react-toastify/dist/ReactToastify.css'; // Import CSS Toastify

// Admin
import Login from "./page/Login";
import Book from "./page/Book";
import LayoutDefault from "./Layout";
import Dashboard from "./page/Dashboard";
import Employee from "./page/Employee";
import Customer from "./page/Customer";
import WareHouse from "./page/Warehouse";
import Invoice from "./page/Invoice";

// User
import Home from "./page/Home";
import LoginUser from "./page/Login user";
import Register from "./page/Register";
import Listing from "./page/Listing";
import BookDetail from "./page/Book detail";
import Cart from "./page/Cart";
import Payment from "./page/Payment";

// Auth and other...
import ScrollToTop from "./utils/scrolltop";
import { AuthProvider } from "./Wrapper App";
import ProtectedRoute from "./Auth/index";
import MyProduct from "./page/Items";
import ProductOrders from "./page/order";
import MyFarmer from "./page/Farmer";

function App() {
  return (
    <AuthProvider>
      <BrowserRouter>
        <ScrollToTop />
        <Routes>
          {/* User */}
          <Route path="/" element={<Home />} />
          <Route path="/login" element={<LoginUser />} />
          <Route path="/register" element={<Register />} />
          <Route path="/listing" element={<ProtectedRoute><Listing /></ProtectedRoute>} />
          <Route path="/myproduct" element={<ProtectedRoute><MyProduct /></ProtectedRoute>} />
          <Route path="/mycart" element={<ProtectedRoute><ProductOrders /></ProtectedRoute>} />
          <Route path="/myfarmer/:id" element={<ProtectedRoute><MyFarmer /></ProtectedRoute>} />

          <Route path="/book-detail/:id/:gentype" element={<BookDetail />} />
          <Route path="/cart/:id" element={<ProtectedRoute><Cart /></ProtectedRoute>} />
          <Route path="/payment/:id" element={<ProtectedRoute><Payment /></ProtectedRoute>} />

          {/* Admin */}
          <Route path="/admin/login" element={<Login />} />
          <Route path="/admin/book" element={<LayoutDefault />}>
            <Route path="view" element={<Book />} />
            <Route path="overview" element={<Dashboard />} />
            <Route path="employee" element={<Employee />} />
            <Route path="invoice" element={<Invoice />} />
            <Route path="warehouse" element={<WareHouse />} />
            <Route path="customer" element={<Customer />} />
          </Route>
        </Routes>

        {/* Thêm ToastContainer ở đây để hiển thị thông báo */}
        <ToastContainer />
      </BrowserRouter>
    </AuthProvider>
  );
}

export default App;
