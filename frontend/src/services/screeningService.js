import httpClient from "../httpClient.js";

export const getScreenings = () => {
    return httpClient.get('screenings');
};
