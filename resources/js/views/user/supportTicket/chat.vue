<template>
  <v-container fluid class="bg-background pa-0 align-start" max-width="1600px" >


    <v-row  class="overflow-hidden w-100 bg-background">
      
      <v-col class="d-flex flex-column chat-main-col border-r border-border">
        
        <div class="messages-viewport flex-grow-1 overflow-y-auto pa-6" ref="chatWindow">
          
          <div class="d-flex align-center justify-center my-4">
             <v-divider class="flex-grow-1"></v-divider>
             <span class="mx-4 text-caption text-disabled font-weight-bold">Today</span>
             <v-divider class="flex-grow-1"></v-divider>
             
          </div>
          <div
            v-if="ticket.status === 0"
            class="d-flex align-center justify-center my-4"
          >
         

            <span class="mx-4 w-100 text-caption font-weight-bold text-error text-center">
              Waiting — your ticket is not yet approved by support team
            </span>

          </div>

          <div v-for="reply in ticket.replies" :key="reply.id" 
               :class="['d-flex mb-6', reply.is_admin == 0 ? 'justify-end' : 'justify-start']">
            
            <div :class="['d-flex align-start max-w-75', reply.is_admin == 0 ? 'flex-row-reverse' : 'flex-row']">
              <v-avatar size="32" :class="reply.is_admin ? 'ml-3' : 'mr-3'" class="mt-1 shadow-sm">
                <v-img :src="reply.is_admin ? 'admin-avatar.png' : 'user-avatar.png'"></v-img>
              </v-avatar>

              <div :class="['bubble-container d-flex flex-column', reply.is_admin == 0 ? 'align-end' : 'align-start']">
                <div class="d-flex align-center mb-1 px-1">
                  <span class="text-caption font-weight-bold text-light mr-2">{{ reply.is_admin == 1 ? 'Support team' : ticket.user_name }}</span>
                  <span class="text-disabled" style="font-size: 0.65rem">{{ formatDate(reply.created_at) }}</span>
                </div>
                
                <v-card 
                  :class="['chat-bubble elevation-1 overflow-hidden', reply.is_admin == 0 ? 'admin-bubble text-white' : 'client-bubble bg-surface text-white']"
                  variant="flat"
                  style="max-width: 500px; border-radius: 18px !important;"
                >
                <div v-if="reply.attachment && isImage(reply.attachment)" class="pa-1 pb-0 attachment-image-container">
                  <v-hover v-slot="{ isHovering, props }">
                    <v-img
                      v-bind="props"
                      :src="`https://localhost/autoboli/public/uploads/tickets/${reply.attachment}`"
                      :class="['rounded-t-lg bg-grey-lighten-2 cursor-pointer transition-swing', isHovering ? 'elevation-6' : '']"
                      

                      width="100%" 
                      aspect-ratio="16/9"
                      cover
                      min-height="160"
                      max-height="300"
                      @click="openFile(reply.attachment)"
                    >
                      <v-fade-transition>
                        <div
                          v-if="isHovering"
                          class="d-flex align-center justify-center fill-height"
                          style="background: rgba(0, 0, 0, 0.3); position: absolute; top: 0; width: 100%;"
                        >
                          <v-icon color="white" size="large">mdi-magnify-plus</v-icon>
                        </div>
                      </v-fade-transition>

                      <template v-slot:placeholder>
                        <div class="d-flex align-center justify-center fill-height bg-grey-darken-3">
                          <v-progress-circular indeterminate size="20" color="primary"></v-progress-circular>
                        </div>
                      </template>
                    </v-img>
                  </v-hover>
                </div>

                  <div v-else-if="reply.attachment" class="pa-2">
                    <v-sheet 
                      color="rgba(255,255,255,0.1)" 
                      class="rounded-lg d-flex align-center pa-3 cursor-pointer border border-dashed"
                      @click="openFile(reply.attachment)"
                    >
                      <v-avatar color="white" size="36" class="mr-3">
                        <v-icon :color="getFileIcon(reply.attachment).color" size="24">
                          {{ getFileIcon(reply.attachment).icon }}
                        </v-icon>
                      </v-avatar>
                      <div class="overflow-hidden">
                        <div class="text-caption font-weight-bold text-truncate" style="max-width: 160px;">
                          {{ reply.attachment }}
                        </div>
                        <div class="text-overline" style="font-size: 0.6rem !important; line-height: 1;">
                          {{ getFileExtension(reply.attachment) }} File
                        </div>
                      </div>
                    </v-sheet>
                  </div>

                  <div class="px-3 py-2">
                    <div 
                      v-if="reply.message" 
                      class="html-content text-body-2 mb-1" 
                      v-html="renderMessage(reply.message)"
                    ></div>

                    <div class="d-flex align-center justify-end opacity-60 mt-1" style="font-size: 0.65rem">
                      <span>{{ formatTime(reply.created_at) }}</span>
                      <v-icon v-if="reply.is_admin" size="x-small" class="ml-1" color="primary">mdi-check-all</v-icon>
                    </div>
                  </div>
                </v-card>
              </div>
            </div>
          </div>
        </div>

        <div class="pa-4 bg-background border-t">
          <v-expand-transition>
            <div v-if="newReply.attachment" class="px-4 py-2 d-flex align-center">
              <v-chip closable color="primary" size="small" @click:close="newReply.attachment = null">
                <v-icon start size="x-small">mdi-file-document</v-icon>
                {{ selectedFileName }}
              </v-chip>
            </div>
          </v-expand-transition>

          <!-- <v-card variant="flat" class="rounded-xl bg-surface-variant-1 px-4 py-1 d-flex align-end border" > -->
          <v-card variant="flat" class="rounded-xl bg-surface-variant-1 px-4 py-1 d-flex align-end border"  v-if="ticket.closed_at == null && ticket.status != 0 && ticket.status != 3">
            
            <v-btn icon="mdi-paperclip" variant="text" color="light" size="small" @click="$refs.fileInput.click()"></v-btn>
            <input type="file" ref="fileInput" class="d-none" @change="handleFileUpload" accept="image/*,.pdf,.doc,.docx">

            <v-menu :close-on-content-click="false" location="top">
              <template v-slot:activator="{ props }">
                <v-btn icon="mdi-emoticon-happy-outline" variant="text" color="light" size="small" v-bind="props"></v-btn>
              </template>
              <v-card class="pa-2">
                <v-btn v-for="emoji in ['😊','👍','🙌','🔥','❤️','⭐']" :key="emoji" variant="text" @click="addEmoji(emoji)">
                  {{ emoji }}
                </v-btn>
              </v-card>
            </v-menu>

            <v-textarea
              v-model="newReply.message"
              placeholder="Write Something..."
              variant="plain"
              density="compact"
              hide-details
              auto-grow
              rows="1"
              max-rows="4"
              class="mx-2 message-input-field mb-1"
              @keydown.enter.exact.prevent="submitReply"
            ></v-textarea>

            <v-btn 
              icon="mdi-send" 
              color="primary" 
              variant="flat" 
              size="small" 
              class="mb-1"
              @click="submitReply"
              :loading="loading"
              :disabled="!newReply.message && !newReply.attachment"
            ></v-btn>
          </v-card>
        </div>
      </v-col>

    <v-col cols="12" md="3" class="bg-surface d-none d-md-flex flex-column info-sidebar pa-6 overflow-y-auto border-l">
      <div class="text-center mb-6">
        <v-avatar size="80" class="elevation-2 mb-3 border border-primary border-xl">
        <v-img 
          :src="ticket.replies[0]?.user?.avatar 
            ? `https://localhost/autoboli/public/uploads/avatar/${ticket.replies[0].user.avatar}` 
            : 'https://cdn.vuetifyjs.com/images/lists/1.jpg'"
        ></v-img>
        </v-avatar>
        <h2 class="text-subtitle-1 font-weight-bold text-white mb-0">{{ ticket.user_name }}</h2>
      </div>

      <v-divider class="mb-4"></v-divider>

      <div class="mb-6">
        <div class="d-flex align-center justify-space-between mb-2">
          <span class="text-overline font-weight-black text-primary">Ticket Info</span>
          <v-chip :color="ticket.status === 1 ? 'success' : 'grey'" size="x-small" variant="flat" class="text-uppercase">
            {{ ticket.status === 1 ? 'Open' : 'Closed' }}
          </v-chip>
        </div>
        
        <v-list density="compact" class="bg-transparent pa-0">
          <v-list-item class="px-0 min-h-0">
            <v-list-item-title class="text-caption text-disabled">Issue Topic</v-list-item-title>
            <v-list-item-subtitle class="text-body-2 text-white">{{ ticket.issue_topic }}</v-list-item-subtitle>
          </v-list-item>
          
          <v-list-item class="px-0 min-h-0">
            <v-list-item-title class="text-caption text-disabled">Priority</v-list-item-title>
            <v-chip :color="priorityColor(ticket.priority)" size="x-small" variant="outlined" class="mt-1">
              {{ ticket.priority }}
            </v-chip>
          </v-list-item>
        </v-list>
      </div>





    </v-col>

    </v-row>
  </v-container>
</template>
<script>
import General from '@/models/general.model';

export default {
  data() {
    return {
      ticket: { replies: [] },
      newReply: { 
        message: '', 
        attachment: null 
      },
      selectedFileName: '',
      loading: false,
    }
  },
  async mounted() {
    await this.fetchTicketDetails();
  },
  methods: {
    formatTime(dateString) {
      if (!dateString) return '';
      return new Date(dateString).toLocaleTimeString([], { 
        hour: '2-digit', 
        minute: '2-digit' 
      });
    },

    openFile(filename) {
      window.open(`https://localhost/autoboli/public/uploads/tickets/${filename}`, '_blank');
    },

    getFileExtension(filename) {
      return filename ? filename.split('.').pop().toUpperCase() : 'FILE';
    },

    getFileIcon(filename) {
      const ext = filename.split('.').pop().toLowerCase();
      if (ext === 'pdf') return { icon: 'mdi-file-pdf-box', color: 'error' };
      if (['doc', 'docx'].includes(ext)) return { icon: 'mdi-file-word', color: 'info' };
      return { icon: 'mdi-file-document', color: 'grey' };
    },

    isImage(filename) {
      if (!filename) return false;
      return ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'].includes(filename.split('.').pop().toLowerCase());
    },

    addEmoji(emoji) {
      this.newReply.message += emoji;
    },

    handleFileUpload(event) {
      const file = event.target.files[0];
      if (file) {
        this.newReply.attachment = file;
        this.selectedFileName = file.name;
      }
    },

    renderMessage(message) {
      if (!message) return '';
      const urlRegex = /(https?:\/\/[^\s]+|www\.[^\s]+)/g;
      
      return message.replace(urlRegex, (url) => {
        const href = url.startsWith('http') ? url : `http://${url}`;
        return `<a href="${href}" target="_blank" class="text-primary font-weight-bold" style="text-decoration: underline;">${url}</a>`;
      });
    },

    async fetchTicketDetails() {
      this.loading = true;
      try {
        const res = await General.get(`/api/user/tickets/${this.$route.params.id}`);
        this.ticket = res.data;
        this.scrollToBottom();
      } catch (error) {
        this.$alertStore.add('Record Loading Failed', 'error');
      } finally {
        this.loading = false;
      }
    },

    async submitReply() {
      if (!this.newReply.message) return;
      this.loading = true;

      try {
        const payload = { message: this.newReply.message, ticket_id: this.ticket.id, attachment: this.newReply.attachment };
        await General.post(`/api/user/tickets/${this.ticket.id}/reply`, payload);
        this.$alertStore.add("Reply submitted successfully", "success");
        this.newReply.message = '';
        this.newReply.attachment = null;
        await this.fetchTicketDetails();
      } catch (error) {
        this.$alertStore.add(error.message || 'An error occurred', 'error');
      } finally {
        this.loading = false;
      }
    },
    scrollToBottom() {
      this.$nextTick(() => {
        const container = this.$el.querySelector('.replies-wrapper');
        if (container) container.scrollTop = container.scrollHeight;
      });
    },

    scrollToBottom() {
      this.$nextTick(() => {
        const container = this.$refs.chatWindow;
        if (container) {
          container.scrollTop = container.scrollHeight;
        }
      });
    },

    formatDate(dateStr) {
      if (!dateStr) return 'N/A';
      return new Date(dateStr).toLocaleString('en-US', { 
        month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' 
      });
    },

    priorityColor(priority) {
      const colors = { 'High': 'error', 'Medium': 'warning', 'Low': 'info' };
      return colors[priority] || 'primary';
    },
    
    goBack() { this.$router.back(); }
  },
}
</script>
<style scoped>
.chat-main-col {
  height: calc(100vh - 75px); 
}



.max-w-75 { max-width: 75%; }
.chat-bubble {
  border-radius: 12px;
  position: relative;
  max-width: fit-content;
}

.admin-bubble {
  border-bottom-right-radius: 2px !important;
  background-color: #0f172a !important; 
}

.client-bubble {
  border-bottom-left-radius: 2px !important;
  background-color: #1e293b !important;
}

.info-sidebar {
  border-left: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
}

.message-input-field :deep(textarea) {
  padding-top: 10px !important;
  font-size: 0.9rem;
}

.messages-viewport::-webkit-scrollbar,
.info-sidebar::-webkit-scrollbar {
  width: 4px;
}
.messages-viewport::-webkit-scrollbar-thumb {
  background: rgba(var(--v-theme-primary), 0.2);
  border-radius: 10px;
}

</style>
