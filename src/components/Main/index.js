
import { Outlet } from "react-router-dom";

import React from 'react';

const Main = () => {
    return (
        <div className="p-4 sm:ml-64">
            <Outlet />
        </div>
       
    );
}

export default Main;
