$(document).ready(function() {
    $('#zipCode').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            postcode: {
                validators: {
                    zipCode: {
                        country: 'US',
                        message: 'The value is not valid US postcode'
                    }
                }
            }
        }
    });
});
