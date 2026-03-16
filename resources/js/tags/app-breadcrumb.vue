<template>
  <v-breadcrumbs :items="breadcrumbItems">
    <template v-slot:divider>
      <v-icon small>mdi-chevron-right</v-icon>
    </template>

    <template v-slot:item="{ item }">
      <v-breadcrumbs-item
        :to="item.to"
        :disabled="item.disabled"
      >
        {{ item.text }}
      </v-breadcrumbs-item>
    </template>
  </v-breadcrumbs>
</template>

<script>
export default {
  name: 'AppBreadcrumb',

  computed: {
    breadcrumbItems() {
      let items = [];

      if (this.$route.meta && Array.isArray(this.$route.meta.breadcrumb)) {
        this.$route.meta.breadcrumb.forEach(entry => {
          let text;
          let to = undefined;

          if (typeof entry === 'function') {
            text = entry(this.$route);
          } else if (typeof entry === 'string') {
            text = entry;
          } else if (entry.text) {
            text = entry.text;
            to = entry.to;
          }

          if (text) {
            items.push({
              text: text,
              to: to,
              disabled: false
            });
          }
        });
      } else {
        items.push({ text: 'Home', to: '/', disabled: false });

        const pathParts = this.$route.path.split('/').filter(p => p);
        let cumulativePath = '';

        pathParts.forEach((part, index) => {
          cumulativePath += '/' + part;
          let text = part
            .replace(/-/g, ' ')
            .split(' ')
            .map(w => w.charAt(0).toUpperCase() + w.slice(1))
            .join(' ');

          items.push({
            text,
            to: index === pathParts.length - 1 ? undefined : cumulativePath,
            disabled: index === pathParts.length - 1
          });
        });
      }

      // Last item disabled
      if (items.length > 0) {
        items[items.length - 1].disabled = true;
        items[items.length - 1].to = undefined;
      }

      return items;
    }
  }
}
</script>