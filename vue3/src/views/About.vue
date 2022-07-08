<template>
  <h1>About Page</h1>
  <button v-on:click="submitForm">submitForm</button>
</template>
<script>
export default {
  name: 'MyAbout',
  methods:{
    submitForm(){
      const formData = new FormData();
      formData.append('email', "ggggg");
      this.axios.post('http://vue.localhost/api/test/test/test',formData).then(res => {
        console.log(res.data);
      })
    }
  }
}
</script>