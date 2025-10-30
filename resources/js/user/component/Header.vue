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
            <div
                class="d-flex align-items-center gap-3"
                style="color: white; position: relative"
            >
                <div class="header_icon_container">
                    <div
                        v-for="(icon, index) in headerIcons"
                        :key="index"
                        class="icon-wrapper"
                        :title="icon.title"
                        @click="handleIconClick(icon.name)"
                    >
                        <span class="material-symbols-outlined">{{
                            icon.name
                        }}</span>
                    </div>
                </div>

                <!-- Notifications Dropdown -->
                <div v-if="activeDropdown === 'notifications'" class="dropdown">
                    <div class="dropdown-header">Notifications</div>
                    <ul>
                        <li>No new notifications</li>
                    </ul>
                </div>

                <!-- Profile Dropdown -->
                <div v-if="activeDropdown === 'profile'" class="dropdown">
                    <!-- Profle Section -->
                    <div class="dropdown-header-profile">
                        <div class="dropdown-profile-circle">
                            <img
                                src="http://localhost/autoboli/public/uploads/avatar/1758622849__ff__1754473262__ff__profile.jpg"
                                alt=""
                            />
                        </div>
                        <div class="userName-and-position">
                            <h6>User Name</h6>
                            <p>user_type</p>
                        </div>
                    </div>
                    <div class="parent-item-dropdown">
                        <div class="item-dropdown">
                            <span class="material-symbols-outlined">
                                contact_page
                            </span>
                            <span class="item-dropdown-text">My Profile</span>
                        </div>
                        <div class="item-dropdown">
                            <span class="material-symbols-outlined">
                                settings
                            </span>
                            <span class="item-dropdown-text">Settings</span>
                        </div>
                        <div class="item-dropdown">
                            <span class="material-symbols-outlined">
                                request_quote
                            </span>
                            <span class="item-dropdown-text">Billings</span>
                        </div>
                    </div>
                    <div class="dropdown-footer-profile">
                        <button
                            class="btn btn-danger logoutBtn"
                            @click="logout"
                        >
                            Logout
                            <span class="material-symbols-outlined">
                                logout
                            </span>
                        </button>
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
            activeDropdown: null, // can be 'notifications', 'profile', or null
            headerIcons: [
                { name: "fullscreen", title: "Fullscreen", action: null },
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

    methods: {
        handleIconClick(name) {
            if (name === "fullscreen") {
                this.toggleFullscreen();
            } else if (name === "notifications_unread") {
                this.toggleDropdown("notifications");
            } else if (name === "contacts_product") {
                this.toggleDropdown("profile");
            }
        },

        toggleDropdown(type) {
            this.activeDropdown = this.activeDropdown === type ? null : type;
        },

        toggleFullscreen() {
            const doc = window.document;
            const docEl = doc.documentElement;

            const requestFullScreen =
                docEl.requestFullscreen ||
                docEl.mozRequestFullScreen ||
                docEl.webkitRequestFullScreen ||
                docEl.msRequestFullscreen;
            const cancelFullScreen =
                doc.exitFullscreen ||
                doc.mozCancelFullScreen ||
                doc.webkitExitFullscreen ||
                doc.msExitFullscreen;

            if (
                !doc.fullscreenElement &&
                !doc.mozFullScreenElement &&
                !doc.webkitFullscreenElement &&
                !doc.msFullscreenElement
            ) {
                requestFullScreen.call(docEl);
            } else {
                cancelFullScreen.call(doc);
            }
        },
    },

    mounted() {
        // Close dropdowns when clicking outside
        document.addEventListener("click", (e) => {
            if (!this.$el.contains(e.target)) {
                this.activeDropdown = null;
            }
        });
    },
};
</script>

<style scoped>
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
    }

    .headerDiv-collapsed {
        margin-left: 0px;
        width: 100%;
    }
}
.dropdown {
    position: absolute;
    top: 60px;
    right: 0;
    background: #000f21;
    color: white;
    border: 1px solid #1c2a38;
    border-radius: 4px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    z-index: 3;
    animation: fadeIn 0.2s ease;
    height: 254px;
    width: 224px;
}

.dropdown-header-profile {
    padding: 10px 20px;
    border-bottom: 1px solid #1c2a38;
    display: flex;
    align-items: center;
    gap: 12px;
}

.dropdown-profile-circle {
    flex-shrink: 0;
    border-radius: 50%;
    height: 44px;
    width: 44px;
    background-color: #353f4c;
    overflow: hidden;
}

.dropdown-profile-circle img {
    width: 100%;
    height: 100%;
    background-image: cover;
}

.userName-and-position {
    display: flex;
    flex-direction: column;
    justify-content: center;
    color: white;
    line-height: 1.2;
}

.userName-and-position h6 {
    font-size: 20px;
    font-weight: 600;
    color: white;
    margin: 0;
}

.userName-and-position p {
    font-size: 13px;
    color: #aab8c5;
    margin: 2px 0 0 0;
}

.parent-item-dropdown {
    display: flex;
    flex-direction: column;
    border-bottom: 1px solid #1c2a38;
}

.item-dropdown {
    padding: 10px 26px;
    appearance: none;
    display: flex;
    align-items: center;
    gap: 5px;
    color: #b2c0ce;
    cursor: pointer;
}
.item-dropdown:hover {
    background-color: #0f1c2c;
}

.item-dropdown:hover .material-symbols-outlined {
    color: #0080ff;
}

.item-dropdown .material-symbols-outlined {
    margin-right: 8px;
}

.item-dropdown-text {
    font-size: 15px;
    font-weight: 400;
    color: white;
}

.logoutBtn {
    border-radius: 4px;
    background-color: #ff4c51;
    font-size: 13px;
    font-weight: 500;
    color: white;
    display: flex;
    align-items: center;
    gap: 2px;
}

.logoutBtn span {
    font-size: 13px;
}

.dropdown-footer-profile {
    padding: 10px;
    display: flex;
    justify-content: start;
    align-items: start;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-5px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
