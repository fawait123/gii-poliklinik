@props([
    'pageName' => 'Dashboard',
    'breadcrumbItems' => null
])

<x-layout>
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Content Area -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <!-- Header -->
            <x-header :pageName="$pageName" :breadcrumbItems="$breadcrumbItems" />

            <!-- Main Content -->
            <main class="content-wrapper">
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10 bg-primary-25">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</x-layout>
