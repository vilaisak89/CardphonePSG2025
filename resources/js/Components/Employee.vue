<template lang="">
    <div>
        <div class="col-lg-12 mb-12 mb-xl-0">
          <div class="card-header d-flex justify-content-between pb-2">
            <div class="card-title mb-0">
                <h6 class="mb-3 me-2 text-dark fs-5 fw-bold">* ລາຍຊື່ພະນັກງານໃນກຸ່ມບໍລິສັດພອນສັກກຣຸບ</h6>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-1">
              <div class="d-flex align-items-center">
                <button class="btn btn-info material-shadow-none me-2" v-if="Sort=='asc'" @click="Sort='desc'" style="padding: 3px;">
                    <i class='bx bx-sort-up fs-4 cursor-pointer'></i>
                </button>
                <button class="btn btn-info material-shadow-none me-2" v-if="Sort=='desc'" @click="Sort='asc'" style="padding: 3px;">
                    <i class='bx bx-sort-down fs-4 cursor-pointer'></i>
                </button>
                <div class="d-flex col-md-8">
                    <div class="col-md-3 me-2">
                      <select class="form-select text-dark me-3" v-model="PerPage" @change="GetEmp(1)">
                          <option value="5">5</option>
                          <option value="10">10</option>
                          <option value="20">20</option>
                      </select>
                    </div>
                    <div class="col-md-4 me-2">
                        <select class="form-select text-dark" v-model="company" @change="GetEmp(1)">
                          <option value="all">ເລືອກບໍລິສັດ</option>
                          <option v-for="item in CompData" :key="item.id" :value="item.id">{{ item.name_company }}</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select class="form-select text-dark" v-model="deparment" @change="GetEmp(1)">
                        <option value="all">ເລືອກພະແນກ</option>
                        <option v-for="item in filteredDepartments" :key="item.id" :value="item.id">{{ item.name_deparment }}</option>
                        </select>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-1">
                <div class="d-flex justify-content-end">
                  <div class="d-flex col-md-7">
                  <div class="input-group me-3">
                      <input type="text" class="form-control" v-model="Search" placeholder="ຄົ້ນຫາພະນັກງານ...">
                  </div>
                  <button type="button" @click="AddEmp()" class="btn btn-primary"><i class='bx bx-list-plus fs-4 me-2'></i>ເພີ່ມ</button>
                </div>
                </div>
            </div>
          </div> 
          <div class="table-responsive">
            <table class="table table-responsive table-sm mt-4 dataTable dtr-inline border border-2 table-hover">
              <thead class="table-primary text-nowrap">
                <tr>
                    <th class="fs-6 text-dark fw-bold">ລຳດັບ</th>
                    <th class="fs-6 text-dark text-center fw-bold">ຮູບ</th>
                    <th class="fs-6 text-dark fw-bold">ຊື່ ແລະ ນາມສະກຸນ</th>
                    <th class="fs-6 text-dark fw-bold">ຕຳແໜ່ງ</th>
                    <th class="fs-7 text-dark fw-bold">Cost Center</th>
                    <th class="fs-7 text-dark fw-bold">LG Account</th>
                    <th class="fs-6 text-dark fw-bold">ພະແນກ</th>
                    <th class="fs-6 text-dark fw-bold">ບໍລິສັດ</th>
                    <th class="fs-6 text-dark fw-bold">ເບີໄທລະສັບ</th>
                    <th class="fs-6 text-dark fw-bold text-center">ຈັດການ</th>
                </tr>
              </thead>
              <tbody class="text-nowrap">
                <tr v-for="item in EmpData.data" :key="item">
                    <td class="text-dark text-sm">{{ item.id }}</td>
                    <td class="text-nowrap text-dark fs-6">
                      <img v-if="item.employee_img" :src="url + '/assets/img/'+ item.employee_img" class="list-img border-1 p-1 rounded shadow-sm">
                      <img v-else :src="url + '/assets/img/no_image1.png'" class="list-img border-1 p-1 rounded shadow-sm">
                    </td>
                    <td class="text-nowrap text-dark fs-6">{{ item.employee_name }}</td>
                    <td class="text-nowrap text-dark fs-6">{{ item.position }}</td>
                    <td class="text-nowrap text-dark fs-6">{{ item.costcenter}}</td>
                    <td class="text-nowrap text-dark fs-6">{{ item.lgaccount}}</td>
                    <td class="text-nowrap text-dark fs-6">{{ item.name_deparment}}</td>
                    <td class="text-nowrap text-dark fs-6">{{ item.name_company}}</td>
                    <td class="text-nowrap text-dark fs-6">{{ item.employee_phone}}</td>
                    <td class="text-center text-nowrap">
                    <button type="button" @click="EditEmp(item.id)" class="badge btn btn-sm btn-icon bg-label-warning me-2">
                      <span class="icon-base bx bx-edit icon-sm"></span>
                    </button>
                    <button type="button" @click="DelEmp(item.id)" class="badge btn btn-sm btn-icon bg-label-danger">
                      <span class="icon-base bx bx-trash icon-sm"></span>
                    </button>                 
                    </td>
                </tr>
              </tbody>
            </table>
            <pagination :pagination="EmpData" :offset="4" @paginate='GetEmp($event)' />
          </div>
          
        </div>
        <!-- Modal Form Company -->
        <div class="modal fade" id="FormEmp" data-bs-backdrop="static" tabindex="-1" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title fs-5 fw-bold" id="backDropModalTitle">* ຟອມຈັດການຊື່ພະນັກງານໃນກຸ່ມບໍລິສັດພອນສັກກຣຸບ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <!-- {{ FormEmp }} -->
              <div class="modal-body">   
                <div class="row g-6 mb-2">
                  <div class="col-md-2 d-flex justify-content-center border border-1" style=" position:relative;">
                      <button type="button" v-if="FormEmp.employee_img" @click="RemoveImg()" class="btn rounded-pill btn-icon btn-danger btn-sm img-x">
                          <i class='bx bx-trash fs-5'></i>
                      </button>
                      <img :src="Image_preview" @click="$refs.img_emp.click()" class="img-emp rounded cursor-pointer">
                      <input type="file" ref="img_emp" style="display:none;" @change="onSelect($event)">
                  </div>

                  <div class="col-md-10">
                    <div class="row">
                      <div class="col-md-4 mb-2">
                        <label class="form-label fs-6" for="basic-icon-default-fullname">ຊື່ ແລະ ນາມສະກຸນ:</label>
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-fullname2" class="input-group-text"><i class="icon-base bx bx-user"></i></span>
                          <input type="text" v-model="FormEmp.employee_name" class="form-control" id="basic-icon-default-fullname" placeholder="ປ້ອນ ຊື່ ແລະ ນາມສະກຸນ" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                        </div>
                      </div>
                      <div class="col-md-4 mb-2">
                          <label class="form-label fs-6">Cost Center:</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="icon-base bx bx-wallet-alt"></i></span>
                            <input type="text" v-model="FormEmp.costcenter" class="form-control" id="basic-icon-default-fullname" placeholder="ປ້ອນ Cost Center" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                          </div>
                      </div>
                      <div class="col-md-4 mb-2">
                          <label class="form-label fs-6">LG Account:</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="icon-base bx bxs-user-account"></i></span>
                            <input type="text" v-model="FormEmp.lgaccount" class="form-control" id="basic-icon-default-fullname" placeholder="ປ້ອນ LG Account" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                          </div>
                      </div>
                      <div class="col-md-4 mb-2">
                          <label class="form-label fs-6">ບໍລິສັດ:</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="icon-base bx bx-buildings"></i></span>
                            <select class="form-select ps-3" v-model="FormEmp.company_id">
                                <option value="">ເລືອກບໍລິສັດ</option>
                                <option v-for="item in CompData" :key="item.id" :value="item.id">{{ item.name_company }}</option>
                                
                            </select>
                          </div>
                      </div>
                      <div class="col-md-4 mb-2">
                          <label class="form-label fs-6">ພະແນກ:</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="icon-base bx bx-sitemap"></i></span>
                            <select class="form-select ps-3" v-model="FormEmp.deparment_id" :disabled="!FormEmp.company_id">
                                <option value="">ເລືອກພະແນກ</option>
                                <option v-for="item in filteredDepartmentsForm" :key="item.id" :value="item.id">{{ item.name_deparment }}</option>
                            </select>
                          </div>
                      </div>
                      <div class="col-md-4 mb-2">
                        <label class="form-label fs-6" for="basic-icon-default-fullname">ຕຳແໜ່ງ:</label>
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-fullname2" class="input-group-text"><i class="icon-base bx bx-spreadsheet"></i></span>
                          <input type="text" v-model="FormEmp.position" class="form-control" id="basic-icon-default-fullname" placeholder="ປ້ອນຕຳແໜ່ງ" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label fs-6">ເບີໂທລະສັບ:</label>
                            <div class="input-group input-group-merge">
                              <span id="basic-icon-default-fullname2" class="input-group-text"><i class="icon-base bx bx-phone"></i></span>
                              <input type="text" v-model="FormEmp.employee_phone" class="form-control" id="basic-icon-default-fullname" placeholder="ປ້ອນເບີໂທລະສັບ" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-6">ໝາຍເຫດ:</label>
                              <input type="text" v-model="FormEmp.remark" class="form-control" id="basic-icon-default-fullname" placeholder="....." aria-label="John Doe" aria-describedby="basic-icon-default-fullname2">
                        </div>
                  </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" :disabled="CheckForm" @click="SaveEmp()">ບັນທຶກ</button>
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
        FormEmp:{
          company_id: '',
          deparment_id: '',
          employee_name: '',
          employee_img: '',
          position: '',
          costcenter: '',
          lgaccount: '',
          employee_phone: '',
          remark: ''
        },
        FormType:true,
        EmpData:[],
        EditID:'',
        Sort: "desc",
        PerPage:10,
        url: window.location.origin,
        Image_preview: window.location.origin + '/assets/img/upload-file.png',
        Search:'',
        CompData:[],
        company:'all',
        DepData:[],
        deparment:'all'
      }
    },
    computed:{
      CheckForm(){
        if(this.FormEmp.company_id == '' || this.FormEmp.deparment_id == '' || this.FormEmp.employee_name == '' || this.FormEmp.position == '' || this.FormEmp.costcenter == '' || this.FormEmp.lgaccount == '' || this.FormEmp.employee_phone == ''){
          return true;
        } else {
          return false;
        }
      },
      filteredDepartments() {
        if (this.company === 'all') {
            return [];
        }
        return this.DepData.data.filter(dep => dep.company_id == this.company);
      },
      filteredDepartmentsForm() {
        // console.log("filtering for company_id:", this.FormEmp.company_id);
        if (!this.FormEmp.company_id) {
          return [];
        }
        return this.DepData.data.filter(dep => dep.company_id == this.FormEmp.company_id);
      }
    },
    methods: {
      RemoveImg(){
        this.FormEmp.employee_img = '';
        this.Image_preview = window.location.origin + '/assets/img/upload-file.png';
      },
      onSelect(event){
       console.log(event);
          this.FormEmp.employee_img = event.target.files[0];
          let reader = new FileReader();
          reader.readAsDataURL(this.FormEmp.employee_img);
          reader.addEventListener("load", function(){
              this.Image_preview = reader.result
          }.bind(this,false));
      },
      AddEmp() {
        $('#FormEmp').modal('show');
        this.FormType = true;
        this.FormEmp = {
          company_id: '',
          deparment_id: '',
          employee_name: '',
          employee_img: '',
          position: '',
          costcenter: '',
          lgaccount: '',
          employee_phone: '',
          remark: ''
        };
        this.Image_preview = this.url + '/assets/img/upload-file.png';
        this.GetEmp();
      },
      EditEmp(id) {
        this.EditID = id;
        this.FormType = false;

        axios.get(`api/emp/edit/${id}`,{ headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res)=>{
          this.FormEmp =res.data;
          //Get image
          if (this.FormEmp.employee_img) {
              this.Image_preview = this.url + '/assets/img/' + this.FormEmp.employee_img;
          } else {
              this.Image_preview = this.url + '/assets/img/upload-file.png';
          }

          $('#FormEmp').modal('show');

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
      DelEmp(id) {
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
              axios.delete(`api/emp/delete/${id}`,{ headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res)=>{
              if(res.data.success){
                this.$swal({
                    toast: true,
                    position: "top-end",
                    icon: "success",
                    title: res.data.message,
                    showConfirmButton: false,
                    timer: 2000
                });
                this.GetEmp();
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
      SaveEmp() {
        if(this.FormType) {
          //Add
          axios.post('api/emp/add', this.FormEmp, { headers: { "content-Type":"multipart/form-data", Authorization: 'Bearer ' + this.store.get_token }}).then((res)=>{
            if(res.data.success){
              $('#FormEmp').modal('hide');
              this.GetEmp();
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
          axios.post(`api/emp/update/${this.EditID}`,this.FormEmp, { headers: { "content-Type":"multipart/form-data", Authorization: 'Bearer ' + this.store.get_token }}).then((res)=>{
            if(res.data.success){
              $('#FormEmp').modal('hide');
              this.GetEmp();
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
      GetEmp(page) {
        axios.get(`api/emp?page=${page}&sort=${this.Sort}&perpage=${this.PerPage}&search=${this.Search}&company=${this.company}&deparment=${this.deparment}`, { headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res) => {
            // console.log("Response Data:", res.data);
            this.EmpData = res.data;
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
    },
    created() {
      this.GetEmp(1);
      this.GetComp();
      this.GetDep();
    },
    watch:{
      Sort(){
        this.GetEmp(1);
      },
      Search() {
        this.GetEmp();
      },
      'FormEmp.company_id'(newVal) {
        this.FormEmp.deparment_id = '';
      }
    }
}
</script>
<style scoped>
    .img-emp{
        width: 80%;
        height: auto;
        object-fit: contain;
    }
    .img-x{
        position: absolute;
        top: 5px;
        right: 10px;
    }
    .list-img{
        width: 50px;
        height: 50px;
        object-fit: cover;
        object-position: center;
    }
</style>