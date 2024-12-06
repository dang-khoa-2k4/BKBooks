import React from "react";
import { useState } from "react";
import AddCircleOutlineIcon from "@mui/icons-material/AddCircleOutline";
import ModalAdd from "../Modal add";
import { Button, Box } from "@mui/material";
import LongMenu from "../../components/Ellipsis";
import SortButton from "../Sort";

const Table = ({
  Header,
  DataRender,
  setRender,
  buttonAddName,
  modalAdd,
  tableName,
  id,
}) => {
  // Add row
  const [openAdd, setOpenAdd] = useState(false);
  const handleOpenAdd = () => setOpenAdd(true);
  const handleCloseAdd = () => setOpenAdd(false);
  // End add row

  return (
    <div className="table-book">
      <div class="p-6 bg-white rounded-lg table-border">
        <div className="table-header flex justify-between">
          <div>
            <h2 class="text-xl font-semibold ">{tableName} </h2>
            <Button
              variant="contained"
              color="success"
              startIcon={<AddCircleOutlineIcon sx={{ color: "white" }} />}
              sx={{ borderRadius: 10 }}
              size="small"
              onClick={handleOpenAdd}
            >
              {buttonAddName}
            </Button>
            <ModalAdd
              open={openAdd}
              onClose={handleCloseAdd}
              setData={setRender}
              dataTitle={modalAdd}
              modalName={buttonAddName}
              id={id}
            />
          </div>

          <ul className="flex">
            <li className="mr-6">
                <SortButton Header={Header} Data={DataRender} setData={setRender}/>
            </li>
            <li>
              <i class="fa-solid fa-filter mr-2"></i>
              <span className="text-black text-sm">Filter</span>
            </li>
          </ul>
        </div>

        <div class="overflow-x-auto">
          <table class="min-w-full">
            <thead>
              <tr>
                {Header.map((header, index) => (
                  <th
                    key={index}
                    className="px-4 py-2 border-b font-semibold text-left"
                  >
                    {header}
                  </th>
                ))}
              </tr>
            </thead>
            <tbody>
              {DataRender.map((dataRow, index) => {
                const row = Object.values(dataRow);
                return (
                  <tr key={index} className="hover:bg-gray-50">
                    {row.map((value, i) => (
                      <td key={i} className="px-4 py-6 border-b text-gray-800">
                        {value}
                      </td>
                    ))}
                    <td className="px-4 py-6 border-b text-gray-800 text-right">
                      <LongMenu
                        dataList={DataRender}
                        setData={setRender}
                        item={dataRow}
                        dataTitle={modalAdd}
                        id={id}
                      />
                    </td>
                  </tr>
                );
              })}
            </tbody>
          </table>
        </div>

        <div class="flex items-center justify-end mt-4 ">
          <div class="flex space-x-2 items-center">
            <div className="flex mr-10">
              <span>Dòng mỗi trang</span>
              <div className="mx-1">
                <span class="pr-1 text-black">8</span>
                <i class="fa-solid fa-caret-down"></i>
              </div>
            </div>
            <span class="text-gray-500">1-8 of 1240</span>
            <button class="px-2 py-1 text-sm font-semibold text-blue-600">
              ❮
            </button>
            <button class="px-2 py-1 text-sm font-semibold text-blue-600">
              ❯
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Table;
