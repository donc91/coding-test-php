<template>
  <nav class="top-bar expanded" data-topbar role="navigation">
      <div class="top-bar-section">
          <ul class="right no-list-style">
              <li><router-link :to="{ name: 'root' }">Home</router-link></li>
              <li><router-link :to="{ name: 'articles' }">Articles</router-link></li>
              <li v-if="isAuthenticated"><button @click="logout">Logout</button></li>
              <li v-else><router-link :to="{ name: 'login' }">Login</router-link></li>
          </ul>
      </div>
  </nav>
</template>

<script>
 import { mapGetters } from "vuex";
 import { LOGOUT } from "../store/actions";
 export default {
  name: "SideBar",
    
  computed: {
    ...mapGetters(["isAuthenticated"])
  },

  methods: {
    logout() {
      this.$store.dispatch(LOGOUT).then(() => {
        this.$router.push({ name: "articles" });
      });
    }
  }
};
</script>
