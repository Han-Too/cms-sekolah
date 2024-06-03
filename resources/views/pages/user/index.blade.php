@extends('layouts.app')

@section('title', 'User Data')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a
                            href="{{ url(request()->segment(1)) }}">{{ ucwords(request()->segment(1)) }}</a></div>
                </div>
            </div>

            <div class="section-body">
                {{-- <h2 class="section-title">Table</h2>
                <p class="section-lead">Example of some Bootstrap table components.</p> --}}

                <div class="row">
                    <div class="col-12 ">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Table User Data</h4>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddUser">
                                    Add User
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive overflow-hidden">
                                    <table class="table-bordered table-md table py-4" id="table-1">
                                        <thead>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Telephone</th>
                                            <th>Role</th>
                                            <th>Last Login</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <input type="hidden" value="{{ count($user) }}" id="jumlah">
                                            @forelse ($user as $index=>$data)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ $data->email }}</td>
                                                    <td>{{ $data->telepon }}</td>
                                                    <td>
                                                        @if ($data->role == 'Administrator')
                                                            <div class="badge badge-primary">
                                                                Admin
                                                            </div>
                                                        @elseif ($data->role == 'Guru')
                                                            <div class="badge badge-warning">
                                                                Guru
                                                            </div>
                                                        @elseif ($data->role == 'User')
                                                            <div class="badge badge-success">
                                                                User
                                                            </div>
                                                        @else
                                                            <div class="badge badge-info">
                                                                Siswa
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>{{ App\Helper\Utils::changeDate($data->last_login) }}</td>
                                                    <td>
                                                        <div class="dropdown d-inline">
                                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                                id="dropdownMenuButton2" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                Action
                                                            </button>
                                                            <div class="dropdown-menu" style="z-index: 99">
                                                                <a class="dropdown-item has-icon" href="javascript:void(0)"
                                                                    data-id="{{ $data->user_token }}"
                                                                    id="edituser-{{ $index }}">
                                                                    <i class="fa fa-pen"></i>
                                                                    Edit
                                                                </a>
                                                                {{-- onclick="deleteData({!! $data->user_token !!})" --}}
                                                                <a class="dropdown-item has-icon" href="javascript:void(0)"
                                                                    data-id="{{ $data->user_token }}"
                                                                    id="deluser-{{ $index }}">
                                                                    <i class="fa fa-trash-alt"></i>
                                                                    Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    <ul class="pagination mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1"><i
                                                    class="fas fa-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1 <span
                                                    class="sr-only">(current)</span></a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="modalAddUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="modalAddUser_form">
                        @csrf
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="" />
                            <span id="er0" class="invalid-feedback">Mohon Perhatikan Username Anda</span>
                        </div>

                        <div class="mb-3">
                            <label for="nama">Name</label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="" />
                            <span id="er1" class="invalid-feedback">Mohon Perhatikan Nama Anda</span>
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="" />
                            <span id="er2" class="invalid-feedback"></span>
                        </div>

                        <div class="mb-3">
                            <label for="telepon">Telepon</label>
                            <input type="number" class="form-control" name="telepon" id="telepon" placeholder="" />
                            <span id="er3" class="invalid-feedback">Mohon Perhatikan Nomor Telepon Anda</span>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="30"></textarea>
                            <span id="er1" class="invalid-feedback">Mohon Perhatikan Alamat Anda</span>
                        </div>


                        <div class="mb-3">
                            <label for="" class="form-label">Role</label>
                            <select class="form-control" name="role" id="role">
                                <option disabled selected>Select one</option>
                                <option value="Administrator">Administrator</option>
                                <option value="Guru">Guru</option>
                                <option value="User">User</option>
                                <option value="Siswa">Siswa</option>
                            </select>
                            <span id="er4" class="invalid-feedback">Mohon Perhatikan Role Anda</span>
                        </div>


                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="" />
                            <span id="er5" class="invalid-feedback">Mohon Perhatikan Password Anda</span>
                        </div>

                        <div class="mb-3">
                            <label for="repassword">Re-Password</label>
                            <input type="password" class="form-control" name="repassword" id="repassword"
                                placeholder="" />
                            <span id="er6" class="invalid-feedback">Repassword tidak sama dengan password</span>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="modalAddUser_btn" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEditUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="modalEditUser_form">
                        @csrf
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="editusername" id="editusername"
                                placeholder="" />
                            <span id="er0" class="invalid-feedback">Mohon Perhatikan Username Anda</span>
                        </div>

                        <div class="mb-3">
                            <label for="nama">Name</label>
                            <input type="text" class="form-control" name="editnama" id="editnama" placeholder="" />
                            <span id="er1" class="invalid-feedback">Mohon Perhatikan Nama Anda</span>
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="editemail" id="editemail" placeholder="" />
                            <span id="er2" class="invalid-feedback"></span>
                        </div>

                        <div class="mb-3">
                            <label for="telepon">Telepon</label>
                            <input type="number" class="form-control" name="edittelepon" id="edittelepon" placeholder="" />
                            <span id="er3" class="invalid-feedback">Mohon Perhatikan Nomor Telepon Anda</span>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" name="editalamat" id="editalamat" cols="30" rows="30"></textarea>
                            <span id="er1" class="invalid-feedback">Mohon Perhatikan Alamat Anda</span>
                        </div>


                        <div class="mb-3">
                            <label for="" class="form-label">Role</label>
                            <select class="form-control" name="editrole" id="editrole">
                                <option disabled selected>Select one</option>
                                <option value="Administrator">Administrator</option>
                                <option value="Guru">Guru</option>
                                <option value="User">User</option>
                                <option value="Siswa">Siswa</option>
                            </select>
                            <span id="er4" class="invalid-feedback">Mohon Perhatikan Role Anda</span>
                        </div>


                        {{-- <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="editpassword" id="editpassword" placeholder="" />
                            <span id="er5" class="invalid-feedback">Mohon Perhatikan Password Anda</span>
                        </div>

                        <div class="mb-3">
                            <label for="repassword">Re-Password</label>
                            <input type="password" class="form-control" name="editrepassword" id="editrepassword"
                                placeholder="" />
                            <span id="er6" class="invalid-feedback">Repassword tidak sama dengan password</span>
                        </div> --}}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="modalEditUser_btn" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

    {{-- <script src="{{ asset('js/page/modules-datatables.js') }}"></script> --}}

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/components-table.js') }}"></script>
    <script src="{{ asset('js/custom/user/add.js') }}"></script>
    <script src="{{ asset('js/custom/user/del.js') }}"></script>
    <script src="{{ asset('js/custom/user/edit.js') }}"></script>

    <script>
        $("#table-1").dataTable({
            language: {
                paginate: {
                    previous: "<",
                    next: ">"
                }
            },
            columnDefs: [{
                sortable: false,
                targets: [2, 3]
            }],
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            dom: 'Bfrtip',
        });
    </script>
@endpush
