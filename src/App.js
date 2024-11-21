import logo from './logo.svg';
import './App.css';
import { BrowserRouter, Routes, Route } from "react-router-dom";
import Login from './page/Login';
import Book from './page/Book';
import LayoutDefault from './Layout';
import Dashboard from './page/Dashboard';
import Employee from './page/Employee';
import Customer from './page/Customer';
import WareHouse from './page/Warehouse';
import Invoice from './page/Invoice';

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Login />} />
        <Route path="/book" element={<LayoutDefault />}>
          <Route path='view' element={<Book />} />
          <Route path='overview' element={<Dashboard />} />
          <Route path='employee' element={<Employee />} />
          <Route path='invoice' element={<Invoice />} />
          <Route path='warehouse' element={<WareHouse />} />
          <Route path='customer' element={<Customer />} />
        </Route>
      </Routes>
    </BrowserRouter>
  );
}

export default App;
