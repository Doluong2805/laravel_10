@extends('admin.share.master_page')
@section('noi_dung')
    <div id="app" class="row">
        <div class="card">
            <div class="card-header">
                Chi Tiết Đơn Hàng
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Mã Đơn Hàng</th>
                            <th>Tiền hàng</th>
                            <th>Phí Ship</th>
                            <th>Địa Chỉ</th>
                            <th>Thanh Toán</th>
                            <th>Giao Hàng</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(value, index) in list">
                            <tr>
                                <th class="text-center align-middle">@{{ index +  1}}</th>
                                <td class="text-center align-middle">@{{ value.hash_don_hang }}</td>
                                <td class="text-end align-middle">@{{ value.tien_hang }}</td>
                                <td class="text-end align-middle">@{{ value.phi_ship }}</td>
                                <td class="text-end align-middle">@{{ value.dia_chi }}</td>
                                <td class="text-center align-middle">
                                    <button v-if="value.thanh_toan == - 1" class="btn btn-danger">Chưa Thanh Toán</button>
                                    <button v-else-if="value.thanh_toan == 0" class="btn btn-success">Thanh Toán Online</button>
                                    <button v-else class="btn btn-info">Thanh Toán Tiền Mặt</button>
                                </td>
                                <td class="text-center align-middle">
                                    <button v-if="value.giao_hang == 0" class="btn btn-danger">Chưa Giao</button>
                                    <button v-else-if="value.giao_hang == 1" class="btn btn-success">Đang Vận Chuyển</button>
                                    <button v-else class="btn btn-info">Đã Nhận</button>
                                </td>
                                <td class="text-center align-middle">
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#chiTietDonhang" v-on:click="chiTietDonHang(value.id)">Chi Tiết</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="chiTietDonhang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                           <h3>Danh Sách Sản Phẩm</h3>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Hình Ảnh</th>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Đơn Giá</th>
                                        <th>Thành Tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(value, key) in list_san_pham">
                                        <th class="text-center align-middle">@{{key + 1}}</th>
                                        <td class="align-middle">
                                            <img style="height: 100PX; width: 100px ;" v-bind:src="value?.hinh_anh.split(',')[0]"
                                                    alt="img">
                                        </td>
                                        <td class="align-middle">
                                            <h6><a  class="text-dark"target="_blank" v-bind:href="'/product/' + value.slug_san_pham + 'post' + value.id_san_pham">@{{ value.ten_san_pham }}</a></h6>
                                        </td>
                                        <td class="align-middle">@{{ numberformat(tinhGia(value.gia_ban, value.gia_khuyen_mai)) }} x @{{ value.so_luong }}</td>
                                        <td class="align-middle">@{{ numberformat(tinhGia(value.gia_ban, value.gia_khuyen_mai) * value.so_luong ) }}</td>
                                    </tr>
                                </tbody>
                                {{-- <tr v-for="(value, key) in list_san_pham">
                                    <td>
                                        <div class="minicart-item d-flex">
                                            <div class="mini-img-wrapper">
                                                <img style="height: 100PX; width: 100px ;" v-bind:src="value?.hinh_anh.split(',')[0]"
                                                    alt="img">
                                            </div>
                                            <div class="product-info">
                                                <h5 class="product-title"><a target="_blank"
                                                        v-bind:href="'/product/' + value.slug_san_pham + 'post' + value.id_san_pham">@{{ value.ten_san_pham }}</a>
                                                </h5>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @{{ numberformat(tinhGia(value.gia_ban, value.gia_khuyen_mai)) }} x @{{ value.so_luong }}
                                    </td>
                                    <td>
                                        @{{ numberformat(tinhGia(value.gia_ban, value.gia_khuyen_mai) * value.so_luong ) }}
                                    </td>
                                </tr> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')
<script>
    new Vue({
        el: '#app',
        data: {
            list: [],
            list_san_pham: [],
            sub: 0,
            ship: 0,
        },
        created() {
            this.loadData();
        },
        methods: {
            numberformat(number) {
                return new Intl.NumberFormat('vi-VI', {
                    style: 'currency',
                    currency: 'VND'
                }).format(number)
            },
            loadData() {
                axios
                    .get('/admin/don-hang/data')
                    .then((res) => {
                        this.list = res.data.data;

                    });
            },
            chiTietDonHang(id) {
                axios
                    .get('/admin/don-hang/chi-tiet/' + id)
                    .then((res) => {
                        this.list_san_pham = res.data.data;
                    });
            },

            tinhGia(gia_ban, gia_khuyen_mai) {
                if (gia_khuyen_mai > 0) {
                    return gia_khuyen_mai;
                }
                return gia_ban;
            },
        },
    });
</script>
@endsection
