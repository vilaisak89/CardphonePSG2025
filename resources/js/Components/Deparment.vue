<template lang="">
    <div>
        <div class="col-lg-7 mb-7 mb-xl-0">
          <div class="card-header d-flex justify-content-between pb-2">
            <div class="card-title mb-0">
              <h6 class="mb-1 me-2 text-dark fw-bold">* ຈັດການຊື່ບັນດາພະແນກຂອງບໍລິສັດໃນກຸ່ມ</h6>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-2">
              <div class="d-flex align-items-center">
                <button class="btn btn-info material-shadow-none me-2" v-if="Sort=='asc'" @click="Sort='desc'" style="padding: 3px;">
                    <i class='bx bx-sort-up fs-4 cursor-pointer'></i>
                </button>
                <button class="btn btn-info material-shadow-none me-2" v-if="Sort=='desc'" @click="Sort='asc'" style="padding: 3px;">
                    <i class='bx bx-sort-down fs-4 cursor-pointer'></i>
                </button>
                <div class="d-flex col-md-10">
                  <div class="col-md-4 me-2">
                  <select class="form-select text-dark me-3" v-model="PerPage" @change="GetDep(1)">
                      <option value="5">5</option>
                      <option value="10">10</option>
                      <option value="20">20</option>
                  </select>
                  </div>
                  <div class="col-md-8">
                  <select class="form-select text-dark" v-model="company" @change="GetDep(1)">
                      <option value="all">ບໍລິສັດທັງໝົດ</option>
                      <option v-for="item in CompData" :key="item.id" :value="item.id">{{ item.name_company }}</option>
                  </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-2">
              <div class="d-flex justify-content-end">
                <!-- <div class="input-group">
                    <input type="text" class="form-control" @keyup.enter="GetDep(1)" v-model="Search" placeholder="ຄົ້ນຫາ...">
                    <button class="btn btn-primary px-2 me-2" type="button" @click="GetDep(1)"><i class='bx bx-search-alt'></i></button>
                </div> -->
                <button type="button" @click="AddDep()" class="btn btn-sm rounded-pill btn-icon btn-primary">
                  <i class="bx bx-plus fs-4"></i>
                </button>
                <!-- <button type="button" @click="AddDep()" class="btn btn-primary"><i class='bx bx-list-plus fs-4 me-2'></i>ເພີ່ມ</button> -->
              </div>
            </div>
          </div>
          
            <div class="table-responsive">
              <table class="table table-sm border border-2 table-hover table-nowrap mb-0">
                <thead class="table-primary text-nowrap">
                  <tr>
                    <th class="fs-6 text-dark fw-bold " style="width: 10%;">ລຳດັບ</th>
                    <th class="fs-6 text-dark fw-bold " style="width: 35%;">ຊື່ພະແນກ</th>
                    <th class="fs-6 text-dark fw-bold " style="width: 40%;">ຂື້ນກັບບໍລິສັດ</th>
                    <th class="fs-6 text-dark fw-bold text-center" style="width: 15%;">ຈັດການ</th>
                  </tr>
                </thead>
                <tbody class="text-nowrap">
                  <tr v-for="item in DepData.data" :key="item">
                    <td class="text-sm text-dark">{{ item.id }}.</td>
                    <td class="text-nowrap text-dark fs-6">{{ item.name_deparment }}</td>
                    <td class="text-nowrap text-dark fs-6">{{ item.fullname_company }}</td>
                    <td class="text-center text-nowrap">
                      <button type="button" @click="EditDep(item.id)" class="badge btn btn-sm btn-icon bg-label-warning me-2">
                        <span class="icon-base bx bx-edit icon-sm"></span>
                      </button>
                      <button type="button" @click="DelDep(item.id)" class="badge btn btn-sm btn-icon bg-label-danger">
                        <span class="icon-base bx bx-trash icon-sm"></span>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <pagination :pagination="DepData" :offset="4" @paginate='GetDep($event)' />
            </div>
          
        </div>
        <!-- Modal Form Company -->
        <div class="modal fade" id="FormDep" data-bs-backdrop="static" tabindex="-1" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title fw-bold" id="backDropModalTitle">* ຈັດການຊື່ບັນດາພະແນກຂອງບໍລິສັດໃນກຸ່ມ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <!-- {{ FormDep }} -->
              <div class="modal-body">   
                <div class="row g-6 mb-2">
                  <div class="col mb-0">
                    <label for="emailBackdrop" class="form-label fs-6">ຊື່ພະແນກ:</label>
                    <input type="text" id="emailBackdrop" v-model="FormDep.name_deparment" class="form-control" placeholder="ປ້ອນຊື່ຫຍໍ້ບໍລິສັດ">
                  </div>
                  <div class="col mb-0">
                    <label for="dobBackdrop" class="form-label fs-6">ຂື້ນກັບບໍລິສັດ:</label>
                    <!-- <input type="text" id="dobBackdrop" v-model="FormDep.company_id" class="form-control" placeholder="ປ້ອນຊື່ເຕັມບໍລິສັດ"> -->   
                    <select class="form-select" v-model="FormDep.company_id">
                      <option value=""> ເລືອກບໍລິສັດ </option>
                      <option v-for="item in CompData" :key="item.id" :value="item.id">{{ item.name_company }}</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col mb-6">
                    <label for="nameBackdrop" class="form-label fs-6">ໝາຍເຫດ:</label>
                    <input type="text" id="nameBackdrop" v-model="FormDep.remark" class="form-control" placeholder="...">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" :disabled="CheckForm" @click="SaveDep()">ບັນທຶກ</button>
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
      company:'all',
      CompData:[],
      FormDep:{
        company_id: '',
        name_deparment: '',
        remark: ''
      },
      Sort: "desc",
      FormType:true,
      DepData:[],
      EditID:'',
      Sort:"desc",
      PerPage:5,
      Search:''
    }
  },
  computed:{
    CheckForm(){
      if(this.FormDep.name_deparment == '' || this.FormDep.company_id == ''){
        return true;
      } else {
        return false;
      }
    }
  },
  methods: {
    AddDep() {
      $('#FormDep').modal('show');
      this.FormType = true;
      this.GetComp();
      this.FormDep = {
        company_id: '',
        name_deparment: '',
        remark: ''
      }
    },
    EditDep(id){
      this.EditID = id;
      this.FormType = false;

      axios.get(`api/dep/edit/${id}`,{ headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res)=>{
        this.FormDep =res.data;
        $('#FormDep').modal('show');

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
    DelDep(id) {
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
            axios.delete(`api/dep/delete/${id}`,{ headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res)=>{
            if(res.data.success){
              this.$swal({
                  toast: true,
                  position: "top-end",
                  icon: "success",
                  title: res.data.message,
                  showConfirmButton: false,
                  timer: 2000
              });
              this.GetDep();
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
    SaveDep() {
      if(this.FormType){
        //Add
        axios.post('api/dep/add', this.FormDep, { headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res)=>{
          if(res.data.success){
            $('#FormDep').modal('hide');
            this.GetDep();
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
        axios.post(`api/dep/update/${this.EditID}`,this.FormDep, { headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res)=>{
          if(res.data.success){
            $('#FormDep').modal('hide');
            this.GetDep();
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
    GetDep(page) {
      axios.get(`api/dep?page=${page}&sort=${this.Sort}&perpage=${this.PerPage}&search=${this.Search}&company=${this.company}`, { headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res) => {
          // console.log("Response Data:", res.data);
          this.DepData = res.data;
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
    this.GetDep(1);
  },
  watch:{
    Sort(){
      this.GetDep(1);
    },
    Search(){
      // if(this.Search == ''){
      //   this.GetDep(1);
      // }
      this.GetDep();
    },
  }
}
</script>
<style>

</style>