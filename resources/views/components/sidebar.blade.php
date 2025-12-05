<aside :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
    class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 duration-300 ease-linear text-slate-900 lg:static lg:translate-x-0"
    @click.outside="sidebarToggle = false">
    <!-- SIDEBAR HEADER -->
    <div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
        class="sidebar-header flex items-center gap-2 pb-7 pt-8">
        <a href="#">
            <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
                <x-logo />
            </span>
        </a>
    </div>
    <!-- SIDEBAR HEADER -->

    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        <!-- Sidebar Menu -->
        <nav x-data="{ selected: '' }">
            <!-- Menu Group -->
            <div>
                <h3 class="mb-4 text-xs uppercase leading-5 text-gray-400">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">
                        MENU
                    </span>

                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                        class="menu-group-icon mx-auto fill-current" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                            fill="" />
                    </svg>
                </h3>

                <ul class="mb-6 flex flex-col gap-4">
                    @foreach ($menuItems as $item)
                        <li>
                            @if (isset($item['hasDropdown']) && $item['hasDropdown'])
                                {{-- Menu Item with Dropdown --}}
                                <a href="{{ $item['route'] === '#' ? '#' : route($item['route']) }}"
                                    @if ($item['route'] === '#') @click.prevent="selected = (selected === {{ json_encode($item['label']) }} ? '' : {{ json_encode($item['label']) }})" @endif
                                    class="menu-item group"
                                    :class="'{{ request()->routeIs($item['activeRoute']) || (isset($item['submenu']) && $isSubmenuActive($item['submenu'])) ? 'menu-item-active' : 'menu-item-inactive' }}'">
                                    <x-menu-icon :name="$item['icon']" class="w-5 h-5 {{ request()->routeIs($item['activeRoute']) || (isset($item['submenu']) && $isSubmenuActive($item['submenu'])) ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}"/>

                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                        {{ $item['label'] }}
                                    </span>

                                    <svg class="menu-item-arrow text-slate-950"
                                        :class="[(selected === {{ json_encode($item['label']) }}) || {{ (isset($item['submenu']) && $isSubmenuActive($item['submenu'])) ? 'true' : 'false' }} ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive',
                                            sidebarToggle ? 'lg:hidden' : ''
                                        ]"
                                        width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke=""
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>

                                {{-- Dropdown Menu --}}
                                <div class="translate transform overflow-hidden"
                                    :class="(selected === {{ json_encode($item['label']) }}) || {{ (isset($item['submenu']) && $isSubmenuActive($item['submenu'])) ? 'true' : 'false' }} ? 'block' : 'hidden'">
                                    <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                        class="menu-dropdown mt-2 flex flex-col gap-1 pl-9">
                                        @foreach ($item['submenu'] as $subitem)
                                            <li>
                                                <a href="{{ $subitem['route'] === '#' ? '#' : route($subitem['route']) }}"
                                                    class="menu-dropdown-item group"
                                                    :class="'{{ request()->routeIs($subitem['activeRoute']) ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive' }}'">
                                                    @if(isset($subitem['icon']))
                                                        <x-menu-icon :name="$subitem['icon']" class="w-4 h-4 {{ request()->routeIs($subitem['activeRoute']) ? 'stroke-brand-500' : 'stroke-gray-500 group-hover:stroke-gray-700' }}"/>
                                                    @endif
                                                    {{ $subitem['label'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                {{-- Simple Menu Item --}}
                                <a href="{{ route($item['route']) }}" class="menu-item group"
                                    :class="'{{ request()->routeIs($item['activeRoute']) ? 'menu-item-active' : 'menu-item-inactive' }}'">
                                    <x-menu-icon :name="$item['icon']" class="w-5 h-5 {{ request()->routeIs($item['activeRoute']) ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}"/>

                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                        {{ $item['label'] }}
                                    </span>
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
        <!-- Sidebar Menu -->
    </div>
</aside>
