<?php if (isset($custom_footer) && $custom_footer): ?>
<?php else: ?>
    <hr>
    <footer class="container-fluid" id="page_footer">
        <address class="col-md-3">
            <h3><?= DEVELOPER_NAME; ?></h3>
            <br/>
            <br/>

            <a class="btn btn-primary" href="mailto:<?= DEVELOPER_MAIL; ?>?subject=Contact for Support&body=Sent from <?= $_SERVER['REMOTE_ADDR']; ?>">
                <span class="glyphicon glyphicon-envelope"></span>
                <strong><?= DEVELOPER_NAME; ?></strong>
            </a>
        </address>

        <div class="col-md-6 col-md-offset-3">
            <div class="row">
                <h3>Follow Updates on Social Media</h3>
            </div>
            <div class="row">
                <a href="https://twitter.com/lakshay__verma" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @lakshay__verma</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
            <div class="row">
                <div id="fb-root"></div>
                <script>(function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id))
                            return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                <div class="fb-like" data-href="https://facebook.com/lk.lakshay" data-layout="standard" data-action="like" data-colorscheme="dark" data-size="large" data-show-faces="true" data-share="true"></div>
            </div>
            <br>


            <div class="row">
                <!-- Place this tag in your head or just before your close body tag. -->
                <script src="https://apis.google.com/js/platform.js" async defer></script>

                <!-- Place this tag where you want the +1 button to render. -->
                <div class="g-plusone" data-size="tall" data-annotation="none" data-href="https://plus.google.com/u/0/+LakshayVermaS"></div>
            </div>

            <div class="row">
                <a class="wordpress-follow-button btn btn-default" href="https://vermalakshay.wordpress.com" data-blog="https://vermalakshay.wordpress.com" data-lang="en" data-show-follower-count="true">Follow Lakshay Talks on WordPress.com</a>
                <script type="text/javascript">(function (d) {
                        var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');
                        p.type = 'text/javascript';
                        p.async = true;
                        p.src = '//widgets.wp.com/platform.js';
                        f.parentNode.insertBefore(p, f);
                    }(document));</script>
            </div>
        </div>
    </footer>

<?php endif; ?>

<script>
    $('select').select2();


    jQuery.validator.addMethod("greaterThan",
            function (value, element, params) {
                if (!/Invalid|NaN/.test(new Date(value))) {
                    return new Date(value) > new Date($(params).val());
                }
                return isNaN(value) && isNaN($(params).val())
                        || (Number(value) > Number($(params).val()));
            },
            function (params) {
                return "Date is required to be greater than " + $(params).val().replace("T", " ");
            });

</script>


</body>
</html>

<?php $database->close_connection(); ?>