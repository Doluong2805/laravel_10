@extends('admin.share.master_page')
@section('noi_dung')
<div class="row" id="app">
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                Danh Sách Sản Phẩm
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="100%">
                                <input v-on:keyup="timSP()" v-model="search_sp" type="text" class="form-control" placeholder="Nhập vào sản phẩm cần tìm">
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Tên Sản Phẩm</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(v, key) in dsSanPham">
                            <th class="text-center align-middle">@{{ key + 1 }}</th>
                            <td class="align-middle">@{{ v.ten_san_pham }}</td>
                            <td class="align-middle text-center">
                                <button class="btn btn-sm btn-primary">Thêm</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                Chi tiết đơn hàng
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Tên Sản Phẩm</th>
                            <th class="text-center">Số Lượng</th>
                            <th class="text-center">Đơn Giá</th>
                            <th class="text-center">Thành Tiền</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-center align-middle">#</th>
                            <td class="align-middle">Iphone 14</td>
                            <td class="align-middle">
                                <input type="number" class="form-control">
                            </td>
                            <td class="align-middle">
                                <input type="number" class="form-control">
                            </td>
                            <td class="align-middle">
                                14.00.000 đ
                            </td>
                            <td class="align-middle text-center">
                                <button class="btn btn-danger">Xóa Dòng</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
new Vue({
    el      :   '#app',
    data    :   {
        dsSanPham   : [],
        search_sp   : '',
    },
    created()   {
        this.loadSanPham();
    },
    methods :   {
        loadSanPham() {
            axios
                .get('/admin/san-pham/data')
                .then((res) => {
                    this.dsSanPham = res.data.data;
                });
        },
        timSP() {
            var payload = {
                'search_sp_serve' : this.search_sp,
            };
            axios
                .post('/admin/san-pham/search', payload)
                .then((res) => {
                    this.dsSanPham = res.data.data;
                })
                .catch((res) => {
                    $.each(res.response.data.errors, function(k, v) {
                        toastr.error(v[0]);
                    });
                });
        },
    },
});
</script>
@endsection
