<template>
    <main>
        <user-title-bar title="Auction Scheduler"
            subtitle="Manage and view platform auctions across all centers in one place.">
            <div
                class="d-flex flex-column flex-sm-row ga-2 w-100 w-md-75 w-lg-50 justify-center justify-sm-start align-start pr-5 pr-sm-0">
                <v-combobox label="Select Platform"
                    :items="['California', 'Colorado', 'Florida', 'Georgia', 'Texas', 'Wyoming']" variant="outlined"
                    color="primary" density="compact" class="w-100 w-sm-auto"></v-combobox>
                <v-combobox label="Select Center"
                    :items="['California', 'Colorado', 'Florida', 'Georgia', 'Texas', 'Wyoming']" variant="outlined"
                    color="primary" density="compact" class="w-100 w-sm-auto"></v-combobox>
                <v-switch v-model="isToggleEnabled" color="primary" density="compact" size="small" hide-details
                    @change="handleToggleChange" class="ml-3" />
            </div>
            <div class=" pt-4 d-flex align-center ga-4
            flex-wrap ml-auto mr-auto
            ">
                <div v-for="(item, index) in scheduleItems" :key="index"
                    class="scheduleDiv border border-border rounded-md bg-surface-variant-1 pa-3 ps-5 d-flex flex-column mb-3"
                    style=" height: 95px; width: 195px;">
                    <div class="text-caption d-flex align-center justify-center border-b border-border pb-2 pt-2 text-wrap"
                        style="white-space: wrap !important;">
                        {{ item.title }}
                    </div>
                    <div class="lowerSection d-flex justify-space-between mt-2">
                        <div class="d-flex align-center text-primary">
                            <small><v-icon icon="mdi-hammer" size="small"></v-icon></small>
                            <span class="text-caption text-[#cccccc]">{{ item.auctions }}</span>
                        </div>
                        <div class="d-flex align-center" style=" font-size: 10px; color: #00bad1;">
                            <small><v-icon icon="mdi-car" size="small"></v-icon></small>
                            <span class="text-caption text-[#cccccc]">{{ item.cars }}</span>
                        </div>
                        <div class="d-flex align-center text-danger" style="font-size: 10px;">
                            <small><v-icon icon="mdi-charity" size="small"></v-icon></small>
                            <span class="text-caption text-[#cccccc]">{{ item.favorites }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </user-title-bar>
        <div class="mainContent ps-2 ps-sm-6 mr-auto ml-auto mt-8 rounded-lg">
            <v-data-table :headers="[
                { title: 'Name', key: 'name' },
                { title: 'Calories', key: 'calories' },
                { title: 'Fat (g)', key: 'fat' },
                { title: 'Carbs (g)', key: 'carbs' },
                { title: 'Protein (g)', key: 'protein' }
            ]" :items="[
                { name: 'Frozen Yogurt', calories: 159, fat: 6.0, carbs: 24, protein: 4.0 },
                { name: 'Ice Cream Sandwich', calories: 237, fat: 9.0, carbs: 37, protein: 4.3 },
                { name: 'Eclair', calories: 262, fat: 16.0, carbs: 24, protein: 6.0 },
                { name: 'Cupcake', calories: 305, fat: 3.7, carbs: 67, protein: 4.3 },
                { name: 'Gingerbread', calories: 356, fat: 16.0, carbs: 49, protein: 3.9 }
            ]" class="elevation-1"></v-data-table>

        </div>
    </main>
</template>

<script>


export default {
    props: {},
    components: {
    },
    data() {
        return {
            isToggleEnabled: false,
            scheduleItems: [
                { title: 'Mon', auctions: 3, cars: 5, favorites: 2 },
                { title: 'Tue', auctions: 2, cars: 8, favorites: 1 },
                { title: 'Wed', auctions: 5, cars: 4, favorites: 3 },
                { title: 'Thu', auctions: 1, cars: 7, favorites: 2 },
                { title: 'Fri', auctions: 4, cars: 6, favorites: 4 },
                { title: 'Sat', auctions: 3, cars: 2, favorites: 1 },
                { title: 'Sun', auctions: 2, cars: 3, favorites: 0 },
            ]
        };
    },
    methods: {
        handleToggleChange(value) {
            console.log('Toggle changed:', value);
            if (value) {
                this.enableFeature();
            } else {
                this.disableFeature();
            }
        },
    },
};
</script>

<style scoped></style>
