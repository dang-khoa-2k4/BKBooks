

const getBooksFromCart = (cart,book) => {
    const booksInCart = cart.book_order.map((order) => {
      const bookDetail = book.find((b) => b.book_id === order.id); // Find book by book_id
      if (bookDetail) {
        return {
          ...bookDetail, // Spread the book details
          quantity: order.quantity // Add the quantity from the order
        };
      }
      return null; // Return null if book is not found
    }).filter((b) => b !== null); // Filter out any null values
  
    return booksInCart;
};

export default  getBooksFromCart;