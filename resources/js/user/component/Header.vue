<template>
    <div :class="'headerDiv-' + themeStore.menuType">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div
                class="header_icon_container mobileIcon_container"
                @click="themeStore.toggleMenuType()"
            >
                <div class="icon-wrapper">
                    <span class="material-symbols-outlined">
                        density_medium
                    </span>
                </div>
            </div>

            <h1 class="titleHeading">Dashboard</h1>
            <!-- Header Icons -->
            <div class="d-flex align-items-center gap-3">
                <div class="fullscreen-container" @click="toggleFullScreen">
                    <span class="material-symbols-outlined">
                        {{ isFullScreen ? "fullscreen_exit" : "pageless" }}
                    </span>
                </div>
                <!-- Notifications Dropdown -->
                <Notification />
                <Profile />
            </div>
        </div>
    </div>
</template>

<script>
import { useThemeStore } from "../../stores/theme";
import Notification from "./NotificationDropdown.vue";
import Profile from "./ProfileDropdown.vue";

export default {
    props: {},
    components: {
        Notification,
        Profile,
    },
    data() {
        return {
            themeStore: useThemeStore(),
            activeDropdown: null,
            isMobileSidebarOpen: false,
            isFullScreen: false,
        };
    },
    methods: {
        toggleFullScreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen?.();
                this.isFullScreen = true;
            } else {
                document.exitFullscreen?.();
                this.isFullScreen = false;
            }
        },
    },
    mounted() {
        document.addEventListener("fullscreenchange", () => {
            this.isFullScreen = !!document.fullscreenElement;
        });
    },
};
</script>

<style>
.fullscreen-container {
    background-color: #353f4c;
    border-radius: 8px;
    padding: 5px;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}

.fullscreen-container:hover {
    background-color: #002145;
}

.titleHeading {
    font-size: 24px;
    color: white;
}

.headerDiv-expanded {
    position: fixed;
    margin-left: 258px;
    width: calc(100vw - 258px);
    top: 0;
    left: 0;
    height: 88px;
    border-bottom: 1px solid #353f4c;
    background-color: #000f21;
    z-index: 99;
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
    z-index: 99;
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
    .titleHeading {
        display: none;
    }

    .mobileIcon_container {
        display: block;
        color: white;
    }

    .headerDiv-expanded {
        margin-left: 0px;
        width: 100%;
        z-index: 99;
    }

    .headerDiv-collapsed {
        margin-left: 0px;
        width: 100%;
        z-index: 99;
    }
}
</style>
