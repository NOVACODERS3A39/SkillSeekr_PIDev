
$(document).ready(function() {
    // Initialize select2 for skills dropdown
    $('#offer_skills').select2({
        placeholder: 'Select skills',
        multiple: true,
        tags: true, // Allow custom tags
        tokenSeparators: [',', ' '], // Define separators for tags
        ajax: {
            // Implement AJAX functionality to fetch skills dynamically (optional)
        }
    });

    // Handler for adding skills
    $('#add_skill_button').click(function() {
        var skill = $('#new_skill_input').val().trim();
        if (skill !== '') {
            // Add the skill to the select2 dropdown
            var $select = $('#offer_skills');
            var newOption = new Option(skill, skill, true, true);
            $select.append(newOption).trigger('change');

            // Clear the input field
            $('#new_skill_input').val('');
        }
    });
});
