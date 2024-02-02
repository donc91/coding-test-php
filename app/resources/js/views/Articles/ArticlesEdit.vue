<template>
    <div class="posts form large-9 medium-8 columns content">
        <form novalidate="novalidate" @submit.prevent="onSubmit">
            <fieldset>
                <legend>Edit Article</legend>
                <div class="input text required">
                    <label for="title">Title</label>
                    <input type="text" name="title" v-model="title" :disabled="submiting">
                </div>
                <div class="input textarea required">
                    <label for="description">Body</label>
                    <textarea name="body" rows="5" v-model="body"  :disabled="submiting"></textarea>
                </div>
                <button type="submit" class="button radius shadow primary" :disabled="submiting">Submit</button>
  
                <a class="button shadow radius right mr-6" name="goBack" @click.prevent="$router.go(-1)">Back</a>
            </fieldset>
        </form>
    </div>
  </template>
  
  <script>
    import { mapGetters } from "vuex";
    import { ArticlesService } from "../../common/api";
  
    export default {
        data() {
            return {
                title: '',
                body: '',
                submiting: false
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
                console.log(this.$route.params.id)
                ArticlesService
                    .get(this.$route.params.id)
                    .then(response => {
                        this.title = response.data.article.title
                        this.body = response.data.article.body
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

            onSubmit(event) {
                this.submiting = true
                ArticlesService.update(this.$route.params.id, { 'title': this.title, 'body': this.body })
                    .then(response => {
                        this.$router.push({ name: 'articles' })
                    })
                    .catch(error => {
                        console.log(error)
                    })
                    .finally(this.submiting = false)
            }
        }
    }
  </script>
  