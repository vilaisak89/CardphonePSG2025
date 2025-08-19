<template lang="">
  <div>
    <h1>Home Page</h1>
    <button @click="testjwt()">Test JWT</button>
  </div>
</template>
<script>

import axios from 'axios';
import { useStore } from '../Store/Auth';

export default {
  setup() {
      const store = useStore();
      return { store }
  },
  data() {
    return {
      
    }
  },
  methods: {
    testjwt(){
      axios.post('api/testjwt', {}, { headers: { Authorization: 'Bearer ' + this.store.get_token } }).then((res)=>{

      }).catch((error)=>{
          //console.log(error)
          if (error.response) {
              if (error.response.status != 200) {
                  //ກໍລະນີ token ໝົດອາຍຸ ຫຼື ນຳໃຊ້ບໍ່ໄດ້
                  if (error.response.status == 401) {
                      // clear data from localstorage
                      localStorage.removeItem('web_token');
                      localStorage.removeItem('web_user');

                      //clear data from pinia
                      this.store.remove_token();
                      this.store.remove_user();

                      //user go to login page
                      this.$router.push('/login');
                  }
              }
          }
      });
    }
  },
}
</script>
<style lang="">
  
</style>