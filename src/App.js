import logo from "./logo.svg";
import "./App.css";
import { BrowserRouter, Routes, Route } from "react-router-dom";

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

          <Route
            path="/listing"
            element={
              <ProtectedRoute>
                <Listing />
              </ProtectedRoute>
            }
          />  

          <Route
            path="/book-detail/:id"
            element={
              <ProtectedRoute>
                <BookDetail />
              </ProtectedRoute>
            }
          />
          <Route
            path="/cart/:id"
            element={
              <ProtectedRoute>
                <Cart />
              </ProtectedRoute>
            }
          />
          <Route
            path="/payment/:id"
            element={
              <ProtectedRoute>
                <Payment />
              </ProtectedRoute>
            }
          />
          {/* <ProtectedRoute path="/listing" element={<Listing />} />
          <ProtectedRoute path="/book-detail/:id" element={<BookDetail />} />
          <ProtectedRoute path="/cart" element={<Cart />} />
          <ProtectedRoute path="/payment/:id" element={<Payment />} /> */}

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
      </BrowserRouter>
    </AuthProvider>
  );
}

export default App;
