<template lang="">
    <div>
        <div class="col-lg-6 mb-6 mb-xl-0">
          <div class="card-header d-flex justify-content-between pb-2">
            <div class="card-title mb-0">
              <h6 class="mb-1 me-2 fw-bold">* ຈັດການລາຄາບັດໂທລະສັບ</h6>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-0">
              <div class="d-flex align-items-center">
                <button class="btn btn-info material-shadow-none me-2" v-if="Sortcp=='asc'" @click="Sortcp='desc'" style="padding: 3px;">
                    <i class='bx bx-sort-up fs-4 cursor-pointer'></i>
                </button>
                <button class="btn btn-info material-shadow-none me-2" v-if="Sortcp=='desc'" @click="Sortcp='asc'" style="padding: 3px;">
                    <i class='bx bx-sort-down fs-4 cursor-pointer'></i>
                </button>
                <div class="d-flex col-md-10">
                  <div class="col-md-4 me-2">
                  <select class="form-select text-dark me-3" v-model="PerPage" @change="GetCardprice(1)">
                      <option value="5">5</option>
                      <option value="10">10</option>
                      <option value="20">20</option>
                  </select>
                  </div>
                  <div class="col-md-8">
                    <select class="form-select text-dark" v-model="cardtype" @change="GetCardprice(1)">
                      <option value="all">ເຄືອຄ່າຍທັງໝົດ</option>
                      <option v-for="item in CardtypeData" :key="item.id" :value="item.id">{{ item.cardtype_name }}</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-2">
              <div class="d-flex justify-content-end">
                <div class="input-group">
                    <input type="text" class="form-control" @keyup.enter="GetCardprice(1)" v-model="Search" placeholder="ຄົ້ນຫາ...">
                    <button class="btn btn-primary px-2 me-2" type="button" @click="GetCardprice(1)"><i class='bx bx-search-alt'></i></button>
                </div>
                <button type="button" @click="AddCardprice()" class="btn btn-sm rounded-pill btn-icon btn-primary">
                  <i class="bx bx-plus fs-4"></i>
                </button>
              </div>
            </div>
          </div> 
          <div class="table-responsive">
            <table class="table table-responsive table-sm mt-4 dataTable dtr-inline border border-2 table-hover">
              <thead class="table-primary text-nowrap">
                <tr>
                  <th class="fs-6 text-dark fw-bold" style="width: 10%;">#</th>
                  <th class="fs-6 text-dark fw-bold" style="width: 35%;">ລາຄາບັດໂທລະສັບ</th>
                  <th class="fs-6 text-dark fw-bold" style="width: 30%;">ເຄືອຄ່າຍ</th>
                  <th class="fs-6 text-dark fw-bold text-center" style="width: 15%;">ຈັດການ</th>
                </tr>
              </thead>
              <tbody class="text-nowrap">
                <tr v-for="item in CardpriceData.data" :key="item">
                  <td class="text-dark text-sm">{{ item.id }}</td>
                  <td class="text-nowrap text-dark fs-6">{{ formatPrice(item.price) }}</td>
                  <td class="text-nowrap text-dark fs-6">{{ item.cardtype_name }}</td>
                  <td class="justify-content-center text-nowrap">
                    <i class="bx bx-edit bx-sm cursor-pointer text-warning" @click="EditCardprice(item.id)"></i> |
                    <i class="bx bx-trash bx-sm cursor-pointer text-danger" @click="DelCardprice(item.id)"></i>
                  </td>
                </tr>
              </tbody>
            </table>
            <pagination :pagination="CardpriceData" :offset="4" @paginate='GetCardprice($event)' />
          </div>
          
        </div>
        <!-- Modal Form Company -->
        <div class="modal fade" id="FormCardprice" data-bs-backdrop="static" tabindex="-1" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title fw-bold" id="backDropModalTitle">* ຈັດການລາຄາບັດໂທລະສັບ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              {{ FormCardprice }}
              <div class="modal-body">   
                <div class="row g-6 mb-2">
                  <div class="col mb-0">
                    <label for="emailBackdrop" class="form-label fs-6">ລາຄາບັດ:</label>
                    <cleave :options="options" id="emailBackdrop" v-model="FormCardprice.price" class="form-control" placeholder="ປ້ອນລາຄາບັດໂທລະສັບ" />
                  </div>
                  <div class="col mb-0">
                    <label for="dobBackdrop" class="form-label fs-6">ເຄືອຄ່າຍ:</label>
                    <select class="form-select" v-model="FormCardprice.cardtype_id">
                      <option value=""> ເລືອກເຄືອຄ່າຍ </option>
                      <option v-for="item in CardtypeData" :key="item.id" :value="item.id">{{ item.cardtype_name }}</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" :disabled="CheckForm" @click="SaveCardprice()">ບັນທຶກ</button>
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
          cardtype:'all',
          CardtypeData:[],
            FormCardprice: {
                cardtype_id: '',
                price: ''
            },
            FormType:true,
            CardpriceData:[],
            EditID:'',
            options: {
                numeral: true,
                numeralPositiveOnly: true,
                noImmediatePrefix: true,
                rawValueTrimPrefix: true,
                numeralIntegerScale: 10,
                numeralDecimalScale: 2,
                numeralDecimalMark: '.',
                delimiter: ','
            },
            Sortcp: "desc",
            PerPage:5,
            Search:''
        }
    },
    computed:{
      CheckForm(){
        if(this.FormCardprice.cardtype_id == '' || this.FormCardprice.price == ''){
          return true;
        } else {
          return false;
        }
      }
    },
    methods: {
        formatPrice(value) {
            let val = (value / 1).toFixed(0).replace(",", ".");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        AddCardprice() {
            $('#FormCardprice').modal('show');
            this.FormType = true;
            this.GetCardtype();
            this.FormCardprice = {
                cardtype_id: '',
                price: ''
            }
        },
        EditCardprice(id) {
            this.EditID = id;
            this.FormType = false;

            axios.get(`api/cardprice/edit/${id}`,{ headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res)=>{
            this.FormCardprice =res.data;
            $('#FormCardprice').modal('show');

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
        DelCardprice(id){
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
                axios.delete(`api/cardprice/delete/${id}`,{ headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res)=>{
                if(res.data.success){
                    this.$swal({
                        toast: true,
                        position: "top-end",
                        icon: "success",
                        title: res.data.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    this.GetCardprice();
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
        SaveCardprice() {
            if(this.FormType){
                //Add
                axios.post('api/cardprice/add', this.FormCardprice, { headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res)=>{
                    if(res.data.success){
                    $('#FormCardprice').modal('hide');
                    this.GetCardprice();
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
                axios.post(`api/cardprice/update/${this.EditID}`,this.FormCardprice, { headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res)=>{
                    if(res.data.success){
                    $('#FormCardprice').modal('hide');
                    this.GetCardprice();
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
        GetCardprice(page) {
            axios.get(`api/cardprice?page=${page}&sortcp=${this.Sortcp}&perpage=${this.PerPage}&search=${this.Search}&cardtype=${this.cardtype}`, { headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res) => {
                // console.log("Response Data:", res.data);
                this.CardpriceData = res.data;
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
        this.GetCardprice(1);
        this.GetCardtype();
    },
    watch:{
        Sort() {
            this.GetCardprice(1);
        },
        Search() {
          this.GetCardprice();
        }
    }
}
</script>
<style>
    
</style>