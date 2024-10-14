import {Navigate, Outlet} from "react-router-dom";
import {useStateContext} from "../ContextProvider.jsx";
import Menu from "../views/components/menu.jsx";
import axios from "axios";
import httpClient from "../httpClient.js";

export default function AuthenticatedLayout({children}) {
    const { user, setUser , token, setToken, globalError, setGlobalError } = useStateContext();

    if (!token)
        return <Navigate to='/login' />

    const logoutAction = (e) => {
        e.preventDefault();

        setGlobalError('');
        httpClient.post("logout").then(
            ({data}) => {
                setToken(null);
                setUser(null);
            }
        ).catch(error => {
            const response = error.response;
            setGlobalError(response.data.message);
            setTimeout(() => globalError !== '' && setGlobalError(''), 2000);
        });
    }

    return (
        <>
        <header>
            <Menu user={ user } token={ token } logoutAction={logoutAction} />
        </header>
            { globalError && <div className="alert alert-danger">{globalError}</div> }
        <main className="container mt-3">
            {children}
        </main>
        </>
    )
}
