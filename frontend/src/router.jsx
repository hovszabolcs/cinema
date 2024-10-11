import {BrowserRouter, Navigate, Route, Routes} from "react-router-dom";
import Login from "./views/login.jsx";
import Index from "./views/index.jsx";
import {ContextProvider} from "./contextProvider.jsx";

export default function Router() {
    return (
        <ContextProvider>
            <BrowserRouter>
                <Routes>
                    <Route path="/" element={<Index/>} />
                    <Route path="/login" element={<Login/>} />
                    <Route path="*" element={<Navigate to="/" />} />
                </Routes>
            </BrowserRouter>
        </ContextProvider>
    )
}
