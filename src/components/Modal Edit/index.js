import * as React from "react";
import Box from "@mui/material/Box";
import Button from "@mui/material/Button";
import Typography from "@mui/material/Typography";
import Modal from "@mui/material/Modal";

const style = {
  position: "absolute",
  top: "50%",
  left: "50%",
  transform: "translate(-50%, -50%)",
  width: 600,
  bgcolor: "background.paper",
  //   border: '2px solid #000',
  //   boxShadow: 24,
  //   p: 4,
};

export default function ModalEdit({ open, onClose, dataItem,changeBook,dataTitle}) {
  const [formData, setFormData] = React.useState({ ...dataItem });
 
  const handleSubmit = (e) => {
    e.preventDefault();
    changeBook(formData)
    onClose()
  };

  const handleChange = (e) => {
    const { name, value } = e.target;    
    setFormData({ ...formData, [name]: value });
  };

  const handleCancel = () => {
    setFormData(dataItem)
    onClose()
  }

  return (
    <div>
      <Modal
        open={open}
        onClose={onClose}
        aria-labelledby="modal-modal-title"
        aria-describedby="modal-modal-description"
      >
        <Box sx={style}>
          <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 space-y-6">
              <div class="flex justify-between items-center border-b pb-4">
                <h2 class="text-xl font-semibold">Chi tiết sách</h2>
                <button
                  class="text-gray-400 hover:text-gray-600"
                  onClick={onClose}
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M10 9.293l4.646-4.647a1 1 0 011.414 1.414L11.414 10l4.646 4.646a1 1 0 01-1.414 1.414L10 11.414l-4.646 4.646a1 1 0 01-1.414-1.414L8.586 10 3.94 5.354a1 1 0 111.414-1.414L10 9.293z"
                      clip-rule="evenodd"
                    />
                  </svg>
                </button>
              </div>

              <form class="space-y-4" onSubmit={handleSubmit}>
                {dataTitle.map((title, index) => (
                  <div key={index}>
                    {/* Label được tạo từ phần tử đầu tiên của dataTitle */}
                    <label className="block text-sm font-medium text-gray-700">{title[0]}</label>
                    <input
                      type="text"
                      name={title[1]}
                      value={formData[title[1]] || ""}
                      onChange={handleChange}
                      className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    />
                  </div>
                ))}
                
                <div class="flex justify-end space-x-4">
                    <button
                      class="px-4 py-2 bg-gray-200 rounded-md text-gray-700 hover:bg-gray-300"
                      onClick={handleCancel}
                    >
                      Hủy
                    </button>
                    <button
                      class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
                      type="submit"
                    >
                      Sửa
                    </button>
                </div>
              </form>
            </div>
          </div>
        </Box>
      </Modal>
    </div>
  );
}
