<?php
require 'functions.php';
$msg = "";
?>

<?=template_header('Settings');?>
<?=template_nav();?>

<div class="container mt-3">
    <h2 class="title">Settings</h2>
    <div class="columns">
        <div class="column is-one-quarter">
            <p class="subtitle">Profile</p>
            <p class="subtitle">Notifications</p>
            <p class="subtitle">Accounts</p>
        </div>
        <div class="column">
            <p class="title">Profile Info</p>
            <div class="columns is-multiline">
                <div class="column is-one-third has-text-centered">
                    <img src="https://via.placeholder.com/150" alt="">
                </div>
                <div class="column">
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label for="name" class="label">Name</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <input type="text" name="name" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label for="email" class="label">Email</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <input type="text" name="email" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="field is-horizontal">
                        <div class="field-label is-normal"></div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <button class="button is-link">
                                    Edit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column is-full mt-4 mb-4">
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Change Password</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <input type="text" class="input" placeholder="Old Password">
                            </div>
                            <div class="field">
                                <input type="text" class="input" placeholder="New Password">
                            </div>
                            <div class="field">
                                <input type="text" class="input" placeholder="Confirm Password">
                            </div>
                            <div class="field">
                                <button class="button is-link">Change Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?=template_footer();?>