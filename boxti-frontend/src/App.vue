<template>
  <v-app>
      <div style="background-color: #244873; height: 64px; padding-top: 20px; padding-left: 60px; ">
        <b style="font-size: 20px; color: white;">Teste BoxTI</b>
      </div>
      <SideMenu id="sidemenu-theme"></SideMenu>
      <v-content>
        <router-view></router-view>
      </v-content>
  </v-app>
</template>

<script>
import SideMenu from './components/SideMenu';

export default {
  name: 'App',

  components: {
    SideMenu,
  },
};
</script>

<style scoped>
  #sidemenu-theme {
    margin-top: 64px;
  }
</style>
