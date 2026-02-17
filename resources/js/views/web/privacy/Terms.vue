<template>
  <v-container fluid max-width="1400px">
    <div class="mt-16 mx-auto content d-flex w-100 ga-12">
      <!-- Sidebar -->
      <div
        class="position-sticky d-none d-md-block"
        style="min-width: 200px; top: 120px; align-self: flex-start;"
      >
        <Sidebar />
      </div>

      <!-- Content -->
      <div class="flex-grow-1 mt-10">
        <!-- Title -->
        <div>
          <h1 class="text-h6 text-lg-h4 text-md-h5 font-weight-bold mb-4">
            Terms & Conditions
          </h1>
          <p class="mb-6">Last Updated: [Insert Date]</p>
        </div>

        <!-- 1. Introduction -->
        <div>
          <h2 class="text-h6 font-weight-bold mb-3">1. Introduction</h2>
          <p class="text-body-1 mb-4">
            Welcome to <strong>:contentReference[oaicite:0]{index=0}</strong>
            (“Company”, “we”, “our”, “us”).
          </p>
          <p class="text-body-1 mb-4">
            These Terms & Conditions govern your access to and use of our
            website, platform, and services. By creating an account or using
            our services, you agree to be bound by these Terms.
          </p>
          <p class="text-body-1 font-weight-bold">
            If you do not agree, you must not use our services.
          </p>
        </div>

        <!-- 2. Eligibility -->
        <div class="mt-10">
          <h2 class="text-h6 font-weight-bold mb-4">2. Eligibility</h2>
          <p class="text-body-1 mb-3">To use our services, you must:</p>
          <ul class="ml-6">
            <li>Be at least 18 years old</li>
            <li>Provide accurate and complete information</li>
            <li>Use the platform for lawful business purposes</li>
          </ul>
          <p class="text-body-1 mt-3">
            We reserve the right to suspend or terminate accounts that provide
            false information.
          </p>
        </div>

        <!-- 3. Account Registration -->
        <div class="mt-10">
          <h2 class="text-h6 font-weight-bold mb-4">3. Account Registration</h2>
          <p class="text-body-1 mb-3">When creating an account:</p>
          <ul class="ml-6">
            <li>You are responsible for maintaining confidentiality of your login credentials</li>
            <li>You are responsible for all activity under your account</li>
            <li>You must notify us immediately of any unauthorised access</li>
          </ul>
          <p class="text-body-1 mt-3">
            We are not liable for losses resulting from unauthorised account use.
          </p>
        </div>

        <!-- 4. Services Provided -->
        <div class="mt-10">
          <h2 class="text-h6 font-weight-bold mb-4">4. Services Provided</h2>
          <p class="text-body-1 mb-3">
            Autoboli provides auction insights, vehicle data, valuation
            comparisons, and reauction tracking tools for dealers and traders.
          </p>
          <p class="text-body-1 mb-2">We do not:</p>
          <ul class="ml-6">
            <li>Sell vehicles</li>
            <li>Act as an auction house</li>
            <li>Guarantee auction outcomes</li>
            <li>Provide financial or legal advice</li>
          </ul>
          <p class="text-body-1 mt-3 font-weight-bold">
            All purchasing decisions are your responsibility.
          </p>
        </div>

        <!-- 5. Subscription & Payments -->
        <div class="mt-10">
          <h2 class="text-h6 font-weight-bold mb-4">5. Subscription & Payments</h2>

          <h3 class="text-body-1 font-weight-bold">a) Subscription Plans</h3>
          <p class="text-body-1">
            Access to certain features requires a paid subscription (monthly,
            quarterly, or yearly).
          </p>

          <h3 class="text-body-1 font-weight-bold mt-4">b) Billing</h3>
          <p class="text-body-1">
            Subscriptions are billed in advance and renew automatically unless
            cancelled before the renewal date.
          </p>

          <h3 class="text-body-1 font-weight-bold mt-4">c) Cancellation</h3>
          <p class="text-body-1">
            You may cancel your subscription at any time via your account
            settings. Refunds are not provided for partial billing periods unless
            required by law.
          </p>
          <p class="text-body-1">
            We reserve the right to modify pricing with reasonable notice.
          </p>
        </div>

        <!-- 6. Data Accuracy Disclaimer -->
        <div class="mt-10">
          <h2 class="text-h6 font-weight-bold mb-4">6. Data Accuracy Disclaimer</h2>
          <p class="text-body-1 mb-3">
            While we aim to provide accurate and up-to-date auction data:
          </p>
          <ul class="ml-6">
            <li>We do not guarantee completeness or accuracy</li>
            <li>Vehicle valuations are estimates only</li>
            <li>Market conditions may change rapidly</li>
          </ul>
          <p class="text-body-1 mt-3">
            You rely on platform data at your own risk.
          </p>
        </div>

        <!-- 7. Acceptable Use -->
        <div class="mt-10">
          <h2 class="text-h6 font-weight-bold mb-4">7. Acceptable Use</h2>
          <p class="text-body-1 mb-3">You agree not to:</p>
          <ul class="ml-6">
            <li>Use the platform for unlawful purposes</li>
            <li>Attempt to reverse engineer, copy, or resell data</li>
            <li>Share your login credentials</li>
            <li>Interfere with platform security</li>
            <li>Scrape or extract data without permission</li>
          </ul>
          <p class="text-body-1 mt-3">
            Violation may result in account suspension or legal action.
          </p>
        </div>

        <!-- 8. Intellectual Property -->
        <div class="mt-10">
          <h2 class="text-h6 font-weight-bold mb-4">8. Intellectual Property</h2>
          <p class="text-body-1">
            All content, software, design, branding, and data (excluding
            third-party data sources) are the intellectual property of Autoboli.
          </p>
        </div>

        <!-- 9–15 -->
        <div class="mt-10">
          <h2 class="text-h6 font-weight-bold mb-4">9. Limitation of Liability</h2>
          <p class="text-body-1">
            To the fullest extent permitted by law, our total liability shall not
            exceed the amount paid by you in the last 12 months.
          </p>

          <h2 class="text-h6 font-weight-bold mt-8 mb-4">10. Service Availability</h2>
          <p class="text-body-1">
            We do not guarantee uninterrupted or error-free service.
          </p>

          <h2 class="text-h6 font-weight-bold mt-8 mb-4">11. Termination</h2>
          <p class="text-body-1">
            We may suspend or terminate your account if you breach these Terms,
            misuse the platform, or if payment fails.
          </p>

          <h2 class="text-h6 font-weight-bold mt-8 mb-4">12. Privacy</h2>
          <p class="text-body-1">
            Your use of the platform is also governed by our Privacy Policy.
          </p>

          <h2 class="text-h6 font-weight-bold mt-8 mb-4">13. Changes to Terms</h2>
          <p class="text-body-1">
            Continued use of the platform after updates constitutes acceptance
            of the revised Terms.
          </p>

          <h2 class="text-h6 font-weight-bold mt-8 mb-4">14. Governing Law</h2>
          <p class="text-body-1">
            These Terms are governed by the laws of the United Kingdom.
          </p>

          <h2 class="text-h6 font-weight-bold mt-8 mb-4">15. Contact Information</h2>
          <p class="text-body-1">
            Company Name: Autoboli <br />
            Email: [Insert Support Email] <br />
            Address: [Insert Business Address]
          </p>
        </div>
      </div>
    </div>
  </v-container>
</template>

<script>
import Sidebar from "./Sidebar.vue";

export default {
  components: {
    Sidebar,
  },
};
</script>
