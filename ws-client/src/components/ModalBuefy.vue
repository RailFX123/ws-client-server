<template>
  <section>
    <button class="button is-primary" @click="isCardModalActive = true">
      <i :class="!editar?'fa fa-plus':'fa fa-edit'" aria-hidden="true"></i>
      {{!editar?'Añadir':''}}
    </button>

    <b-modal :active.sync="isCardModalActive">
      <form action="#" method="POST" autocomplete="on">
        <div class="modal-card" style="width: auto;">
          <header class="modal-card-head">
            <p class="modal-card-title">{{editar ? 'Editar':'Crear'}}</p>
          </header>
          <section class="modal-card-body">
            <b-field label="Titulo">
              <b-input
                type="text"
                name="titulo"
                v-model="tt"
                max="255"
                placeholder="Titanes del pacifico"
                required
              ></b-input>
            </b-field>
            <b-field label="Año de salida">
              <b-input
                type="number"
                min="1950"
                :max="new Date().getFullYear()"
                v-model="yy"
                placeholder="2002"
                required
              ></b-input>
            </b-field>
            <b-field label="Url Video">
              <b-input type="text" v-model="uu" max="255" placeholder="http://www.youtube.com/watch?v=21381" required></b-input>
            </b-field>
          </section>
          <footer class="modal-card-foot">
            <button 
              class="button is-primary"
              @click="crear(editar)"
              type="button"
            >{{editar ? 'Guardar':'Crear'}}</button>
            
            <button class="button is-danger" type="button" @click="isCardModalActive = false">Cerrar</button>
            <h1>{{tt}}</h1>
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
      isCardModalActive: false,
      tt: this.titulo,
      yy: this.year,
      uu: this.url_year,
      ii: this.id
    };
  },
  props: {
    editar: Boolean,
    titulo: String,
    url_year: String,
    year: String,
    id: Number,
    movie: Object
  },
  methods: {
    onInput(newInputValue) {
      this.$emit("msgChange", newInputValue);
    },
    update(){},
    crear(e) {
      const ok = {
        id:this.ii,
        titulo: this.tt,
        year_salida: this.yy,
        url_trailer: this.uu
      };
      var url;
      if(!e){
        url="http://35.225.171.201/ws-server/public/index.php/movies";
      }else{
        url="http://35.225.171.201/ws-server/public/index.php/update";
      }
      axios
        .post(url, ok)
        .then(response => {
          if (response.data.errors === "Not found!") {
            alert("hola jj");
          } else {
            this.$buefy.notification.open({
              message: "Operacion Exitosa",
              type: "is-success"
            });
            this.isCardModalActive=false;
            location.reload();

          }
        })
        .catch((error)=> {
          var err;
          switch(error.response.status){
            case 422:
              err="Completar los campos antes de enviar";
            break;
            default:
              err="Error no controlado, status:"+error.response.status;
            break;
          }
          this.$buefy.notification.open({
            message: "La operacion Fallo :C :"+err,
            type: "is-danger"
          });
        });
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