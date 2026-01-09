<template>
    <v-card :loading="loading" :disabled="loading" class="my-3 border ">
        <div class="d-flex justify-space-between border-b py-3 px-4">
            <div class="align-self-center">
                <h1 class=" text-h6 Sheet">CSV</h1>
            </div>
            <div class="mx-3 d-flex">
                <div class="px-2">
                    <v-icon @click="submit" style="background-color: rgb(var(--v-theme-primary),0.3); padding: 20px;"
                        class="border" color="primary">mdi-check-decagram</v-icon>
                </div>
                <div class="px-2">
                    <v-icon style="background-color: rgb(var(--v-theme-background)); padding: 20px;" class="border"
                        color="primary" @click="handleFile()">mdi-database-check-outline</v-icon>
                </div>
                <div class="px-2">
                    <v-icon style="background-color: rgb(var(--v-theme-background)); padding: 20px;" class="border"
                        color="primary" @click="loadVehicle()">mdi-restart</v-icon>
                </div>
            </div>
        </div>
        <v-card-text>
            
            <v-table style="table-layout: auto; width: max-content;" height="700px" fixed-header>

                <thead>
                    <tr>
                        <th>#</th>
                        <th v-for="value in columns" :style="{ width: value?.width }" class="text-left">
                            {{ value.title }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, id) in data">

                        <td>{{ id }}</td>
                        <td v-for="col in columns">

                            <div v-if="col.key === 'title'">
                                <span>{{ item[col.key] }}</span>
                            </div>

                            <div v-else-if="col.key === 'vehicle_id'">
                                <span :class="{ has_error: errors['data.' + id + '.vehicle_id'] }" class="pointer"
                                    @click="OpenModal(id, 'vehicle_id', item[col.key])">
                                    {{ item[col.key] }}
                                </span>
                            </div>

                            <div v-else-if="col.key === 'body_id'">
                                <span :class="{ has_error: errors['data.' + id + '.body_id'] }" class="pointer"
                                    @click="OpenModal(id, 'body_id', item[col.key])">
                                    {{ item[col.key] ?? 'None' }}
                                </span>
                            </div>

                            <div v-else-if="col.key === 'make_id'">
                                <span :class="{ has_error: errors['data.' + id + '.make_id'] }" class="pointer"
                                    @click="OpenModal(id, 'make_id', item[col.key])">
                                    {{ item[col.key] ?? 'None' }}
                                </span>
                            </div>

                            <div v-else-if="col.key === 'model_id'">
                                <span :class="{ has_error: errors['data.' + id + '.model_id'] }" class="pointer"
                                    @click="OpenModal(id, 'model_id', item[col.key])">
                                    {{ item[col.key] ?? 'None' }}
                                </span>
                            </div>

                            <div v-else-if="col.key === 'variant_id'">
                                <span :class="{ has_error: errors['data.' + id + '.variant_id'] }" class="pointer"
                                    @click="OpenModal(id, 'variant_id', item[col.key])">
                                    {{ item[col.key] ?? '' }}
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

    <VehicleTypeModal ref="vehicleTypeModalModal" @update:dailog="hanldeDailog" />
    <BodyTypeModal ref="bodyTypeModal" @update:dailog="hanldeDailog" />
    <MakeModal ref="makeModal" @update:dailog="hanldeDailog" />
    <CenterModal ref="centerModal" @update:dailog="hanldeDailog" />

    <ModelModal ref="modelModal" @update:dailog="hanldeDailog" />
    <VairantModal ref="variantModal" @update:dailog="hanldeDailog" />

</template>
<script>

import PlateformDropdown from '@/components/PlateformDropdown.vue';
import Auction from '@/models/auction.model';
import columns from './columns'
import cskMaker, { ColRender } from '@/plugins/cskMaker';
import VehicleTypeModal from '@/components/VehicleTypeModal.vue';
import BodyTypeModal from '@/components/BodyTypeModal.vue';
import MakeModal from '@/components/MakeModal.vue';
import CenterModal from '@/components/CenterModal.vue';
import ModelModal from '@/components/ModelModal.vue';
import VairantModal from '@/components/VairantModal.vue';
import { toRaw } from 'vue';

export default {
    components: {
        PlateformDropdown,
        VehicleTypeModal,
        BodyTypeModal,
        MakeModal,
        CenterModal,
        VairantModal,
        ModelModal
    },
    data() {

        return {
            scrap: [],
            auction_id: this.$route.params.id,
            selectedRow: null,
            loading: false,
            data: [],
            errors: {},
            columns: columns,
            csv: null,
        }
    },
    mounted() {


        this.loadVehicle()

    },
    methods: {

        async loadVehicle() {

            this.errors = {};
            this.loading = true;
            const id = this.$route.params.id;
            try {

                let res = await Auction.csvGet(id, {});
                let data = res.data.data;
                let modified = [];
                data.forEach(element => {
                    modified.push(ColRender(element));
                });
                this.data = modified;
                this.loading = false;
                this.$alertStore.add('Data Loaded', 'success');

            } catch (error) {
                this.loading = false;
                this.data = [];
                this.$alertStore.add(error.message, 'error');
            }

        },
        async submit() {

            this.errors = {};
            this.loading = true;
            try {

                const id = this.$route.params.id;
                let res = await Auction.csvUpdate(id, { data: this.data });
                this.$alertStore.add(res.message, 'success');
                this.loadVehicle();

            } catch (error) {

                this.$alertStore.add(error.message, 'error');
                let validations = error.validation;
                if (validations) {
                    for (const key in validations) {
                        if (!Object.hasOwn(validations, key)) continue;
                        const element = validations[key];
                        this.errors[key] = element;
                    }
                }

            } finally {
                this.loading = false;
            }

        },
        async handleFile() {

            this.loading = true;
            this.errors = {};
            try {

                const id = this.$route.params.id;
                let res = await Auction.getScrap(id, {});
                let modified = [];
                let data = res.data ?? [];
                data.forEach(element => {
                    element.derivative = element.variant_id;
                    element.variant_id = null;
                    modified.push(ColRender(element));
                });

                this.data = modified;
                this.$alertStore.add('Loaded Data From Scrapper', 'success');
                this.loading = false;

            } catch (error) {
                this.$alertStore.add(error.message, 'error');
                this.loading = false;
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
                case 'make_id':
                    this.$refs.makeModal.open(row, value);
                    break;
                case 'model_id':
                    this.$refs.modelModal.open(row, value);
                    break;
                case 'variant_id':
                    debugger
                    this.$refs.variantModal.open(row, value);
                    break;
                case 'center_id':
                    this.$refs.centerModal.open(row, value);
                    break;
            }
        },
        updateCell(rowIndex, key, value) {
            this.data[rowIndex][key] = value;
        },
        hanldeDailog(row, key, e) {
            this.data[row][key] = e;
        }


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
}

.has_error {
    background: rgb(var(--v-theme-danger), 0.2);
    padding: 14px 0px;
}
</style>