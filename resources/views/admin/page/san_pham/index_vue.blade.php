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
                <div class="input-group">
                    <input name="hinh_anh" id="hinh_anh" class="form-control" type="text" name="filepath">
                    <span class="input-group-prepend">
                        <a id="lfm" data-input="hinh_anh" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                </div>
                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                <label>Mô tả</label>
                <input name="mo_ta" class="form-control mt-1" type="text">
                <label>Giá bán</label>
                <input name="gia_ban" class="form-control mt-1" type="number">
                <label>Giá khuyến mãi</label>
                <input name="gia_khuyen_mai" class="form-control mt-1" type="number">
                <label>Chuyên mục</label>
                <select name="id_chuyen_muc" class="form-control mt-1">
                    <template v-for="(v, k) in listChuyenMuc">
                        {{-- Nếu không phải là text mà là giá trị --}}
                        <option v-bind:value="v.id">@{{ v.ten_chuyen_muc }}</option>
                    </template>
                </select>
                <label>Tình trạng</label>
                <select name="trang_thai"class="form-control">
                    <option value="1">Còn kinh doanh</option>
                    <option value="0">Dừng kinh doanh</option>
                </select>
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
                        <template v-for="(v, k) in listSanPham">
                            <tr>
                                <th class="text-center align-middle">@{{ k + 1 }}</th>
                                <td class="align-middle">@{{ v.ten_san_pham }}</td>
                                <td class="align-middle">@{{ v.hinh_anh }}</td>
                                <td class="align-middle">@{{ v.gia_ban }}</td>
                                <td class="align-middle">@{{ v.ten_chuyen_muc }}</td>
                                <td class="align-middle">@{{ v.trang_thai }}</td>
                                <td class="text-center align-middle text-nowrap">
                                    <button class="btn btn-info">Cập Nhật</button>
                                    <button class="btn btn-danger">Xóa Bỏ</button>
                                </td>
                            </tr>
                        </template>
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
        listChuyenMuc : [],
        listSanPham   : [],
    },
    created()   {
        this.loadChuyenMuc();
        this.loadSanPham();
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
            paramObj['mo_ta'] = CKEDITOR.instances['mo_ta'].getData();

            axios
                .post('/admin/san-pham/create', paramObj)
                .then((res) => {
                    if(res.data.status) {
                        toastr.success(res.data.message);
                    }
                })
                .catch((res) => {
                    $.each(res.response.data.errors, function(k, v) {
                        toastr.error(v[0]);
                    });
                });
        },
        loadChuyenMuc() {
            axios
                .get('/admin/chuyen-muc/data')
                .then((res) => {
                    this.listChuyenMuc = res.data.list;
                });
        },
        loadSanPham() {
            axios
                .get('/admin/san-pham/data')
                .then((res) => {
                    this.listSanPham = res.data.data;
                });
        },
    },
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.19.1/ckeditor.js"></script>
<script>
    CKEDITOR.replace('mo_ta');
</script>
<script>
    var route_prefix = "/laravel-filemanager";
</script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $("#lfm").filemanager('image', {prefix : route_prefix});
</script>
@endsection

