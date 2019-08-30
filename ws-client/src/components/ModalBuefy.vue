<template>
  <section>
    <button class="button is-primary" @click="isCardModalActive = true">
      <i :class="!editar?'fa fa-plus':'fa fa-edit'" aria-hidden="true"></i>
      {{!editar?'Añadir':''}}
    </button>

    <b-modal :active.sync="isCardModalActive">
      <form action>
        <div class="modal-card" style="width: auto;">
          <header class="modal-card-head">
            <p class="modal-card-title">{{editar ? 'Editar':'Crear'}}</p>
          </header>
          <section class="modal-card-body">
            <b-field label="Titulo">
              <b-input type="text" :value="titulo" max="255" placeholder="Your email" required></b-input>
            </b-field>
            <b-field label="Año de salida">
              <b-input
                type="number"
                min="1950"
                :max="new Date().getFullYear()"
                :value="year"
                placeholder="Your email"
                required
              ></b-input>
            </b-field>
            <b-field label="Url Video">
              <b-input type="text" :value="url_year" max="255" placeholder="Your email" required></b-input>
            </b-field>
          </section>
          <footer class="modal-card-foot">
            <button
              class="button"
              type="button"
              @click="created()"
            >{{!editar ? 'Guardar':'Crear'}}</button>
            <button class="button" type="button" @click="isCardModalActive = false">Cerrar</button>
          </footer>
        </div>
      </form>
    </b-modal>
  </section>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      isImageModalActive: false,
      isCardModalActive: false
    };
  },
  props: {
    editar: Boolean,
    titulo: String,
    year: String,
    url_year: String,
    id: Number
  },
  methods: {
    alertar() {
      alert("Hola");
    },
    created() {
      try {
       const ok = 
          {
            titulo: this.titulo,
            year_salida: this.year,
            url_trailer: this.url_trailer
          }
        ;
        const response = axios.post("http://172.16.2.150:8000/movies",ok);
        this.movies = response.data;
        this.isLoading = false;
      } catch (e) {
        this.isLoading = false;
      }
    }
  }
};
</script>
<style>
.modalito {
  max-height: 95%;
  max-width: 95%;
}
</style>