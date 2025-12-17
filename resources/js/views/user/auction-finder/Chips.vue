<template>
    <div class="chips d-flex flex-wrap w-100">
        <div class="vehicleType">
            <Chip :data="masterStore.vehicleTypes.data" :compareValue="auctionStore.filter.vehicleType"
                removeKey="vehicleType" :removeValue="auctionStore.removeValue" />
        </div>

        <div class="make">
            <Chip :data="masterStore.makes.data" :compareValue="auctionStore.filter.make" removeKey="make"
                :removeValue="auctionStore.removeValue" />
        </div>

        <div class="model">
            <Chip :data="masterStore.models.data" :compareValue="auctionStore.filter.model" removeKey="model"
                :removeValue="auctionStore.removeValue" />
        </div>

        <div class="variant">
            <Chip :data="masterStore.variants.data" :compareValue="auctionStore.filter.variant" removeKey="variant"
                :removeValue="auctionStore.removeValue" />
        </div>

        <div class="platform">
            <Chip :data="masterStore.platforms.data" :compareValue="auctionStore.filter.platform" removeKey="platform"
                :removeValue="auctionStore.removeValue" />
        </div>

        <div class="center">
            <Chip :data="masterStore.centers.data" :compareValue="auctionStore.filter.center" removeKey="center"
                :removeValue="auctionStore.removeValue" />
        </div>

        <div class="year">
            <Chip :data="masterStore.years.data" :compareValue="auctionStore.filter.year" removeKey="year"
                :removeValue="auctionStore.removeValue" />
        </div>

        <div class="transmission">
            <Chip :data="masterStore.transmissions.data" :compareValue="auctionStore.filter.transmission"
                removeKey="transmission" :removeValue="auctionStore.removeValue" />
        </div>

        <div class="fuelType">
            <Chip :data="masterStore.fuelType.data" :compareValue="auctionStore.filter.fuelType" removeKey="fuelType"
                :removeValue="auctionStore.removeValue" />
        </div>

        <div class="door">
            <Chip :data="masterStore.doors.data" :compareValue="auctionStore.filter.door" removeKey="door"
                :removeValue="auctionStore.removeValue" />
        </div>

        <div class="seat">
            <Chip :data="masterStore.seats.data" :compareValue="auctionStore.filter.seat" removeKey="seat"
                :removeValue="auctionStore.removeValue" />
        </div>

        <div class="grade">
            <Chip :data="masterStore.grades.data" :compareValue="auctionStore.filter.grade" removeKey="grade"
                :removeValue="auctionStore.removeValue" />
        </div>

        <div class="v5">
            <Chip :data="masterStore.v5.data" :compareValue="auctionStore.filter.v5" removeKey="v5"
                :removeValue="auctionStore.removeValue" />
        </div>

        <div class="cc">
            <Chip :data="masterStore.cc.data" :compareValue="auctionStore.filter.cc" removeKey="cc"
                :removeValue="auctionStore.removeValue" />
        </div>

        <div class="formerKeeper">
            <Chip :data="masterStore.formerKeepers.data" :compareValue="auctionStore.filter.formerKeeper"
                removeKey="formerKeeper" :removeValue="auctionStore.removeValue" />
        </div>

        <div class="noOfService">
            <Chip :data="masterStore.noOfServices.data" :compareValue="auctionStore.filter.noOfService"
                removeKey="noOfService" :removeValue="auctionStore.removeValue" />
        </div>
    </div>
</template>

<script>
import { useAuctionStore } from "@/stores/auctionStore";
import { useMasterStore } from "@/stores/masterStore";
import Chip from "./sidebar/fields/chip.vue";
export default {
    name: "chips",
    components: {
        Chip
    },
    data() {
        return {
            auctionStore: useAuctionStore(),
            masterStore: useMasterStore(),
        }
    },
    methods: {
        handleChipClose(field, e) {
            console.log(e);
        }
    },
}
</script>