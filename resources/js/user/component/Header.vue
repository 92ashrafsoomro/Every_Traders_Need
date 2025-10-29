<template>
    <div class="headerDiv"
        :style="{
            marginLeft: isSidebarOpen ? '258px' : '68px',
            width: isSidebarOpen ? 'calc(100vw - 258px)' : 'calc(100vw - 68px)',
        }">
        <button class="btn btn-outline-light me-3" @click="toggleSidebar">☰</button>
        <div class="d-flex justify-content-between align-items-center"
            style="width: 100%"
        >
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
export default {
    props: {
        isSidebarOpen: {
            type: Boolean,
            default: true,
        },
        toggleSidebar: {
            type: Function,
            default: () => {},
        },
    },
    components: {},
    data() {
        return {
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
.headerDiv {
    position: fixed;
    top: 0;
    left: 0;
    height: 88px;
    border-bottom: 1px solid #353f4c;
    background-color: #000f21;
    z-index: 1000;
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
</style>
