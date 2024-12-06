

import React from 'react';
import { Route, Navigate } from 'react-router-dom';
import { useAuth } from '../Wrapper App';

// Protected Route Component
const ProtectedRoute = ({ children}) => {

  const { isLoggedIn } = useAuth();

  
  return isLoggedIn ? children : <Navigate to="/login" />;
};

export default ProtectedRoute;