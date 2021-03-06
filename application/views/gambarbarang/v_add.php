<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header ">
            <h3 class="card-title">Tambah Gambar Barang : <?= $barang->nama_barang; ?></h3>

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

            echo form_open_multipart('gambarbarang/add/' . $barang->id_barang) ?>

            <div class="row">
                <div class="col-sm-4">
                    <label>Keterangan Gambar</label>
                    <input name="ket" class="form-control" placeholder="Keterangan Gambar" value="<?= set_value('ket'); ?>">
                    <?php echo form_error('ket', '<div class="text-danger small ml-2">', '</div>') ?>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Upload Gambar</label>
                        <input type="file" name="gambar" class="form-control" id="preview_gambar" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <img src="<?= base_url('assets/uploads/imgnotfound.jpg') ?>" id="gambar_load" width="200px">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-m float-right">Save</button>
                <a href="<?= base_url('gambarbarang'); ?>" class="btn btn-default btn-m">Back</a>
            </div>

            <?php echo form_close() ?>

            <hr>

            <div class="row">
                <?php foreach ($gambarbarang as $key => $value) { ?>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <img src="<?= base_url('assets/gmr_brg/' . $value->gambar) ?>" id="gambar_load" width="250px" height="200px">
                        </div>
                        <p for="">Keterangan : <?= $value->ket; ?></p>
                        <button class="btn btn-danger btn-xs btn-block" data-toggle="modal" data-target="#delete<?= $value->id_gambar ?>"><i class="fa fa-trash"> Delete</i></button>
                    </div>

                <?php } ?>
            </div>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>


<!-- modal delete -->
<?php foreach ($gambarbarang as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value->id_gambar ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete <?= $value->ket; ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">

                    <div class="form-group">
                        <img src="<?= base_url('assets/gmr_brg/' . $value->gambar) ?>" id="gambar_load" width="250px" height="200px">
                    </div>
                    <h6>Apakah Anda yakin ingin menghapus gambar ini ?</h6>


                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('gambarbarang/delete/' . $value->id_barang . '/' . $value->id_gambar) ?>" class="btn btn-primary">Delete</a>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>



<script>
    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#gambar_load').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#preview_gambar').change(function() {
        bacaGambar(this);
    })
</script>