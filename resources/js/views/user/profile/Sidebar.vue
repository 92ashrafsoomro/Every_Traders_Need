<template>

    <custom-card title="Company Details">
        <v-container>
            <v-row>
                <v-col cols="12" >
                    <div v-for="(item, i) in companyItems" :key="i" class="d-flex align-start mb-6">
                        <v-icon color="grey-lighten-1" class="mr-4 mt-1">{{ item.icon }}</v-icon>
                        <div>
                            <div class="text-body-1 font-weight-bold ">{{ item.label }}</div>
                            <div style="color:rgb(var(--v-theme-light))" class="text-body-2 font-weight-medium">{{ item.value }}</div>
                        </div>
                    </div>
                </v-col>
            </v-row>

            <v-divider class="border-opacity-30 mb-4" color="grey" />

            <!-- Personal Information -->
            <h2 class="text-h6 font-weight-bold mb-6 ">Personal Information</h2>

            <v-row>
                <v-col cols="12">
                    <div v-for="(item, i) in personalItems" :key="i" class="d-flex align-start mb-6">
                        <v-icon color="grey-lighten-1" class="mr-4 mt-1">{{ item.icon }}</v-icon>
                        <div>
                            <div class="text-body-1 font-weight-bold">{{ item.label }}</div>
                            <div style="color:rgb(var(--v-theme-light))" 
                               v-if="!item.download" 
                               class="text-body-2">
                                {{ item.value }}
                            </div>

                             <div v-if="item.download" class="text-body-2">
                                <v-btn v-if="item.download" 
                                    variant="outlined"
                                    size="small" 
                                    color="primary"
                                    class="mt-3" 
                                    @click="downloadFile(item.label)">
                                    Download
                                </v-btn>
                            </div>

                        </div>
                    </div>
                </v-col>
            </v-row>
        </v-container>
    </custom-card>
</template>

<script>
export default {
    name: 'CompanyProfile',

    data() {
        return {
            companyItems: [
                { icon: 'mdi-office-building', label: 'Business Name', value: 'VeeSoft Technologies' },
                { icon: 'mdi-web', label: 'Business Type', value: 'Motor Trader' },
                { icon: 'mdi-earth', label: 'Website', value: 'https://softauto.co.uk' },
                { icon: 'mdi-email-outline', label: 'Business Email', value: 'admin@veesoft.com' },
                { icon: 'mdi-shield-check', label: 'Motor Trade Insurance', value: 'yes' },
                { icon: 'mdi-card-bulleted-outline', label: 'VAT Number', value: '2324' },
                { icon: 'mdi-home-city', label: 'Company Address 1', value: 'Phase 2' },
                { icon: 'mdi-home-city-outline', label: 'Company Address 2', value: 'DHA' },
                { icon: 'mdi-map-marker', label: 'Town/City', value: 'Karachi' },
                { icon: 'mdi-flag', label: 'Country', value: 'United Kingdom' },
                { icon: 'mdi-mailbox', label: 'Postcode / Zip code', value: '74600' },
                { icon: 'mdi-phone', label: 'Telephone', value: '02197279723' }
            ],
            personalItems: [
                { icon: 'mdi-account', label: 'Full Name', value: 'Shah Khan' },
                { icon: 'mdi-briefcase', label: 'Title', value: 'Developer' },
                { icon: 'mdi-phone', label: 'Job Title', value: 'Full Stack Developer' },
                { icon: 'mdi-cellphone', label: 'Number', value: '+923361234567' },
                { icon: 'mdi-email', label: 'Personal Email', value: 'shahkhan4120@gmail.com' },
                { 
                    icon: 'mdi-card-account-details', 
                    label: 'Upload ID', 
                    value: 'Download', 
                    download: true 
                },
                {
                     icon: 'mdi-file-account', 
                     label: 'Motor Trade Proof', 
                     value: 'Download', 
                     download: true 
                },
                { 
                    icon: 'mdi-file-document', 
                    label: 'Address Proof', 
                    value: 'Download', 
                    download: true 
                }
            ]
        }
    },

    methods: {
        downloadFile(label) {
            // Simulate file download
            alert(`Downloading ${label}...`)
            // In real app: window.location.href = '/api/download/' + label.toLowerCase().replace(/\s+/g, '-')
        }
    }
}
</script>

<style scoped>
.v-application {
    /* background: #0f0f1e !important; */
}

.v-card {
    /* background: #1e1e2e !important; */
}

.text-red-accent-2 {
    /* color: #FF5252 !important; */
}

/* Optional: add subtle hover effect */
.v-card .v-row>.v-col>div:hover {
    /* opacity: 0.9; */
}
</style>