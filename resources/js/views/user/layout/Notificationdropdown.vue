<template>
    <v-menu location="bottom end" :offset="10" transition="slide-y-transition">
        <template #activator="{ props }">
            <v-badge :content="notifications.unread" color="primary" :model-value="notifications.unread > 0"
                offset-x="8" offset-y="8">
                <v-btn icon size="small" v-bind="props" variant="text">
                    <v-icon>mdi-bell-outline</v-icon>
                </v-btn>
            </v-badge>
        </template>

        <!-- Main Dropdown Card -->
        <v-card width="380" class="notificationCard bg-surface text-white rounded-lg" >
            <!-- Header -->
            <div class="d-flex justify-space-between align-center pa-4">
                <h2 class="text-h6 font-weight-medium">Notifications</h2>
                <!-- <div class="d-flex align-center ga-3">
                    <v-chip color="primary" size="small" class="font-weight-bold text-caption">
                        {{ notifications.unread }} New
                    </v-chip>
                    <v-icon size="22">mdi-email-outline</v-icon>
                </div> -->
            </div>

            <v-divider />

            <!-- Scrollable List -->
            <div class="max-h-96 overflow-y-auto border-none">
                <template v-if="notifications.length > 0">
                    <template v-for="(note, i) in notifications.slice(0, 7)" :key="i">

                        <v-list-item class="px-4 py-4 bg-surface border-none">
                            <div class="d-flex align-start gap-4 w-100">
                                <!-- Avatar -->
                                <v-avatar size="42">
                                    <v-img :src="note.image || userAvatar" cover />
                                </v-avatar>


                                <div class="flex-grow-1 min-w-0 ml-2 mr-1">

                                    <router-link :to="getNotificationLink(note)"
                                        style="text-decoration: none; color: rgb(var(--v-theme-whiteLight));">
                                        <p class="text-body-2 font-weight-medium mb-1 text-wrap rounded-md">
                                            {{ note.title }}
                                        </p>
                                    </router-link>
                                    <p class="text-caption text-medium-emphasis text-wrap">
                                        {{ note.message }}
                                    </p>

                                </div>


                                <!-- <div class="mt-2">
                                    <v-icon v-if="note.is_read == 0" color="primary" size="10">
                                        mdi-circle
                                    </v-icon>
                                </div> -->
                            </div>
                        </v-list-item>
                        <v-divider v-if="i < notifications.length - 1" />
                        <div v-else>

                        </div>
                    </template> </template>
                <template v-else>
                    <div class="text-center pa-4 text-body-2 text-medium-emphasis">
                        No notifications
                    </div>
                </template>
            </div>

            <v-divider />

            <!-- View All Button -->
            <div class="pa-3" v-if="notifications.length > 0">
                <v-btn block color="primary" variant="flat" class="text-none rounded-lg py-3" :to="'/user/profile'">
                    View all notifications
                </v-btn>

            </div>
        </v-card>
    </v-menu>
</template>

<script>
import api from "@/plugins/axios";
import userAvatar from "@/assets/images/avatar/user.png"
import General from "@/models/general.model";
export default {
    name: "NotificationMenu",
    data() {
        return {
            userAvatar,
            notifications: [],
            // notifications: {
            //     data: [],
            //     unread: 0
            // },
            isLoading: false,
        };
    },
    computed: {

    },
    mounted() {
        this.notificationFetch();
    },
    methods: {
        async notificationFetch() {
            this.isLoading = true;
            try {
                const res = await General.get("/api/notifications/myNotifications");
                // const unreadNotes = res.data.data.filter(n => n.is_read === 0);
                // this.notifications = {
                //     data: unreadNotes,
                //     unread: unreadNotes.length
                // };
                this.notifications = res
            } catch (error) {
                console.error("Error fetching notifications:", error);
            } finally {
                this.isLoading = false;
            }
        },
        getNotificationLink(note) {
            if (note.type === "vehicle") {
                return `/user/vehicle-detail/${note.id}`;
            } else if (note.type === "auction") {
                return `/autoboli/user/reauction`;
            }
            return "#"; // fallback if type is unknown
        },

    },
};
</script>

<style scoped>
.min-w-0 {
    min-width: 0;
    /* Crucial for long text to wrap properly */
}

.text-wrap {
    word-break: break-word;
    overflow-wrap: anywhere;
}

.max-h-96 {
    max-height: 384px;
}

@media (max-width: 786px) {
    .notificationCard {
        width: 300px !important;
    }
}
</style>