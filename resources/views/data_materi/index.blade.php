@extends('halaman_dashboard.index')
@section('navitem')
    <!-- Divider -->
    <hr class="sidebar-divider my-0"  style="color: black;">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/admin"  style="color: black;">
            <i class="fas fa-fw fa-tachometer-alt" style="color: black;"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" style="color: black;">

    <!-- Heading -->
    <div class="sidebar-heading" style="color: black;">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo" style="color: black;">
            <i class="fas fa-fw fa-cog" style="color: black;"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header" style="color: black;">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html" style="color: black;">Buttons</a>
                <a class="collapse-item" href="cards.html" style="color: black;">Cards</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities" style="color: black;">
            <i class="fas fa-fw fa-wrench" style="color: black;"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="{{ route('usercontrol') }}" style="color: black;">User Control</a>
                <a class="collapse-item" href="{{ route('datamahasiswa') }}" style="color: black;">Data Mahasiswa</a>
                <a class="collapse-item" href="{{ route('datamateri') }}" style="color: black;">Data Materi</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" style="color: black;">

    <!-- Heading -->
    <div class="sidebar-heading" style="color: black;">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder" style="color: black;"></i>
            <span style="color: black;">Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header" style="color: black;">Login Screens:</h6>
                <a class="collapse-item" href="login.html" style="color: black;">Login</a>
                <a class="collapse-item" href="register.html" style="color: black;">Register</a>
                <a class="collapse-item" href="forgot-password.html" style="color: black;">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header" style="color: black;">Other Pages:</h6>
                <a class="collapse-item" href="404.html"style="color: black;">404 Page</a>
                <a class="collapse-item" href="blank.html" style="color: black;">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html" style="color: black;">
            <i class="fas fa-fw fa-chart-area" style="color: black;"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html" style="color: black;">
            <i class="fas fa-fw fa-table" style="color: black;"></i>
            <span>Tables</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" style="color: black;">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle" style="color: black;"></button>
    </div>
@endsection
 @section('main')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h4 class="font-weight-bold mb-0">Daftar Materi</h4>
                    @if ($isAdmin || $isInstructor)
                        <a href="/tambahmat" class="btn btn-light btn-icon-text btn-rounded">
                            <i class="ti-plus btn-icon-prepend"></i>Tambah Materi
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th> @if ($isUser)
                                        <th>Enroll</th>
                                    @endif
                                    @if ($isAdmin || $isInstructor)
                                        <th>Tindakan</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>
                                            <a href="{{ url('/view', $item->id) }}" class="btn btn-sm btn-info">View</a>
                                            <a href="{{ url('/download', $item->file) }}" class="btn btn-sm btn-secondary">Download</a>
                                        </td>
                                        @if ($isUser)
                                            <td>
                                                <form action="{{ route('courses.enroll', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">Enroll</button>
                                                </form>
                                                <form action="{{ route('courses.unenroll', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger">Unenroll</button>
                                                </form>
                                            </td>
                                        @endif
                                        @if ($isAdmin || $isInstructor)
                                            <td>
                                                <a href="/materiedit/{{ $item->id }}" class="btn btn-sm btn-warning text-decoration-none">Edit</a>
                                                <form onsubmit="return confirmHapus(event)" action="/materihapus/{{ $item->id }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE') 
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>