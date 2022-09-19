jQuery(document).ready(($) => {

    function handleFindAllAssessment(e) {
        e.preventDefault();
        $.ajax({
            url: '/wp-json/assessment/v1/find-all',
            type: 'GET',
            dataType: 'JSON',
            data: {
                'action': 'find_all_assessment_question',
            },
            success: (data) => {
                console.log(data);
            },
            fail: (err) => {
                console.log(err);
            }
        })
    }

    $(document).on('click', '.btn-fetch', handleFindAllAssessment);
});