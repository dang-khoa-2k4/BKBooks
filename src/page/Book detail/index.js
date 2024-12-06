
import HeaderUser from "../../components/Header user";
import DetailBook from "../../components/Book detail";
import MoreDetail from "../../components/More detail/index.";
import Comment from "../../components/Comment";
import { useParams } from 'react-router-dom';
import {book} from "../../data/book"

import { getProductById } from "../../Services/product";
import { useEffect,useState } from "react";
import { token } from "../../Config/API";
import { useAuth } from "../../Wrapper App";

const filterBooksByID = (id,books) => {
    return books.filter(book => book.book_id === id);
};


const BookDetail = () => {

    const [product, setProduct] = useState(null);
    const { id,gentype } = useParams();
    const {setCart,cart} = useAuth()

    // const bookDetail = filterBooksByID(id,book)[0]
   useEffect(()=>{
        const fetchProduct = async () => {
            try {
                const productData = await getProductById(id,gentype,token);  // Gọi API để lấy sản phẩm
                setProduct(productData);  // Cập nhật state với dữ liệu sản phẩm
            } catch (err) {
                console.log("Error fetching product");  // Cập nhật lỗi nếu có
            }
        };
        fetchProduct()
   },[])

   console.log("Day la cart",cart)
    return (
        <div className="flex flex-col ">
            <HeaderUser  />

            {product && <DetailBook book={product} setCart={setCart} />}

            {/* <MoreDetail book={bookDetail} /> */}

            {/* <Comment /> */}
        </div>
    );
}

export default BookDetail;
