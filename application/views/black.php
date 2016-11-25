<!DOCTYPE html>
<html>
    <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Members data</title>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head> 
<body>

<div class="navbar-wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="top-nav">
        <div class="container">
        <div class="navbar-header">
            <a href="#" class="navbar-brand">Hi Admin,></a>

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            </div>

            <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Pendaftar</a></li>
                <li ><a href="http://localhost/master/person">Anggota</a></li>
            </ul>

            <div class="nav navbar-nav navbar-right">
                <li><a href="http://localhost/master/person/logout">Logout</a></li>
            </div>
        </div>
     </nav>
</div>
<br><br>

    <div class="container">
        <h1 style="font-size:20pt">IBGF Members</h1>

        <h3>Anggota Data</h3>
        <br />
        <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Add Person</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />

        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>No</th>
                    <th>Waktu</th>
                    <th>Nama</th>
                    <td>Gender</td>
                    <th>Jurusan</th>
                    <th>Angkatan</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Id Line</th>
                    <th>Hobi</th>
                    <th>Prestasi</th>
                    <th>Alamat</th>
                    <th>Keterangan</th>
                    <th style="width:150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
            <tr>
                    <th>Id</th>
                    <th>No</th>
                    <th>Waktu</th>
                    <th>Nama</th>
                    <td>Gender</td>
                    <th>Jurusan</th>
                    <th>Angkatan</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Id Line</th>
                    <th>Hobi</th>
                    <th>Prestasi</th>
                    <th>Alamat</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
            </tr>
            </tfoot>
        </table>
    </div>

<script type="text/javascript">

var save_method; //for save method string
var table;
var base_url = '<?php echo base_url();?>';

$(document).ready(function() {

    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Pendaftar/ajax_list')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            { 
                "targets": [ -1 ], //last column
                "orderable": false, //set not orderable
            },
            { 
                "targets": [ -2 ], //2 last column (photo)
                "orderable": false, //set not orderable
            },
        ],

    });

    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });

    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

});



function add_person()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title

    $('#photo-preview').hide(); // hide photo preview modal

    $('#label-photo').text('Upload Photo'); // label photo upload
}

function edit_person(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string


    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('Pendaftar/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="nama"]').val(data.nama);
            $('[name="gender"]').val(data.gender);
            $('[name="jurusan"]').val(data.jurusan);
            $('[name="angkatan"]').val(data.angkatan);
            $('[name="nohp"]').val(data.nohp);
            $('[name="email"]').val(data.email);
            $('[name="idline"]').val(data.idline);
            $('[name="hobi"]').val(data.hobi);
            $('[name="prestasi"]').val(data.prestasi);
            $('[name="alamat"]').val(data.alamat);
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title

            $('#photo-preview').show(); // show photo preview modal

            /*if(data.photo)
            {
                $('#label-photo').text('Change Photo'); // label photo upload
                $('#photo-preview div').html('<img src="'+base_url+'upload/'+data.photo+'" class="img-responsive">'); // show photo
                $('#photo-preview div').append('<input type="checkbox" name="remove_photo" value="'+data.photo+'"/> Remove photo when saving'); // remove photo

            }
            else
            {
                $('#label-photo').text('Upload Photo'); // label photo upload
                $('#photo-preview div').text('(No photo)');
            }*/


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('Pendaftar/ajax_add')?>";
    } else {
        url = "<?php echo site_url('Pendaftar/ajax_update')?>";
    }

    // ajax adding data to database

    var formData = new FormData($('#form')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function delete_person(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('Pendaftar/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">

                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                     <div class="form-group">
                            <label class="control-label col-md-3">Nama Lengkap</label>
                            <div class="col-md-9">
                                <input type="text" name="nama" placeholder="Nama Legkap" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Jenis Kelamin</label>
                            <div class="col-md-9">
                               <select class="form-control" name="gender">
                                  <option value="">Select Gender</option>
                                  <option value="bujang">Bujang</option>
                                  <option value="gadis">Gadis</option>
                              </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Jurusan</label>
                            <div class="col-md-9">
                                <select class="form-control" name="jurusan">
                                <option value="">Jurusan</option>
                                      <optgroup label="Teknik Informatika">
                                            <option value="ti reg">Teknik Informatika Reguler</option>
                                            <option value="tibil">Teknik Informatika Bilingual</option>
                                      </optgroup>
                                      <optgroup label="Sistem Informasi">
                                            <option value="si reg">Sistem Informasi Reguler</option>
                                            <option value="si bil">Sistem Informasi Bilingual</option>
                                      </optgroup>
                                      <optgroup label="Sistem Komputer">
                                            <option value="sk reg">Sistem Komputer Reguler</option>
                                            <option value="sk unggulan">Sistem Komputer Unggulan</option>
                                      </optgroup>
                                      <optgroup label="Diploma Komputer">
                                            <option value="mi">Management Informatika</option>
                                            <option value="ka">Komputerisasi Akutansi</option>
                                            <option value="tk">Teknik Komputer</option>
                                            <option value="tkj">Teknik Komputer jaringan</option>
                                      </optgroup>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Angkatan</label>
                            <div class="col-md-9">
                                <select class="form-control" name="angkatan">
                                      <option value="">Select Angkatan</option>
                                      <option value="2014">2014</option>
                                      <option value="2015">2015</option>
                                      <option value="2016">2016</option>
                               </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">No. Handphone</label>
                            <div class="col-md-9">
                                <input type="text" name="nohp" placeholder="No. Handphone" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input type="email" name="email" placeholder="Email" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-md-3">id LINE</label>
                            <div class="col-md-9">
                                <input type="text" name="idline" placeholder="Id LINE" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-md-3">Hobi</label>
                            <div class="col-md-9">
                                <input type="text" name="hobi" value="" placeholder="Hobi" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Prestasi Yang Pernah Diraih</label>
                            <div class="col-md-9">
                                <input type="text" name="prestasi" class="form-control" value="" placeholder="Prestasi">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Alamat</label>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="3" name="alamat"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
</body>
</html>