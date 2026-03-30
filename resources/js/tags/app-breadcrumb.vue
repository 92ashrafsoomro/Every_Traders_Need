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
      <span :title="item.text">
        {{ truncateText(item.text, 5) }}
      </span>
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
  },
  methods:{
   truncateText(text, wordlimit = 5) {
  if (!text) return ''

  // slug ko readable text banado
  const formatted = text
    .replace(/-/g, ' ') 
    .split(' ')
    .map(w => w.charAt(0).toUpperCase() + w.slice(1))
    .join(' ')

  const words = formatted.split(' ')

  if (words.length > wordlimit) {
    return words.slice(0, wordlimit).join(' ') + '...'
  }

  return formatted
}
  }
}
</script>