import axios from "axios";

const httpClient = axios.create({
   baseURL: "http://localhost:8000/api"
});

httpClient.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        const { response } = error;
        if ( response.status === 401 )
            localStorage.removeItem("token");

        throw error;
    }
)

httpClient.interceptors.request.use( (config) => {
    const token = localStorage.getItem("token");
    config.headers.Authorization = `Bearer ${token}`;
    return config;
});


export default httpClient;
