import AuthenticatedLayout from "../layouts/AuthenticatedLayout.jsx";
import {useEffect, useState} from "react";
import { getMovies } from "../services/movieService";

export default function Movies() {

    const [ movies, setMovies ] = useState([]);

    useEffect(() => {
        getMovies().then( ({ data }) => {

            let movieRows = data.movieList.map((item) => {
                return <tr>
                    <td>{item.id}</td>
                    <td><img src={item.image_path} height="100" /></td>
                    <td>{item.title}</td>
                    <td>{item.description}...</td>
                    <td>{item.age_classification}</td>
                    <td>{item.lang}</td>
                </tr>
            });
            setMovies(movieRows);
        });
    }, []);


    return (
        <AuthenticatedLayout>
            <h1>Filmek</h1>
            <table className="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kép</th>
                    <th scope="col">Cím</th>
                    <th scope="col">Leírás</th>
                    <th scope="col">Korhatár</th>
                    <th scope="col">Nyelv</th>
                </tr>
                </thead>
                <tbody>
                {movies}
                </tbody>
            </table>
        </AuthenticatedLayout>
    )
}
