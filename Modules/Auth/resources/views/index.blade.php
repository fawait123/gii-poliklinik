<x-layout>
    <div class="relative p-6 bg-white z-1 sm:p-0">
        <div class="relative flex flex-col justify-center w-full h-screen sm:p-0 lg:flex-row">
            <div class="relative items-center hidden w-full h-full bg-primary-secondary lg:grid lg:w-1/2">
                <div class="flex items-center justify-center z-1">
                    <!-- ===== Common Grid Shape Start ===== -->
                    <div class="flex flex-col items-center max-w-xs">
                        <a href="#" class="block mb-4">
                            <img src="{{ asset('assets/banner/login-banner.png') }}" alt="Logo" />
                        </a>
                        <h1 class="text-center text-slate-900 font-bold text-xl mb-3">Selamat Datang di Cyber Campus</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400 text-center">
                            Bukan hanya sekedar sistem akademik kampus,Sebuah sistem yang menjadikan perguruan tinggi
                            lebih efesien dan terotomasi untuk SDM,Software dan Hardware
                        </p>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <div class="flex flex-col flex-1 w-full lg:w-1/2">
                <div class="flex flex-col justify-center flex-1 w-full max-w-md mx-auto">
                    <div>
                        <div class="flex justify-center mb-5">
                            <x-logo />
                        </div>
                        <div class="mb-5 sm:mb-8">
                            <h1
                                class="mb-2 font-semibold text-slate-950 text-title-sm sm:text-[30px] flex justify-center">
                                Welcome Back
                            </h1>
                            <p class="text-sm text-gray-500 dark:text-gray-400 flex justify-center">
                                Enter your credentials to access your account
                            </p>
                        </div>
                        <div>
                            <form @submit.prevent="login()" x-data="authStore">
                                <div class="space-y-5">
                                    <!-- Email -->
                                    <div>
                                        <x-input 
                                            label="Email" 
                                            type="email"
                                            placeholder="Masukan email anda" 
                                            x-model="formData.email"
                                        />
                                        <template x-if="errors.email">
                                            <p class="mt-1 text-sm text-red-500" x-text="errors.email[0]"></p>
                                        </template>
                                    </div>
                                    
                                    <!-- Password -->
                                    <div>
                                        <x-input 
                                            label="Password" 
                                            type="password" 
                                            placeholder="Masukan password anda"
                                            x-model="formData.password"
                                        />
                                        <template x-if="errors.password">
                                            <p class="mt-1 text-sm text-red-500" x-text="errors.password[0]"></p>
                                        </template>
                                    </div>
                                    
                                    <!-- Checkbox -->
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <label for="remember"
                                                class="flex items-center text-sm font-normal text-gray-700 cursor-pointer select-none dark:text-gray-400">
                                                <div class="relative">
                                                    <input 
                                                        type="checkbox" 
                                                        id="remember" 
                                                        class="sr-only"
                                                        x-model="formData.remember"
                                                    />
                                                    <div 
                                                        :class="formData.remember ? 'border-brand-500 bg-brand-500' : 'bg-transparent border-gray-300 dark:border-gray-700'"
                                                        class="mr-3 flex h-5 w-5 items-center justify-center rounded-md border-[1.25px]">
                                                        <span :class="formData.remember ? '' : 'opacity-0'">
                                                            <svg width="14" height="14" viewBox="0 0 14 14"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M11.6666 3.5L5.24992 9.91667L2.33325 7"
                                                                    stroke="white" stroke-width="1.94437"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                </div>
                                                Remember Me
                                            </label>
                                        </div>
                                        <a href="#" class="text-sm text-primary hover:text-brand-600">Forgot
                                            password?</a>
                                    </div>
                                    
                                    <!-- Button -->
                                    <div>
                                        <button
                                            type="submit"
                                            :disabled="isSubmitting"
                                            class="w-full rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500/20 disabled:opacity-50 disabled:cursor-not-allowed"
                                        >
                                            <span x-show="!isSubmitting">Login</span>
                                            <span x-show="isSubmitting">Logging in...</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="mt-5">
                                <p
                                    class="text-sm font-normal text-center text-gray-700 dark:text-gray-400 sm:text-start">
                                    Don't have an account?
                                    <a href="#"
                                        class="text-brand-500 hover:text-brand-600 dark:text-brand-400">Sign Up</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
