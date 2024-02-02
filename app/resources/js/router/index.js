import Vue from "vue";
import Router from "vue-router";
Vue.use(Router);

import Home from '../views/Home.vue';
import Articles from '../views/Articles/ArticlesIndex.vue';
import ArticlesAdd from '../views/Articles/ArticlesAdd.vue';
import ArticlesEdit from '../views/Articles/ArticlesEdit.vue';
import ArticlesView from '../views/Articles/ArticlesView.vue';
import PageNotFound from '../views/PageNotFound.vue';
import Login from '../views/Login.vue';

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'root',
            component: Home
        },
        {
          path: '/home',
          name: 'home',
          component: Home
      },
        {
            path: '/articles',
            name: 'articles',
            component: Articles
        },
        {
            path: '/articles/add',
            name: 'addArticles',
            component: ArticlesAdd
        },
        {
            path: '/articles/edit/:id',
            name: 'editArticles',
            component: ArticlesEdit
        },
        {
            path: '/articles/view/:id',
            name: 'viewArticles',
            component: ArticlesView
        },
        {
          path: '/login',
          name: 'login',
          component: Login
        },
        {
            path: "*",
            component: PageNotFound
        }
    ],
});