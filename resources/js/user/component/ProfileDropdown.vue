<template>
    <div class="relative inline-block">
        <div class="profile-avatar" @click="toggleDropdown">
            <img
                src="http://localhost/autoboli/public/uploads/avatar/1758622849__ff__1754473262__ff__profile.jpg"
                alt="User Avatar"
            />
        </div>

        <div v-if="isOpen" class="dropdown" @click.stop>
            <div class="dropdown-header-profile">
                <div class="dropdown-profile-circle">
                    <img
                        src="http://localhost/autoboli/public/uploads/avatar/1758622849__ff__1754473262__ff__profile.jpg"
                        alt="User Avatar"
                    />
                </div>
                <div class="userName-and-position">
                    <h6>{{ userStore.user.username }}</h6>
                    <p>{{ userStore.user.type }}</p>
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
                    <span class="material-symbols-outlined"> settings </span>
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
                <button class="btn logoutBtn" @click="logout">
                    Logout
                    <span class="material-symbols-outlined"> logout </span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { useUserStore } from "../stores/user";

export default {
    setup() {
        return {
            userStore: useUserStore(),
        };
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
        closeDropdown(e) {
            if (!e.target.closest(".relative")) {
                this.isOpen = false;
            }
        },
    },
    mounted() {
        document.addEventListener("click", this.closeDropdown);
    },
};
</script>

<style scoped>
.profile-avatar {
    height: 45px;
    width: 45px;
    border-radius: 50%;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

.profile-avatar img {
    height: 100%;
    width: 100%;
    object-fit: cover;
}

.profile-avatar:hover {
    border-color: #0080ff;
}

.dropdown {
    position: absolute;
    top: 75px;
    right: 15px;
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
    object-fit: cover;
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
    border: none;
    padding: 6px 10px;
    cursor: pointer;
}

.logoutBtn:hover {
    background-color: #ff2c32;
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
</style>
