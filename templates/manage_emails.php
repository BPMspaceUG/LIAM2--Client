<div class="modal fade" id="liam2_manage_emails_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if (isset($success)) : ?>
                <div class="alert alert-success" role="alert"><?php echo $success; ?></div>
            <?php endif; ?>
            <h2>Manage E-Mails</h2>
            <form method="post" action="" class="needs-validation">
                <div class="form-group row">
                    <label for="liam2_email_text" class="col-lg-4 col-sm-6">Add another email *</label>
                    <input type="text" name="liam2_email_text" class="form-control col-lg-8" required />
                </div>
                <input type="submit" class="form-submit btn btn-primary" value="Add another email" name="liam2_add_another_email" />
            </form>
            <?php if ($unselected_user_emails) : ?>
                <form method="post" action="" class="needs-validation">
                    <div class="form-group col-12">
                        <hr>
                    </div>
                    <div class="form-group row">
                        <label for="unselected_primary_email_dropdown" class="col-lg-4 col-sm-6">Select Email *</label>
                        <select id="unselected_primary_email_dropdown" class="form-control col-lg-8" name="email" required>
                            <option value="" selected disabled>Please select</option>
                            <?php foreach ($unselected_user_emails as $user_email) : ?>
                                <option value="<?php echo $user_email['liam2_User_email_id']; ?>"><?php echo $user_email['liam2_email_id_fk_396224']['liam2_email_text']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="submit" class="form-submit btn btn-primary" value="Select Email" name="liam2_select_email" />
                </form>
            <?php endif; ?>
            <?php if (count($selected_user_emails) > 1) : ?>
                <form method="post" action="" class="needs-validation">
                    <div class="form-group col-12">
                        <hr>
                    </div>
                    <div class="form-group row">
                        <label for="selected_email_dropdown" class="col-lg-4 col-sm-6">Unselect email *</label>
                        <select id="selected_email_dropdown" class="form-control col-lg-8" name="email" required>
                            <option value="" selected disabled>Please select</option>
                            <?php foreach ($selected_user_emails as $user_email) : ?>
                                <option value="<?php echo $user_email['liam2_User_email_id']; ?>"><?php echo $user_email['liam2_email_id_fk_396224']['liam2_email_text']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="submit" class="form-submit btn btn-primary" value="Unselect email" name="liam2_unselect_email" />
                </form>
            <?php endif; ?>
            <?php if (count($selected_user_emails) > 1 || ($selected_user_emails && $unselected_user_emails)) : ?>
                <form method="post" action="" class="needs-validation">
                    <div class="form-group col-12">
                        <hr>
                    </div>
                    <div class="form-group row">
                        <label for="delete_email_dropdown" class="col-lg-4 col-sm-6">Delete email *</label>
                        <select id="delete_email_dropdown" class="form-control col-lg-8" name="email" required>
                            <option value="" selected disabled>Please select</option>
                            <?php if (count($selected_user_emails) == 1) $user_emails = $unselected_user_emails;
                            foreach ($user_emails as $user_email) : ?>
                                <option data-user_email_id="<?php echo $user_email['liam2_User_email_id']; ?>" value="<?php echo $user_email['liam2_email_id_fk_396224']['liam2_email_id']; ?>"><?php echo $user_email['liam2_email_id_fk_396224']['liam2_email_text']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input id="delete_user_email_id" name="delete_user_email_id" type="hidden" value="" />
                    </div>
                    <input type="submit" class="form-submit btn btn-primary" value="Delete email" name="liam2_delete_email" />
                </form>
            <?php endif; ?>
            <div>
                <a class="form-submit btn btn-primary" href="/index.php">Go Back</a>
            </div>
        </div>
    </div>
</div>