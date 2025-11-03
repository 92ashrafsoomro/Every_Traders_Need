import { defineStore } from 'pinia'

export const useThemeStore = defineStore('theme', {
    state: () => ({
        menuOpen: true,
        menuType: 'expanded',
        themeMode: 'dark',
        loading: false,
    }),

    getters: {
        // userName: (state) => state.user?.name || 'Guest',
    },

    actions: {
        toggleThemeMode() {
            this.themeMode = this.themeMode === 'dark' ? 'light' : 'dark'
        },
        toggleMenuType() {
            this.menuType = this.menuType === 'collapsed' ? 'expanded' : 'collapsed'
        },
        toggleMenu() {
            this.menuOpen = this.menuOpen === true ? false : true;
        },
        setMenuType(type) {
            this.menuType = this.menuType === type;
        },
        startLoading() {
            this.loading = true;
            console.log('Theme Store Loading',this.loading);
        },
        endLoading() {
            this.loading = false;
             console.log('Theme Store Loading',this.loading);
        },
    },
})
