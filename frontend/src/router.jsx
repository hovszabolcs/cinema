import {BrowserRouter, Navigate, Route, Routes} from "react-router-dom";
import Login from "./views/login.jsx";
import Movies from "./views/movies.jsx";
import {ContextProvider} from "./ContextProvider.jsx";
import Screenings from "./views/screenings.jsx";

export default function Router() {
    return (
        <ContextProvider>
            <BrowserRouter>
                <Routes>
                    <Route path="/" element={<Navigate to="/movies" />} />
                    <Route path="/movies" element={<Movies/>} />
                    <Route path="/screenings" element={<Screenings/>} />
                    <Route path="/login" element={<Login/>} />
                    <Route path="*" element={<Navigate to="/" />} />
                </Routes>
            </BrowserRouter>
        </ContextProvider>
    )
}
