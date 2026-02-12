<template>
  <v-container class="d-flex align-center justify-center" style="min-height: 100vh;">
    <v-card width="420" class="pa-6 text-center">
      <v-card-title class="text-h5 font-weight-bold mb-2">
        Email Verification
      </v-card-title>

      <v-card-text>
        <div v-if="loading">
          Verifying your email...
        </div>

        <div v-else>
          Redirecting...
        </div>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
import api from "@/plugins/axios";
import { useAlertStore } from "@stores/alertStore";
import { useThemeStore } from '@/stores/themeStore';
import { useUserStore } from '@/stores/userStore';
export default {
  name: 'VerifyEmail',

  data() {
    return {
      loading: true,
      themeStore: useThemeStore(),
      userStore: useUserStore(),
      alertStore: useAlertStore(),
      form: {
        email: this.$route.query.email || '',
        token: this.$route.query.token || ''
      }
    }
  },

  mounted() {

    if (!this.form.email || !this.form.token) {
      this.redirectRegister('Invalid verification link')
      return
    }
    this.verifyEmail();

    setTimeout(() => {
      this.verifyEmail()
    }, 2000)
  },

  methods: {
    async verifyEmail() {
      try {

        const res = await api.post('/api/auth/verifyemail', this.form)
        this.userStore.initializeUserSession(res.data.data.token, res.data.data.user);
        this.themeStore.endLoading();
        this.alertStore.add(res.data.message);
        this.$router.replace('/user/dashboard')

      } catch (error) {
        this.alertStore.add(error.message,'error');
        this.redirectRegister(error.message || 'Email verification failed')
      } finally {
        this.loading = false
      }
    },

    redirectRegister(message) {
      this.$router.replace({
        path: '/register',
        query: { error: message }
      })
    }
  }
}
</script>
