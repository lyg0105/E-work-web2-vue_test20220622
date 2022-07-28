<template>
  <div class="login_wrap">
    <h1>Login Page</h1>
    <br />
    <table class="login_table">
      <colgroup>
        <col width="20%">
        <col width="80%">
      </colgroup>
      <tbody>
        <tr>
          <th>아이디</th>
          <td>
            <input type="text" id="user_id" v-model="user_id" />
          </td>
        </tr>
        <tr>
          <th>암호</th>
          <td>
            <input type="password" id="user_pw" v-model="user_pw" />
          </td>
        </tr>
      </tbody>
    </table>
    <br />
    <b-button variant="success" @click="go_login">로그인</b-button>
  </div>
</template>
<script>
export default {
  name: 'MyLogin',
  data(){
    return {
      user_id:"",
      user_pw:""
    }
  },
  methods: {
    go_login(){
      console.log(this.user_id);
      console.log(this.user_pw);

      this.axios.get("http://vue.localhost/api/test/test/test").then((response) => { // 실제 API를 요청한다
        console.log(response.data);
      });
    }
  },
}
</script>
<style>
.login_wrap{
  width: 300px;
  margin: 0 auto;
}
.login_table{
  width: 100%;

}
</style>