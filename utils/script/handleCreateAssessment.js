jQuery(document).ready(($) => {
    const handleFormSubmit = ((e) => {
        e.preventDefault();

        $.ajax({
            url: '/wp-json/assessment/v1/add',
            type: 'POST',
            dataType: 'JSON',
            data: {
                'action': 'create_assessment_question',
                'component': $("#component").find(":selected").val(),
                'description': $("#description").val(),
                'illustrative_metric': $("#illustrative_metric").val(),
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

