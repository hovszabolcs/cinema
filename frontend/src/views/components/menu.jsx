import {useState} from "react";

export default function Menu({ user, token, logoutAction }) {

    const [activeMenu, setActiveMenu] = useState('/');

    const menu = [
        {
            label: "Filmek",
            url: "/movies"
        },
        {
            label: "Vetítések",
            url: "/screenings"
        }
    ];

    return (
        <nav className="navbar navbar-expand-lg bg-body-tertiary">
            <div className="container-fluid">
                <a className="navbar-brand" href="/">AutósMozi</a>
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse" id="navbarText">
                    <ul className="navbar-nav me-auto mb-2 mb-lg-0">
                    { menu.map((item) => {
                        return (
                            <li key={item.url} className={"nav-item nav-link" + (activeMenu === item.url ? " active" : "") }>
                                <a className="nav-link" href={ item.url }>{ item.label }</a>
                            </li>
                        )
                    }) }
                    </ul>
                    <span className="navbar-text">
                        { token ?
                            (<a className="nav-item" href="/logout" onClick={logoutAction}>Kijelentkezés</a>) :
                            (<a className="nav-item" href="/login">Bejelentkezes</a>)
                        }
                    </span>
                </div>
            </div>
        </nav>
    )
}
