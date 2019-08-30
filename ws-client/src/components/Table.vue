<template>
  <section>
    <section class="section">
      <modal class="modalin"></modal>
    </section>
    <b-table
      :data="isEmpty ? [] :movies"
      :bordered="isBordered"
      :striped="isStriped"
      :narrowed="isNarrowed"
      :hoverable="isHoverable"
      :loading="isLoading"
      :focusable="isFocusable"
      :mobile-cards="hasMobileCards"
    >
      <template slot-scope="props">
        <!-- <b-table-column field="id" label="ID" width="40" numeric>{{ props.row.id }}</b-table-column> -->
        <b-table-column field="Titulo" label="Titulo">{{ props.row.titulo }}</b-table-column>
        <b-table-column field="Año Salida" label="Año Salida">{{ props.row.year_salida}}</b-table-column>
        <b-table-column field="Año Salida" label="Actions">
          <div class="buttons">
            <button class="button is-danger" @click="removeMovie(props.row.id) ">
              <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
            <modal
              :editar="true"
              :id="props.row.id"
              :year="props.row.year_salida"
              :titulo="props.row.titulo"
              :url_year="props.row.url_trailer"
            ></modal>
          </div>
        </b-table-column>
      </template>

      <template slot="empty">
        <section class="section">
          <div class="content has-text-grey has-text-centered">
            <p>
              <b-icon icon="emoticon-sad" size="is-large"></b-icon>
            </p>
            <p>No tienes peliculas agregadas</p>
          </div>
        </section>
      </template>
    </b-table>
  </section>
</template>

<script>
import axios from "axios";
import modal from "./ModalBuefy";
//import Vue from "vue";

export default {
  components: {
    modal
  },
  data() {
    return {
      movies: [],
      isLoading: true,
      countUpdatingTable: [],
      isEmpty: false,
      isBordered: false,
      isStriped: false,
      isNarrowed: false,
      isHoverable: false,
      isFocusable: false,
      hasMobileCards: true
    };
  },
  async created() {
    try {
      const response = await axios.get("http://172.16.2.150:8000/movies");
      this.movies = response.data;
      this.isLoading = false;
    } catch (e) {
      this.isLoading = false;
    }
  },
  methods: {
    removeMovie(movie) {
      ///movies/{id}/delete
      axios
        .get("http://172.16.2.150:8000/movies/" + movie + "/delete")
        .then(response => {
          if (response.data.errors === "Not found!") {
            alert("hola jj");
          } else {
            this.movies.pop(movie);
            this.$buefy.notification.open({
              message: "Operacion Exitosa",
              type: "is-success"
            });
          }
        })
        .catch(() => {
          this.$buefy.notification.open({
            message: "La operacion Fallo :C",
            type: "is-danger"
          });
        });
    }
    
  }
};
</script>
<style scoped>
.modalin {
  margin-right: 1em;
}
</style>
