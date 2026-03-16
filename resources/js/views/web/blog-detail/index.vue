<template>
    <v-container fluid class="pa-0 mt-12" style="padding: 0 !important;">

        <div class="mb-12 rounded-lg py-10 px-0" style="background-color: rgb(var(--v-theme-surface));">
            <div class="mx-auto d-flex flex-wrap align-center justify-space-between"
                style="max-width:1400px; gap:40px;">

                <div style="flex:1; min-width:300px;">
                    <h4 class="text-h5 font-weight-bold mb-6">
                        {{ data.title }}
                    </h4>

                    <div class="text-body-1 mb-6 text-light_text_on" style="line-height:1.9;" v-html="data.description">
                        
                    </div>

                    <v-chip style="background-color: rgb(var(--v-theme-primary));" class="text-body-1">
                        Updated: {{ data.date }} • 12 min read
                    </v-chip>
                </div>

                <div class="text-center" style="flex:1; min-width:300px;">
                    <v-img
                        :src="data.image_preview"
                        alt="Smartphones 2026" class="rounded-lg elevation-6 mx-auto" max-width="520" />
                </div>

            </div>
        </div>
        <v-container fluid class="pa-0 mt-12">
            <v-container style="max-width:1400px;">
                <div class="d-flex" style="gap:40px; align-items:flex-start; position:relative;">

                    <!-- LEFT ARTICLE -->
                    <div style="flex:1; min-width:700px;">
                        <section v-for="section in sections" :key="section.id" :id="section.id" class="mb-12">
                            <h2 class="text-h5 font-weight-bold mb-6">{{ section.title }}</h2>
                            <v-row 
                                :class="[
                                    section.alignment === 'right' ? 'flex-row-reverse' : '',
                                    section.alignment === 'center' ? 'flex-column align-center' : ''
                                ]" 
                                align="start"
                            >
                                <v-col v-if="section.preview" cols="12" :md="section.alignment === 'center' ? '10' : '5'">
                                    <v-img 
                                        :src="section.preview" 
                                        alt="Section Image" 
                                        class="rounded-lg elevation-2 border mx-auto" 
                                        cover
                                        :max-height="section.alignment === 'center' ? '350' : '350'"
                                    ></v-img>
                                </v-col>

                                <v-col cols="12" 
                                    :md="section.alignment === 'center' ? '12' : (section.preview ? '7' : '12')"
                                    
                                >
                                    <div 
                                        class="text-body-1 text-light_text_on blog-content" 
                                        :style="section.alignment === 'center' ? 'line-height:1.8; margin: 0 auto;' : 'line-height:1.8;'" 
                                        v-html="section.blocks"
                                    ></div>
                                </v-col>
                            </v-row>
                        </section>
                    </div>

                    <!-- RIGHT SIDEBAR -->
                    <div style="width:400px; position:sticky; top:60px;">
                        <div>
                            <h4 class="mb-4">SHARE THIS POST</h4>
                            <!-- <div class="d-flex  mb-6">
                                <v-icon class="rounded-xl pa-4 bg-primary text-white">mdi-facebook</v-icon>
                                <v-icon class="rounded-xl pa-4 bg-primary text-white">mdi-whatsapp</v-icon>
                                <v-icon class="rounded-xl pa-4 bg-primary text-white">mdi-twitter</v-icon>
                                <v-icon class="rounded-xl pa-4 bg-primary text-white">mdi-instagram</v-icon>
                            </div> -->
                            <div class="d-flex mb-6">
                            <v-icon
                                class="rounded-xl pa-4 bg-primary text-white cursor-pointer"
                                @click="share('facebook')"
                            >
                                mdi-facebook
                            </v-icon>
                            <v-icon
                                class="rounded-xl pa-4 bg-primary text-white cursor-pointer"
                                @click="share('whatsapp')"
                            >
                                mdi-whatsapp
                            </v-icon>
                            <v-icon
                                class="rounded-xl pa-4 bg-primary text-white cursor-pointer"
                                @click="share('twitter')"
                            >
                                mdi-twitter
                            </v-icon>
                            <v-icon
                                class="rounded-xl pa-4 bg-primary text-white cursor-pointer"
                                @click="copyLink"
                            >
                                mdi-instagram
                            </v-icon>

                            </div>
                            <v-expansion-panels class="bg-transparent elevation-0">
                                <v-expansion-panel class="bg-transparent elevation-0">
                                    <v-expansion-panel-title ripple="false">
                                        <h3>Content</h3>
                                    </v-expansion-panel-title>
                                    <v-expansion-panel-text>
                                        <div v-for="section in sections" :key="section.id" @click="scrollTo(section.id)"
                                            class="hoverElement text-white"
                                            :class="activeSection === section.id ? 'text-primary font-weight-bold cursor-pointer mb-2' : 'text-disabled cursor-pointer mb-2'">
                                            {{ section.title }}
                                        </div>
                                    </v-expansion-panel-text>
                                </v-expansion-panel>
                            </v-expansion-panels>
                        </div>
                    </div>

                </div>
            </v-container>
        </v-container>
    </v-container>

</template>
<script>
import General from '@/models/general.model';
import { useGlobalSettingStore } from '@/stores/globalSetting';
export default {

    data() {
        return {
            activeSection: null,
            data : [],
            expandedPanel: 0,
            sections: []
        }
    },
    setup() {
        const globalStore = useGlobalSettingStore();
        return { globalStore };
    },
    async  mounted() {
        if (Object.keys(this.globalStore.settings).length === 0) {
            await this.globalStore.loadSettings();
            }

        const observer = new IntersectionObserver(
            (entries) => {

                entries.forEach(entry => {

                    if (entry.isIntersecting) {
                        this.activeSection = entry.target.id
                    }

                })

            },
            {
                threshold: 0.4
            }
        )

        this.sections.forEach(section => {

            const el = document.getElementById(section.id)

            if (el) {
                observer.observe(el)
            }

        })
        

         this.load();

    },
    computed: {
        shareUrl() {
            return window.location.href
        }
    },  
    methods: {

        scrollTo(id) {

            document.getElementById(id).scrollIntoView({
                behavior: "smooth"
            })
            this.activeSection = id

        },
        async load() {

            try {
                const slug = this.$route.params.slug;
                let res = await General.get(`/api/web/getBlogdetail/${slug}`);
                this.data = res.data;
                this.sections = this.data.details.map(section => ({
                    id: section.id,
                    title: section.title,
                    blocks: section.description,
                    alignment: section.alignment,
                    preview: section.preview_image || null, 
                    }));
            } catch (error) {
                console.error("Dashboard load failed:", error);
            } finally {
             
            }
        },

        
        share(platform) {

            const url = encodeURIComponent(window.location.href)
            const text = encodeURIComponent("Check this blog")

            let shareLink = ""

            if (platform === "facebook") {
            shareLink = `https://www.facebook.com/sharer/sharer.php?u=${url}`
            }

            if (platform === "whatsapp") {
            shareLink = `https://api.whatsapp.com/send?text=${text}%20${url}`
            }

            if (platform === "twitter") {
            shareLink = `https://twitter.com/intent/tweet?text=${text}&url=${url}`
            }

            window.open(shareLink, "_blank")

        },

        copyLink() {
            navigator.clipboard.writeText(window.location.href)
            this.$alertStore.add('Link copied! Share on Instagram', 'success');


        }

    }

}
</script>
<style scoped>
.d-flex {
    align-items: flex-start;
    gap: 40px;
}

.d-flex>div:first-child {
    flex: 1;
}

.d-flex>div:last-child {
    width: 400px;
}

.hoverElement:hover {
    text-decoration: underline;
}
</style>