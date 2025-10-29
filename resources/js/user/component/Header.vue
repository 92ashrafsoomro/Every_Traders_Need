<template>
    <div :class="'headerDiv-' + themeStore.menuType">
        <div
            class="d-flex justify-content-between align-items-center"
            style="width: 100%"
        >
            <div
                class="mobileIcon_container"
                @click="themeStore.toggleMenuType()"
            >
                <span class="material-symbols-outlined">dock_to_left</span>
            </div>
            <h1 style="font-size: 24px; color: white">Dashboard</h1>
            <div class="d-flex align-items-center gap-3" style="color: white">
                <div class="header_icon_container">
                    <div
                        v-for="(icon, index) in headerIcons"
                        :key="index"
                        class="icon-wrapper"
                        :title="icon.title"
                        @click="icon.action && icon.action()"
                    >
                        <span class="material-symbols-outlined">{{
                            icon.name
                        }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useThemeStore } from "../stores/theme";

export default {
    props: {},
    components: {},
    data() {
        return {
            themeStore: useThemeStore(),
            headerIcons: [
                { name: "pageless", title: "Page View", action: null },
                {
                    name: "notifications_unread",
                    title: "Notifications",
                    action: null,
                },
                { name: "contacts_product", title: "Profile", action: null },
            ],

            isMobileSidebarOpen: false,
        };
    },

    methods: {},
};
</script>

<style scoped>
.headerDiv-expanded {
    position: fixed;
    margin-left: 258px;
    width: calc(100vw - 258px);
    top: 0;
    left: 0;
    height: 88px;
    border-bottom: 1px solid #353f4c;
    background-color: #000f21;
    z-index: 1;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0px 24px;
}

.headerDiv-collapsed {
    margin-left: 68px;
    width: calc(100vw - 68px);
    position: fixed;
    top: 0;
    left: 0;
    height: 88px;
    border-bottom: 1px solid #353f4c;
    background-color: #000f21;
    z-index: 1;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0px 24px;
}

.header_icon_container {
    display: flex;
    align-items: center;
    gap: 12px;
}

.icon-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    border-radius: 8px;
    cursor: pointer;
    background-color: #353f4c;
}

.icon-wrapper span {
    font-size: 22px;
    padding: 8px;
}

.icon-wrapper span:hover {
    background-color: #000f21;
    border-radius: 100%;
}

.mobileIcon_container {
    display: none;
}

@media (max-width: 768px) {
    .mobileIcon_container {
        display: block;
        color: white;
    }

    .headerDiv-expanded {
        margin-left: 0px;
        width: 100%;
    }

    .headerDiv-collapsed {
        margin-left: 0px;
        width: 100%;
    }
}
</style>
