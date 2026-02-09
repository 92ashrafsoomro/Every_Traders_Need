<template>
    <v-card :loading="CsvStore.loading" :disabled="CsvStore.loading" class="my-3 border">
        <div class="d-flex justify-space-between border-b py-3 px-4">
            <div class="align-self-center">
                <h1 class=" text-h6 Sheet"> <span class="pointer bg-background">{{ form.table_id }}</span>
                    <!-- <span class="pointer ml-2 bg-background">{{ form.name }}</span> -->
                    <span class="pointer ml-2 bg-background">{{ form.auctionname }}</span>
                </h1>
            </div>
            <div class="mx-3 d-flex">
                <div class="px-2">
                    <v-icon @click="CsvStore.submit"
                        style="background-color: rgb(var(--v-theme-primary),0.3); padding: 20px;" class="border"
                        color="primary">mdi-check-decagram</v-icon>
                </div>
                <div class="px-2">
                    <v-icon style="background-color: rgb(var(--v-theme-background)); padding: 20px;" class="border"
                        color="primary" @click="CsvStore.handleFile()">mdi-database-check-outline</v-icon>
                </div>
                <div class="px-2">
                    <v-icon style="background-color: rgb(var(--v-theme-background)); padding: 20px;" class="border"
                        color="primary" @click="CsvStore.loadVehicle()">mdi-restart</v-icon>
                </div>
                <div class="px-2">
                <v-icon
                    class="border"
                    color="primary"
                    style="background-color: rgb(var(--v-theme-background)); padding: 20px;"
                    @click="CsvStore.toggleSidebar($route.params.id)"
                >
                    {{ CsvStore.isSidebarOpen ? 'mdi-close' : 'mdi-dots-vertical' }}
                </v-icon>
                </div>

                <div class="px-2">
                    <router-link :to="`/admin/vehicle/${form.id}`" target="_blank" rel="noopener noreferrer">
                        <v-icon style="background-color: rgb(var(--v-theme-background)); padding: 20px;" class="border"
                        color="primary" >mdi-eye</v-icon>
                </router-link>

                </div>

            </div>
        </div>
        <v-card-text>
            <v-table hover style="table-layout: auto; width: max-content;" height="700px" fixed-header>
                <thead>
                    <tr>
                        <th>#</th>
                        <th 
                            v-for="value in CsvStore.columns" 
                            :key="value.title"
                            :class="['text-left', 'nowrap-text', value.required ? 'bg-primary text-white font-weight-bold' : '']"
                            :style="{
                                width: value.required  ? '120px' :'10px',
                                fontWeight: value.required ? 'bold' : 'normal'
                            }"
                            >
                            {{ value.title }}
                            </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, id) in CsvStore.data">
                        <td>{{ id }}</td>
                        <td v-for="col in CsvStore.columns">

                            <div v-if="col.key === 'title'">
                                <span>{{ item[col.key] }}</span>
                            </div>

                            <div v-else-if="col.key === 'vehicle_id'">
                                <span :class="{ has_error: CsvStore.errors['data.' + id + '.vehicle_id'] }"
                                    class="pointer" @click="OpenModal(id, 'vehicle_id', item[col.key])">
                                    {{ item[col.key] }}
                                </span>
                            </div>

                            <div v-else-if="col.key === 'body_id'">
                                <span :class="{ has_error: CsvStore.errors['data.' + id + '.body_id'] }" class="pointer"
                                    @click="OpenModal(id, 'body_id', item[col.key])">
                                    {{ item[col.key] ?? 'None' }}
                                </span>
                            </div>



                            <div v-else-if="col.key === 'make_id'">
                                <span :class="{ has_error: CsvStore.errors['data.' + id + '.make_id'] }" class="pointer"
                                    @click="CsvStore.openModal(id)">
                                    {{ item[col.key] ?? 'None' }}
                                </span>
                            </div>

                            <div v-else-if="col.key === 'model_id'">
                                <span :class="{ has_error: CsvStore.errors['data.' + id + '.model_id'] }"
                                    class="pointer" @click="CsvStore.openModal(id)">
                                    {{ item[col.key] ?? 'None' }}
                                </span>
                            </div>

                       

                            <div v-else-if="col.key === 'variant_id'">
                                <span :class="{ has_error: CsvStore.errors['data.' + id + '.variant_id'] }"
                                    class="pointer" @click="CsvStore.openModal(id)">
                                    {{ item[col.key] ?? 'None' }}
                                </span>
                            </div>

                            <div v-else-if="col.key === 'center_id'">
                                <span class="pointer" @click="OpenModal(id, 'center_id', item[col.key])">
                                    {{ item[col.key] ?? 'None' }}
                                </span>
                            </div>

                            <div v-else-if="col.disabled">
                                <input disabled class="py-2" :value="item[col.key]" />
                            </div>

                            <div v-else>
                                <input class="border py-2 px-1" :value="item[col.key]" />
                            </div>

                        </td>
                    </tr>
                </tbody>
            </v-table>
        </v-card-text>
    </v-card>

    <VairantModal />
    <VehicleTypeModal ref="vehicleTypeModalModal" @update:dailog="CsvStore.hanldeDailog" />
    <BodyTypeModal ref="bodyTypeModal" @update:dailog="CsvStore.hanldeDailog" />
    <CenterModal ref="centerModal" @update:dailog="CsvStore.hanldeDailog" />

</template>
<script>


import PlateformDropdown from '@/components/PlateformDropdown.vue';
import VehicleTypeModal from '@/components/VehicleTypeModal.vue';
import BodyTypeModal from '@/components/BodyTypeModal.vue';
import CenterModal from '@/components/CenterModal.vue';
import VairantModal from './VariantModal.vue';
import { toRaw } from 'vue';
import { useCsvStore } from './CsvStore';
import Auction from '@/models/auction.model';

export default {

    components: {
        PlateformDropdown,
        VehicleTypeModal,
        BodyTypeModal,
        CenterModal,
        VairantModal,
    },
    data() {
        return {
            CsvStore: useCsvStore(),
            selectedRow: null,
            form: {
                table_id: '',
                id:'',
                auctionname:'',
                name: '',
            }
        }
    },
    emits: ['toggle'],
    mounted() {
        this.CsvStore.id = this.$route.params.id;
        this.CsvStore.loadVehicle();
        this.$themeStore.menuType = 'collapsed';
        this.getData()
    },
    methods: {
        async getData() {
            const id = this.$route.params.id;
            try {
                let res = await Auction.find(id, {});
                this.form.table_id = res.data.table_id;
                this.form.id = res.data.id;
                this.form.auctionname = res.data.name;
                this.form.name = this.CsvStore.platformName;
                this.form.type = res.data.type
            } catch (error) {
                this.$alertStore.add(error.message, 'error');
                // this.$router.push('/admin/auction');
            }

        },
        OpenModal(row, key, value) {
            switch (key) {
                case 'vehicle_id':
                    this.$refs.vehicleTypeModalModal.open(row, value);
                    break;
                case 'body_id':
                    this.$refs.bodyTypeModal.open(row, value);
                    break;
                case 'center_id':
                    this.$refs.centerModal.open(row, value);
                    break;
            }
        },

    }


}

</script>

<style lang="css" scoped>
.truncate {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

td {
    white-space: nowrap;
}


.activeRow {
    background-color: red !important;
}


.pointer {
    cursor: pointer;
     padding: 8px;
     border-radius: 4px;
}
.pointer:hover{
    background-color: rgb(var(--v-theme-background));
}

.has_error{
      background: rgb(var(--v-theme-danger), 0.2);
      padding: 8px;
}
.nowrap-text {
  white-space: nowrap;      
  overflow: hidden;         
  text-overflow: ellipsis;  
}

</style>