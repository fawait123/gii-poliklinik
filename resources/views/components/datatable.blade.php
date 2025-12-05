@props(['apiUrl', 'columns', 'actions' => false, 'basePath' => '', 'title' => 'Data Table', 'createUrl' => null])

<div 
    x-data="datatable" 
    data-api-url="{{ $apiUrl }}" 
    class="overflow-hidden border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/3"
>
    <!-- Header -->
    <div class="flex flex-col gap-4 px-6 py-5 sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 dark:border-gray-800">
        <div class="flex items-center gap-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                {{ $title }}
            </h3>
            @if($createUrl)
                <a href="{{ $createUrl }}">
                    <button class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-white bg-brand-500 border border-brand-500 rounded-lg hover:bg-brand-600 dark:bg-brand-600 dark:hover:bg-brand-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add New
                    </button>
                </a>
            @endif
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            <!-- Search -->
            <div class="relative w-full sm:w-64">
                <input 
                    x-model.debounce.500ms="search"
                    type="text" 
                    placeholder="Search" 
                    class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300"
                >
                <div class="absolute left-3 top-2.5 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            @if(isset($headerActions))
                {{ $headerActions }}
            @endif
        </div>
    </div>

    <!-- Loading Indicator (Absolute or Overlay) -->
    <div x-show="isLoading" class="absolute inset-0 z-10 flex items-center justify-center bg-white/50 dark:bg-gray-900/50" style="display: none;">
        <svg class="animate-spin h-8 w-8 text-brand-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </div>

    <!-- Table -->
    <div class="w-full overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="bg-brand-50/50 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    @foreach($columns as $column)
                        <th class="py-4 px-6 text-left">
                            <div class="flex items-center">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    {{ $column['label'] }}
                                </p>
                            </div>
                        </th>
                    @endforeach
                    @if($actions)
                        <th class="py-4 px-6 text-left">
                            <div class="flex items-center">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Action
                                </p>
                            </div>
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                <template x-for="(item, index) in items" :key="index">
                    <tr>
                        @foreach($columns as $column)
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400" x-text="item['{{ $column['key'] }}']"></p>
                                </div>
                            </td>
                        @endforeach
                        @if($actions)
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2">
                                    <!-- Edit Button -->
                                    <a 
                                        :href="'/' + '{{ $basePath }}' + '/' + item.id + '/edit'"
                                        class="text-gray-500 hover:text-brand-500 dark:text-gray-400 dark:hover:text-brand-400"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <!-- Delete Button -->
                                    <button 
                                        @click="openDeleteModal(item.id)"
                                        class="text-gray-500 hover:text-error-500 dark:text-gray-400 dark:hover:text-error-400"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        @endif
                    </tr>
                </template>
                
                <!-- Empty State -->
                <tr x-show="!isLoading && items.length === 0" style="display: none;">
                    <td colspan="{{ count($columns) }}" class="py-8 text-center">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">No data found.</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-between px-6 py-4 border-t border-gray-200 dark:border-gray-800" x-show="pagination.total > 0">
        <div class="text-theme-sm text-gray-500 dark:text-gray-400">
            Showing <span class="font-medium" x-text="pagination.from"></span> to <span class="font-medium" x-text="pagination.to"></span> of <span class="font-medium" x-text="pagination.total"></span> results
        </div>
        
        <div class="flex gap-2">
            <button 
                @click="prevPage" 
                :disabled="pagination.current_page === 1"
                class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 disabled:opacity-50 disabled:cursor-not-allowed dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/3 dark:hover:text-gray-200"
            >
                Previous
            </button>

            <template x-for="page in paginationNumbers">
                <button 
                    @click="page !== '...' ? goToPage(page) : null"
                    :disabled="page === '...'"
                    :class="page === pagination.current_page ? 'bg-brand-500 text-white border-brand-500 hover:bg-brand-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700 dark:hover:bg-white/3 dark:hover:text-gray-200'"
                    class="inline-flex items-center justify-center rounded-lg border px-4 py-2 text-theme-sm font-medium shadow-theme-xs disabled:opacity-50 disabled:cursor-default"
                    x-text="page"
                >
                </button>
            </template>
            
            <button 
                @click="nextPage" 
                :disabled="pagination.current_page === pagination.last_page"
                class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 disabled:opacity-50 disabled:cursor-not-allowed dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/3 dark:hover:text-gray-200"
            >
                Next
            </button>
        </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <x-dialog x-model="deleteModalOpen">
        <x-dialog.content class="max-w-md">
            <x-dialog.header>
                <x-dialog.title>
                    Confirm Deletion
                </x-dialog.title>
                <x-dialog.description>
                    Are you sure you want to delete this item? This action cannot be undone.
                </x-dialog.description>
            </x-dialog.header>
            <x-dialog.footer>
                <x-button variant="outline" @click="closeDeleteModal">
                    Cancel
                </x-button>
                <x-button variant="destructive" @click="confirmDelete">
                    Delete
                </x-button>
            </x-dialog.footer>
        </x-dialog.content>
    </x-dialog>
</div>
