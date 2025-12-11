    <template>
        <v-container>
            <v-card title="Create BodyType">
                <div class="border"></div>
                <v-card-text>
                    <v-row>
                        <v-col class="bg-primary text-h6 ma-4 rounded-sm">
                            Id: {{ platformData.id }}
                        </v-col>

                    </v-row>
                    <v-row>

                        <v-col v-for="field in fields" :key="field.key" :sm="field.col">
                        <DynamicInput
                            :field="field.type"
                            :label="field.label"
                            :items="field.options"
                            :modelValue="form[field.key]" 
                            @update:modelValue="val => form[field.key] = val"
                            item-text="label"
                            item-value="value"
                            />
                        </v-col>
                    </v-row>
                </v-card-text>
                <v-card-actions>
                    <v-btn variant="tonal" type="submit" color="primary">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-container>
    </template>


    <script>
    import fields from './feilds';
    import DynamicInput from './Dynamicinput.vue';
    import api from '@/plugins/axios';

    export default {
        components: { DynamicInput },
        data() {
            return {
                form: {},
                 platformData: {},
                fields
            }
        },
        mounted() {
            const id = this.$route.params.id;
            this.fetchPlatform(id);
        },
        methods: {
            async fetchPlatform(id) {
                try {
                    let res = await api.get(`/api/master/getAuctionHouse/${id}`);
                    this.platformData = res.data
                    this.form = {...res.data}
                } catch (error) {
                    console.error(error);
                }
            },
            handleFile(event , key){
                this.form[key] = event.target.files[0]
            },
            submitForm(){
                this.$emit("update:modelValue", this.form);
                this.$emit("submit")
            }

        }
    }
    </script>
