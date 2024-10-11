import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'

import './assets/css/App.scss'
import Login from "./views/login.jsx";
import Router from "./router.jsx";

createRoot(document.getElementById('app')).render(
  <StrictMode>
    <Router />
  </StrictMode>,
)
