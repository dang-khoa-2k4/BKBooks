import { baseURL } from "../Config/API";

export const getAllProducts = async (currentPage, itemPerPage,token) => {
    try {
        console.log(baseURL + `/customer/products/getAll?page=${currentPage}&perPage=${itemPerPage})
`)
    
        const response = await fetch(baseURL + `/customer/products/getAll?page=${currentPage}&perPage=${itemPerPage}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                // Nếu cần token hoặc xác thực, bạn có thể thêm Authorization header
                'Authorization': `Bearer ${token}`
            }
        });

        if (!response.ok) {
            throw new Error('Failed to fetch products');
        }

        // Lấy dữ liệu sản phẩm từ response
        const productData = await response.json();

        // Kiểm tra nếu có sản phẩm
        if (productData && productData.data) {
            console.log('All Products:', productData.data);
            return productData;  // Trả về danh sách sản phẩm
        } else {
            console.log('No products found');
            return [];
        }
    } catch (error) {
        console.error('Error:', error);
    }
};



export const getProductById = async (id,gentype, token) => {
    try {
        console.log(baseURL + `/customer/products/getById?id=${id}`)
        const response = await fetch(baseURL + `/customer/products/getById?id=${id}&genType=${gentype}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
        });

        if (!response.ok) {
            throw new Error('Failed to fetch product by ID');
        }

        const productData = await response.json();

        if (productData && productData.data) {
            console.log('Product:', productData.data);
            return productData.data;  // Trả về sản phẩm với ID cụ thể
        } else {
            console.log('No product found');
            return null;
        }
    } catch (error) {
        console.error('Error:', error);
    }
};



export const getMyProduct = async (currentPage, itemPerPage,sort,id,token) => {
    try {
        console.log(baseURL + `/customer/products/getMyProducts?customerID=${id}&inorder=${sort}&page=${currentPage}&perPage=${itemPerPage}`)
    
        const response = await fetch(baseURL + `/customer/products/getMyProducts?customerID=${id}&inorder=${sort}&page=${currentPage}&perPage=${itemPerPage}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                // Nếu cần token hoặc xác thực, bạn có thể thêm Authorization header
                'Authorization': `Bearer ${token}`
            }
        });

        if (!response.ok) {
            throw new Error('Failed to fetch products');
        }

        // Lấy dữ liệu sản phẩm từ response
        const productData = await response.json();

        // Kiểm tra nếu có sản phẩm
        if (productData && productData.data) {
            console.log('All Products:', productData.data);
            return productData;  // Trả về danh sách sản phẩm
        } else {
            console.log('No products found');
            return [];
        }
    } catch (error) {
        console.error('Error:', error);
    }
};


export const getMyOrder = async (currentPage, itemPerPage,sort,id,token) => {
    try {
        console.log("Day la link API: ",baseURL + `/customer/orders/getAll?customerID=10&page=${currentPage}&perPage=${itemPerPage}`)
        console.log(id,token)
        const response = await fetch(baseURL + `/customer/orders/getAll?customerID=${id}&page=${currentPage}&perPage=${itemPerPage}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                // Nếu cần token hoặc xác thực, bạn có thể thêm Authorization header
                'Authorization': `Bearer ${token}`
            }
        });

        if (!response.ok) {
            throw new Error('Failed to fetch products');
        }

        // Lấy dữ liệu sản phẩm từ response
        const productData = await response.json();

        // Kiểm tra nếu có sản phẩm
        if (productData && productData.data) {
            console.log('All Products:', productData.data);
            return productData;  // Trả về danh sách sản phẩm
        } else {
            console.log('No products found');
            return [];
        }
    } catch (error) {
        console.error('Error:', error);
    }
};



export const getMyFarmer = async (currentPage, itemPerPage,sort,id,token) => {
    try {
        const response = await fetch(baseURL + `/customer/getFarmer?id=${id}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                // Nếu cần token hoặc xác thực, bạn có thể thêm Authorization header
                'Authorization': `Bearer ${token}`
            }
        });

        if (!response.ok) {
            throw new Error('Failed to fetch products');
        }

        // Lấy dữ liệu sản phẩm từ response
        const productData = await response.json();

        // Kiểm tra nếu có sản phẩm
        if (productData && productData.data) {
            console.log('All Products:', productData.data);
            return productData;  // Trả về danh sách sản phẩm
        } else {
            console.log('No products found');
            return [];
        }
    } catch (error) {
        console.error('Error:', error);
    }
};


