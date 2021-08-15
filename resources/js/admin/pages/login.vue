<template>
<div class="content-wrapper">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="" class="h1"><b>Login to the </b>Dashboard</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to Dashboard</p>


        <div class="input-group mb-3">
          <input v-model="data.email" type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input v-model="data.password" type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button  @click="login" class="btn btn-primary btn-block" :disabled="isLogging" :loading="isLogging">{{isLogging ? 'Loging...' : 'Sign In'}}</button>
          </div>
          <!-- /.col -->
        </div>


      <p class="mb-1">
        <a href="#">I forgot my password</a>
      </p>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

</div>
</template>
<script>
export default {
    data(){
        return{
            data:{
            email:'',
            password:''
            },
            isLogging: false,
        }
    },

    methods:{
        async login(){
            if(this.data.email.trim()=='') return this.error('Email is required')
            if(this.data.password.trim() =='') return this.error('Password is required')
            if(this.data.password.length < 6) return this.error('Password is too short, altleast 6 characters')
            this.isLogging = true
            const res = await this.callApi('post', 'app/admin_login', this.data)
            if(res.status===200){
                window.location="/"
                this.success(res.data.msg)
            }else{
                if(res.status===401){
                    this.error(res.data.msg)
                }else if(res.status===422){
                    for(let i in res.data.errors)
                    this.error(res.data.errors[i][0])
                }
                else{
                    this.smwr()
                }
            }
            this.isLogging = false

        }
    }
}
</script>
