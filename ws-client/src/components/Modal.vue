<template>
  <div>
    <transition name="modal">
      <div v-if="isOpen">
        <div class="overlay" @click.self="isOpen = false;">
          <div class="changeyourmind">
            <iframe
              allowfullscreen="allowfullscreen"
              mozallowfullscreen="mozallowfullscreen"
              msallowfullscreen="msallowfullscreen"
              oallowfullscreen="oallowfullscreen"
              webkitallowfullscreen="webkitallowfullscreen"
              width="100%"
              height="100%"
              v-bind:src="youtube"
            ></iframe>
          </div>
        </div>
      </div>
    </transition>
    <button
      class="button is-primary"
      @click="isOpen = !isOspen;"
    ><i class="fas fa-eye"></i></button>
  </div>
</template>


<script>
export default {
  data: function() {
    return {
      isOpen: false
    };
  },
  props: ['youtube']
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
</style>