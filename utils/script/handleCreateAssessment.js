jQuery(document).ready(($) => {
    const handleFormSubmit = ((e) => {
        e.preventDefault();

        const component = $("#component");
        const description = $("#description");
        const hasNA = $("#hasNA");
        const scoring = $("#scoring");

        // TODO: validate form inputs
        


        // Submit form to RESTful API
        $.ajax({
            url: '/wp-json/assessment/v1/add',
            type: 'POST',
            dataType: 'JSON',
            data: {
                'action': 'create_assessment_question',
                'component': component.find(":selected").val(),
                'description': description.val(),
                'hasNA': hasNA.prop("checked") ? 1 : 0,
                'scoring': scoring.val()
            }
        }).done((data) => {
            alert("Added");
            // reset form
            component.prop('selectedIndex',0);
            description.val("");
            hasNA.prop("checked", false);
            scoring.val("5");
        }).fail((err) => {
            console.log(err);
        });
    });

    $(document).on('click', '.btn-submit', handleFormSubmit);
});

