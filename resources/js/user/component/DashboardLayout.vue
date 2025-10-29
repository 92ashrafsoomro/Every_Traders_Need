<template>
    <div class="layout">
        <Sidebar :isSidebarOpen="isSidebarOpen"></Sidebar>
        <div
            class="contentDiv"
            :style="{
                marginLeft: isSidebarOpen ? '258px' : '0',
                width: isSidebarOpen ? 'calc(100vw - 258px)' : '100vw',
            }"
        >
            <Header :toggleSidebar="toggleSidebar" :isSidebarOpen="isSidebarOpen" ></Header>
            <div
                class="viewPage"
                :style="{
                    marginLeft: isSidebarOpen ? '0px' : '68px',
                }"
            >
                <main class="p-4" style="background-color: yellow">
                    <h1>Content</h1>
                    <router-view />
                </main>
                <footer>
                    <p> © 2025 Design & Develop By <span>DaPrimeProductions</span> </p>
                </footer>
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from "./Sidebar.vue";
import Header from "./Header.vue";

export default {
    components: {
        Sidebar,
        Header,
    },
    data() {
        return {
            isSidebarOpen: true,
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
    methods: {
        toggleSidebar() {
            this.isSidebarOpen = !this.isSidebarOpen;
        },
    },
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

footer p {
    font-size: 15px;
    font-weight: 400;
    color: #d3d3d3;
}

footer span {
    color: #0080ff;
}
</style>
