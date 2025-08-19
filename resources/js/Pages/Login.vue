<template lang="">
    <div class="row justify-content-center">
        <div class="authentication-wrapper authentication-basic container-p-y col-md-4">
            <div class="authentication-inner">
                <!-- Login -->
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <img :src="'assets/img/logo-dark9.jpg'" class="logo-default" style="width: 190px; height: 55px;"/>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1 fw-bold fs-5">ສະບາຍດີ ຍິນດີຕ້ອນຮັບ! 👋</h4>
                        <p class="mb-6 fw-bold">ກະລຸນາເຂົ້າສູ່ລະບົບ</p>
                            <div class="mb-6 form-control-validation fv-plugins-icon-container">
                                <label for="email" class="form-label fs-6">ອີເມວລ໌:</label>
                                <input type="text" v-model="email" class="form-control" id="email" name="email-username"
                                    placeholder="ປ້ອນອີເມວລ໌" autofocus="">
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="mb-6 form-password-toggle form-control-validation fv-plugins-icon-container">
                                <label class="form-label fs-6" for="password">ລະຫັດຜ່ານ</label>
                                <div class="input-group input-group-merge has-validation">
                                    <input type="password" v-model="password" id="password" class="form-control" name="password"
                                        placeholder="············" aria-describedby="password">
                                    <span class="input-group-text cursor-pointer"><i
                                            class="icon-base bx bx-hide"></i></span>
                                </div>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="mb-7">
                                <div class="d-flex justify-content-between">
                                    <div class="form-check mb-0 fs-6">
                                        <input class="form-check-input" v-model="remember_me" type="checkbox" id="remember-me">
                                        <label class="form-check-label" for="remember-me"> ຈື່ຂ້ອຍໄວ້ໃນລະບົບ </label>
                                    </div>
                                    <!-- <a href="auth-forgot-password-basic.html">
                                        <span>Forgot Password?</span>
                                    </a> -->
                                </div>
                            </div>
                            <div class="alert alert-danger" v-if="check_email_text || check_password_text || text_error" role="alert">
                                {{ text_error }} {{ check_email_text }} {{ check_password_text }}
                            </div>
                            <div class="mb-6">
                                <button class="btn btn-primary d-grid w-100" :disabled="CheckBt" type="button" @click="Login()">ເຂົ້າສູ່ລະບົບ</button>
                            </div>
                            <input type="hidden">
                        <p class="text-center">
                            <span>ບໍ່ມີບັນຊີ? </span>
                            <router-link to="/register">
                                <span>ລົງທະບຽນ</span>
                            </router-link>
                        </p>
                    </div>
                </div>
                <!-- /Login -->
            </div>
        </div>
    </div>
</template>
<script>

import axios from 'axios';

    export default {
        data() {
            return {
                email:'',
                password:'',
                remember_me: false,
                check_email_text:'',
                check_password_text:'',
                text_error:'',
            }
        },
        computed:{
            CheckBt(){
                const EmailRehex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                //Check email
                if(this.email){
                    if(EmailRehex.test(this.email)){
                        this.check_email_text = '';
                    }else{
                        this.check_email_text = 'ອີເມວລ໌ບໍ່ຖືກຕ້ອງ!';
                    }
                } else {
                    this.check_email_text = '';
                }

                //Check password
                if(this.password){
                    if(this.password.length <=5){
                        this.check_password_text = 'ລະຫັດຜ່ານຕ້ອງຫຼາຍກວ່າ 5 ໂຕອັກສອນ';
                    }else{
                        this.check_password_text = '';
                    }
                } else {
                    this.check_password_text = '';
                }

                //Disable button
                if(!EmailRehex.test(this.email) || this.password.length <=5){
                    return true;
                } else {
                    return false;
                }
            }
        },
        mounted() {
            this.email = this.$route.query.email;
        },
        methods: {
            Login() {
                axios.post('api/login',{
                    login_email: this.email,
                    login_password: this.password,
                    login_remember_me: this.remember_me
                }).then((res)=>{
                    if(res.data.success){
                        this.text_error = '';
                        //save data to local storage
                        localStorage.setItem('web_token', res.data.token);
                        localStorage.setItem('web_user', JSON.stringify(res.data.user_data));
                        //clear Form
                        this.email = '';
                        this.password = '';
                        //go to root path
                        this.$router.push('/');
                    } else {
                        this.text_error = res.data.message;
                    }
                }).catch((error)=>{
                    console.log(error);
                    if(error.response){
                        if(error.response.status!=200){
                            this.text_error = error.response.data.message;
                        }
                    }
                });
            }
        },
    }

</script>
<style lang="">

</style>
