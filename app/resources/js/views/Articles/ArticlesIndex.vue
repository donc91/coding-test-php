<template>
  <div class="posts index large-9 medium-8 columns content">
    <div class="row">
      <div class="columns large-6">
        <h3>Article</h3>
      </div>
      <div class="columns large-6 tr">
        <router-link
          v-if="isAuthenticated"
          :to="{ name: 'addArticles' }"
          class="button shadow radius left small">Add Article</router-link>
      </div>
    </div>
    <table cellpadding="0" cellspacing="0">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Title</th>
          <th scope="col">Body</th>
          <th scope="col">Likes</th>
          <th scope="col">Created</th>
          <th scope="col" class="actions">Actions</th>
        </tr>
      </thead>
      <tbody>
          <tr v-for="article, key in records" :key="key">
            <td>{{ article.id }}</td>
            <td>{{ article.title }}</td>
            <td>{{ article.body }}</td>
            <td>{{ article.count }}</td>
            <td>{{ article.created_at }}</td>
            <td class="actions">
              <router-link :to="{ name: 'viewArticles', params: { id: article.id } }">View</router-link>
              <template v-if="isAuthenticated && !article.favourite">
                <a @click="_favorite(article)" title="Like" :disabled="favorting">Like</a>
              </template>
              <template v-if="isAuthenticated && article.favourite">
                Liked
              </template>
              <template v-if="currentUser && currentUser.user_id === article.user_id">
                <router-link :to="{ name: 'editArticles', params: { id: article.id } }">Edit</router-link>
                <a @click="_delete(article.id)" title="Remove" :disabled="removing">Remove</a>
              </template>
            </td>
          </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
  import moment from 'moment';
  import { mapGetters } from "vuex";

  import { ArticlesService } from "../../common/api";

  export default {
    data() {
      return {
        records: [],
        removing: false,
        favorting: false
      };
    },

    computed: {
      ...mapGetters(["isAuthenticated", "currentUser"])
    },

    mounted() {
      this.load()
    },
    methods: {
      load() {
        ArticlesService.query()
          .then(res => {
            this.records = res.data
          })
          .catch(err => {
            console.log(err)
          });
      },

      _favorite(article) {
        this.favorting = true
        ArticlesService.favorite(article.id)
          .then(res => {
            this.$set(article, 'favourite', 1)
          })
          .catch(err => {
            console.log(err)
          })
          .finally(() => {
            this.favorting = false
          })
      },
      
      _delete(id) {
        this.removing = true
        ArticlesService.destroy(id)
          .then(res => {
            const records = [...this.records]
            const index = records.findIndex((obj) => obj.id === id);
            if (index > -1) {
              records.splice(index, 1);
            }
            this.records = records
          })
          .catch(err => {
            console.log(err)
          })
          .finally(() => {
            this.removing = false
          })
      }
    }
  }
</script>
