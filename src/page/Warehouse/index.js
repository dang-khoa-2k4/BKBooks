import React from 'react';
import { wareHouseData,wareHouseHeader as header,wareHouseModal } from '../../data/warehouse';
import Table from '../../components/Table';

const WareHouse = () => {
    const [data, setData] = React.useState(wareHouseData);
    return (
        <Table
            Header={header}
            DataRender={data}
            setRender={setData}
            buttonAddName={"Thêm Tồn Khoa"}
            tableName = {"Danh Sách Tồn Kho"}
            modalAdd={wareHouseModal}
            id={"book_id"}
    />
    );
}

export default WareHouse;
