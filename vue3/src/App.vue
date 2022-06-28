<template>
  <div class="menu">
    <a v-for="(menu,i) in menus" :key="i">
      {{menu}}
    </a>
  </div>
  <h1>부동산 리스트</h1>
  <div v-for="(product,i) in products" :key="i">
    <h4>{{i+1}}. {{product}}</h4>
    <p>50만원</p>
  </div>
</template>

<script>

export default {
  name: 'App',
  data(){
    return {
      products:['신설동','종로1','역삼동'],
      menus:["Home","Shop","About"],
    };
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
