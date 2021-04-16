<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header ">
            <h3 class="card-title">Data User</h3>

            <div class="card-tools">
                <button data-toggle="modal" data-target="#add" type="button" class="btn btn-tool btn-sm">
                    <i class="fas fa-plus"></i>
                    Add
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            if ($this->session->flashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i>';
                echo $this->session->flashdata('pesan');
                echo '</h5></div>';
            }

            ?>
            <table class="table table-bordered" id="example1">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php $no = 1;
                    foreach ($user as $key => $value) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $value->nama_pelanggan; ?></td>
                            <td><?= $value->email; ?></td>
                            <td><?= $value->password; ?></td>
                            <td><?php
                                if ($value->level_user == 1) {
                                    echo '<span class="badge bg-primary">Admin</span>';
                                } else {
                                    echo '<span class="badge bg-success">User</span>';
                                }
                                ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $value->id_pelanggan ?>"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $value->id_pelanggan ?>"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- modal add -->
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?php
                echo form_open('user/add');
                ?>

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama Anda" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <label>Level User</label>
                    <select name="level_user" class="form-control">
                        <option value="1" selected>Admin</option>
                        <option value="2">User</option>
                    </select>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <?php
            echo form_close();
            ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- modal edit -->
<?php foreach ($user as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value->id_pelanggan ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?php
                    echo form_open('user/edit/' . $value->id_pelanggan);
                    ?>

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama_pelanggan" value="<?= $value->nama_pelanggan ?>" class="form-control" placeholder="Nama Anda" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?= $value->email ?>" class="form-control" placeholder="Email" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" value="<?= $value->password ?>" class="form-control" placeholder="Password" required>
                    </div>

                    <div class="form-group">
                        <label>Level User</label>
                        <select name="level_user" class="form-control">
                            <option value="1" <?php if ($value->level_user == 1) {
                                                    echo 'selected';
                                                } ?>>Admin</option>
                            <option value="2" <?php if ($value->level_user == 2) {
                                                    echo 'selected';
                                                } ?>>User</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <?php
                echo form_close();
                ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>


<!-- modal delete -->
<?php foreach ($user as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value->id_pelanggan ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete <?= $value->nama_pelanggan; ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h6>Apakah Anda yakin ingin menghapus data ini ?</h6>


                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('user/delete/' . $value->id_pelanggan) ?>" class="btn btn-primary">Delete</a>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>