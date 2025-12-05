import Alpine from 'alpinejs';
import collapse from "@alpinejs/collapse";
import anchor from "@alpinejs/anchor";
import persist from '@alpinejs/persist';

// Import plugins
import './plugins/axios.js';
import './module/dashboard/index.js';

// setup alpine
window.Alpine = Alpine

import datatable from './components/datatable.js';
import userStore from './module/user/stores/userStore.js';
import authStore from './module/auth/stores/authStore.js';
import dashboardStore from './module/dashboard/stores/dashboardStore.js';

Alpine.plugin(anchor);
Alpine.plugin(collapse);
Alpine.plugin(persist)

Alpine.data('datatable', datatable);
Alpine.data('userStore', userStore);
Alpine.data('authStore', authStore);
Alpine.data('dashboardStore', dashboardStore);

// Also register as store for global access
Alpine.store('userStore', userStore());

Alpine.start()
