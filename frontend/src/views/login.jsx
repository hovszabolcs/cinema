import GuestLayout from "../layouts/GuestLayout.jsx";
import {Navigate} from "react-router-dom";
import {useStateContext} from "../ContextProvider.jsx";
import {useRef, useState} from "react";
import httpClient from "../httpClient.js";

export default function Login() {
    const
        {token} = useStateContext(),
        emailRef = useRef(),
        passwordRef = useRef();

    const { setUser, setToken } = useStateContext();
    const [ error, setError ] = useState('')

    if (token)
        return <Navigate to='/' />

    const Submit = (event) => {
        event.preventDefault();
        setError('');
        const payload = {
            email: emailRef.current.value,
            password: passwordRef.current.value
        };

        httpClient.post("login", payload).then(
            ({data}) => {
                setToken(data.token);
                setUser(data.user);
            }
        ).catch(error => {
            const response = error.response;
            setError(response.data.message);
        });

    }

    return (
        <GuestLayout>
            <form method="post" className="animate fade-in text-start" onSubmit={Submit}>
                <div className="card col-md-4 shadow mx-auto">
                    <h4 className="modal-title pb-4">Bejelentkezés</h4>
                    {error && <div className="text-danger pb-3">{error}</div>}
                    <div className="input-group mb-3">
                        <span className="input-group-text shadow-sm">@</span>
                        <input ref={emailRef} type="email" className="form-control" placeholder="Felhasználónév" aria-label="Felhasználónév" defaultValue="admin@admin.hu" />
                    </div>
                    <div className="input-group mb-3">
                        <input ref={passwordRef} type="password" className="form-control" aria-label="Jelszó" placeholder="Jelszó" defaultValue="password" />
                    </div>
                    <div className="input-group text-end d-block">
                        <input type="submit" className="btn btn-primary float-end" aria-label="Elküld" />
                    </div>
                </div>
            </form>
        </GuestLayout>
    )
}
