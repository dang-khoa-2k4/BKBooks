

import React from 'react';
import { invoiceData ,invoiceHeader as header,invoiceModal } from '../../data/invoice';
import Table from "../../components/Table";

const Invoice = () => {
    const [data, setData] = React.useState(invoiceData);
    return (
        <Table
            Header={header}
            DataRender={data}
            setRender={setData}
            buttonAddName={"Thêm Hóa Đơn"}
            tableName = {"Danh Sách Hóa Đơn"}
            modalAdd={invoiceModal}
            id={"invoice_id"}
        />
    );
}

export default Invoice;
