<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title><?= $title; ?></title>
</head>

<body>
    <h1 class="ml-4 text-center">INI OUTLET KU</h1>
    <div class="ml-4">
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#ModalAdd">Add New Outlet</button>
    </div>


    <div class="row ml-2">
        <div class="col-lg-6">
            <table id="mytable" class="table bg-primary" style="width:100%">
                <tr>
                    <th class="bg-primary">id</th>
                    <th class="bg-primary">Outlet</th>
                    <th class="bg-primary">Pack</th>
                    <th class="bg-primary">Item</th>
                    <th class="bg-primary">Action</th>
                </tr>
                <tbody class="show_outlet bg-light">
            </table>
        </div>

    </div>



    <!-- Modal Add New Outlet -->
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Outlet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="input1">Outlet Name</label>
                        <input type="text" name="outlet" id="outlet" class="form-control outlet" id="input1" required>
                    </div>
                    <div class="form-group">
                        <label for="input2">Pack</label>
                        <input type="text" name="pack" id="pack" class="form-control pack" id="input2" required>
                    </div>
                    <div class="form-group">
                        <label for="input3">Item</label>
                        <input type="text" name="item" id="item" class="form-control item" id="input3" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" class="id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-save" class="btn btn-primary btn-save">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete OUTLET-->
    <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="alert alert-info">
                        Anda yakin mau menghapus ( <a class="hasil-output" id="hasil-output"></a> ) ?
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" class="id">
                    <!-- <input type="text" name="outlet" class="outlet"> -->
                    <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary btn-delete">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete OUTLET End-->

    <!-- Edit Outlet Modal -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Outlet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="otedit">Outlet name</label>
                        <input type="text" name="otedit" class="form-control otedit" id="otedit">
                    </div>
                    <div class="form-group">
                        <label for="pack_edit">Pack</label>
                        <input type="text" name="pack_edit" class="form-control pack_edit" id="pack_edit">
                    </div>
                    <div class="form-group">
                        <label for="item_edit">Item</label>
                        <input type="text" name="item_edit" class="form-control item_edit" id="item_edit">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_edit" class="id_edit" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-edit" name="btn-edit" id="btn-edit">Edit</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/'); ?>jquery.min.js"></script>
    <!-- <script src="https://js.pusher.com/4.4/pusher.min.js"></script> -->
    <script src="<?= base_url('assets/js/'); ?>popper.min.js"></script>
    <script src="<?= base_url('assets/js/'); ?>bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            show_outlet();

            function show_outlet() {
                $.ajax({
                    url: '<?php echo site_url("outlet/get_outlet"); ?>',
                    type: 'GET',
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        var count = 1;
                        var i;
                        for (i = 0; i < data.length; i++) {
                            html += '<tr>' +
                                '<td>' + count++ + '</td>' +
                                '<td>' + data[i].outlet + '</td>' +
                                '<td>' + data[i].pack + '</td>' +
                                '<td>' + data[i].item + '</td>' +
                                '<td>' +
                                '<a href="javascript:void(0);" class="badge badge-sm btn-info outlet_edit" id="item_edit" data-id="' + data[i].id + '" data-outlet="' + data[i].outlet + '" data-pack="' + data[i].pack + '" data-item="' + data[i].item + '">Edit</a>' +
                                '<a href="javascript:void(0);" class="badge badge-sm btn-danger ml-1 outlet_delete" data-id="' + data[i].id + '" data-outlet="' + data[i].outlet + '">Delete</a>' +
                                '</td>' +
                                '</tr>';
                        }
                        $('.show_outlet').html(html);
                    }

                });
            }

            // END CREATE OUTLET
            $('.btn-save').on('click', function() {
                var outlet = $('#outlet').val();
                var pack = $('#pack').val();
                var item = $('#item').val();
                $.ajax({
                    url: '<?php echo site_url("outlet/post_outlet"); ?>',
                    method: 'POST',
                    data: {
                        outlet: outlet,
                        pack: pack,
                        item: item
                    },
                    success: function() {
                        $('#ModalAdd').modal('hide');
                        $('.outlet').val("");
                        $('.pack').val("");
                        $('.item').val("");
                        show_outlet();
                    }
                });
            });

            // END CREATE OUTLET

            // DELETE OUTLET
            $('#mytable').on('click', '.outlet_delete', function() {
                var id = $(this).data('id');
                var outlet = $(this).data('outlet');
                var hasil = document.getElementById("hasil-output");
                $('#ModalDelete').modal('show');
                $('.id').val(id);

                hasil.innerHTML = outlet;
            });

            $('.btn-delete').on('click', function() {
                var id = $('.id').val();
                $.ajax({
                    url: '<?php echo site_url("outlet/delete"); ?>',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function() {
                        $('#ModalDelete').modal('hide');
                        $('.id').val("");
                        show_outlet();
                    }
                });
            });
            // END DELETE OUTLET

            // UPDATE PRODUCT
            $('#mytable').on('click', '.outlet_edit', function() {
                var id = $(this).data('id');
                var outlet = $(this).data('outlet');
                var pack = $(this).data('pack');
                var item = $(this).data('item');
                $('#ModalEdit').modal('show');
                $('.id_edit').val(id);
                $('.otedit').val(outlet);
                $('.pack_edit').val(pack);
                $('.item_edit').val(item);
            });

            $('.btn-edit').on('click', function() {
                var id = $('.id_edit').val();
                var outlet = $('.otedit').val();
                var pack = $('.pack_edit').val();
                var item = $('.item_edit').val();
                $.ajax({
                    url: '<?php echo site_url("outlet/update_outlet"); ?>',
                    method: 'POST',
                    data: {
                        id: id,
                        outlet: outlet,
                        pack: pack,
                        item: item
                    },
                    success: function() {
                        $('#ModalEdit').modal('hide');
                        $('.id_edit').val("");
                        $('.outlet_edit').val("");
                        $('.pack_edit').val("");
                        $('.item_edit').val("");
                        // alert(outlet);
                        show_outlet();
                    }
                });
            });
            // END EDIT PRODUCT

        });
    </script>

</body>

</html>