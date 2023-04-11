$(document).ready(function () {
    $('table tbody tr td.extend-row').click(function () {
        traitementRemoveAll($(this).parents('tbody'));

        if (!$(this).hasClass('extend-row-show')) {
            traitementShowTr($(this))
        } else {
            traitementRemoveShowTr($(this))
        }
    })
});

function traitementShowTr(row) {
    row.addClass('extend-row-show');
    row.find('i').html('remove')
    let val = row.find('input').val();
    let tr = row.parents('tbody').find('tr[data-id=' + val + ']');
    tr.removeClass('hidden');
    tr.addClass('extend-row-show')
}

function traitementRemoveShowTr(row) {
    row.find('i').html('add')
    row.removeClass('extend-row-show');
}

function traitementRemoveAll(tbody) {
    tbody.find('.extend-row-show').each(function () {
        let val = $(this).find('input').val();
        $(this).find('i').html('add');
        let tr = $(this).parents('tbody').find('tr[data-id=' + val + ']');
        tr.addClass('hidden');
        tr.removeClass('extend-row-show');
    })
}
