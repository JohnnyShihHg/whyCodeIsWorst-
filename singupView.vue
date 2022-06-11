<template>
  <div class="container">
    <h1>註冊帳號</h1>
    <form class="row g-3 needs-validation" novalidate>
      <div class="col-md-12">
        <label for="validationCustom03" class="form-label">帳號</label>
        <!-- v-model為 input限定用法 -->
        <input v-model="account" type="text" class="form-control" />
        <div class="invalid-feedback">請輸入帳號</div>
      </div>
      <div class="col-md-12">
        <label for="validationCustom03" class="form-label">信箱</label>
        <!-- v-model為 input限定用法 -->
        <input v-model="email" type="email" class="form-control" pattern=".+@gmail\.com" />
        <div class="invalid-feedback">請輸入正確的信箱格式</div>
      </div>
      <div class="col-md-12">
        <label for="validationCustom03" class="form-label">密碼</label>
        <input v-model="password" type="password" class="form-control" />
        <div class="invalid-feedback">請輸入密碼</div>
      </div>

      <div id="singupForm" class="col-6">
        <button @click="singup" class="btn btn-primary" type="submit">
          註冊
        </button>
      </div>
      <div class="col-6">
        <button @click="cancel" class="btn btn-primary" type="submit">
          回首頁
        </button>

      </div>
      <div id="logOutForm" class="col-12 d-none">
        <button @click="logout" class="btn btn-primary" type="submit">
          登出
        </button>

      </div>
    </form>
  </div>

  <div v-if="singUpSuccess == true" class="col-12 mt-5">註冊成功</div>
</template>
<script>
import axios from 'axios'

export default {
  data() {
    return {
      singUpSuccess: false,
      account: '',
      password: '',
      email: '',
    }
  },
  methods: {
    cancel() {
      this.$router.push("./home");
    },
    // singup() {
    //   let test = this.account+this.password;
    //   localStorage.setItem("token", JSON.stringify(test));




    
//TODO 傳入資料庫為空值

    async singup() {
      //殘疾
      // if (this.account != "") {
      //   if (this.password != "") {
      //     this.singUpSuccess = true;
      //   }
      //微正常

      //因php只認得FormData的實例對象
      let data = new FormData()
      let vm = this
      data.append('account', vm.account)
      data.append('password', vm.password)
      data.append('email', vm.email)
      let { data: result } = await axios.post("./doSingup.php", data)
      // if (result.status) {
      //           this.success = true
      //         } else {
      //           this.success = false
      //         } 
      console.log(result);
      //測試連線
      console.log('NMSL');
      //判斷成功
      if (result.status == 1) {
        //成功 將被打包的陣列塞入localStorage,不應該存token註冊只能將東西寫入資料庫，驗證用token要從登入那邊取得
        //localStorage.setItem("userAccount", JSON.stringify(result));
        alert('註冊成功')
        this.$router.push("./login");
        $("#logOutForm").removeClass("d-none");
        $("#singupForm").addClass("d-none");
      } else {
        //失敗
        alert("帳號或密碼錯誤");
        // return false;
      }
      // if (this.account != '' && this.password != '' && this.email === true) {
      //   this.singUpSuccess = true
      //   alert('註冊成功')
      // }
    }
    , logout() {
      localStorage.removeItem("userAccount");
      $("#logOutForm").addClass("d-none");
      $("#singupForm").removeClass("d-none");
      this.$router.push("./home");
    }
  }



  // mounted() {
    // // Example starter JavaScript for disabling form submissions if there are invalid fields
    // ; (() => {
    //   'use strict'

    //   // Fetch all the forms we want to apply custom Bootstrap validation styles to
    //   const forms = document.querySelectorAll('.needs-validation')

    //   // Loop over them and prevent submission
    //   Array.from(forms).forEach((form) => {
    //     form.addEventListener(
    //       'submit',
    //       async (event) => {
    //         if (!form.checkValidity()) {
    //           event.preventDefault()
    //           event.stopPropagation()
    //         } else {



    //         }

    //         form.classList.add('was-validated')
    //       },
    //       false
    //     )
    //   })
    // })()
  // },
}
</script>
