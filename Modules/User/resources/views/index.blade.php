<x-dashboard-layout 
    pageName="Users" 
    :breadcrumbItems="[
        ['label' => 'Home', 'url' => route('dashboard')],
        ['label' => 'Master'],
        ['label' => 'Users']
    ]"
>
    <div class="p-6" x-data="userStore" x-init="checkAndShowToast()">
        <x-datatable 
            api-url="/api/users" 
            :columns="[
                ['key' => 'id', 'label' => 'ID'],
                ['key' => 'name', 'label' => 'Name'],
                ['key' => 'email', 'label' => 'Email'],
                ['key' => 'created_at', 'label' => 'Created At']
            ]" 
            :actions="true"
            base-path="users"
            title="User Management"
            create-url="{{ route('users.create') }}"
            x-init="$el._x_deleteUser = deleteUser"
        >
            <x-slot name="headerActions">
                <button @click="exportUsers()" :disabled="isExporting" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-brand-500 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-brand-400 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg x-show="!isExporting" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <svg x-show="isExporting" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span x-text="isExporting ? 'Exporting...' : 'Export'"></span>
                </button>
            </x-slot>
        </x-datatable>
    </div>
</x-dashboard-layout>
