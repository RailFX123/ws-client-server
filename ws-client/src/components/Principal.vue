<template>
  <div>
    <Navbar></Navbar>
    <Body></Body>
    <!-- <Footer></Footer> -->
  </div>
</template>

<script>
import Navbar from "./Navbar";
//import Footer from "./Footer";
import Body from "./Body";

export default {
  name: "app",
  components: {
    Navbar,
    Body
    //,
   // Footer
  }
};
</script>

<style>
#app {
  font-family: Helvetica, Arial, sans-serif;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>