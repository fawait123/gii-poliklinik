export default () => ({
    menuToggle: false,
    // Authenticated user data
    user: null,

    init() {
        this.fetchUser();
    },

    async fetchUser() {
        try {
            // Using axios - interceptor will automatically attach Bearer token
            const response = await window.axios.get('/api/auth/user');

            if (response.data.success) {
                // User data is in the 'data' property of the response
                this.user = response.data.data;
            }
        } catch (error) {
            console.error('Fetch user error:', error);
            // 401 errors are handled by axios interceptor (auto redirect to login)
        }
    },

    async logout() {
        try {
            // Using axios - interceptor will automatically attach Bearer token
            const response = await window.axios.post('/api/auth/logout');

            if (response.data.success) {
                // Remove stored token and user data
                localStorage.removeItem('auth_token');
                this.user = null;
                window.location.href = '/';
            }
        } catch (error) {
            console.error('Logout error:', error);
        }
    },
})
