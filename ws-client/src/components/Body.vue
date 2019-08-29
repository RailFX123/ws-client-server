<template>
  <div>
    <section class="hero">
      <div class="hero-body has-background-light">
        <div class="container">
          <h1 class="title">CRUD Peliculas</h1>
          <h2 class="subtitle">
            En la seccion de abajo podra agregar, borrar, eliminar y ver las peliculas disponibles en nuestros
            servidores.
          </h2>
        </div>
      </div>
    </section>
    <section class="section">
      <div class="container has-text-centered">
        <h1 class="title">Tabla de peliculas</h1>
        <h2
          class="subtitle"
        >En esta parte podran insertar, seleccionar, actualizar y borrar peliculas</h2>
        <span class="help is-info" v-if="isLoading">Loading...</span>
        <table class="table mx-auto" v-else>
          <thead>
            <tr>
              <th>ID</th>
              <th>Titulo</th>
              <th>Año Salida</th>
              <th>Trailer</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="movie in movies">
              <tr v-bind:key="movie.id">
                <td>{{ movie.id }}</td>
                <td>{{ movie.titulo }}</td>
                <td>{{ movie.year_salida }}</td>
                <td>{{ movie.url_trailer }}</td>
                <td class="has-text-centered">
                  <Modal :youtube="movie.url_trailer"></Modal>
                  <!-- <form @submit.prevent="onSubmit(movie)">
                    <button
                      class="button is-primary"
                      v-bind:class="{ 'is-loading' : isCountUpdating(movie.id) }"
                    >Increase Count</button>
                  </form>-->
                </td>
              </tr>
            </template>
          </tbody>
        </table>
        <button class="button is-primary m1">Agregar</button>
        <button class="button is-primary m1">Borrar</button>
        <button class="button is-primary m1">Actualizar</button>
      </div>
    </section>
  </div>
</template>

<script>
import axios from "axios";
import Vue from "vue";
// import MovieForm from "./MovieForm.vue";
import Modal from "./Modal";
export default {
  components: {
    // MovieForm,
    Modal
  },
  data() {
    return {
      movies: {},
      isLoading: true,
      countUpdatingTable: []
    };
  },
  async created() {
    // axios.defaults.headers.common['Authorization'] = `Bearer ${await this.$auth.getAccessToken()}`
     axios.defaults.headers.common['Access-Control-Allow-Origin']='http://192.168.8.101:8080';
    try {
      const response = await axios.get("http://localhost:8000/movies");
      this.movies = response.data;
      this.isLoading = false;
    } catch (e) {
      // handle authentication error here
    }
  },
  methods: {
    onSubmit(movie) {
      Vue.set(this.countUpdatingTable, movie.id, true);
      this.increaseCount(movie);
    },
    async increaseCount(movie) {
      // axios.defaults.headers.common['Authorization'] = `Bearer ${await this.$auth.getAccessToken()}`
      axios
        .post("http://localhost:8000/movies/" + movie.id + "/count")
        .then(response => {
          movie.count = response.data.count;
          this.countUpdatingTable[movie.id] = false;
        })
        //
        .catch(() => {
          // handle authentication and validation errors here
          this.countUpdatingTable[movie.id] = false;
        });
    },
    isCountUpdating(id) {
      return this.countUpdatingTable[id];
    },
    addMovie(movie) {
      this.movies.push(movie);
    }
  }
};
</script>

<style>
.mx-auto {
  margin: 0 auto;
}
.m1{
    margin:1em;
}
</style>