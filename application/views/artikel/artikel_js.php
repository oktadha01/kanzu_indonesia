<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-YN9QR6KJ0J"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-YN9QR6KJ0J');
</script>
<script>
    $('.konten').removeAttr('hidden', true).hide();
    // $('.add-view-news').on('click', function(e) {
    //     var id_berita = $(this).data('id-berita');
    //     let formData = new FormData();
    //     formData.append('id-berita', id_berita);
    //     $.ajax({
    //         type: 'POST',
    //         url: "<?php echo site_url('berita/add_view_berita'); ?>",
    //         data: formData,
    //         cache: false,
    //         processData: false,
    //         contentType: false,
    //         success: function(data) {
    //             // $('.konten' + id_berita).toggle(300);
    //         },
    //         error: function() {
    //             alert("Data Gagal Diupload");
    //         }
    //     });
    // });
</script>

<!-- paginations berita -->
<script>
    $(document).ready(function() {
        
        var limit = 8;
        var start = 0;
        var action = 'inactive';

        function lazzy_loader(limit) {
            var output = '';
            output += '<div class="post_data">';
            output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
            output += '<p><span class="content-placeholder" style="width:100%; height: 90px;">&nbsp;</span></p>';
            output += '</div>';
            $('#load_data_message').html(output);
        }

        lazzy_loader(limit);

        function load_data(limit, start) {
            $.ajax({
                url: "<?php echo base_url(); ?>artikel/get_berita",
                method: "POST",
                data: {
                    limit: limit,
                    start: start
                },
                cache: false,
                success: function(data) {
                    if (data == '') {
                        $('#load_data_message').html('');
                        // $('#read-more').hide();
                        action = 'active';
                    } else {
                        $('#load_data').append(data);
                        $('#load_data_message').html('');
                        action = 'inactive';
                    }
                }
            })
        }

        if (action == 'inactive') {
            action = 'active';
            load_data(limit, start);
        }
        //  ### fitur infinity scroll jika ingin diaktifkan bisa hilangkan komentar ###

        // $(window).scroll(function() {
        //     if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action ==
        //         'inactive') {
        //         lazzy_loader(limit);
        //         action = 'active';
        //         start = start + limit;
        //         setTimeout(function() {
        //             load_data(limit, start);
        //         }, 1000);
        //     }
        // });

        // Tombol Next Page
        $(document).on('click', '#read-more-art', function() {
            if (action == 'inactive') {
                lazzy_loader(limit);
                action = 'active';
                start = start + limit;
                setTimeout(function() {
                    load_data(limit, start);
                }, 1000);
            }
        });

    });
</script>
<!-- Akhir pagination berita -->


<!-- paginations tag_berita -->
<script>
    $(document).ready(function() {

        var limit = 8;
        var start = 0;
        var action = 'inactive';
        var tag_berita = $('#tag-berita').val();


        function lazzy_loader(limit) {
            var output = '';
            output += '<div class="post_data">';
            output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
            output += '<p><span class="content-placeholder" style="width:100%; height: 90px;">&nbsp;</span></p>';
            output += '</div>';
            $('#load_data_message').html(output);
        }

        lazzy_loader(limit);

        function load_data() {
            $.ajax({
                url: "<?php echo base_url(); ?>artikel/get_berita_tag",
                method: "POST",
                data: {
                    limit: limit,
                    start: start,
                    tag_berita: tag_berita
                },
                cache: false,
                success: function(data) {
                    if (data == '') {
                        $('#load_data_message').html('');
                        $('#read-more').hide();
                        action = 'active';
                    } else {
                        $('#load_data_tag').append(data);
                        $('#load_data_message').html('');
                        action = 'inactive';
                    }
                }
            })
        }

        if (action == 'inactive') {
            action = 'active';
            load_data(limit, start);
        }

        // Tombol Next Page
        $(document).on('click', '#read-more', function() {
            if (action == 'inactive') {
                lazzy_loader(limit);
                action = 'active';
                start = start + limit;
                setTimeout(function() {
                    load_data(limit, start);
                }, 900);
            }
        });

    });
</script>
<!-- Akhir pagination tag_berita -->