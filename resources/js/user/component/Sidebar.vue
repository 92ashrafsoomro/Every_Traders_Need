<template>
    <aside class="sideBar" :style="{ width: isSidebarOpen ? '258px' : '68px' }">
        <div class="logoDiv p-4">
            <img
                src="http://localhost/autoboli/public/themeadmin/images/logo/logo.png"
                alt=""
            />
        </div>

        <div class="pt-3 p-3">
            <p
                style="
                    color: #d3d3d3;
                    letter-spacing: 0px;
                    font-weight: 400;
                    font-size: 14px;
                "
            >
                Menu
            </p>
            <hr style="color: #d3d3d3; margin-top: -8px; margin-bottom: 6px" />
            <div>
                <router-link
                    v-for="(item, index) in menuItems"
                    :key="index"
                    :to="item.path"
                    class="text-decoration-none"
                >
                    <div
                        class="router-element"
                        :class="{ active: $route.path === item.path }"
                    >
                        <span class="material-symbols-outlined">{{
                            item.icon
                        }}</span>
                        <p v-if="isSidebarOpen" class="m-0">
                            {{ item.label }}
                        </p>
                    </div>
                </router-link>
            </div>
        </div>
        <div class="pt-3 p-3">
            <p
                style="
                    color: #d3d3d3;
                    letter-spacing: 0px;
                    font-weight: 400;
                    font-size: 14px;
                "
            >
                Profile
            </p>
            <hr style="color: #d3d3d3; margin-top: -8px; margin-bottom: 6px" />
            <div>
                <router-link
                    v-for="(item, index) in profileItems"
                    :key="index"
                    :to="item.path"
                    class="text-decoration-none"
                >
                    <div
                        class="router-element"
                        :class="{ active: $route.path === item.path }"
                    >
                        <span class="material-symbols-outlined">{{
                            item.icon
                        }}</span>
                        <p v-if="isSidebarOpen" class="m-0">
                            {{ item.label }}
                        </p>
                    </div>
                </router-link>
            </div>
        </div>
    </aside>
</template>

<script>
export default {
    props: {
        isSidebarOpen: {
            type: Boolean,
            default: true,
        },
    },
    data() {
        return {
            menuItems: [
                { icon: "dashboard", label: "Dashboard", path: "/" },
                {
                    icon: "gavel",
                    label: "Auction Finder",
                    path: "/auction-finder",
                },
                { icon: "thumb_up", label: "My Interest" },
                { icon: "history", label: "Watchlist", path: "/viewhsitory" },
                {
                    icon: "edit_calendar",
                    label: "Reauction",
                    path: "/reauction",
                },
                { icon: "compare_arrows", label: "Compare", path: "/compare" },
                {
                    icon: "calendar_check",
                    label: "Auction Scheduler",
                    path: "/auctionscheduler",
                },
            ],
            profileItems: [
                { icon: "support_agent", label: "Support", path: "/support" },
                {
                    icon: "newspaper",
                    label: "News",
                    path: "/news",
                },
                { icon: "account_circle", label: "Profile", path: "/interest" },
                { icon: "settings", label: "Settings", path: "/viewhsitory" },
            ],
        };
    },
};
</script>

<style scoped>
.sideBar {
    height: 100vh;
    position: fixed;
    background-color: #000f21;
    border-right: 1px solid #353f4c;
    transition: all 0.3s ease;
    overflow: hidden;
}

.logoDiv {
    display: flex;
    justify-content: start;
    align-items: center;
    border-bottom: 1px solid #353f4c;
}

.router-element {
    display: flex;
    align-items: center;
    padding: 8px;
    width: 100%;
    border-radius: 2px;
    color: #cfcde4;
    margin-bottom: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.router-element:hover {
    background-color: #0080ff20;
    color: white;
}

.router-element.active {
    background-color: #0080ff;
    color: white;
}

.router-element p {
    margin-left: 8px !important;
    font-weight: 500;
}
</style>
