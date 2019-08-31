<template>
  <div>
    <transition name="modal">
      <div v-if="isImageModalActive">
        <div class="overlay" @click="isImageModalActive = false">
          <div class="changeyourmind">
            <iframe
              allowfullscreen="allowfullscreen"
              mozallowfullscreen="mozallowfullscreen"
              msallowfullscreen="msallowfullscreen"
              oallowfullscreen="oallowfullscreen"
              webkitallowfullscreen="webkitallowfullscreen"
              width="100%"
              height="100%"
              :src="youtube"
            ></iframe>
          </div>
        </div>
      </div>
    </transition>
    <button class="button is-primary" @click="isImageModalActive = !isImageModalActive">
      <i class="fas fa-eye"></i>
    </button>
  </div>
</template>


<script>
export default {
  data() {
    return {
      isImageModalActive: false
    };
  },
  props: { youtube: String }
};
</script>
<style scoped>
.changeyourmind {
  width: 85%;
  height: 85%;
  margin: 0px auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px 3px;
  transition: all 0.2s ease-in;
  font-family: Helvetica, Arial, sans-serif;
}
.fadeIn-enter {
  opacity: 0;
}

.fadeIn-leave-active {
  opacity: 0;
  transition: all 0.2s step-end;
}

.fadeIn-enter .modal,
.fadeIn-leave-active.modal {
  transform: scale(1.1);
}

.overlay {
  position: fixed;
  top: 0;
  left: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
  background: #00000094;
  z-index: 999;
  transition: opacity 0.2s ease;
}
iframe {
  height: 100%;
}
</style>