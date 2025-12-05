import axios from 'axios';

// Setup axios instance
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Axios Request Interceptor
 * Automatically attach authentication token to all requests
 */
window.axios.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem('auth_token');
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

/**
 * Axios Response Interceptor
 * Handle 401 Unauthorized errors globally
 */
window.axios.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        if (error.response && error.response.status === 401) {
            // Remove expired/invalid token from localStorage
            localStorage.removeItem('auth_token');

            // Redirect to login page
            window.location.href = '/';
        }
        return Promise.reject(error);
    }
);

export default axios;
