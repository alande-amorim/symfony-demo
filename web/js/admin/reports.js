jQuery(() => {
    function refreshCount() {
        jQuery.ajax({
            type: 'get',
            url: refresh_url,
            dataType: 'json',
            success: (resp) => {
                if(!!resp.posts) {
                    $('#num_posts').html(resp.posts);
                }
                if(!!resp.comments) {
                    $('#num_comments').html(resp.comments);
                }
            }
        });
    };

    setInterval(refreshCount, 1000);
});