jQuery(document).ready(($) => {
    const handleFormSubmit = ((e) => {
        e.preventDefault();
        console.log(
            {
                'component': $("#component").find(":selected").val(),
                'description': $("#description").val(),
                'illustrative_metric' : $("#illustrative_metric").val(),
                'scoring': $("#scoring").val()
            }
        )

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                'action': 'create_assessment_question',
                'component': $("#component").find(":selected").val(),
                'description': $("#description").val(),
                'illustrative_metric' : $("#illustrative_metric").val(),
                'scoring': $("#scoring").val()
            },
            success: (data) => {
                console.log(data);
                alert('Added Assessment Question');
            },
            fail: (err) => {
                console.log(err);
            }
        })
    });

    $(document).on('click', '.btn-submit', handleFormSubmit);
});

