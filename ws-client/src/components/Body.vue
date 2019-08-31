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
      </div>
       <tablita></tablita>
    </section>
  </div>
</template>

<script>
import axios from "axios";
import Vue from "vue";
import tablita from "./Table";

export default {
  components: {
    tablita
  },
  data() {
    return {
      countUpdatingTable: []
    };
  },
  methods: {
    onSubmit(movie) {
      Vue.set(this.countUpdatingTable, movie.id, true);
      this.increaseCount(movie);
    },
    async increaseCount(movie) {
      // axios.defaults.headers.common['Authorization'] = `Bearer ${await this.$auth.getAccessToken()}`
      axios
        .post("http://35.225.171.201/ws-server/public/index.php/movies/" + movie.id + "/count")
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
    },
    removeMovie(movie) {
      ///movies/{id}/delete
      axios
        .delete("http://35.225.171.201/ws-server/public/index.php/movies/" + movie.id + "/delete")
        .then(response => {
          if (response.data.errors === "Not found!") {
            alert("hola jj");
          } else {
            this.movies.pop(movie);
          }
        })
        //
        .catch(() => {
          // handle authentication and validation errors here
          this.countUpdatingTable[movie.id] = false;
        });
    }
  }
};
</script>

<style>
.mx-auto {
  margin: 0 auto;
}
.m1 {
  margin: 1em;
}

h1 {
  font-size: 2em;
}

@media screen and (max-width: 800px) {
  .is-responsive {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    display: block;
    position: relative;
  }
  .is-responsive td:empty:before {
    content: " ";
  }
  .is-responsive th,
  .is-responsive td {
    margin: 0;
    vertical-align: top;
  }
  .is-responsive th {
    text-align: left;
  }
  .is-responsive thead {
    border-right: solid 2px #dbdbdb;
    display: block;
    float: left;
  }
  .is-responsive thead tr {
    display: block;
    padding: 0 10px 0 0;
  }
  .is-responsive thead tr th::before {
    content: " ";
  }
  .is-responsive thead td,
  .is-responsive thead th {
    border-width: 0 0 1px;
  }
  .is-responsive tbody {
    display: block;
    width: auto;
    position: relative;
    overflow-x: auto;
    white-space: nowrap;
  }
  .is-responsive tbody tr {
    display: inline-block;
    vertical-align: top;
  }
  .is-responsive th {
    display: block;
    text-align: right;
  }
  .is-responsive td {
    display: block;
    min-height: 1.25em;
    text-align: left;
  }
  .is-responsive th:last-child,
  .is-responsive td:last-child {
    border-bottom-width: 0;
  }
  .is-responsive tr:last-child td:not(:last-child) {
    border: 1px solid #dbdbdb;
    border-width: 0 0 1px;
  }
  .is-responsive.is-bordered td,
  .is-responsive.is-bordered th {
    border-width: 1px;
  }
  .is-responsive.is-bordered tr td:last-child,
  .is-responsive.is-bordered tr th:last-child {
    border-bottom-width: 1px;
  }
  .is-responsive.is-bordered tr:last-child td,
  .is-responsive.is-bordered tr:last-child th {
    border-width: 1px;
  }
}
.spacio-button {
  padding-left: 0.75em;
  padding-right: 0.75em;
}
.padding1{
padding-top: 50px;
}
</style>