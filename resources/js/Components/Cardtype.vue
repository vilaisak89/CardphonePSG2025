<template lang="">
    <div>
        <div class="col-lg-4 mb-4 mb-xl-0">
          <div class="card-header d-flex justify-content-between pb-0">
            <div class="card-title mb-0">
              <h6 class="mb-1 me-2 fw-bold">* ຈັດການປະເພດບັດໂທລະສັບ</h6>
            </div>
            <button type="button" @click="AddCardtype()" class="btn btn-sm rounded-pill btn-icon btn-primary">
              <i class="bx bx-plus fs-4"></i>
            </button>
          </div>
          
          <div class="table-responsive">
            <table class="table table-responsive table-sm mt-4 dataTable dtr-inline border border-2 table-hover">
              <thead class="table-primary text-nowrap">
                <tr>
                  <th class="fs-6 text-dark fw-bold" style="width: 10%;">#</th>
                  <th class="fs-6 text-dark fw-bold" style="width: 75%;">ປະເພດບັດໂທລະສັບ</th>
                  <th class="fs-6 text-dark fw-bold text-center" style="width: 15%;">ຈັດການ</th>
                </tr>
              </thead>
              <tbody class="text-nowrap">
                <tr v-for="item in CardtypeData" :key="item">
                  <td class="text-dark text-sm">{{ item.id }}.</td>
                  <td class="text-nowrap text-dark fs-6">{{ item.cardtype_name }}</td>
                  <td class="justify-content-center text-nowrap">
                    <button type="button" @click="Editcardtype(item.id)" class="badge btn btn-sm btn-icon bg-label-warning me-2">
                      <span class="icon-base bx bx-edit icon-sm"></span>
                    </button>
                    <button type="button" @click="DelCardtype(item.id)" class="badge btn btn-sm btn-icon bg-label-danger">
                      <span class="icon-base bx bx-trash icon-sm"></span>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          
        </div>
        <!-- Modal Form Company -->
        <div class="modal fade" id="FormCardtype" data-bs-backdrop="static" tabindex="-1" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title fw-bold" id="backDropModalTitle">* ຈັດການປະເພດບັດໂທລະສັບ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <!-- {{ FormCardtype }} -->
              <div class="modal-body">
                <div class="row g-6 mb-2">
                  <div class="col mb-0">
                    <label for="emailBackdrop" class="form-label fs-6">ຊື່ປະເພດບັດໂທລະສັບ:</label>
                    <input type="text" id="emailBackdrop" v-model="FormCardtype.cardtype_name" class="form-control" placeholder="ປ້ອນຊື່ປະເພດບັດໂທລະສັບ">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" :disabled="CheckForm" @click="SaveCardtype()">ບັນທຶກ</button>
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">ປິດ</button>
              </div>
            </div>
          </div>
        </div>
    </div>
</template>
<script>

import axios from 'axios';
import { useStore } from '../Store/Auth';

export default {
    setup(){
      const store = useStore();
      return { store }
    },
    data() {
        return {
            FormCardtype: {
              cardtype_name:''
            },
            FormType:true,
            CardtypeData:[],
            EditID:''
        }
    },
    computed:{
      CheckForm(){
        if(this.FormCardtype.cardtype_name == ''){
          return true;
        } else {
          return false;
        }
      }
    },
    methods: {
      AddCardtype() {
        $('#FormCardtype').modal('show');
        this.FormType = true;
        this.FormCardtype = {
          cardtype_name: ''
        }
      },
      Editcardtype(id) {
        this.EditID = id;
        this.FormType = false;

        axios.get(`api/cardtype/edit/${id}`,{ headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res)=>{
          this.FormCardtype =res.data;
          $('#FormCardtype').modal('show');

        }).catch((error)=>{
            if(error.response){
              if(error.response.status==401){
                  // clear information from localstorage
                  localStorage.removeItem('web_token');
                  localStorage.removeItem('web_user');
                  //clear information from pinia
                  this.store.remove_token();
                  this.store.remove_user();
                  //user go to login page
                  this.$router.push('/login');
              }
            }
        })
      },
      DelCardtype(id) {
        this.$swal({
          title: "ທ່ານແນ່ໃຈບໍ່?",
          text: "ທີ່ຈະລຶບຂໍ້ມູນນີ້! ກົດຕົກລົງແລ້ວຈະບໍ່ສາມາດເອີ້ນຄືນໄດ້",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#DCDCDC",
          confirmButtonText: "ຕົກລົງ!",
          cancelButtonText: "ຍົກເລີກ!",
        }).then((result) => {
          if(result.isConfirmed){
              axios.delete(`api/cardtype/delete/${id}`,{ headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res)=>{
              if(res.data.success){
                this.$swal({
                    toast: true,
                    position: "top-end",
                    icon: "success",
                    title: res.data.message,
                    showConfirmButton: false,
                    timer: 2000
                });
                this.GetCardtype();
              } else {
                this.$swal({
                    icon: "error",
                    title: "ຜິດຜາດ!",
                    text: res.data.message,
                    showConfirmButton: false,
                    timer: 3500
                });
              }
            });
          }
        
        }).catch((error)=>{
          if(error.response){
              if(error.response.status==401){
                  // clear information from localstorage
                  localStorage.removeItem('web_token');
                  localStorage.removeItem('web_user');
                  //clear information from pinia
                  this.store.remove_token();
                  this.store.remove_user();
                  //user go to login page
                  this.$router.push('/login');
              }
            }
        })
      },
      SaveCardtype() {
        if(this.FormType){
          //Add
          axios.post('api/cardtype/add', this.FormCardtype, { headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res)=>{
          if(res.data.success){
            $('#FormCardtype').modal('hide');
            this.GetCardtype();
            this.$swal({
                toast: true,
                position: "top-end",
                icon: "success",
                title: res.data.message,
                showConfirmButton: false,
                timer: 2000
            });
          } else {
            this.$swal({
                icon: "error",
                title: "ຜິດຜາດ!",
                text: res.data.message,
                showConfirmButton: false,
                timer: 3500
            });
          }

        }).catch((error)=>{
          if(error.response){
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
        });

        } else {
          //update
          axios.post(`api/cardtype/update/${this.EditID}`,this.FormCardtype, { headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res)=>{
            if(res.data.success){
              $('#FormCardtype').modal('hide');
              this.GetCardtype();
              this.$swal({
                  toast: true,
                  position: "top-end",
                  icon: "success",
                  title: res.data.message,
                  showConfirmButton: false,
                  timer: 2000
              });
            } else {
              this.$swal({
                  icon: "error",
                  title: "ຜິດຜາດ!",
                  text: res.data.message,
                  showConfirmButton: false,
                  timer: 3500
              });
            }

          }).catch((error)=>{
            if(error.response){
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
          });
        }
      },
      GetCardtype() {
        axios.get(`api/cardtype`, { headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res) => {
          // console.log("Response Data:", res.data);
          this.CardtypeData = res.data;
        }).catch((error) => {
            if (error.response) {
                if (error.response.status == 401) {
                    // clear information from localstorage
                    localStorage.removeItem('web_token');
                    localStorage.removeItem('web_user');

                    //clear information from pinia
                    this.store.remove_token();
                    this.store.remove_user();

                    //user go to login page
                    this.$router.push('/login');
                }
            }
        });
      }
    },
    created() {
      this.GetCardtype();
    },
    
}
</script>
<style lang="">
    
</style>