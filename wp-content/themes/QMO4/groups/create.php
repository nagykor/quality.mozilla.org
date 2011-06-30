<?php get_header(); ?>

<section id="content-main" role="main">

  <form action="<?php bp_group_creation_form_action(); ?>" method="post" id="create-group-form" class="standard-form full" enctype="multipart/form-data">
    <h1 class="section-title"><?php _e( 'Create a Team', 'qmo' ); ?></h1>

    <?php do_action( 'bp_before_create_group' ); ?>

    <div class="item-list-tabs no-ajax" id="object-nav">
      <ul>
        <?php bp_group_creation_tabs(); ?>
      </ul>
    </div>

    <?php do_action( 'template_notices' ); ?>

    <div class="item-body" id="group-create-body">

    <?php /* Group creation step 1: Basic group details */ ?>
    <?php if ( bp_is_group_creation_step( 'group-details' ) ) : ?>

      <?php do_action( 'bp_before_group_details_creation_step' ); ?>
      <p>
        <label for="group-name"><?php _e('* Team Name', 'buddypress'); ?> <?php _e( '(required)', 'buddypress' ); ?></label>
        <input type="text" name="group-name" id="group-name" value="<?php bp_new_group_name() ?>" />
      </p>
      <p>
        <label for="group-desc"><?php _e('* Team Description', 'buddypress'); ?> <?php _e( '(required)', 'buddypress' ); ?></label>
        <textarea name="group-desc" id="group-desc" rows="6" cols="60"><?php bp_new_group_description(); ?></textarea>
      </p>
      <?php do_action( 'bp_after_group_details_creation_step' ); /* Deprecated -> */ do_action( 'groups_custom_group_fields_editable' ); ?>

      <?php wp_nonce_field( 'groups_create_save_group-details' ); ?>

    <?php endif; ?>

    <?php /* Group creation step 2: Group settings */ ?>
    <?php if ( bp_is_group_creation_step( 'group-settings' ) ) : ?>

      <?php do_action( 'bp_before_group_settings_creation_step' ); ?>

      <?php if ( function_exists('bp_wire_install') ) : ?>
      <p class="checkbox">
        <label><input type="checkbox" name="group-show-wire" id="group-show-wire" value="1"<?php if ( bp_get_new_group_enable_wire() ) { ?> checked="checked"<?php } ?> /> <?php _e('Enable comment wire', 'buddypress') ?></label>
      </p>
      <?php endif; ?>

      <?php if ( function_exists('bp_forums_is_installed_correctly') ) : ?>
        <?php if ( bp_forums_is_installed_correctly() ) : ?>
          <p class="checkbox">
            <label><input type="checkbox" name="group-show-forum" id="group-show-forum" value="1"<?php if ( bp_get_new_group_enable_forum() ) { ?> checked="checked"<?php } ?> /> <?php _e('Enable discussion forum', 'buddypress') ?></label>
          </p>
        <?php else : ?>
          <?php if ( is_site_admin() ) : ?>
            <p class="checkbox">
              <label><input type="checkbox" disabled="disabled" name="disabled" id="disabled" value="0" /> <?php printf( __('<strong>Attention Site Admin:</strong> Group forums require the <a href="%s">correct setup and configuration</a> of a bbPress installation.', 'buddypress' ), bp_get_root_domain() . '/wp-admin/admin.php?page=bb-forums-setup' ) ?></label>
            </p>
          <?php endif; ?>
        <?php endif; ?>
      <?php endif; ?>

        <h3><?php _e( 'Privacy Options', 'buddypress' ); ?></h3>
        <ul class="radio">
          <li>
            <label><input type="radio" name="group-status" value="public"<?php if ( 'public' == bp_get_new_group_status() || !bp_get_new_group_status() ) { ?> checked="checked"<?php } ?> />
              <strong><?php _e( 'This is a public team', 'qmo' ) ?></strong>
              <ul class="note">
                <li><?php _e( 'Any site member can join this team.', 'qmo' ) ?></li>
                <li><?php _e( 'This group will be listed in the teams directory and in search results.', 'qmo' ) ?></li>
                <li><?php _e( 'Team content and activity will be visible to any site member.', 'qmo' ) ?></li>
              </ul>
            </label>
          </li>

          <li>
            <label><input type="radio" name="group-status" value="private"<?php if ( 'private' == bp_get_new_group_status() ) { ?> checked="checked"<?php } ?> />
              <strong><?php _e( 'This is a private team', 'qmo' ) ?></strong>
              <ul class="note">
                <li><?php _e( 'Only users who request membership and are accepted can join the team.', 'qmo' ) ?></li>
                <li><?php _e( 'This team will be listed in the teams directory and in search results.', 'qmo' ) ?></li>
                <li><?php _e( 'Team content and activity will only be visible to members of the team.', 'qmo' ) ?></li>
              </ul>
            </label>
          </li>

          <li>
            <label><input type="radio" name="group-status" value="hidden"<?php if ( 'hidden' == bp_get_new_group_status() ) { ?> checked="checked"<?php } ?> />
              <strong><?php _e('This is a hidden team', 'qmo') ?></strong>
              <ul class="note">
                <li><?php _e( 'Only users who are invited can join the team.', 'qmo' ) ?></li>
                <li><?php _e( 'This team will not be listed in the teams directory or search results.', 'qmo' ) ?></li>
                <li><?php _e( 'Team content and activity will only be visible to members of the team.', 'qmo' ) ?></li>
              </ul>
            </label>
          </li>
        </ul>

        <?php do_action( 'bp_after_group_settings_creation_step' ); ?>
        <?php wp_nonce_field( 'groups_create_save_group-settings' ); ?>

      <?php endif; ?>

      <?php /* Group creation step 3: Avatar Uploads */ ?>
      <?php if ( bp_is_group_creation_step( 'group-avatar' ) ) : ?>

        <?php do_action( 'bp_before_group_avatar_creation_step' ); ?>

        <?php if ( !bp_get_avatar_admin_step() ) : ?>

          <div class="left-menu">
            <?php bp_new_group_avatar() ?>
          </div><!-- .left-menu -->

          <div class="main-column">
            <p><?php _e("Upload an image to use as an avatar for this team. The image will be shown on the main team page and in search results. You can skip this step and update the avatar later.", 'qmo') ?></p>

            <p>
              <input type="file" name="file" id="file" />
              <input type="submit" name="upload" id="upload" value="<?php _e( 'Upload Image', 'buddypress' ) ?>" />
              <input type="hidden" name="action" id="action" value="bp_avatar_upload" />
            </p>
          </div><!-- .main-column -->

        <?php endif; ?>

        <?php if ( 'crop-image' == bp_get_avatar_admin_step() ) : ?>

          <h3><?php _e( 'Crop Group Avatar', 'buddypress' ) ?></h3>

          <img src="<?php bp_avatar_to_crop() ?>" id="avatar-to-crop" class="avatar" alt="<?php _e( 'Avatar to crop', 'buddypress' ) ?>" />

          <div id="avatar-crop-pane">
            <img src="<?php bp_avatar_to_crop() ?>" id="avatar-crop-preview" class="avatar" alt="<?php _e( 'Avatar preview', 'buddypress' ) ?>" />
          </div>

          <input type="submit" name="avatar-crop-submit" id="avatar-crop-submit" value="<?php _e( 'Crop Image', 'buddypress' ) ?>" />

          <input type="hidden" name="image_src" id="image_src" value="<?php bp_avatar_to_crop_src() ?>" />
          <input type="hidden" name="upload" id="upload" />
          <input type="hidden" id="x" name="x" />
          <input type="hidden" id="y" name="y" />
          <input type="hidden" id="w" name="w" />
          <input type="hidden" id="h" name="h" />

        <?php endif; ?>

        <?php do_action( 'bp_after_group_avatar_creation_step' ); ?>

        <?php wp_nonce_field( 'groups_create_save_group-avatar' ) ?>

      <?php endif; ?>

      <?php /* Group creation step 4: Invite friends to group */ ?>
      <?php if ( bp_is_group_creation_step( 'group-invites' ) ) : ?>

        <?php do_action( 'bp_before_group_invites_creation_step' ); ?>

        <?php if ( function_exists( 'bp_get_total_friend_count' ) && bp_get_total_friend_count( bp_loggedin_user_id() ) ) : ?>
          <div class="left-menu">

            <div id="invite-list">
              <ul>
                <?php bp_new_group_invite_friend_list() ?>
              </ul>

              <?php wp_nonce_field( 'groups_invite_uninvite_user', '_wpnonce_invite_uninvite_user' ) ?>
            </div>

          </div><!-- .left-menu -->

          <div class="main-column">

            <div id="message" class="info">
              <p><?php _e('Select people to invite from your friends list.', 'buddypress'); ?></p>
            </div>

            <?php /* The ID 'friend-list' is important for AJAX support. */ ?>
            <ul id="friend-list" class="item-list">
            <?php if ( bp_group_has_invites() ) : ?>

              <?php while ( bp_group_invites() ) : bp_group_the_invite(); ?>

                <li class="item" id="<?php bp_group_invite_item_id() ?>">
                  <?php bp_group_invite_user_avatar() ?>

                  <h4><?php bp_group_invite_user_link() ?></h4>
                  <span class="activity"><?php bp_group_invite_user_last_active() ?></span>

                  <div class="action">
                    <a class="remove" href="<?php bp_group_invite_user_remove_invite_url() ?>" id="<?php bp_group_invite_item_id() ?>"><?php _e( 'Remove Invite', 'buddypress' ) ?></a>
                  </div>
                </li>

              <?php endwhile; ?>

              <?php wp_nonce_field( 'groups_send_invites', '_wpnonce_send_invites' ) ?>
            <?php endif; ?>
            </ul>

          </div><!-- .main-column -->

        <?php else : ?>

          <div id="message" class="info">
            <p><?php _e( 'Once you have built up friend connections you will be able to invite others to your group. You can send invites any time in the future by selecting the "Send Invites" option when viewing your new group.', 'buddypress' ); ?></p>
          </div>

        <?php endif; ?>

        <?php wp_nonce_field( 'groups_create_save_group-invites' ) ?>
        <?php do_action( 'bp_after_group_invites_creation_step' ); ?>

      <?php endif; ?>

      <?php do_action( 'groups_custom_create_steps' ) // Allow plugins to add custom group creation steps ?>

      <?php do_action( 'bp_before_group_creation_step_buttons' ); ?>

      <?php if ( 'crop-image' != bp_get_avatar_admin_step() ) : ?>
        <div class="submit" id="previous-next">
          <?php /* Previous Button */ ?>
          <?php if ( !bp_is_first_group_creation_step() ) : ?>
            <input type="button" value="&larr; <?php _e('Previous Step', 'buddypress') ?>" id="group-creation-previous" name="previous" onclick="location.href='<?php bp_group_creation_previous_link() ?>'" />
          <?php endif; ?>

          <?php /* Next Button */ ?>
          <?php if ( !bp_is_last_group_creation_step() && !bp_is_first_group_creation_step() ) : ?>
            <button type="submit" id="group-creation-next" name="save"><?php _e('Next Step', 'buddypress') ?> &rarr;</button>
          <?php endif;?>

          <?php /* Create Button */ ?>
          <?php if ( bp_is_first_group_creation_step() ) : ?>
            <button type="submit" id="group-creation-create" name="save"><?php _e('Create Group and Continue', 'buddypress') ?> &rarr;</button>
          <?php endif; ?>

          <?php /* Finish Button */ ?>
          <?php if ( bp_is_last_group_creation_step() ) : ?>
            <input type="submit" value="<?php _e('Finish', 'buddypress') ?> &rarr;" id="group-creation-finish" name="save" />
          <?php endif; ?>
        </div>
      <?php endif;?>

      <?php do_action( 'bp_after_group_creation_step_buttons' ); ?>

      <?php /* Don't leave out this hidden field */ ?>
      <input type="hidden" name="group_id" id="group_id" value="<?php bp_new_group_id() ?>" />

      <?php do_action( 'bp_directory_groups_content' ) ?>

    </div><!-- .item-body -->

    <?php do_action( 'bp_after_create_group' ) ?>

  </form>

</section>

<section id="content-sub" role="complementary">
<?php include (TEMPLATEPATH . '/user-state.php'); ?>
</section>

<?php get_footer() ?>