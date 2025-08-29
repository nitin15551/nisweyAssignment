<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">

                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseAdd" aria-expanded="false" aria-controls="collapseExample">
                    Add New
                </button>
                &nbsp;
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    upload XML
                </button>

                &nbsp;
                <a class="btn btn-warning" href="{{ route('users.index') }}">Back</a>
            </div>
        </div>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <div class="card shadow-lg border-0 rounded-3 p-4">
                <div class="row mb-3 align-items-center text-center text-md-start">
                    <div class="col-12 col-md-6 mb-2 mb-md-0">
                        <h5 class="modal-title fw-bold text-primary">
                            <i class="bx bx-import"></i> Import XML
                        </h5>
                    </div>

                    <div class="col-12 col-md-3">
                        <a href="{{ asset('sample/download.xml') }}" download="download.xml"
                           class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-center w-100">
                            <i class="bx bxs-download me-1"></i> Download Sample
                        </a>
                    </div>
                </div>

                <form action="{{ route('import.xml') }}" method="POST" enctype="multipart/form-data" id="importForm">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="customFile" class="form-label fw-bold">Upload XML File</label>
                            <input type="file" name="file" class="form-control" id="customFile" accept=".xml" required>
                            <small class="text-muted">Only .xml file are allowed.</small>
                            <p id="fileError" class="text-danger mt-1" style="display: none;">Only XML files are allowed.</p>
                        </div>
                    </div>
                    <!-- Loader -->
                    <div id="uploadLoader" class="text-center my-3" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Uploading...</span>
                        </div>
                        <p class="mt-2 text-muted">Uploading, please wait...</p>
                    </div>


                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3 gap-2">
                        <div class="d-flex flex-column flex-md-row gap-2 w-100 w-md-auto">
                            <button type="button" class="btn btn-outline-secondary btn-sm w-100" data-bs-toggle="collapse"
                                    data-bs-target="#collapse">
                                <i class="bx bx-x"></i> Close
                            </button>
                            <button type="submit" class="btn btn-success btn-sm w-100">
                                <i class="bx bx-import"></i> Import
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="collapse" id="collapseAdd">
        <div class="card card-body">
            <div class="card shadow-lg border-0 rounded-3 p-4">
                <div class="row mb-3 align-items-center text-center text-md-start">
                    <div class="col-12 col-md-6 mb-2 mb-md-0">
                        <h5 class="modal-title fw-bold text-primary">
                            <i class="bx bx-add"></i> Add User
                        </h5>
                    </div>
                </div>

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="col-md-6">
                        <label for="customFile" class="form-label fw-bold">User Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="customFile" class="form-label fw-bold">User Mobile</label>
                        <input type="text" name="number" class="form-control" pattern="\d{10}" maxlength="10" minlength="10" required title="Please enter a 10 digit mobile number">

                    </div>
                    <button type="submit" class="btn btn-success mt-2">Add</button>
                </form>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="">
                <div class="card card-body">
                    <div class="card shadow-lg border-0 rounded-3 p-4">
                        <div class="row mb-3 align-items-center text-center text-md-start">
                            <div class="col-12 col-md-6 mb-2 mb-md-0">
                                <h5 class="modal-title fw-bold text-primary">
                                    <i class="bx bx-add"></i> Edit User
                                </h5>
                            </div>
                        </div>

                        <form action="{{ route('users.update', $users->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="col-md-6">
                                <label for="customFile" class="form-label fw-bold">User Name</label>
                                <input type="text" name="name" value="{{ $users->name }}" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="customFile" class="form-label fw-bold">User Mobile</label>
                                <input type="text" name="number" value="{{ $users->mobile_number }}" class="form-control"
                                       pattern="\d{10}" maxlength="10" minlength="10"
                                       required title="Please enter a 10 digit mobile number">
                            </div>

                            <button type="submit" class="btn btn-success mt-2">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    body{margin-top:20px;
        background-color:#eee;
    }
    .project-list-table {
        border-collapse: separate;
        border-spacing: 0 12px
    }

    .project-list-table tr {
        background-color: #fff
    }

    .table-nowrap td, .table-nowrap th {
        white-space: nowrap;
    }
    .table-borderless>:not(caption)>*>* {
        border-bottom-width: 0;
    }
    .table>:not(caption)>*>* {
        padding: 0.75rem 0.75rem;
        background-color: var(--bs-table-bg);
        border-bottom-width: 1px;
        box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    }

    .avatar-sm {
        height: 2rem;
        width: 2rem;
    }
    .rounded-circle {
        border-radius: 50%!important;
    }
    .me-2 {
        margin-right: 0.5rem!important;
    }
    img, svg {
        vertical-align: middle;
    }

    a {
        color: #3b76e1;
        text-decoration: none;
    }

    .badge-soft-danger {
        color: #f56e6e !important;
        background-color: rgba(245,110,110,.1);
    }
    .badge-soft-success {
        color: #63ad6f !important;
        background-color: rgba(99,173,111,.1);
    }

    .badge-soft-primary {
        color: #3b76e1 !important;
        background-color: rgba(59,118,225,.1);
    }

    .badge-soft-info {
        color: #57c9eb !important;
        background-color: rgba(87,201,235,.1);
    }

    .avatar-title {
        align-items: center;
        background-color: #3b76e1;
        color: #fff;
        display: flex;
        font-weight: 500;
        height: 100%;
        justify-content: center;
        width: 100%;
    }
    .bg-soft-primary {
        background-color: rgba(59,118,225,.25)!important;
    }
</style>
