import {createContext, useContext, useState} from 'react';

const stateContext = createContext({
    user: null,
    token: null,
    setUser: () => {},
    setToken: () => {}
});

export const ContextProvider = ({children}) => {

    const [user, setUser] = useState({ id : null });
    const [token, setTokenValue] = useState(readToken());

    function readToken() {
        return localStorage.getItem('token');
    }

    function storeToken(token) {
        localStorage.setItem('token', token);
    }

    function removeToken() {
        localStorage.removeItem('token');
    }

    function setToken(token) {
        setTokenValue(token);

        if (token)
            storeToken(token);
        else
            removeToken();
    }

    return (
        <stateContext.Provider value={{
            user,
            token,
            setUser,
            setToken
        }}>{children}</stateContext.Provider>
    )
}

export const useStateContext = () =>  useContext(stateContext)
