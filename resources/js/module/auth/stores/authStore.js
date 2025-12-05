export default () => ({
    // Form data
    formData: {
        email: '',
        password: '',
        remember: false
    },
    errors: {},
    isSubmitting: false,
    menuToggle: false,
    // Authenticated user data
    user: null,
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

    async login() {
        this.isSubmitting = true;
        this.errors = {};
        this.user = null;

        try {
            // Using axios for login (no token needed for login endpoint)
            const response = await window.axios.post('/api/auth/login', this.formData);

            if (response.data.success) {
                // Save token and user data from the 'data' property
                const token = response.data.data.token;
                const user = response.data.data.user;
                const redirect = response.data.data.redirect || '/dashboard';

                localStorage.setItem('auth_token', token);
                this.user = user;

                // Use setTimeout to ensure localStorage write completes
                setTimeout(() => {
                    window.location.href = redirect;
                }, 100);
            }
        } catch (error) {
            console.error('Login error:', error);
            // Handle validation errors
            if (error.response && error.response.data) {
                if (error.response.data.errors) {
                    this.errors = error.response.data.errors;
                } else {
                    this.errors = { email: [error.response.data.message || 'Login failed'] };
                }
            } else {
                this.errors = { email: ['An unexpected error occurred.'] };
            }
        } finally {
            this.isSubmitting = false;
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
