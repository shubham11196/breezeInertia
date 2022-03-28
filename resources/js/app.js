require('./bootstrap');

import "./modules/sidebar";
import "./modules/theme";
import "./modules/feather";
import moment from 'moment';
import { createApp, h } from 'vue';
import { createInertiaApp, usePage, Link, Head } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Layout from './Layouts/LayoutComponent.vue';
import axios from 'axios';
import VueFeather from 'vue-feather';
import Datepicker from 'vue3-date-time-picker';
import 'vue3-date-time-picker/dist/main.css'
import * as bootstrap from "bootstrap";
const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>{
        const page = require(`./Pages/${name}.vue`).default;
        if (page.layout === undefined && !name.startsWith('public/')) {
            page.layout = Layout;
		}
		return page;
    },
    setup({ el, App, props, plugin }) {
        let app = createApp({ render: () => h(App, props) });
        app.config.globalProperties.$prop = usePage().props;
		app.config.globalProperties.$axios = axios;
		app.config.globalProperties.$moment = moment;
		app.config.globalProperties.$bootstrap = bootstrap;
        app.component('Datepicker', Datepicker);
		app.component('Link', Link);
		app.component('Head', Head);
        app.use(plugin, bootstrap);
		app.component('VueFeather', VueFeather);
		app.mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
