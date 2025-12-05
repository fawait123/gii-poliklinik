export default () => ({
    items: [],
    pagination: {
        current_page: 1,
        last_page: 1,
        total: 0,
        per_page: 15,
        from: 0,
        to: 0
    },
    search: '',
    isLoading: false,
    apiUrl: '',
    deleteModalOpen: false,
    itemToDelete: null,

    init() {
        this.apiUrl = this.$el.dataset.apiUrl;
        if (!this.apiUrl) {
            console.error('Datatable: API URL is required');
            return;
        }
        this.fetchData();

        this.$watch('search', value => {
            this.fetchData(1);
        });
    },

    openDeleteModal(id) {
        this.itemToDelete = id;
        this.deleteModalOpen = true;
    },

    closeDeleteModal() {
        this.deleteModalOpen = false;
        this.itemToDelete = null;
    },

    confirmDelete() {
        console.log('confirmDelete called, itemToDelete:', this.itemToDelete);
        if (this.itemToDelete) {
            console.log('Calling deleteUser with ID:', this.itemToDelete);
            // Get userStore from Alpine and call deleteUser
            const userStore = Alpine.store('userStore');
            if (userStore && userStore.deleteUser) {
                userStore.deleteUser(this.itemToDelete);
            } else {
                console.error('userStore or deleteUser method not found');
            }
            this.closeDeleteModal();
        }
    },

    get paginationNumbers() {
        const total = this.pagination.last_page;
        const current = this.pagination.current_page;
        const delta = 2;
        const range = [];
        const rangeWithDots = [];
        let l;

        range.push(1);

        if (total <= 1) return range;

        for (let i = current - delta; i <= current + delta; i++) {
            if (i < total && i > 1) {
                range.push(i);
            }
        }
        range.push(total);

        for (let i of range) {
            if (l) {
                if (i - l === 2) {
                    rangeWithDots.push(l + 1);
                } else if (i - l !== 1) {
                    rangeWithDots.push('...');
                }
            }
            rangeWithDots.push(i);
            l = i;
        }

        return rangeWithDots;
    },

    async fetchData(page = 1) {
        this.isLoading = true;
        try {
            const params = new URLSearchParams({
                page: page,
                search: this.search,
            });

            const response = await window.axios.get(`${this.apiUrl}?${params.toString()}`);

            // Handle ResponseData wrapper format
            let responseData = response.data;

            // Check if response is wrapped in ResponseData format
            if (responseData.success && responseData.data) {
                responseData = responseData.data;
            }

            // Handle different pagination structures
            if (responseData.data && responseData.current_page) {
                // Standard Laravel paginate()
                this.items = responseData.data;
                this.pagination = {
                    current_page: responseData.current_page,
                    last_page: responseData.last_page,
                    total: responseData.total,
                    per_page: responseData.per_page,
                    from: responseData.from,
                    to: responseData.to
                };
            } else if (responseData.data && responseData.meta) {
                // API Resource Collection
                this.items = responseData.data;
                this.pagination = {
                    current_page: responseData.meta.current_page,
                    last_page: responseData.meta.last_page,
                    total: responseData.meta.total,
                    per_page: responseData.meta.per_page,
                    from: responseData.meta.from,
                    to: responseData.meta.to
                };
            } else {
                // Simple array or unknown structure
                this.items = Array.isArray(responseData) ? responseData : (responseData.data || []);
            }

        } catch (error) {
            console.error('Datatable: Error fetching data', error);
        } finally {
            this.isLoading = false;
        }
    },

    nextPage() {
        if (this.pagination.current_page < this.pagination.last_page) {
            this.fetchData(this.pagination.current_page + 1);
        }
    },

    prevPage() {
        if (this.pagination.current_page > 1) {
            this.fetchData(this.pagination.current_page - 1);
        }
    },

    goToPage(page) {
        this.fetchData(page);
    }
})
