import {Navigate, Outlet} from "react-router-dom";
import {useStateContext} from "../contextProvider.jsx";
import Menu from "../views/components/menu.jsx";

export default function AuthenticatedLayout({children}) {
    const {user, token} = useStateContext();

    if (!token)
        return <Navigate to='/login' />

    return (
        <>
        <header>
            <Menu user={ user } token={ token } />
        </header>
        <main className="container mt-3">
            {children}
        </main>
        </>
    )
}
