<?php
/**
 * The template for displaying Comment form
 */
 
	global $cs_theme_options;
	if ( comments_open() ) {
		if ( post_password_required() ) return;
	}
?>
<?php if ( have_comments() ) : ?>
<div class="col-md-12">
	<div id="cs-comments">
        
        <h2 class="cs-section-title"><?php echo comments_number(__('No Comments', 'Awaken'), __('1 Comment', 'Awaken'), __('% Comments', 'Awaken') );?></h2>
        <ul>
            <?php wp_list_comments( array( 'callback' => 'cs_comment' ) );	?>
        </ul>
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <div class="navigation">
                <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'Awaken') ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'Awaken') ); ?></div>
            </div> <!-- .navigation -->
        <?php endif; // check for comment navigation ?>
        
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <div class="navigation">
                <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'Awaken') ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'Awaken') ); ?></div>
            </div><!-- .navigation -->
        <?php endif; ?>
    </div>
</div>
<?php endif; // end have_comments() ?>
<div class="col-md-12">
    <div class="leave-form">
		<?php 
        global $post_id;
        $you_may_use = __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'Awaken');
        $must_login = __( 'You must be <a href="%s">logged in</a> to post a comment.', 'Awaken');
        $logged_in_as = __('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'Awaken');
        $required_fields_mark = ' ' . __('Required fields are marked %s', 'Awaken');
        $required_text = sprintf($required_fields_mark , '<span class="required">*</span>' );

        $defaults = array( 'fields' => apply_filters( 'comment_form_default_fields', 
            array(
                'notes' => '',
                
                'author' => '<p>'.
                '<label for="">' . __( 'Name', 'Awaken').'</label>' . __( '', 'Awaken').
                ''.( $req ? __( '', 'Awaken') : '' ) .'<input id="author"  name="author" class="nameinput" type="text" value=""' .
                esc_attr( $commenter['comment_author'] ) . ' tabindex="1">' .
                '<span>*</span></p><!-- #form-section-author .form-section -->',
                
                'email'  => '<p>' .
                '<label>' . __( 'Email', 'Awaken').'</label>'. __( '', 'Awaken').
                ''.( $req ? __( '', 'Awaken') : '' ) .''.
                '<input id="email"  name="email" class="emailinput" type="text"  value=""' . 
                esc_attr(  $commenter['comment_author_email'] ) . ' size="30" tabindex="2"><span>*</span>' .
                '</p><!-- #form-section-email .form-section -->',
                
                'url'    => '<p>' .
                '<label>' . __( 'Website', 'Awaken').'</label>' . __( '', 'Awaken') . '' .
                '<input id="url" name="url" type="text" class="websiteinput"  value="" size="30" tabindex="3">' .
                '</p><!-- #<span class="hiddenSpellError" pre="">form-section-url</span> .form-section -->' ) ),
                
                'comment_field' => '<p>'.
                ''.__( '', 'Awaken'). ''.( $req ? __( '', 'Awaken') : '' ) .'' .
                '<label>' . __( 'Message', 'Awaken').'</label><textarea id="comment_mes" name="comment"  class="commenttextarea" rows="4" cols="39"></textarea>' .
                '</p><!-- #form-section-comment .form-section -->',
                
                'must_log_in' => '<p>' .  sprintf( $must_login,	wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
                'logged_in_as' => '<p>' . sprintf( $logged_in_as, admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ),
                'comment_notes_before' => '',
                'comment_notes_after' =>  '',
                'class_form' => 'form-style',
                'id_form' => 'form-style',
				'class_submit' => 'form-style',
                'id_submit' => 'cs-bg-color',
                'title_reply' => __( '<h2 class="cs-section-title">Leave us a reply</h2>', 'Awaken' ),
                'title_reply_to' => __( '<h2 class="cs-section-title">Leave a Reply to %s </h2>', 'Awaken' ),
                'cancel_reply_link' => __( 'Cancel reply', 'Awaken' ),
                'label_submit' => __( 'Submit', 'Awaken' ),); 
                comment_form($defaults, $post_id); 
            ?>
    </div>
</div>

<!-- Col Start -->