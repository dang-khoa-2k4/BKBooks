
import React from "react";
import "./index.css"
import { bookHeader as header,bookData,bookModalAdd } from "../../data/book";
import Table from "../../components/Table";

const Book = () => {
    const [data, setData] = React.useState(bookData);

    return (
        <Table
            Header={header}
            DataRender={data}
            setRender={setData}
            buttonAddName={"Thêm Sách"}
            tableName = {"Danh Sách Sách"}
            modalAdd={bookModalAdd}
            id={"book_id"}
        />
    );
}

export default Book;
