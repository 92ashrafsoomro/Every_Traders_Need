<template>
    <div class="bg-surface d-flex align-items-center justify-center"
        style="height: 80vh; padding: 20px;  background: linear-gradient(to top, rgba(var(--v-theme-primary),0.2) 5%, transparent 80%);">
        <div class="mx-auto d-flex flex-wrap align-items-center justify-center" style="max-width:1400px; gap:40px;">

            <!-- Left Text Section -->
            <div style="flex:1; min-width:300px;" class="d-flex flex-column justify-center">
                <app-breadcrumb class="mb-3 px-0" />
                <h2 class="text-h4 font-weight-bold mb-4">
                    {{ data.title }}
                </h2>

                <div class="text-body-1 text-light_text_on mb-6" style="line-height:1.9;"
                    v-html="truncateText(data.description)">
                </div>

                <div class="d-flex  align-center" style="height: 40px;">
                    <!-- Left Section -->
                    <div class="d-flex align-items-center px-2"
                        style="border-right: 1px solid rgb(var(--v-theme-border)); width: 220px;">
                        <span>Updated : {{ data.date }}</span>
                    </div>

                    <!-- Right Section -->
                    <div class="d-flex align-items-center justify-center px-2 ml-4">
                        <span>12 min read</span>
                    </div>
                </div>
            </div>

            <!-- Right Image Section -->
            <div class="d-flex justify-center align-items-center" style="flex:1; min-width:300px;">
                <v-img :src="data.image_preview" alt="Smartphones 2026" class="rounded-lg " max-width="520" />
            </div>

        </div>
    </div>
    <v-container fluid class="pa-0 mt-12">
        <v-container style="max-width:1400px;">
            <div class="d-flex" style="gap:40px; align-items:flex-start; position:relative;">


                <!-- LEFT ARTICLE -->
                <div style="flex:1; min-width:700px;">
                    <section v-for="section in sections" :key="section.id" :id="section.id" class="mb-12">

                        <h2 class="text-h5 font-weight-bold mb-2 mt-10">{{ section.title }}</h2>

                        <v-row :class="[
                            section.alignment === 'right' ? 'flex-row-reverse' : '',
                            section.alignment === 'center' ? 'flex-column align-center' : ''
                        ]" align="start" style="margin-left: 5px !important;">

                            <v-col v-if="section.preview" cols="12" :md="section.alignment === 'center' ? '10' : '5'">
                                <v-img :src="section.preview" alt="Section Image"
                                    class="rounded-lg elevation-2 border mx-auto" cover
                                    :max-height="section.alignment === 'center' ? '350' : '350'"></v-img>
                            </v-col>

                            <v-col cols="12"
                                :md="section.alignment === 'center' ? '12' : (section.preview ? '7' : '12')">
                                <div class="text-body-1 text-light_text_on blog-content "
                                    :style="section.alignment === 'center' ? 'line-height:1.8; margin: 0 auto;' : 'line-height:1.8;'"
                                    v-html="section.blocks"></div>
                            </v-col>
                        </v-row>
                    </section>
                </div>


                <!-- RIGHT SIDEBAR -->
                <div style="width:400px; position:sticky; top:60px;">
                    <div>
                        <h4 class="mb-4">Share this post
                        </h4>
                        <div class="d-flex ga-2 mb-6">
                            <v-icon class="rounded-xl pa-6 bg-primary text-white cursor-pointer"
                                @click="share('facebook')">
                                mdi-facebook
                            </v-icon>
                            <v-icon class="rounded-xl pa-6 bg-primary text-white cursor-pointer"
                                @click="share('whatsapp')">
                                mdi-whatsapp
                            </v-icon>
                            <v-icon class="rounded-xl pa-6 bg-primary text-white cursor-pointer"
                                @click="share('twitter')">
                                mdi-twitter
                            </v-icon>
                            <v-icon class="rounded-xl pa-6 bg-primary text-white cursor-pointer" @click="copyLink">
                                mdi-instagram
                            </v-icon>

                        </div>
                        <v-expansion-panels v-model="expandedPanel" class="bg-transparent elevation-0">
                            <v-expansion-panel class="bg-transparent elevation-0">
                                <v-expansion-panel-title ripple="false">
                                    <h3>Content</h3>
                                </v-expansion-panel-title>
                                <v-expansion-panel-text>
                                    <div v-for="section in sections" :key="section.id" @click="scrollTo(section.id)"
                                        :class="[
                                            'cursor-pointer mb-2',
                                            activeSection === section.id
                                                ? 'text-primary font-weight-bold active-link'
                                                : 'text-disabled'
                                        ]">
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

</template>
<script>
import General from '@/models/general.model';
import { useGlobalSettingStore } from '@/stores/globalSetting';
export default {

    data() {
        return {
            activeSection: null,
            data: [],
            sections: [],
            expandedPanel: 0
        }
    },
    setup() {
        const globalStore = useGlobalSettingStore();
        return { globalStore };
    },
    async mounted() {
        if (Object.keys(this.globalStore.settings).length === 0) {
            await this.globalStore.loadSettings();
        }

        this.load();
    },
    computed: {
        shareUrl() {
            return window.location.href
        }
    },
    methods: {
        initObserver() {
            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            this.activeSection = Number(entry.target.id) // 👈 ensure match
                        }
                    })
                },
                {
                    threshold: 0.5
                }
            );

            this.sections.forEach(section => {
                const el = document.getElementById(section.id)
                if (el) observer.observe(el)
            })
        },
        scrollTo(id) {

            document.getElementById(id).scrollIntoView({
                behavior: "smooth"
            })

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
                this.$nextTick(() => {
                    this.initObserver();
                });
            } catch (error) {
                console.error("Dashboard load failed:", error);
            } finally {

            }
        },


        truncateText(text, wordlimit = 30) {
            if (!text) return '';

            const plainText = text.replace(/<\/?[^>]+(>|$)/g, "");

            const words = plainText.split(' ');

            if (words.length > wordlimit) {
                return words.slice(0, wordlimit).join(' ') + '...';
            }

            return plainText;
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
.hoverElement:hover {
    text-decoration: underline;
}

:deep(.blog-content ul) {
    list-style: none;
    padding-left: 0;
    margin-left: 15px;
}

:deep(.blog-content ul li) {
    position: relative;
    padding-left: 28px;
    margin-top: 10px;
    margin-bottom: 10px;
}

:deep(.blog-content ul li::before) {
    content: "";
    position: absolute;
    left: 0;
    top: 5px;
    width: 16px;
    height: 16px;
    background-image: url('@/assets/images/icons/checkIcon.png');
    background-size: contain;
    background-repeat: no-repeat;
}
</style>