@extends('admin.share.master_page')
@section('noi_dung')
<div class="row" id="abcxyz">
    <div class="col-md-5">
        <div class="card">
            <form id="taoTaiKhoan" v-on:submit.prevent="themMoiTaiKhoan()">
                <div class="card-header">
                    Thêm Mới Tài Khoản
                </div>
                <div class="card-body">
                    <label>Họ Và Tên</label>
                    <input name="ho_va_ten" class="form-control mt-1" type="text" placeholder="Nhập vào họ và tên">
                    <label>Email</label>
                    <input name="email" class="form-control mt-1" type="email" placeholder="Nhập vào email">
                    <label>Mật Khẩu</label>
                    <input name="password" class="form-control mt-1" type="text">
                    <label>Nhập Lại Mật Khẩu</label>
                    <input name="re_password" class="form-control mt-1" type="text">
                    <label>Số Điện Thoại</label>
                    <input name="so_dien_thoai" class="form-control mt-1" type="text" placeholder="Nhập vào số điện thoại">
                    <label>Ngày Sinh</label>
                    <input name="ngay_sinh" class="form-control mt-1" type="date" placeholder="Nhập vào ngày sinh">
                    <label>Quyền</label>
                    <select name="id_quyen" class="form-control mt-1">
                        <option selected>Chọn Quyền</option>
                        @foreach ($list_quyen as $key => $value )
                            <option value="{{ $value->id }}">{{ $value->ten_quyen }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Thêm Mới Tài Khoản</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                Danh Sách Tài Khoản
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Họ Và Tên</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Số Điện Thoại</th>
                            <th class="text-center">Ngày Sinh</th>
                            <th class="text-center">Quyền</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(v, key) in listTK">
                            <tr>
                                <th class="text-center align-middle">@{{ key + 1 }}</th>
                                <td class="align-middle">@{{ v.ho_va_ten }}</td>
                                <td class="align-middle">@{{ v.email }}</td>
                                <td class="align-middle">@{{ v.so_dien_thoai }}</td>
                                <td class="align-middle">@{{ v.ngay_sinh }}</td>
                                <td class="align-middle">@{{ v.ten_quyen }}</td>
                                <td class="text-center">
                                    <button class="btn btn-info" v-on:click="detail_admin = v" data-bs-toggle="modal" data-bs-target="#editModal">Cập Nhật</button>
                                    <button class="btn btn-danger" v-on:click="detail_admin = v" data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa Bỏ</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            {{-- Model Xoa --}}
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xóa Nhân Viên</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Bạn có chắc chắn muốn xóa nhân viên: <b>"@{{ detail_admin.ho_va_ten }}"</b> này không?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button v-on:click="delete_quyen()" type="button" class="btn btn-danger" data-bs-dismiss="modal">Xác Nhận</button>
                    </div>
                </div>
                </div>
            </div>

            {{-- Model Edit --}}
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Chỉnh Sửa Quyền</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Tên Quyền</label>
                            <input type="text" name="ten_quyen" v-model="detail_admin.ten_quyen" class="form-control">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Trạng Thái</label>
                            <select name="is_open" class="form-control" v-model="detail_admin.is_open">
                                <option value="1">Hoạt Động</option>
                                <option value="0">Tạm Tắt</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button v-on:click="update_quyen()" type="button" class="btn btn-primary">Xác Nhận</button>
                    </div>
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
        el      :   '#abcxyz',
        data    :   {
            listTK          : [],
            detail_admin    : {},
        },
        created()   {
            this.loadData();
        },
        methods :   {
            themMoiTaiKhoan()  {
                var paramObj = {};
                $.each($('#taoTaiKhoan').serializeArray(), function(_, kv) {
                    if (paramObj.hasOwnProperty(kv.name)) {
                        paramObj[kv.name] = $.makeArray(paramObj[kv.name]);
                        paramObj[kv.name].push(kv.value);
                    }
                    else {
                        paramObj[kv.name] = kv.value;
                    }
                });

                axios
                    .post('/admin/tai-khoan/create-ajax', paramObj)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success("Đã thêm mới tài khoản!");
                            $('#taoTaiKhoan').trigger("reset");
                            this.loadData();
                        } else {
                            toastr.error(res.data.message);
                        }
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0]);
                        });
                    });
            },
            loadData() {
                axios
                    .get('/admin/tai-khoan/data')
                    .then((res) => {
                        this.listTK = res.data.data;
                    });
            },
        },
    });
</script>
@endsection
