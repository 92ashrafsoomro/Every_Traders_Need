<template>
    <div :class="'layout ' + 'layout-' + themeStore.menuType">
        <Sidebar />
        <div class="contentDiv">
            <Header></Header>
            <div class="viewPage">
                <main>
                    <router-view />
                </main>
                <!-- <footer class="px-4">
                    <p>
                        © 2025 Design & Develop By
                        <span>DaPrimeProductions</span>
                    </p>
                </footer> -->
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from "./Sidebar.vue";
import Header from "./Header.vue";
import { useThemeStore } from "../stores/theme";

export default {
    components: {
        Sidebar,
        Header,
    },
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
        };
    },
    methods: {},
};
</script>

<style scoped>
.layout {
    display: flex;
    padding: 0px;
    margin: 0px;
}

.contentDiv {
    width: 100%;
}

.layout-expanded .contentDiv {
    margin-left: 258px;
    width: calc(100vw - 258px);
}

.layout-collapsed .contentDiv {
    width: 100%;
    margin-left: 58px;
}

.viewPage {
    margin-top: 88px;
}

footer {
    background-color: #0f1c2c;
}

footer p {
    font-size: 15px;
    font-weight: 400;
    color: #d3d3d3;
}

footer span {
    color: #0080ff;
}

@media (max-width: 768px) {
    .layout-expanded .contentDiv {
        margin-left: 0px;
        width: 100%;
    }

    .layout-collapsed .contentDiv {
        margin-left: 0px;
        width: 100%;
    }
}
</style>
