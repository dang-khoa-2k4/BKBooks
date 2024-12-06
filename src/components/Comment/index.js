
const UserCommet = () => {
    return(
        <>
        <div className="col-span-1 p-4">
      <p className="text-xl">Hirumi</p>
      <p className="text-gray-500">11/2/2022</p>
    </div>

    {/* Second div (spans 3 columns) */}
    <div className="col-span-3">
        <div class="flex items-center my-5">
            <svg class="h-8 w-8 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
            </svg>

            <svg class="h-8 w-8 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
            </svg>

            <svg class="h-8 w-8 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
            </svg>

            <svg class="h-8 w-8 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
            </svg>

            <svg class="h-8 w-8 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
            </svg>
        </div>
        <span className="text-xs text-black">
        Sword Art Online tập 10 là phần thứ hai của Alicization arc, Alicization Running. Arc này liên tục làm mình thích thú vì nó rất khác biệt so với những arc trước đó. Phần đầu của tập 10 có rất nhiều phần giải thích. 
        Ai đó có thể coi nó là một lỗ hổng hoặc gây nhàm chán, nhưng đối với bản thân mình, mình thích những lời giải thích vì nó là nền móng của Underworld và cũng đem người đọc vào nó. 
        Không chỉ như vậy,sau khi xây dựng thế giới, trong tập 10 này ta còn thấy trung tâm của câu chuyện và cả sự tiến bộ của Eugeo và Kirito trong Underworld. Khởi đầu thì chậm chạp nhưng khi bắt đầu tập trung thì sẽ thấy rất cuốn hút. Quá ngắn, không thể không đợi tập 11 được !
        </span>
    </div>
        </>
    )
}


const Comment = () => {
    return (
        <div className="grid grid-cols-6 mt-5 ">
  {/* First empty div (occupies 2 columns) */}
  <div className="col-span-1"></div>

  {/* Content div (occupies 2 columns) */}
  <div className="col-span-4 pl-10">
  {/* Title */}
  <div className="p-3 bg-blue-500 w-full">
    <h2 className="text-2xl text-white">Đánh Giá</h2>
  </div>
    
  <div className="p-3  w-full flex items-center">
    <h2 className="text-2xl text-black mr-5">4.0/5</h2>
    <div class="flex items-center mr-10">
            <svg class="h-8 w-8 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
            </svg>

            <svg class="h-8 w-8 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
            </svg>

            <svg class="h-8 w-8 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
            </svg>

            <svg class="h-8 w-8 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
            </svg>

            <svg class="h-8 w-8 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
            </svg>
        </div>
        <button type="button" class="mt-1 focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
            <i class="fa-solid fa-pen mr-2"></i>
            Viết Đánh Giá
        </button>
  </div>

  {/* Nested grid for first row */}
  <div className="grid grid-cols-4 gap-4 ">
    
    <UserCommet />
    <UserCommet />
    <UserCommet />
    <UserCommet />
    
  </div>

  {/* You can add more rows below if needed */}
</div>



  {/* Third empty div (occupies 2 columns) */}
  <div className="col-span-1"></div>
</div>
    );
}

export default Comment;
