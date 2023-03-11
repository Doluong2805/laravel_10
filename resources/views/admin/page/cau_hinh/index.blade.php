@extends('admin.share.master_page')
@section('noi_dung')
<div class="row" id="app">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                Cấu Hình Hệ Thống
            </div>
            <div class="card-body">
                <label>Danh Sách Hình Ảnh</label>
                <input class="form-control mt-1" v-model="data.list_image">
                <label>Danh Sách Tiêu Đề</label>
                <input class="form-control mt-1" v-model="data.list_title">
                <label>Danh Sách Mô Tả</label>
                <input class="form-control mt-1" v-model="data.list_des">
                <label>Danh Sách Link</label>
                <input class="form-control mt-1" v-model="data.list_link">
            </div>
            <div class="card-footer text-end">
                <button class="btn btn-primary" v-on:click="create()">Thêm Mới</button>
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
            data    :   {},
        },
        created()   {
            this.loadData();
        },
        methods :   {
            loadData() {
                axios
                    .get('/admin/cau-hinh/data')
                    .then((res) => {
                        this.data = res.data.data;
                    });
            },
            create() {
                axios
                    .post('/admin/cau-hinh/create', this.data)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success(res.data.mess);
                            this.loadData();
                        } else {
                            toastr.error(res.data.mess);
                        }
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
