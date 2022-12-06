import axios from "axios";

const axiosRequest = axios.create({
    baseURL: "/api/v1/",
    timeout: 20000,
    headers: {
        Authorization: `Bearer ${window.localStorage.getItem("SUNTEC_TOKEN")}`,
    }
});

// RESPONSE
// Add a response interceptor
axiosRequest.interceptors.response.use(
    function(response) {
        // Do something with response data
        // console.log(response);
        return response;
    },
    function(error) {
        // Do something with response error

        if (error.response.status == 401) {
           
           
        }
        if (error.response.status == 422) {
         
        }
        return Promise.reject(error);
    }
);

export default axiosRequest;
