import { defineStore } from 'pinia'

export const useThemeStore = defineStore('theme', {
    state: () => ({
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
        setMenuType(type) {
            this.menuType = this.menuType === type;
        },
    },
})
