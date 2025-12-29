<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Placement Test Date
            <small>Edit Placement Test Date</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Placement Test Date</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <br>
                    <form action="<?= base_url() ?>PlacementDate/update" method="POST">
                        <div class="box-body">
                            <input type="hidden" name="id" value="<?= $data->id ?>">

                            <div class="form-group">
                                <label for="name" class="col-sm-4 control-label" style="margin-bottom:20px;">Full Name <span style="color: red;">
                                    <?php echo form_error('name'); ?>
                                </span></label>

                                <div class="col-sm-8" style="margin-bottom:20px;">
                                    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name"
                                           value="<?php echo set_value('name', $data->student_name); ?>" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="date" class="col-sm-4 control-label" style="margin-bottom:20px;">Date <span style="color: red;">
                                    <?php echo form_error('date'); ?>
                                </span></label>

                                <div class="col-sm-8" style="margin-bottom:20px;">
                                    <input type="date" class="form-control" id="date" placeholder="Enter Date" name="date"
                                           value="<?php echo set_value('date', $data->date); ?>" required>
                                </div>
                                
                                <label for="time" class="col-sm-4 control-label" style="margin-bottom:20px;">Time <span style="color: red;">
                                    <?php echo form_error('time'); ?>
                                </span></label>
                                <div class="col-sm-8" style="margin-bottom:20px;">
                                    <select class="form-control" id="time" name="time" required>
                                        <option value="">-- Select Time --</option>
                                        <option value="09:00" <?php echo set_select('time', '09:00', $data->time == '09:00'); ?>>09:00</option>
                                        <option value="10:00" <?php echo set_select('time', '10:00', $data->time == '10:00'); ?>>10:00</option>
                                        <option value="11:00" <?php echo set_select('time', '11:00', $data->time == '11:00'); ?>>11:00</option>
                                        <option value="12:00" <?php echo set_select('time', '12:00', $data->time == '12:00'); ?>>12:00</option>
                                        <option value="13:00" <?php echo set_select('time', '13:00', $data->time == '13:00'); ?>>13:00</option>
                                        <option value="14:00" <?php echo set_select('time', '14:00', $data->time == '14:00'); ?>>14:00</option>
                                        <option value="15:00" <?php echo set_select('time', '15:00', $data->time == '15:00'); ?>>15:00</option>
                                        <option value="16:00" <?php echo set_select('time', '16:00', $data->time == '16:00'); ?>>16:00</option>
                                        <option value="17:00" <?php echo set_select('time', '17:00', $data->time == '17:00'); ?>>17:00</option>
                                        <option value="18:00" <?php echo set_select('time', '18:00', $data->time == '18:00'); ?>>18:00</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="whatsapp" class="col-sm-4 control-label" style="margin-bottom:20px;">WhatsApp <span style="color: red;">
                                    <?php echo form_error('whatsapp'); ?>
                                </span></label>
                                <div class="col-sm-8" style="margin-bottom:20px;">
                                    <input type="text" class="form-control" id="whatsapp" placeholder="Enter WhatsApp Number" name="whatsapp"
                                           value="<?php echo set_value('whatsapp', $data->whatsapp); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                            <a href="<?= base_url() ?>PlacementDate"><button type="button" class="btn btn-default">Cancel</button></a>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </section>
    </div>