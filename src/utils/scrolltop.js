import { useLocation } from 'react-router-dom';
import { useEffect } from 'react';

const ScrollToTop = () => {
  const location = useLocation();

  useEffect(() => {
    // Scroll to top of the page on route change
    window.scrollTo(0, 0);
  }, [location]); // Depend on location, so it runs on route change

  return null; // This component doesn't render anything
};

export default ScrollToTop;