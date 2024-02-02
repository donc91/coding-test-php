import Vue from "vue";
import axios from "axios";
import VueAxios from "vue-axios";
import JwtService from "./jwt";

const ApiService = {
  init() {
    Vue.use(VueAxios, axios);
  },

  setHeader() {
    Vue.axios.defaults.headers.common[
      "Authorization"
    ] = `Bearer ${JwtService.getToken()}`;
    Vue.axios.defaults.headers.common['Content-Type'] = 'application/json';
    Vue.axios.defaults.headers.common['Accept'] = 'application/json';
  },


  query(resource, params) {
    return Vue.axios.get(resource).catch(error => {
      throw new Error(`[RWV] ApiService ${error}`);
    });
  },

  get(resource) {
    return Vue.axios.get(`${resource}`).catch(error => {
      throw new Error(`[RWV] ApiService ${error}`);
    });
  },

  post(resource, params) {
    return Vue.axios.post(resource, params);
  },

  update(resource, params) {
    return Vue.axios.put(resource, params);
  },

  put(resource, params) {
    return Vue.axios.put(`${resource}`, params);
  },

  delete(resource) {
    return Vue.axios.delete(resource).catch(error => {
      throw new Error(`[RWV] ApiService ${error}`);
    });
  }
};

export default ApiService;


export const ArticlesService = {
  query(params) {
    ApiService.setHeader()
    return ApiService.query("/api/articles.json").catch(error => {
      throw new Error(`[RWV] ArticleService ${error}`);
    });
  },
  
  get(id) {
    ApiService.setHeader()
    return ApiService.get(`/api/articles/${id}.json`);
  },

  create(params) {
    ApiService.setHeader()
    return ApiService.post("/api/articles.json", params);
  },

  update(id, params) {
    ApiService.setHeader()
    return ApiService.update(`/api/articles/${id}.json`, params);
  },

  destroy(id) {
    ApiService.setHeader()
    return ApiService.delete(`/api/articles/${id}.json`);
  },

  favorite(id) {
    ApiService.setHeader()
    return ApiService.post(`api/articles/${id}/favorite.json`).catch(error => {
      throw new Error(`[RWV] ArticleService ${error}`);
    });
  },

};
