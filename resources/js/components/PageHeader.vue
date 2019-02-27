  <template>
  <v-layout row class="align-center layout px-4 pt-4 app--page-header">
    <div class="page-header-left">
      <h3 class="pr-3">{{title}}</h3>
    </div>

    <v-breadcrumbs :items="breadcrumbs" light>
      <v-icon slot="divider">chevron_right</v-icon>
    </v-breadcrumbs>

    <v-spacer></v-spacer>
    <div class="page-header-right">
      <v-btn icon>
        <v-icon class="text--secondary">refresh</v-icon>
      </v-btn>
    </div>
  </v-layout>
</template>

<script>
import menu from "@/config/menu";
export default {
  data() {
    return {
      title: ""
    };
  },
  computed: {
    breadcrumbs: function() {
      let breadcrumbs = [];
      menu.forEach(item => {
        if (item.items) {
          let child = item.items.find(i => {
            return i.component === this.$route.name;
          });
          if (child) {
            breadcrumbs.push({ text: item.title });
            breadcrumbs.push({ text: child.title });   
            this.title = child.title;
          }
        } else {
          if (item.name === this.$route.name) {
            this.title = item.title;
            breadcrumbs.push({ text: item.title });
          }
        }
      });
      return breadcrumbs;
    }
  }
};
</script>
