
const MoreDetail = ({book}) => {
    return (
        <div className="grid grid-cols-6 mt-5">
  {/* First empty div (occupies 2 columns) */}
  <div className="col-span-1"></div>

  {/* Content div (occupies 2 columns) */}
  <div className="col-span-4 pl-10">
  <div className="p-3 bg-blue-500 w-full">
     <h2 className="text-2xl text-white">Thông tin chi tiết</h2>
  </div>
    <div className="flex w-full">
      <p className="text-black dark:text-gray-400 mt-5 mr-2">Mã Sách:</p>
      <p className="text-blue-500 dark:text-gray-400 mt-5">{book.book_id}</p>
    </div>
    <div className="flex">
      <p className="text-black dark:text-gray-400 mt-5 mr-2">Nhà Xuất Bản:</p>
      <p className="text-blue-500 dark:text-gray-400 mt-5">{book.book_publisher}</p>
    </div>
    <div className="flex">
      <p className="text-black dark:text-gray-400 mt-5 mr-2">Tác Giả:</p>
      <p className="text-blue-500 dark:text-gray-400 mt-5">{book.book_author}</p>
    </div>
    <div className="flex">
      <p className="text-black dark:text-gray-400 mt-5 mr-2">Năm Xuất Bản:</p>
      <p className="text-blue-500 dark:text-gray-400 mt-5">{book.book_year}</p>
    </div>
    <div className="flex mb-5">
      <p className="text-black dark:text-gray-400 mt-5 mr-2">Ngôn Ngữ:</p>
      <p className="text-blue-500 dark:text-gray-400 mt-5">{book.book_language}</p>
    </div>

    <span className="text-black text-xs">
      {book.book_description}
    </span>
  </div>

  {/* Third empty div (occupies 2 columns) */}
  <div className="col-span-1"></div>
</div>
    );
}

export default MoreDetail;
