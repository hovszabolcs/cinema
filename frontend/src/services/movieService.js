import httpClient from "../httpClient.js";

export const getMovies = () => {
    return httpClient.get('movies');
};
