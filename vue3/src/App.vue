<template>
  <div class="menu">
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link>
    <router-link to="/accodion">Accodion</router-link>
    <router-link to="/login">Login</router-link>
  </div>
  <router-view />

</template>

<script>
import onerooms from './oneroom.js';

export default {
  name: 'App',
  data(){
    return {
      
    };
  },
  methods: {
    
  },
  components: {
    
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
.menu{
  background: darkslateblue;
  padding:15px;
  border-radius:5px;
}
.menu a{
  color:white;
  padding: 10px;
}
</style>
