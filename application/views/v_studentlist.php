<div class="content-wrapper">
    <section class="content-header">
        <h1>Student <small>List Students</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Student</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <?php if ($this->session->flashdata('alert')): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $this->session->flashdata('alert'); ?>
                    </div>
                <?php endif; ?>

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#active_students" data-toggle="tab">Active Students</a></li>
                        <li><a href="#inactive_students" data-toggle="tab">Inactive Students</a></li>
                        <li class="pull-right">
                            <a href="<?= base_url() ?>student/addStudent" style="padding: 10px;">
                                <button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New Student</button>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="active_students">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover datatable-student">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Telephone</th>
                                            <th>Program</th>
                                            <th>Status</th>
                                            <th class="notPrintable" width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listStudent->result() as $row):
                                            if ($row->status == "ACTIVE"): ?>
                                                <tr>
                                                    <td><?= $row->sid ?></td>
                                                    <td><?= $row->name ?></td>
                                                    <td><?= $row->phone ?></td>
                                                    <td><?= $row->program ? $row->program : '-' ?></td>
                                                    <td><span class="badge bg-yellow"><?= $row->status ?></span></td>
                                                    <td>
                                                        <a href="<?= base_url() ?>student/updateStudent/<?= $row->sid ?>" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
                                                        <a href="<?= base_url('student/detailPayment/') ?><?= $row->sid; ?>/<?= $row->name; ?>" class="btn btn-primary btn-xs"><i class="fa fa-file-text-o"></i></a>
                                                        <a data-toggle="modal" data-target="#delModal"
                                                            data-id="<?= $row->sid ?>" data-name="<?= $row->name ?>"
                                                            data-program="<?= $row->program ?>" data-id_teacher="<?= $row->id_teacher ?>"
                                                            data-status="<?= $row->status ?>"
                                                            href="#" class="btn btn-warning btn-xs openModal">
                                                            <i class="fa fa-check"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                        <?php endif;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane" id="inactive_students">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover datatable-student">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Telephone</th>
                                            <th>Note</th>
                                            <th>Status</th>
                                            <th class="notPrintable" width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listStudent->result() as $row):
                                            if ($row->status == "INACTIVE"): ?>
                                                <tr>
                                                    <td><?= $row->sid ?></td>
                                                    <td><?= $row->name ?></td>
                                                    <td><?= $row->phone ?></td>
                                                    <td><?= $row->note ?></td>
                                                    <td><span class="badge bg-red"><?= $row->status ?></span></td>
                                                    <td>
                                                        <a href="<?= base_url() ?>student/updateStudent/<?= $row->sid ?>" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
                                                        <a href="<?= base_url('student/detailPayment/') ?><?= $row->sid; ?>/<?= $row->name; ?>" class="btn btn-primary btn-xs"><i class="fa fa-file-text-o"></i></a>
                                                        <a href="<?= base_url() ?>student/activateStudent/<?= $row->sid ?>/<?= $row->status ?>"
                                                            class="btn btn-danger btn-xs"
                                                            onclick="return confirm('Are you sure you want to activate or deactivate this student?');">
                                                            <i class="fa fa-check"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                        <?php endif;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="delModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteStudentForm" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalTitle"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="idstudent" id="idModal">
                    <input type="hidden" name="program" id="programNya">
                    <input type="hidden" name="id_teacher" id="id_teacherNya">
                    <input type="hidden" name="name" id="name">

                    <div class="form-group">
                        <label>Why did she/he leave from U&I English Course?</label>
                        <select name="review_id" id="choose_alasan" class="form-control" required>
                            <?php
                            $data_query = $this->db->get('category_review')->result();
                            foreach ($data_query as $value) {
                                echo '<option value="' . $value->id . '">' . $value->category_name . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Note</label>
                        <textarea name="explanation" id="explanation" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Date Inactive</label>
                        <input type="date" class="form-control" name="date" value="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTable pada class yang sama
        $('.datatable-student').DataTable();

        // Script Modal (Tanpa merubah logika action)
        $('.openModal').on('click', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const program = $(this).data('program');
            const id_teacher = $(this).data('id_teacher');
            const status = $(this).data('status');

            $('#idModal').val(id);
            $('#programNya').val(program);
            $('#id_teacherNya').val(id_teacher);
            $('#name').val(name);

            // Action URL tetap sesuai permintaan Anda
            const formAction = `<?= base_url() ?>student/activateStudent/${id}/${status}`;
            $('#deleteStudentForm').attr('action', formAction);

            $('#myModalTitle').html(`Are you sure to deactivate student: ${name}?`);
        });

        // Auto close alert
        setTimeout(() => {
            $('.alert').fadeOut();
        }, 2000);
    });
</script>