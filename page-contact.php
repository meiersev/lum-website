<?php
/**
 * The template for the about page.
 */

/**
 * Logic for the contact email validation/sending.
 */

$response = "";
function contact_form_generate_response($type, $message) {
    global $response;

    if ($type == "success") {
        $response = "<p class=\"success\">
            {$message}
        </p>";
    } else {
        $response = "<p class=\"error\">
            {$message}
        </p>";
    }
}

// response messages
$missing_content = "Bitte füllen Sie alle Felder aus.";
$email_invalid   = "Email Addresse ungültig";
$message_sent    = "Vielen Dank! Ihre Nachricht wurde gesendet.";
$message_unsent  = "Es ist ein Fehler aufgetreten. Versuchen Sie es nochmal.";

// user posted variables
$name    = $_POST['contact_name'];
$email   = $_POST['contact_email'];
$message = $_POST['contact_message'];

// php mailer variables
$receiver = get_theme_mod('contact_email');
$subject  = "Neue Nachricht von ".$name." über ".get_bloginfo('name');
$headers  = array(
    'From: '.$email,
    'Reply-To '.$email
);

// Validate contact form.
if (!empty($_POST['submitted'])) {
    if (empty($name) || empty($message) || empty($email)) {
        contact_form_generate_response('error', $missing_content);
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            contact_form_generate_response('error', $email_invalid);
        } else {
            // send the email
            $sent = wp_mail($receiver, $subject, strip_tags($message), $headers);
            if ($sent) {
                contact_form_generate_response('success', $message_sent);
            } else {
                contact_form_generate_response('error', $message_unsent);
            }
        }
    }
}

get_header();

// Navigation part
get_template_part('/template-parts/nav/navigation');?>

<?php
$required_field_asterix = "<span
    class=\"highlight tooltip\">*<span class=\"tooltiptext\">Pflichtfeld</span></span>"
?>

<section id="page-content" class="contact-content content-width">
    <h1><?php the_title() ?></h1>

    <?php the_content() ?>

    <?php echo $response ?>
    <form action="<?php the_permalink(); ?>"
        method="post">
        <p>
            Name<?php echo $required_field_asterix ?> <br />
            <input type="text"
                name="contact_name"
                value="<?php echo esc_attr($_POST['contact_name']);?>"/><br />
        </p>
        <p>
            E-Mail<?php echo $required_field_asterix ?> <br />
            <input type="email"
                name="contact_email"
                value="<?php echo esc_attr($_POST['contact_email']);?>"/><br />
        </p>
        <p>
            Nachricht<?php echo $required_field_asterix ?> <br />
            <textarea name="contact_message"
                rows="10"
                cols="50"><?php
                echo esc_textarea($_POST['contact_message']);
            ?></textarea><br />
        </p>
        <input type="hidden" name="submitted" value="1" />
        <p>
            <button type="submit" value="Absenden">Absenden</button>
        </p>
    </form>
</section>

<?php get_footer() ?>
