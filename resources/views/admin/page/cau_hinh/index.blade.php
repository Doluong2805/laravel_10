@extends('admin.share.master_page')
@section('noi_dung')
<div class="row" id="app">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                Cấu Hình Hệ Thống
            </div>
            <form id="formdata" v-on:submit.prevent="create()">
            <div class="card-body">
                <label>Danh Sách Hình Ảnh</label>
                <div class="input-group">
                    <input name="hinh_anh" v-model="data.list_image" id="hinh_anh" class="form-control" type="text" name="filepath">
                    <span class="input-group-prepend">
                        <a v-on:click="is_show = 0" id="lfm" data-input="hinh_anh" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                        <button type="button" v-if="is_show == 0" class="btn btn-info" v-on:click="process()">Info</button>
                    </span>
                </div>
                <div id="holder" style="margin-top:15px;max-height:100px;">
                    <template v-for="(value, key) in cal()">
                        <img v-bind:src="value" style="height: 5rem;">
                    </template>
                </div>
                <template v-if="is_show == 1 && so_hinh > 0">
                    <label class="form-label mt-2"><b>Danh Sách Tiêu Đề</b></label>
                    <template v-for="key in so_hinh">
                        <input class="form-control mt-1" v-bind:name="'title_' + key" v-bind:value="showData(data.list_title,key)">
                    </template>

                    <label class="form-label mt-2"><b>Danh Sách Mô Tả</b></label>
                    <template v-for="key in so_hinh">
                        <input class="form-control mt-1" v-bind:name="'des_' + key" v-bind:value="showData(data.list_des,key)">
                    </template>

                    <label class="form-label mt-2"><b>Danh Sách Link</b></label>
                    <template v-for="key in so_hinh">
                        <input class="form-control mt-1" v-bind:name="'link_' + key" v-bind:value="showData(data.list_link,key)">
                    </template>
                </template>
            </div>
            <div class="card-footer text-end">
                <button v-if="is_show == 1" type="submit" class="btn btn-primary">Thêm Mới</button>
            </div>
            </form>
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
            so_hinh :   0,
            is_show :   1,
        },
        created()   {
            this.loadData();
            this.process();
        },
        methods :   {
            cal() {
                var x = this.data.list_image?.split(',');
                this.so_hinh = x?.length;
                return x;
            },
            showData(v, index) {
                var x = v?.length > 0 ? v?.split('|') : null;
                index = index - 1;
                if (Array.isArray(x) == false || x == null || typeof x[1] === 'undefined') {
                    // console.log('No data!');
                    return '';
                } else {
                    // console.log(x[index]);
                    return x[index];
                }
            },
            process() {
                this.is_show = 1;
                this.data.list_image = $("#hinh_anh").val();
            },
            loadData() {
                axios
                    .get('/admin/cau-hinh/data')
                    .then((res) => {
                        this.data = res.data.data;
                    });
            },
            create() {
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
                    .post('/admin/cau-hinh/create', paramObj)
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
<script>
    var route_prefix = "/laravel-filemanager";
</script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $("#lfm").filemanager('image', {prefix : route_prefix});
</script>
@endsection
