<template>
  <nav class="top-bar expanded" data-topbar role="navigation">
      <div class="top-bar-section">
          <ul class="right">
              <li><router-link :to="{ name: 'root' }">Home</router-link></li>
              <li v-if="!isAuthenticated"><router-link :to="{ name: 'login' }">Login</router-link></li>
              <li><router-link :to="{ name: 'articles' }">Articles</router-link></li>
          </ul>
      </div>
  </nav>
</template>

<script>
 import { mapGetters } from "vuex";
 export default {
  name: "SideBar",
    
  computed: {
    ...mapGetters(["isAuthenticated"])
  },
};
</script>
