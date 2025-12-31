// plugins/vuetify.js
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

// Icon sets
import { aliases, mdi } from 'vuetify/iconsets/mdi';
import { fa } from 'vuetify/iconsets/fa';
import { md } from 'vuetify/iconsets/md';

// Styles
import "vuetify/styles";
import '@fontsource/inter';
import '@mdi/font/css/materialdesignicons.css';
import '@fortawesome/fontawesome-free/css/all.css';
import 'material-design-icons-iconfont/dist/material-design-icons.css';


const vuetify = createVuetify({
    components,
    directives,
    defaults: {
        global: {
            style: {
                fontFamily: 'Inter, sans-serif',
            },
        },
        VBtn: {
            ripple: false,
            style: {
                '--v-btn-overlay-opacity': 0
            },
            class: 'no-overlay',
        },
        VCard: {
            elevation: 0,
            class : "border-b"
        },
        VCardTitle:{
            class:"pl-1"
        },
        VCardText: {
             class:"pl-2 "

        }
       
    },
    theme: {
        defaultTheme: "adminDark",
        themes: {
            adminDark: {
                dark: true,
                colors: {
                    
                    'primary-lighten-1': '#3399ff',
                    primary: "#0080FF",
                    primaryLite :"#3399ff20",
                    primaryDark:"#0658e5ff",
                    'on-primary': '#ffffff',
                    // background: "#000f21",
                    surface: "#000E20",
                    'surface-variant-1': "#0f1c2b",
                    light_text_on: "#B1BFCD",
                    border: "#343E4B",
                    whiteLight:"#fff",
                    white_light_nav : "#fff",
                    danger: "#f21202",
                    dangerlite: "#b91c1c50",
                    success: "#4CAF50",
                    warning: "#FB8C00",
                    text_light:"#B2C0C3",
                    error: "#FF5252",
                    info: "#2196F3",
                    background: "#0E1B2B",
                    shadow: "#353f4c",
                    light:"#b2c0ce",
                    verticalLineBlue: "#0080ff",
                    surfaceBright: "#343E4B",
                    inputBg : "#021830"
                    
                    // lighthover: "#002145",
                    // secondary: "#000f21",
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
                variables: {
                    'space': '10px'
                }
            },
            adminLight: {
                dark: false,
                colors: {
                    primary: "#0080ff",
                    'primary-lighten-1': '#8579F2',
                    primaryLight : "#0080ff20",
                    background: "#f4f6faff",
                    surface: "#fff",
                    whiteLight:"#000",
                    white_light_nav : "#000",
                    'surface-variant-1': "#e9eff6",
                    light_text_on: "#0f1c2b",
                    border: "#B1BFCD",
                    danger: "#ff0000",
                    success: "#4CAF50",
                    warning: "#FB8C00",
                    error: "#FF5252",
                    info: "#2196F3",
                    shadow: "#E1EBEE",
                    
                    // secondary: "#FFFFFF",
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




export default vuetify;
