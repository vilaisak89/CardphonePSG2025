<template lang="">
    <div>
        <div class="col-xl-12">
            <div class="card-body shadow-lg rounded-1">
                <ul
                    class="nav nav-pills mb-4 d-flex flex-nowrap overflow-auto px-2"
                    role="tablist"
                    style="white-space: nowrap; scrollbar-width: none; -ms-overflow-style: none;"
                    >
                    <li class="nav-item mt-2 me-2" role="presentation">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-company">
                        <i class="icon-base bx bxs-bank me-1_5"></i>ບໍລິສັດ
                        </button>
                    </li>
                    <li class="nav-item mt-2 me-2" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-dep">
                        <i class="icon-base bx bx-sitemap me-1_5"></i>ພະແນກ
                        </button>
                    </li>
                    <li class="nav-item mt-2 me-2" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-employee">
                        <i class="icon-base bx bx-group me-1_5"></i>ພະນັກງານ
                        </button>
                    </li>
                    <li class="nav-item mt-2 me-2" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-typecard">
                        <i class="icon-base bx bxs-credit-card-front me-1_5"></i>ປະເພດບັດ
                        </button>
                    </li>
                    <li class="nav-item mt-2 me-2" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-pricecard">
                        <i class="icon-base bx bx-money me-1_5"></i>ລາຄາບັດ
                        </button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content custom-card-bg">
                    <div class="tab-pane fade active show" id="navs-pills-top-company" role="tabpanel"><Company /></div>
                    <div class="tab-pane fade" id="navs-pills-top-dep" role="tabpanel"><Deparment /></div>
                    <div class="tab-pane fade" id="navs-pills-top-employee" role="tabpanel"><Employee /></div>
                    <div class="tab-pane fade" id="navs-pills-top-typecard" role="tabpanel"><Cardtype /></div>
                    <div class="tab-pane fade" id="navs-pills-top-pricecard" role="tabpanel"><Cardprice /></div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    
}
</script>
<style>
    .nav-pills::-webkit-scrollbar {
  display: none;
}

/* Light Mode */
[data-bs-theme="light"] .custom-card-bg {
  background-color: #ffffff !important;
  color: #212529; /* default text */
}

/* Dark Mode */
[data-bs-theme="dark"] .custom-card-bg {
  background-color: #1e1e2d !important;
  color: #e0e0e0;
}
</style>