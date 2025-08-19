<template lang="">
    <div>
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0 fw-bold fs-5">* ລາຍການແຜນເບີກຈ່າຍບັດໂທລະສັບ</h5>
                <div class="d-flex align-items-center row pt-4 gap-md-0 g-6">
                    <div class="col-md-3 user_role">
                        <select class="form-select text-dark" v-model="company" @change="GetEmp(1)">
                          <option value="all">ເລືອກບໍລິສັດ</option>
                          <option v-for="item in CompData" :key="item.id" :value="item.id">{{ item.name_company }}</option>
                        </select>
                    </div>
                    <div class="col-md-3 user_plan">
                        <select class="form-select text-dark" v-model="deparment" @change="GetEmp(1)">
                        <option value="all">ເລືອກພະແນກ</option>
                        <option v-for="item in filteredDepartments" :key="item.id" :value="item.id">{{ item.name_deparment }}</option>
                        </select>
                    </div>
                    
                </div>
            </div>
            <div class="card-datatable">
                <div id="DataTables_Table_0_wrapper" class="">
                    <div class="row mx-3 my-0 align-items-center py-4">
                        <div class="col-md-auto d-flex align-items-center mb-2 mb-md-0">
                            <button class="btn btn-info material-shadow-none me-2" v-if="Sort=='asc'" @click="Sort='desc'" style="padding: 3px;">
                                <i class='bx bx-sort-up fs-4 cursor-pointer'></i>
                            </button>
                            <button class="btn btn-info material-shadow-none me-2" v-if="Sort=='desc'" @click="Sort='asc'" style="padding: 3px;">
                                <i class='bx bx-sort-down fs-4 cursor-pointer'></i>
                            </button>
                            <select class="form-select text-dark me-3" v-model="PerPage" @change="GetEmp(1)">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                        <div class="col-md d-flex justify-content-end align-items-center flex-wrap gap-3">
                            <div class="dt-search">
                                <input type="search" class="form-control" v-model="Search" id="dt-search-0" placeholder="ຄົ້ນຫາພະນັກງານ" aria-controls="DataTables_Table_0">
                            </div>
                            <div class="btn-group">
                                <button class="btn buttons-collection btn-label-secondary dropdown-toggle" type="button" aria-haspopup="dialog" aria-expanded="false">
                                    <i class="icon-base bx bx-export icon-sm me-1"></i>
                                    <span class="d-none d-sm-inline-block">Export</span>
                                </button>
                            </div>
                            <button class="btn add-new btn-primary" type="button">
                                <span><i class="icon-base bx bx-plus icon-sm me-0 me-sm-2"></i>
                                <span class="d-none d-sm-inline-block">ສັ່ງເບີກຈ່າຍ</span>
                                </span>
                            </button>
                        </div>
                    </div>

                    <div class="justify-content-between dt-layout-table">
                        <div
                            class="d-md-flex justify-content-between align-items-center dt-layout-full table-responsive">
                            <table class="datatables-users table table-sm border-top dataTable dtr-column table-hover"
                                id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="dt-select dt-orderable-none fs-6">
                                            <span class="dt-column-order"></span><input class="form-check-input" type="checkbox">
                                        </th>
                                        <th class="fs-6 fw-bold">Id</th>
                                        <th class="fs-6 fw-bold">ຮູບ</th>
                                        <th class="fs-6 fw-bold">ຊື່ - ນາມສະກຸນ</th>
                                        <th class="fs-6 fw-bold">ບໍລິສັດ</th>
                                        <th class="fs-6 fw-bold">ປະເພດບັດທີ່ຕ້ອງຮັບ</th>
                                        <th class="fs-6 fw-bold">ລວມມູນຄ່າ</th>
                                        <th class="text-center fs-6 fw-bold">ຈັດການ</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in EmpData.data" :key="item">
                                        
                                        <td class="dt-select dt-orderable-none fs-6">
                                            <span class="dt-column-order"></span><input class="form-check-input" type="checkbox">
                                        </td>
                                        <td class="fs-6" style=""><span class="text-heading">{{ item.id }}</span></td>
                                        <td class="fs-6" style="">
                                            <img v-if="item.employee_img" :src="url + '/assets/img/'+ item.employee_img" class="list-img border-1 p-1 rounded shadow-sm">
                                            <img v-else :src="url + '/assets/img/no_image1.png'" class="list-img border-1 p-1 rounded shadow-sm">
                                        </td>
                                        <td class="fs-6"><span class="text-heading">{{ item.employee_name }}</span></td>
                                        <td class="fs-6">{{ item.name_company }}</td>
                                        <td class="fs-6">Mphone 50,000*1 | unitel 20,000*5 | Etl 50,000*1 | ETopUp 50,000*1</td>
                                        <td class="fs-6">250,000</td>
                                        <td class="text-center">
                                            <button type="button" @click="" class="badge btn btn-sm btn-icon bg-label-warning me-2">
                                                <span class="icon-base bx bx-show icon-sm"></span>
                                            </button>
                                            <button type="button" @click="AddCardplan(item.id)" class="badge btn btn-sm btn-icon bg-label-info">
                                                <span class="icon-base bx bxs-file-plus icon-sm"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                    </tr>
                                </tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row mx-3 justify-content-between py-4">
                        <pagination :pagination="EmpData" :offset="4" @paginate='GetEmp($event)' />
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Form -->
        <div class="modal fade" id="FormCardplan" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5 fw-bold">* ຈັດການແຜນເບີກຈ່າຍບັດໂທລະສັບຂອງ {{ FormCardplan.employee_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ FormCardplan }}
                        <div class="col mb-6">
                            <label for="nameBasic" class="form-label">employee_id</label>
                            <input type="text" id="nameBasic" class="form-control" v-model="FormCardplan.employee_id" placeholder="Enter Name">
                        </div>
                        <div class="col mb-6">
                            <label for="dobBackdrop" class="form-label fs-6">ເຄືອຄ່າຍ:</label>
                            <select class="form-select" v-model="FormCardplan.cardtype_id">
                                <option value=""> ເລືອກເຄືອຄ່າຍ </option>
                                <option v-for="item in CardtypeData" :key="item.id" :value="item.id">{{ item.cardtype_name }}</option>
                            </select>
                        </div>
                        <div class="col mb-6">
                            <label for="nameBasic" class="form-label fs-6">ລາຄາບັດເຕິມເງິນ:</label>
                            <select class="form-select" v-model="FormCardplan.cardprice_id">
                                <option value=""> ລາຄາບັດ </option>
                                <option v-for="item in filteredPriceForm" :key="item.id" :value="item.id">{{ item.price }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-6">
                        <div class="col mb-3">
                            <label for="emailBasic" class="form-label fs-6">ຈຳນວນ:</label>
                            <input type="email" id="emailBasic" class="form-control" v-model="FormCardplan.qty" placeholder="qty">
                        </div>
                        <div class="col mb-3">
                            <label for="emailBasic" class="form-label fs-6">ມູນຄ່າ:</label>
                            <input type="email" id="emailBasic" class="form-control" v-model="FormCardplan.total" placeholder="total">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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
                EmpData:[],
                Sort: "desc",
                PerPage:5,
                CompData:[],
                company:'all',
                DepData:[],
                deparment:'all',
                Search:'',
                PerPage:10,
                url: window.location.origin,
                Image_preview: window.location.origin + '/assets/img/upload-file.png',
                AddCardIDEmp:'',
                FormCardplan:{
                    employee_id: '',
                    employee_name: '',
                    cardtype_id: '',
                    cardprice_id: '',
                    qty: '',
                    total: ''
                },
                CardtypeData:[],
                CardpriceData:[],
                Sortcp: "desc",
                cardtype:'all',

            }
        },
        computed:{
            filteredDepartments() {
                if (this.company === 'all') {
                    return [];
                }
                return this.DepData.data.filter(dep => dep.company_id == this.company);
            },
            filteredPriceForm() {
                // console.log("filtering for cardtype_id:", this.FormCardplan.cardtype_id);
                // console.log('all prices:', this.CardpriceData.data);
                if (!this.FormCardplan.cardtype_id) {
                return [];
                }
                return this.CardpriceData.data.filter(Cardp => Cardp.cardtype_id == this.FormCardplan.cardtype_id);
            }
        },
        methods: {
            //ຟັງຊັນຄູນລາຄາ ມີປະກາດໂຕແປຕິດຕາມຄ່າຢູ່ watch
            updateTotal() {
                const found = this.CardpriceData.data.find(
                    p => p.id == this.FormCardplan.cardprice_id
                );
                const price = found ? found.price : 0;
                this.FormCardplan.total = price * (this.FormCardplan.qty || 0);
            },
            AddCardplan(id) {
                this.AddCardIDEmp = id;

                axios.get(`api/emp/edit/${id}`,{ headers: { Authorization: 'Bearer ' + this.store.get_token }}).then((res)=>{
                const emp = res.data;
                this.FormCardplan.employee_id = emp.id;
                this.FormCardplan.employee_name = emp.employee_name;

                $('#FormCardplan').modal('show');
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
        },
        created() {
            this.GetEmp(1);
            this.GetComp();
            this.GetDep();
            this.GetCardtype();
            this.GetCardprice();
        },
        watch:{
            Sort(){
                this.GetEmp(1);
            },
            Search() {
                this.GetEmp();
            },
            'FormCardplan.cardprice_id'(newVal) {
                this.updateTotal();
            },
            'FormCardplan.qty'(newVal) {
                this.updateTotal();
            }
        }
    }

</script>
<style scoped>
.list-img{
        width: 30px;
        height: 30px;
        object-fit: cover;
        object-position: center;}
</style>
