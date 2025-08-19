<template lang="">
    <div class="row justify-content-center">
        <div class="authentication-wrapper authentication-basic container-p-y col-md-4">
            <div class="authentication-inner">
                <!-- Login -->
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-2">
                            <a href="index.html" class="app-brand-link gap-2">
                                <img :src="'assets/img/logo-dark9.jpg'" class="logo-default" style="width: 190px; height: 55px;"/>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <div class="app-brand justify-content-center">
                            <h4 class="mb-1 fs-4 fw-bold">ສ້າງບັນຊີໃໝ່</h4>
                        </div>
                        <p class="mb-6">ກະລຸນາລົງທະບຽນເພື່ອເຂົ້ານຳໃຊ້ລະບົບ</p>
                            <div class="mb-6 form-control-validation fv-plugins-icon-container">
                                <label for="email" class="form-label fs-6">ຊື່ຜູ້ໃຊ້:</label>
                                <input type="text" v-model="user_name" class="form-control fs-6" id="username" name="username"
                                    placeholder="ປ້ອນຊື່ຜູ້ໃຊ້" autofocus="">
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="mb-6 form-control-validation fv-plugins-icon-container">
                                <label for="email" class="form-label fs-6">ອີເມວລ໌:</label>
                                <input type="text" v-model="user_email" class="form-control" id="email" name="email-username"
                                    placeholder="ປ້ອນອີເມວລ໌" autofocus="">
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="mb-6 form-password-toggle form-control-validation fv-plugins-icon-container">
                                <label class="form-label fs-6" for="password">ລະຫັດຜ່ານ</label>
                                <div class="input-group input-group-merge has-validation">
                                    <input type="password" v-model="password" id="password" class="form-control" name="password"
                                        placeholder="············">
                                    <span class="input-group-text cursor-pointer"><i
                                            class="icon-base bx bx-hide"></i></span>
                                </div>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="mb-6 form-password-toggle form-control-validation fv-plugins-icon-container">
                                <label class="form-label fs-6" for="password">ຢືນຢັນລະຫັດຜ່ານ</label>
                                <div class="input-group input-group-merge has-validation">
                                    <input type="password" v-model="password2" id="password2" class="form-control" name="password2"
                                        placeholder="············" aria-describedby="password">
                                    <span class="input-group-text cursor-pointer"><i
                                            class="icon-base bx bx-hide"></i></span>
                                </div>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="alert alert-warning fs-6" role="alert" v-if="text_error"> {{ text_error }} </div>
                            <div class="mb-6">
                                <button class="btn btn-primary d-grid w-100" @click="Register()" type="submit">ລົງທະບຽນ</button>
                            </div>
                            <input type="hidden">
                        <p class="text-center">
                            <span>ມີບັນຊີແລ້ວ? </span>
                            <router-link to="/login">
                                <span>ເຂົ້າສູ່ລະບົບ</span>
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
                user_name:'',
                user_email:'',
                password:'',
                password2:'',
                text_error:''
            }
        },
        methods: {
            Register(){
                if( this.user_name == '' || this.user_email == '' || this.password == ''){
                    this.text_error = 'ກະລຸນາປ້ອນຂໍ້ມູນໃຫ້ຄົບຖ້ວນ';
                } else {
                    if(this.password != this.password2){
                        this.text_error = 'ລະຫັດຜ່ານບໍ່ກົງກັນ!';
                    }else{
                        this.text_error = '';

                        axios.post('api/register',{ 
                            form_user_name: this.user_name,
                            form_user_email: this.user_email,
                            form_password: this.password
                        }).then((res)=>{
                            if(res.data.success){
                                this.text_error = '';
                                 //go to login page with user data
                                this.$router.push({ path:'/login', query: { email: this.user_email } });
                                //clear Form
                                this.user_name = '';
                                this.user_email = '';
                                this.password = '';
                                this.password2 = '';
                            } else {
                                this.text_error = res.data.message;
                            }
                            console.log(res)
                        }).catch((error) => {
                            console.log(err)
                        });
                    }
                    
                }
            }
        },
    }

</script>
<style lang="">

</style>
