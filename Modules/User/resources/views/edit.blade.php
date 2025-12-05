<x-dashboard-layout 
    pageName="Edit User" 
    :breadcrumbItems="[
        ['label' => 'Home', 'url' => route('dashboard')],
        ['label' => 'Master'],
        ['label' => 'Users', 'url' => route('users.index')],
        ['label' => 'Edit']
    ]"
>
    <div class="p-6" x-data="userStore" x-init="formData = {{ json_encode(['name' => $user->name, 'email' => $user->email, 'password' => '', 'password_confirmation' => '']) }}">
        <div class="max-w-3xl mx-auto">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Edit User</h1>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <form @submit.prevent="updateUser({{ $user->id }})">
                    <div class="space-y-5">
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                            <input 
                                x-model="formData.name"
                                type="text"
                                placeholder="Enter user name" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300"
                            />
                            <template x-if="errors.name">
                                <p class="mt-1 text-sm text-error-500" x-text="errors.name[0]"></p>
                            </template>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                            <input 
                                x-model="formData.email"
                                type="email"
                                placeholder="Enter email address" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300"
                            />
                            <template x-if="errors.email">
                                <p class="mt-1 text-sm text-error-500" x-text="errors.email[0]"></p>
                            </template>
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password (leave blank to keep current)</label>
                            <input 
                                x-model="formData.password"
                                type="password"
                                placeholder="Enter new password" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300"
                            />
                            <template x-if="errors.password">
                                <p class="mt-1 text-sm text-error-500" x-text="errors.password[0]"></p>
                            </template>
                        </div>

                        <!-- Password Confirmation -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Confirm Password</label>
                            <input 
                                x-model="formData.password_confirmation"
                                type="password"
                                placeholder="Confirm new password" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300"
                            />
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3 pt-4">
                            <button 
                                type="submit" 
                                :disabled="isSubmitting"
                                class="inline-flex items-center px-4 py-2 bg-brand-500 hover:bg-brand-600 text-white font-medium rounded-lg disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                <span x-show="!isSubmitting">Update User</span>
                                <span x-show="isSubmitting">Updating...</span>
                            </button>
                            <a href="{{ route('users.index') }}">
                                <button type="button" class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-50 text-gray-700 font-medium border border-gray-300 rounded-lg dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700 dark:hover:bg-gray-700">
                                    Cancel
                                </button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
