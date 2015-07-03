<?php
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => '<div class="fhizin_widget">',
        'after_widget' => '</div>',
        'before_title' => '<h2 style="display:none;">',
        'after_title' => '</h2><br/>',
    ));


add_action('admin_menu', 'add_fhizin_info');

function add_fhizin_info(){
	add_menu_page('Fhi-zin theme information', 'Fhi-zin theme information', 8, __FILE__, 'fhizin_info');
}

function fhizin_info() {
   ?>
   	<div style="margin-left:20px;">
   	<h1>Important !</h1>
    <p>Fhi-zin uses 7 items on each page, instead of the standard 10 items from Wordpress. This is because the theme would become too wide for 1024x768 resolutions and would be displayed... well, poorly :).<br/>
    To avoid this, you need to set the maximum items on each page to 7, you can do this under "Settings" &raquo; "Reading" &raquo; "Blog pages show at most".<br/>If you don't do this, some post will not be displayed and your visitors will have an annoying javascript popup.</p>
    <p>Because the  blog title is written in a non-standard font, it's included in the website as a PNG-file. You can easily change it by editing the file "/images/title.png". The font used is "Scriptina", its included in your theme folder under the name "Scriptina_font.zip".</p>
    <p>There's a short information notice below, if you have more questions you can post them on my website at <a href="http://www.bydust.com/fhi-zin-free-ajax-wordpress-theme-template-for-portfolio-and-photography/" target="_blank">bydust.com</a>. <br/>
    An example blog is set up, <a href="http://www.bydust.com/examples/fhi-zin/" target="_blank">click here to visit it</a>.</p>
   
   <h2>Post and Page images</h2>
   <p>The small images with reflection which are attached to each post are set using the custom fields. 
   	You'll need a square image with a 120px X 120px resolution for this, without reflection. 
    Upload this image using the standard Wordpress editor tool and copy the "Link URL". 
    The copied URL would be something like this: "http://www.bydust.com/examples/fhi-zin/wp-content/uploads/2008/10/random_image-4.jpg".
    <br/>Now, we can create a new custom field named "<strong>image_small_120x120</strong>". Do to this, open the "Custom Fields"-box under "Advanced Options" when writing a post/page.<br/>
    There you have a "Key" and "Value"-field. Our key will be "image_small_120x120", the value will be the Link URL you've copied. Paste the Link URL in the Value-field and press "Add Custom Field".<br/>
    Now your image is attached to your post/page and will be displayed on the website. The reflections are added automatically.</p>
    
    <h2>Adding a Download link</h2>
    <p>Adding a download link is actually pretty easy. 
    To start, we'll need a downloadable file. 
    If its not uploaded already, you can upload it with the standard Wordpress editor tools. Be sure to copy the Link URL, we'll need it later on.<br/>
    We're going back to the custom fields to attach our downloadable file to the post/page. 
    It works exactly the same way as attaching the reflected images, but this time the key will be "<strong>download_file</strong>". The value will be the link to your file. Thats all :)</p>
    
    <h2>Adding an external link</h2>
    <p>Again, adding external links works with custom fields. We can specify two things here, the first will be the link (obviously), the second will be the label you wish to give your link, for example "Visit website".
    If you don't specify a label, the default "Read more..." will be used.<br/>
    Ok, we're back at custom fields. To add an external link you can use the key "<strong>externallink</strong>", the value will be the URL you wish to link to.<br/>
    To specify a label, use the key "<strong>externallink_label</strong>". The value will be your custom label offcourse. Be sure to pick a short label, so it doesn't trash your site design.</p>
    
    <h2>Adding images</h2>
    <p>You can add as much images as you like to each post or page. The only requirement is that you use numbered keys, for example "<strong>image1_file</strong>", "<strong>image2_file</strong>", "<strong>image3_file</strong>", etc.<br/>
    Upload the images you want to attach, you can do this using the standard Wordpress editor tools. Copy the Link URL, and create a new custom field "image1_file", which has as value the Link URL you copied.</p>
    <p>*HINT* You can upload multiple images at the same time using the standard Wordpress editor tools. If you number them, for examle "image1.jpg","image2.jpg", etc., you can copy one Link URL and change the number in the filename for each custom field you add. This works alot faster :)</p>
    <p>*IMPORTANT* Your keys need to add up. For example, if you attach 4 images with the keys "image1_file", "image2_file", "image3_file" and "image5_file", the theme will only recognise the first three images. </p>
    
    <h2>Display pictures for comments</h2>
    <p>This theme supports the Gravatar pictures for commenters, you can turn these on or off under "Settings" &raquo; "Discussion" &raquo; "Avatar Display".<br/>They are activated by default.</p>
   </div>
   <?php
}

?>