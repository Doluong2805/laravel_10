@extends('admin.share.master_page')
@section('noi_dung')
<div class="row" id="app">
    <div class="col-md-4">
        <form id="formdata" v-on:submit.prevent="add()">
        <div class="card">
            <div class="card-header">
                Thêm Mới Sản Phẩm
            </div>
            <div class="card-body">
                <label>Tên Sản Phẩm</label>
                <input name="ten_san_pham" class="form-control mt-1" type="text">
                <label>Slug Sản Phẩm</label>
                <input name="slug_san_pham" class="form-control mt-1" type="text">
                <label>Hình Ảnh</label>
                <input name="hinh_anh" class="form-control mt-1" type="text">
                <label>Mô tả</label>
                <input name="mo_ta" class="form-control mt-1" type="text">
                <label>Giá bán</label>
                <input name="gia_ban" class="form-control mt-1" type="number">
                <label>Giá khuyến mãi</label>
                <input name="gia_khuyen_mai" class="form-control mt-1" type="number">
                <label>Chuyên mục</label>
                <input name="id_chuyen_muc" class="form-control mt-1" type="text">
                <label>Tình trạng</label>
                <input name="trang_thai" class="form-control mt-1" type="text">
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Thêm Mới</button>
            </div>
        </div>
        </form>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Danh Sách Sản Phẩm
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Tên Sản Phẩm</th>
                            <th class="text-center">Hình Ảnh</th>
                            <th class="text-center">Giá Bán</th>
                            <th class="text-center">Chuyên Mục</th>
                            <th class="text-center">Tình Trạng</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-center align-middle"></th>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="align-middle"></td>
                            <td class="text-center align-middle">
                                <button class="btn btn-info">Cập Nhật</button>
                                <button class="btn btn-danger">Xóa Bỏ</button>
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

    },
    created()   {

    },
    methods :   {
        add() {
            var paramObj = {};
            $.each($('#formdata').serializeArray(), function(_, kv) {
                if (paramObj.hasOwnProperty(kv.name)) {
                    paramObj[kv.name] = $.makeArray(paramObj[kv.name]);
                    paramObj[kv.name].push(kv.value);
                } else {
                    paramObj[kv.name] = kv.value;
                }
            });

            axios
                .post('/admin/san-pham/create', paramObj)
                .then((res) => {

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

