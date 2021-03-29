<template>
  <v-navigation-drawer app fixed style="background-color: #2F3C4A;">
    <v-list dense style="padding-top: 30px;">
      <v-list-item :to="item.endpoint" v-for="item in items" :key="item.title" link style="height: 60px !important; align: center;">
        <v-list-item-icon>
          <v-icon style="color: black; margin-top: 20px;">{{ item.icon }}</v-icon>
        </v-list-item-icon>

        <v-list-item-content>
          <v-list-item-title  style="font-size: 16px;">{{ item.title }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  name: "SideMenu",
  data() {
    return {
      items: [
        { title: "Lista de técnicos", icon: "mdi-format-list-bulleted-square", endpoint: '/' },
        { title: "Cadastro Técnico", icon: "mdi-account-plus", endpoint: '/form-candidate' },
      ],
    };
  },
};
</script>

<style scoped>
    .v-list-item--active {
        color: #2F3C4A !important;
        background-color: white;
    }

    .theme--light.v-list-item--active:hover::before, .theme--light.v-list-item--active::before{
        opacity: 0;
    }

    .theme--light.v-list-item:not(.v-list-item--active):not(.v-list-item--disabled) {
        color: white !important;
    }

    .theme--light.v-list-item:not(.v-list-item--active):not(.v-list-item--disabled) .mdi-account-plus::before {
        color: white !important;
    }

    .theme--light.v-list-item:not(.v-list-item--active):not(.v-list-item--disabled) .mdi-format-list-bulleted-square::before {
        color: white !important;
    }

</style>