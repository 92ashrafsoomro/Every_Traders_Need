<template>
    <v-select
        v-bind="$attrs"
        :model-value="modelValue"
        :items="data"
        :loading="loading"
        @update:value="handleValue($event)"
    />
</template>

<script>
import General from '@/models/general.model';
export default {
    name : 'UserTypeDropDown',
    props:{
        modelValue:{
            type: [String , Number , Boolean],
            default: null
        },
    },
    data(){
        return{
            value : null,
            data : [],
            loading : false
        };
    },
    mounted(){
        this.get();
    },
    methods: {
        async get() {
            this.loading = true;
            try {            
                const response = await General.get('/api/cruds/roles',{});
                this.data = response.data.filter(item => item.id !== 0 && item.id !== 1);

            } catch (err) {
                console.error("Error loading :", err);
                this.data = [];
            } finally {
                this.loading = false;
            }
        },
        handleValue(value) {
                this.$emit("update:value", value);
            },
            emits: ['update:value']
} }
</script>