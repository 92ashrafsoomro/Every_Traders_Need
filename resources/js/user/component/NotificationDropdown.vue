<template>
    <div class="relative inline-block">
        <!-- 🔔 Notification Bell Icon -->
        <div class="notification-icon" @click="toggleDropdown">
            <span class="material-symbols-outlined">
                notifications_unread
            </span>
        </div>

        <!-- ⬇ Notification Dropdown -->
        <div v-if="isOpen" class="dropdown-notification" @click.stop>
            <div class="dropdown-notification-header">
                <div class="title">Notifications</div>
                <div class="title-right-side">
                    <div class="notifyDiv">8 New</div>
                    <span class="material-symbols-outlined"> drafts </span>
                </div>
            </div>

            <!-- Notification Items -->
            <div
                class="notification-item"
                v-for="(note, i) in userStore.notification"
                :key="i"
            >
                <div class="icon-notify">
                    <div class="icon-notify-container">
                        <span class="material-symbols-outlined">
                            notifications
                        </span>
                    </div>
                </div>

                <div class="notification-content-centralized">
                    <div class="titleheading">{{ note.title }}</div>
                    <div class="desc">{{ note.description }}</div>
                    <p>{{ note.time }}</p>
                </div>

                <div class="notification-last-item">
                    <div class="blue-dot"></div>
                    <span class="material-symbols-outlined"> close_small </span>
                </div>
            </div>

            <div class="notification-btn-container">
                <button class="notification-btn">View All Notifications</button>
            </div>
        </div>
    </div>
</template>

<script>
import { useUserStore } from "../stores/user";

export default {
    setup() {
        const userStore = useUserStore();
        return { userStore };
    },

    data() {
        return {
            isOpen: false,
        };
    },
    methods: {
        toggleDropdown() {
            this.isOpen = !this.isOpen;
        },
    },
    mounted() {
        document.addEventListener("click", this.closeDropdown);
    },
    beforeUnmount() {
        document.removeEventListener("click", this.closeDropdown);
    },
    methods: {
        toggleDropdown() {
            this.isOpen = !this.isOpen;
        },
        closeDropdown(e) {
            if (!e.target.closest(".relative")) {
                this.isOpen = false;
            }
        },
    },
};
</script>

<style scoped>
.notification-icon {
    position: relative;
    cursor: pointer;
    color: #ffffff;
    background-color: #353f4c;
    padding: 5px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.notification-icon:hover {
    background-color: #002145;
}

.notification-icon .material-symbols-outlined {
    font-weight: lighter;
    color: white;
}

.dropdown-notification {
    position: absolute;
    top: 72px;
    right: 15px;
    background: #000f21;
    color: white;
    border: 1px solid #1c2a38;
    border-radius: 4px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    z-index: 3;
    animation: fadeIn 0.2s ease;
    width: 352px;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.dropdown-notification-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 16px;
    border-bottom: 1px solid #1c2a38;
}

.dropdown-notification-header .title {
    font-size: 20px;
    font-weight: 500;
    color: white;
}

.title-right-side {
    display: flex;
    align-items: center;
    gap: 10px;
}

.title-right-side .material-symbols-outlined {
    font-size: 20px;
}

.notifyDiv {
    background-color: #002145;
    color: #0080ff;
    font-size: 11px;
    font-weight: 500;
    padding: 3px 6px;
    border-radius: 4px;
}

.notification-item {
    display: flex;
    align-items: start;
    border-bottom: 1px solid #1c2a38;
    cursor: pointer;
    overflow: auto;
}

.notification-item:hover {
    background-color: #0f1c2c;
}

.icon-notify {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
}

.icon-notify-container {
    height: 40px;
    width: 40px;
    border-radius: 100%;
    background-color: #002145;
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon-notify-container span {
    color: #0080ff;
}

.notification-content-centralized {
    padding: 10px;
    width: 70%;
}

.notification-content-centralized .titleheading {
    font-size: 13px;
    font-weight: 400;
    color: #d3d3d3;
}

.notification-content-centralized .desc {
    font-size: 13px;
    font-weight: 400;
    color: white;
}

.notification-content-centralized p {
    margin-top: 10px;
    font-size: 13px;
    font-weight: 400;
    color: #76778e;
}

.notification-last-item {
    height: 100%;
}

.notification-last-item .blue-dot {
    height: 8px;
    width: 8px;
    background-color: #0080ff;
    border-radius: 100%;
    margin-top: 20px;
}

.notification-last-item span {
    display: none;
}

.notification-item:hover span {
    display: block;
}

.notification-btn-container {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 8px 10px;
}

.notification-btn {
    font-size: 13px;
    font-weight: 700;
    color: #ffff;
    background-color: #0080ff;
    width: 90%;
    padding: 8px 5px;
    border: 0px;
    border-radius: 4px;
}

.notification-btn:hover {
    color: #0080ff;
    background-color: white;
}
</style>
