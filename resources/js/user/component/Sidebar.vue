<template>
    <aside :class="'sideBar-' + themeStore.menuType">
        <div
            class="logoDiv p-4 d-flex justify-content-between position-relative"
        >
            <img
                src="http://localhost/autoboli/public/themeadmin/images/logo/logo.png"
                alt=""
            />
            <div class="toggleBtn" @click="themeStore.toggleMenuType()">
                <span class="material-symbols-outlined"> chevron_right </span>
            </div>
        </div>

        <div class="pt-3 p-3">
            <div
                v-for="(item, index) in menus"
                :key="index"
                :to="item.path"
                class="text-decoration-none"
            >
                <div v-if="item.type == 'group'">
                    <p
                        style="
                            color: #d3d3d3;
                            letter-spacing: 0px;
                            font-weight: 400;
                            font-size: 14px;
                        "
                    >
                        {{ item.label }}
                    </p>
                    <hr
                        style="
                            color: #d3d3d3;
                            margin-top: -8px;
                            margin-bottom: 6px;
                        "
                    />
                </div>

                <div
                    v-else
                    class="router-element"
                    :class="{ active: $route.path === item.path }"
                >
                    <span class="material-symbols-outlined">{{
                        item.icon
                    }}</span>
                    <p v-if="themeStore.menuType == 'expanded'" class="m-0">
                        {{ item.label }}
                    </p>
                </div>
            </div>
        </div>
    </aside>
</template>

<script>
import { useThemeStore } from "../stores/theme";
import { getMenu } from "../services/menuService";

export default {
    data() {
        return {
            menus: getMenu(),
            themeStore: useThemeStore(),
        };
    },
    mounted() {
        console.log(this.menus);
    },
};
</script>

<style scoped>
.sideBar-expanded {
    width: 258px;
    height: 100vh;
    position: fixed;
    background-color: #000f21;
    border-right: 1px solid #353f4c;
    transition: all 0.3s ease;
    overflow: hidden;
    z-index: 2;
}

.sideBar-collapsed {
    width: 68px;
    height: 100vh;
    position: fixed;
    background-color: #000f21;
    border-right: 1px solid #353f4c;
    transition: all 0.3s ease;
    overflow: hidden;
    z-index: 2;
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

.toggleBtn {
    background-color: #0080ff;
    height: 20px;
    width: 20px;
    position: absolute;
    right: 0%;
    top: 35%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}

.toggleBtn span {
    color: white;
}

@media (max-width: 768px) {
    .toggleBtn {
        /* display: none; */
    }

    .sideBar-expanded {
        width: 258px;
    }

    .sideBar-collapsed {
        width: 0px;
    }
}
</style>
