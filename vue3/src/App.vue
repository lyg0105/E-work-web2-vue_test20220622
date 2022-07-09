<template>
  <div class="menu">
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link>
    <router-link to="/accodion">Accodion</router-link>
  </div>
  <router-view />
  
  <h1>부동산 리스트</h1>
  <div v-for="(product,i) in products" :key="i">
    <img :src="require('@/assets/'+product.img)" class="room_img" >
    <h4 @click="is_open_modal=true">{{i+1}}. {{product["name"]}}</h4>
    <p>{{product["money"]}}만원</p>
    <button @click="increase(i)">허위매물신고</button> 
    <span>신고수: {{product["report"]}}</span>
  </div>

<div class="black-bg" v-if="is_open_modal"  >
  <div class="white-bg">
    <h4>상세페이지임</h4>
    <p>상세페이지 내용임</p>
    <div>
      <button @click="is_open_modal=false" >닫기</button>
    </div>
  </div>
</div>

</template>

<script>
import onerooms from './oneroom.js';

export default {
  name: 'App',
  data(){
    return {
      is_open_modal:false,
      products:onerooms,
      menus:["Home","Shop","About"],
    };
  },
  methods: {
    increase(i){
      this.products[i]["report"]++;
    }
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
.room_img{
  width: 100%;
  max-width:200px;
  margin-top: 40px;
}
.black-bg{
  width: 100%;
  height: 100%;
  background: #111;
  position: fixed;
  padding:20px;
  left: 0px;
  top:0px;
}
.white-bg{
  width: 100%;
  background: white;
  border-radius: 8px;
  padding:20px;
}
</style>
