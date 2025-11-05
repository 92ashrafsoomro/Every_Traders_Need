import { createApp } from "vue";
import router from "./route";
import pinia from "./stores";
import App from "./app.vue";
// import { useUserStore } from "./stores/userStore";


// Styles
import "vuetify/styles";

// Icons
import '@mdi/font/css/materialdesignicons.css';
import '@fortawesome/fontawesome-free/css/all.css';
import 'material-design-icons-iconfont/dist/material-design-icons.css'



import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import { aliases, mdi } from 'vuetify/iconsets/mdi'
import { fa } from 'vuetify/iconsets/fa'
import { md } from 'vuetify/iconsets/md'

import "./style.css";

const vuetify = createVuetify({
    components,
    directives,
    theme: {
        defaultTheme: "adminDark",
        themes: {
            adminDark: {
                dark: true,
                colors: {
                    primary: "#0080ff",
                    secondary: "#000f21",
                    success: "#4CAF50",
                    warning: "#FB8C00",
                    error: "#FF5252",
                    info: "#2196F3",
                    background: "#0E1B2B",
                    surface: "#000E20",
                    danger: "#ff4d52",
                    lighthover: "#002145",
                    backgound2: "#0f1c2b",
                },
                typography: {
                    fontFamily: 'Inter, "Helvetica Neue", Arial, sans-serif',
                    h1: {
                        // fontSize: '2.25rem',
                        // lineHeight: '2.75rem',
                        // fontWeight: '700'
                    },
                    h2: {
                        // fontSize: '1.75rem',
                        // lineHeight: '2.25rem',
                        // fontWeight: '600'
                    },
                    h3: {
                        // fontSize: '1.5rem',
                        // lineHeight: '2rem',
                        // fontWeight: '600'
                    },
                    subtitle1: {
                        // fontSize: '1.125rem',
                        // lineHeight: '1.75rem'
                    },
                    body1: {
                        // fontSize: '1rem',
                        // lineHeight: '1.5rem'
                    },
                    body2: {
                        // fontSize: '0.875rem',
                        // lineHeight: '1.25rem'
                    },
                    caption: {
                        // fontSize: '0.75rem',
                        // lineHeight: '1rem'
                    },
                    button: {
                        // fontSize: '0.875rem',
                        // fontWeight: '600',
                        // letterSpacing: '0.02em'
                    },
                },
            },
            adminLight: {
                dark: false,
                colors: {
                    background: "#FFFFFF",
                    surface: "#FFFFFF",
                    primary: "#1976D2",
                    secondary: "#000f21",
                    success: "#4CAF50",
                    warning: "#FB8C00",
                    error: "#FF5252",
                    info: "#2196F3",
                },
            },
        },
    },

    icons: {
        defaultSet: 'mdi', // default icon set
        aliases,
        sets: { mdi, fa, md, },
    },
});

const render = createApp(App);
render.use(pinia);
render.use(router);
render.use(vuetify);
// const userStore = useUserStore();

// (async () => {
//     if (userStore.token) {
//         try {
//             await userStore.syncUser();
//         } catch (e) {
//             console.warn("Auth sync failed:", e.message);
//             // userStore.clearAuth();
//         }
//     }

    render.mount("#userApp");
// })();

// render.mount('#userApp');
