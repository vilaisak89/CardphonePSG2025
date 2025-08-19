<template lang="">
    <div>
        <div class="col-lg-7 mb-7 mb-xl-0">
          <div class="card-header d-flex justify-content-between pb-5">
            <div class="card-title mb-0">
              <h6 class="mb-1 me-2 text-dark fs-5 fw-bold">* ລາຍຊື່ບັນດາບໍລິສັດໃນກຸ່ມບໍລິສັດພອນສັກ</h6>
            </div>
            <!-- <button type="button" @click="AddComp()" class="btn btn-sm rounded-pill btn-icon btn-info">
              <i class="bx bx-plus fs-4"></i>
            </button> -->
            <button type="button" @click="AddComp()" class="btn btn-primary">
              <i class='bx bx-list-plus fs-4 me-2'></i>ເພີ່ມບໍລິສັດ
            </button>
          </div>
          
          <div class="table-responsive">
            <table class="table table-sm border border-2 table-hover">
              <thead class="table-primary text-nowrap">
                <tr>
                  <th class="fs-6 text-dark fw-bold" style="width: 10%;">ລຳດັບ</th>
                  <th class="fs-6 text-dark fw-bold text-center" style="width: 35%;">Logo</th>
                  <th class="fs-6 text-dark fw-bold text-center" style="width: 35%;">ຊື່ຫຍໍ້</th>
                  <th class="fs-6 text-dark fw-bold text-center" style="width: 40%;">ຊື່ເຕັມ</th>
                  <th class="fs-6 text-dark fw-bold text-center" style="width: 15%;">ຈັດການ</th>
                </tr>
              </thead>
              <tbody class="text-nowrap">
                <tr v-for="item in CompData" :key="item">
                  <td class="text-dark text-sm">{{ item.id }}.</td>
                  <td class="text-nowrap text-dark fs-6">image</td>
                  <td class="text-nowrap text-dark fs-6">{{ item.name_company }}</td>
                  <td class="text-nowrap text-dark fs-6">{{ item.fullname_company }}</td>
                  <td class="text-center text-nowrap">
                    <button type="button" @click="EditComp(item.id)" class="badge btn btn-sm btn-icon bg-label-warning me-2">
                      <span class="icon-base bx bx-edit icon-sm"></span>
                    </button>
                    <button type="button" @click="DelComp(item.id)" class="badge btn btn-sm btn-icon bg-label-danger">
                      <span class="icon-base bx bx-trash icon-sm"></span>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- Modal Form Company -->
        <div class="modal fade" id="FormComp" data-bs-backdrop="static" tabindex="-1" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title fw-bold" id="backDropModalTitle">* ຈັດການລາຍຊື່ບໍລິສັດໃນກຸ່ມ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <!-- {{ FormComp }} -->
              <div class="modal-body">
                <div class="row g-6 mb-2">
                  <div class="col mb-0">
                    <label for="emailBackdrop" class="form-label fs-6">ຊື່ຫຍໍ້ບໍລິສັດ:</label>
                    <input type="text" id="emailBackdrop" v-model="FormComp.name_company" class="form-control" placeholder="ປ້ອນຊື່ຫຍໍ້ບໍລິສັດ">
                  </div>
                  <div class="col mb-0">
                    <label for="dobBackdrop" class="form-label fs-6">ປ້ອນຊື່ເຕັມບໍລິສັດ:</label>
                    <input type="text" id="dobBackdrop" v-model="FormComp.fullname_company" class="form-control" placeholder="ປ້ອນຊື່ເຕັມບໍລິສັດ">
                  </div>
                </div>
                <div class="row">
                  <div class="col mb-6">
                    <label for="nameBackdrop" class="form-label fs-6">ໝາຍເຫດ:</label>
                    <input type="text" id="nameBackdrop" v-model="FormComp.remark" class="form-control" placeholder="...">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" :disabled="CheckForm" @click="SaveComp()">ບັນທຶກ</button>
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
        FormComp:{
          name_company: '',
          fullname_company: '',
          remark: ''
        },
        FormType:true,
        CompData:[],
        EditID:'',
      }
    },
    computed:{
      CheckForm(){
        if(this.FormComp.name_company == '' || this.FormComp.fullname_company == ''){
          return true;
        } else {
          return false;
        }
      }
    },
    methods: {
      AddComp() {
        $('#FormComp').modal('show');
        this.FormType = true;
        this.FormComp ={
          name_company: '',
          fullname_company: '',
          remark: ''
        }
      },
      EditComp(id){
        this.EditID = id;
        this.FormType = false;

        axios.get(`api/comp/edit/${id}`,{ headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res)=>{
          this.FormComp =res.data;
          $('#FormComp').modal('show');

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
      DelComp(id) {
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
              axios.delete(`api/comp/delete/${id}`,{ headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res)=>{
              if(res.data.success){
                this.$swal({
                    toast: true,
                    position: "top-end",
                    icon: "success",
                    title: res.data.message,
                    showConfirmButton: false,
                    timer: 2000
                });
                this.GetComp();
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
      SaveComp() {
        if(this.FormType){
          //Add
          axios.post('api/comp/add', this.FormComp, { headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res)=>{
            if(res.data.success){
              $('#FormComp').modal('hide');
              this.GetComp();
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
          //Update
          axios.post(`api/comp/update/${this.EditID}`,this.FormComp, { headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res)=>{
            if(res.data.success){
              $('#FormComp').modal('hide');
              this.GetComp();
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
      GetComp(){
        axios.get(`api/comp`, { headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res) => {
            // console.log("Response Data:", res.data);
            this.CompData = res.data;
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
      },
    },
    created() {
      this.GetComp();
    },
}
</script>
<style>
   .swal2-container {
  z-index: 9999 !important;
}
 
</style>