<template>
    <div class="posts view large-9 medium-8 columns content">
        <div class="row">
            <div class="columns large-6">
                <h3>Article Details</h3>
            </div>
            <div class="columns large-6 tr">
                <div class="button-group right">
                    <router-link
                        :to="{ path: '/articles' }"
                        class="button shadow radius left small">Back
                    </router-link>
                </div>
            </div>
        </div>
      <table class="vertical-table" v-if="record">
        <tr>
            <th scope="row">ID</th>
            <td>{{ record.id }}</td>
        </tr>
        <tr>
            <th scope="row">Title</th>
            <td>{{ record.title }}</td>
        </tr>
        <tr>
            <th scope="row">body</th>
            <td>{{ record.Body }}</td>
        </tr>
        <tr>
            <th scope="row">Created</th>
            <td>{{ record.created_at }}</td>
        </tr>
        <tr>
            <th scope="row">Modified</th>
            <td>{{ record.modified_at }}</td>
        </tr>
      </table>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import { ArticlesService } from "../../common/api";

export default {
    data() {
        return {
            record: null
        }
    },

    computed: {
        ...mapGetters(["isAuthenticated", "currentUser"])
    },

    mounted() {
        this.load()
    },

    methods: {
        load() {
            ArticlesService
                .get(this.$route.params.id)
                .then(response => {
                    this.record = response.data.article
                    console.log(this.record)
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
}
</script>