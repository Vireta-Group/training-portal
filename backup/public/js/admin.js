$(function() {
    // Sidebar toggle for mobile
    $('#sidebarToggle').on('click', function() {
        $('#sidebar').toggleClass('open');
        $('#sidebarOverlay').toggleClass('hidden');
    });
    $('#sidebarOverlay').on('click', function() {
        $('#sidebar').removeClass('open');
        $('#sidebarOverlay').addClass('hidden');
    });

    // Auto-hide flash messages
    $('.alert-auto-dismiss').each(function() {
        var $el = $(this);
        setTimeout(function() { $el.fadeOut(300, function() { $el.remove(); }); }, 4000);
    });
});

// Common AJAX handler for CRUD forms
function submitForm($form, successCallback) {
    var btn = $form.find('[type="submit"]');
    btn.prop('disabled', true).text('Saving...');
    $.ajax({
        url: $form.attr('action'),
        method: $form.attr('method') || 'POST',
        data: $form.serialize(),
        dataType: 'json',
        success: function(res) {
            if (successCallback) successCallback(res);
            if (res.message) showToast(res.message, 'success');
            closeModal();
        },
        error: function(xhr) {
            btn.prop('disabled', false).text('Save');
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                $form.find('.text-red-600').remove();
                $.each(errors, function(field, msgs) {
                    var input = $form.find('[name="' + field + '"]');
                    input.after('<p class="text-red-600 text-xs mt-1">' + msgs[0] + '</p>');
                });
            } else {
                showToast(xhr.responseJSON?.message || 'Something went wrong', 'error');
            }
        }
    });
}

function showToast(message, type) {
    var colors = { success: 'bg-green-500', error: 'bg-red-500', warning: 'bg-yellow-500', info: 'bg-blue-500' };
    var $toast = $('<div class="fixed top-4 right-4 z-50 px-4 py-3 rounded-lg text-white text-sm shadow-lg ' + (colors[type] || 'bg-gray-700') + ' alert-auto-dismiss">' + message + '</div>');
    $('body').append($toast);
    setTimeout(function() { $toast.fadeOut(300, function() { $toast.remove(); }); }, 4000);
}

function openModal(html) {
    closeModal();
    var $modal = $('<div class="modal fixed inset-0 z-50 flex items-center justify-center p-4">' +
        '<div class="modal-backdrop fixed inset-0" onclick="closeModal()"></div>' +
        '<div class="relative bg-white rounded-xl shadow-xl max-w-lg w-full max-h-[90vh] overflow-y-auto">' +
        '<button type="button" onclick="closeModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-xl leading-none z-10">&times;</button>' +
        '<div class="modal-body">' + html + '</div></div></div>');
    $('body').append($modal).addClass('overflow-hidden');
    $modal.hide().fadeIn(150);
}

function closeModal() {
    $('.modal').fadeOut(150, function() { $(this).remove(); $('body').removeClass('overflow-hidden'); });
}

// Delete confirmation
function confirmDelete(url, callback) {
    if (confirm('Are you sure you want to delete this item?')) {
        $.ajax({
            url: url,
            method: 'DELETE',
            data: { _token: $('meta[name="csrf-token"]').attr('content') },
            dataType: 'json',
            success: function(res) {
                showToast(res.message || 'Deleted successfully', 'success');
                if (callback) callback(res);
            },
            error: function() { showToast('Delete failed', 'error'); }
        });
    }
}

// Load cascading selects
function loadOptions(selectEl, url, dependsOn, resetTarget) {
    var val = $(dependsOn).val();
    if (!val) { $(selectEl).empty().prop('disabled', true); return; }
    $.getJSON(url.replace(':id', val), function(data) {
        var opts = '<option value="">Select...</option>';
        $.each(data, function(k, v) { opts += '<option value="' + k + '">' + v + '</option>'; });
        $(selectEl).html(opts).prop('disabled', false);
        if (resetTarget) $(resetTarget).empty().prop('disabled', true);
    });
}
