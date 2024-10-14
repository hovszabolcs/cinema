import AuthenticatedLayout from "../layouts/AuthenticatedLayout.jsx";
import {useEffect, useState} from "react";
import {getScreenings} from "../services/screeningService.js";

export default function Screenings() {

    const [ screenings, setScreenings ] = useState([]);

    useEffect(() => {
        getScreenings().then( ({ data }) => {

            let screeningRows = data.screenings.map((item) => {
                return <tr>
                    <td>{item.id}</td>
                    <td>{item.movie}</td>
                    <td>{item.start}</td>
                    <td>{item.seats_available}</td>
                    <td>{item.url}</td>
                </tr>
            });
            setScreenings(screeningRows);
        });
    }, []);


    return (
        <AuthenticatedLayout>
            <h1>Vetítések</h1>
            <table className="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Film címe</th>
                    <th scope="col">Start</th>
                    <th scope="col">Szabad ülőhelyek</th>
                    <th scope="col">Url</th>
                </tr>
                </thead>
                <tbody>
                {screenings}
                </tbody>
            </table>
        </AuthenticatedLayout>
    )
}
