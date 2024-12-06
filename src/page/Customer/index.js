import React from "react";
import {
  customerData,
  customerHeader as header,
  customerModalAdd,
} from "../../data/customer";
import Table from "../../components/Table";

const Customer = () => {
  const [data, setData] = React.useState(customerData);

  return (
      <Table
          Header={header}
          DataRender={data}
          setRender={setData}
          buttonAddName={"Thêm Sách"}
          tableName = {"Danh Sách Khách Hàng"}
          modalAdd={customerModalAdd}
          id={"user_cusId"}
       />
  );
};

export default Customer;

