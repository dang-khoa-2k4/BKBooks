
import HeaderUser from "../../components/Header user";
import DetailBook from "../../components/Book detail";
import MoreDetail from "../../components/More detail/index.";
import Comment from "../../components/Comment";
import { useParams } from 'react-router-dom';
import {book} from "../../data/book"

const filterBooksByID = (id,books) => {
    return books.filter(book => book.book_id === id);
};

const BookDetail = () => {

    const { id } = useParams();
    const bookDetail = filterBooksByID(id,book)[0]
    // console.log(bookDetail)

    return (
        <div className="flex flex-col ">
            <HeaderUser  />

            <DetailBook book={bookDetail}/>

            <MoreDetail book={bookDetail} />

            <Comment />
        </div>
    );
}

export default BookDetail;
