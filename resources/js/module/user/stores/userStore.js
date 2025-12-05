export default () => ({
    // Form data
    formData: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
    },
    errors: {},
    isSubmitting: false,
    isExporting: false,

    // Toast notification method
    showToast(message, type = 'success') {
        const toast = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-green-500' :
            type === 'error' ? 'bg-red-500' :
                type === 'warning' ? 'bg-yellow-500' : 'bg-blue-500';

        // Icon SVG based on type
        const icon = type === 'success'
            ? '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>'
            : type === 'error'
                ? '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>'
                : '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';

        toast.className = `fixed top-4 right-4 z-[99999] px-4 py-3 rounded-lg shadow-2xl text-white flex items-center gap-3 min-w-[300px] ${bgColor}`;
        toast.style.transform = 'translateX(400px)';
        toast.style.transition = 'transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
        toast.innerHTML = `
            <div class="flex-shrink-0">${icon}</div>
            <div class="flex-1 font-medium">${message}</div>
        `;

        document.body.appendChild(toast);

        // Animate in
        setTimeout(() => {
            toast.style.transform = 'translateX(0)';
        }, 10);

        // Remove after 5 seconds
        setTimeout(() => {
            toast.style.transform = 'translateX(400px)';
            setTimeout(() => {
                if (document.body.contains(toast)) {
                    document.body.removeChild(toast);
                }
            }, 400);
        }, 5000);
    },

    // Save toast message to localStorage for showing after reload
    saveToastMessage(message, type = 'success') {
        localStorage.setItem('toastMessage', JSON.stringify({ message, type }));
    },

    // Check and show toast from localStorage
    checkAndShowToast() {
        const toastData = localStorage.getItem('toastMessage');
        if (toastData) {
            const { message, type } = JSON.parse(toastData);
            localStorage.removeItem('toastMessage');
            this.showToast(message, type);
        }
    },

    async createUser() {
        this.isSubmitting = true;
        this.errors = {};

        try {
            const response = await window.axios.post('/api/users', this.formData);

            if (response.data.success) {
                // Save success notification to show after reload
                this.saveToastMessage('User created successfully!', 'success');
                // Redirect to index page
                window.location.href = '/users';
            }
        } catch (error) {
            console.error('Error creating user:', error);
            // Handle validation errors
            if (error.response && error.response.data && error.response.data.errors) {
                this.errors = error.response.data.errors;
            } else {
                alert(error.response?.data?.message || 'Failed to create user');
            }
        } finally {
            this.isSubmitting = false;
        }
    },

    async updateUser(userId) {
        this.isSubmitting = true;
        this.errors = {};

        try {
            const response = await window.axios.put(`/api/users/${userId}`, this.formData);

            if (response.data.success) {
                // Save success notification to show after reload
                this.saveToastMessage('User updated successfully!', 'success');
                // Redirect to index page
                window.location.href = '/users';
            }
        } catch (error) {
            console.error('Error updating user:', error);
            // Handle validation errors
            if (error.response && error.response.data && error.response.data.errors) {
                this.errors = error.response.data.errors;
            } else {
                alert(error.response?.data?.message || 'Failed to update user');
            }
        } finally {
            this.isSubmitting = false;
        }
    },

    async deleteUser(userId) {
        try {
            const response = await window.axios.delete(`/api/users/${userId}`);

            if (response.data.success) {
                // Save success notification to show after reload
                this.saveToastMessage('User deleted successfully!', 'success');
                // Reload the page
                window.location.reload();
            }
        } catch (error) {
            console.error('Error deleting user:', error);
            alert(error.response?.data?.message || 'Failed to delete user');
        }
    },

    async exportUsers() {
        this.isExporting = true;
        try {
            const response = await window.axios.get('/api/users/export', {
                responseType: 'blob'
            });

            const blob = new Blob([response.data]);
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'users.xlsx';
            document.body.appendChild(a);
            a.click();
            a.remove();
            window.URL.revokeObjectURL(url);

            // Show success toast
            this.showToast('Users exported successfully!', 'success');
        } catch (error) {
            console.error('Error exporting users:', error);
            this.showToast('Failed to export users', 'error');
        } finally {
            this.isExporting = false;
        }
    }
});
