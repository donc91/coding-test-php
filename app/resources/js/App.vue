<template>
  <div class="container clearfix">
      <sidebar></sidebar>
      <router-view></router-view>
  </div>
</template>

<script>
  import Sidebar from './components/Sidebar.vue';

  export default {
    name: "App",
    components: {
        'sidebar': Sidebar,
    }
  }
</script>
