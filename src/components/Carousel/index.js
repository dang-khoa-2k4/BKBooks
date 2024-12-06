import React, { useState } from "react";
import imageHome from "../../Assert/images/home.png"
import image1 from "../../Assert/images/Gig Image 1.png"
import image2 from "../../Assert/images/index 1.png"
import image3 from "../../Assert/images/Gig Image 1 (1).png"
import image4 from "../../Assert/images/Gig Image 1 (2).png"
import image5 from "../../Assert/images/images 1.png"

import { Link } from "react-router-dom";

const CardOld = ({ image, title, value }) => (
    <div className="w-72 mx-5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
      <Link to={`/listing?category=${value}`} className="relative block">
        {/* Hình ảnh làm nền */}
        {image && <img className="w-full h-72 object-cover" src={image} alt={title} />}
        
        {/* Chỗ chứa văn bản */}
        <div className="absolute inset-0 flex flex-col justify-end p-4">
          <h5 className="text-2xl font-bold text-white">{title}</h5>
        </div>
      </Link>
    </div>
  );

  const CardNew = ({ image, title, value }) => (
    <div className="w-72 mx-5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 overflow-hidden flex items-center justify-center">
      <Link to={`/listing?category=all`} className="relative block flex flex-col items-center">
        <h5 style={{color:"#173F5F"}} className="text-center font-bold text-3xl">Explore our Top Categories</h5>
        <button type="button" class="mt-10 text-xl focus:outline-none text-white bg-orange-500 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">View All</button>
      </Link>
    </div>
  );

const Carousel = () => {
    
  const cards = [
    { id: 1, image: image1, title: 'Higher Education', value:"education"  },
    { id: 2, image: null, title: 'Advancements in AI 2021', value: "all" },
    { id: 3, image: image2, title: 'Management Books', value:"management"  },
    { id: 4, image: image3, title: 'Finance Books', value:"finance"  },
    { id: 5, image: image4, title: 'Engineering Books', value:"engineer"  },
    { id: 6, image: image5, title: 'Commerce books', value:"commerce"  },
  ];


  return (
    <div className="flex items-center justify-center h-screen mt-10">
    <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 p-4 justify-center">
      {cards.map((card, index) => (
        // Chọn Card cũ nếu index khác 2, nếu không thì chọn Card mới
        index !== 1 ? (
          <CardOld key={card.id} image={card.image} title={card.title} value={card.value} />
        ) : (
          <CardNew key={card.id} image={card.image} title={card.title} value={card.value} />
        )
      ))}
    </div>
  </div>
  );

};

export default Carousel;