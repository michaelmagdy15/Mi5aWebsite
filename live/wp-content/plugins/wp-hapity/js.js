
var apiCallBlog = (function () {

    return {
        checkField: function () {
            var key = jQuery('#blog-hapity-auth-id').val();
            var cat = jQuery('#blog-hapity-category-id').val();

            var site = BLOG_HAPITY_ajaxurl;
            var status = 1;
            if (key == '') {
                alert('Enter your key');
                return false;
            }
            else {
                jQuery.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: 'https://www.hapity.com/api/validate_key',
                    data: {
                        auth_key: key,
                        url: site,
                        type: 'wordpress'
                    },
                    success: function (data) {
                        console.log(data);
                        if (data.message == 'Exist') {
                            alert('Already Authenticated');
                            jQuery.ajax({
                                type: 'GET',
                                url: BLOG_HAPITY_ajaxurl,
                                data: {
                                    action: 'hsak_hp_save_auth_key_blog_hapity',
                                    key: key,
                                    status: status
                                },
                                success: function (data2) {
                                    window.location.href = window.location.href;
                                },
                                error: function (errorThrown) {
                                }
                            });
                        }
                        else if (data.message == 0) {
                            alert('Invalid Key');
                            return data;
                        }
                        else {
                            jQuery.ajax({
                                type: 'GET',
                                url: BLOG_HAPITY_ajaxurl,
                                data: {
                                    action: 'hsak_hp_save_auth_key_blog_hapity',
                                    key: key,
                                    status: status,
                                    cat: cat
                                },
                                success: function (data) {

                                    window.location.href = window.location.href;
                                },
                                error: function (errorThrown) {
                                }
                            });

                            return data;
                        }
                    },
                    error: function (errorThrown) {
                        console.log(errorThrown);
                    }
                });
            }
        },
        savePluginData: function () {
            var status = 0;
            var cat = jQuery('#blog-hapity-category-id').val();

            if (jQuery('input[name="status-blog-hapity"]:checked').val() == 'E')
                status = 1;

            let twitter_card = "no";
            let facebook_card = "no";

            if (jQuery("#twitter-card").prop("checked")) {
                twitter_card = "yes";
            }

            if (jQuery("#facebook-card").prop("checked")) {
                facebook_card = "yes";
            }

            jQuery.ajax({
                type: 'GET',
                url: BLOG_HAPITY_ajaxurl,
                data: {
                    action: 'hed_hp_enable_disable_blog_hapity',
                    status: status,
                    "twitter_card": twitter_card,
                    "facebook_card": facebook_card,
                    cat: cat

                },
                success: function (data) {
                    window.location.href = window.location.href;
                },
                error: function (errorThrown) {
                }
            });
        },
        resetKey: function () {
            var key = jQuery('#blog-hapity-auth-id');
            var site = jQuery('#site-url').val();
            var cat = jQuery('#blog-hapity-category-id').val();

            jQuery.ajax({
                type: 'GET',
                url: BLOG_HAPITY_ajaxurl,
                data: {
                    action: 'hhr_hp_blog_hapity_reset',
                    auth_key: '',
                    cat: cat

                },
                success: function (data) {
                    key.val('');
                    jQuery('#blog-bring-broadcast').removeAttr('disabled', 'disabled');
                    jQuery('#blog-bring-broadcast').attr('enabled', 'enabled');
                    jQuery('#reset-blog-hapity').attr('disabled', 'disabled');
                    jQuery('#radios-blog-hapity').css('visibility', 'hidden');

                    window.location.href = window.location.href;
                },
                error: function (errorThrown) {
                }
            });
        }
    }
})();
jQuery(document).ready(function () {
    var radio = jQuery('input[name="status-blog-hapity"]:checked').val();
    if (jQuery('input[name="status-blog-hapity"]:checked').length > 0) {
        jQuery('#radios-blog-hapity').css('visibility', 'visible');
        //jQuery('#change-status-blog-hapity').attr('disabled','disabled');
    }
    jQuery('#blog-bring-broadcast').click(function () {
        return apiCallBlog.checkField();
    });
    jQuery('#change-status-blog-hapity').click(function () {
        return apiCallBlog.savePluginData();
    });
    jQuery('input[name="status-blog-hapity"]').on('change', function () {
        if (jQuery(this).val() == radio) {
            //jQuery('#change-status-blog-hapity').removeAttr('enabled','enabled');
            //jQuery('#change-status-blog-hapity').attr('disabled','disabled');
        }
        else {
            //jQuery('#change-status-blog-hapity').removeAttr('disabled','disabled');
            //jQuery('#change-status-blog-hapity').attr('enabled','enabled');
        }
    });
    jQuery('#reset-blog-hapity').click(function () {
        return apiCallBlog.resetKey();
    });
});
