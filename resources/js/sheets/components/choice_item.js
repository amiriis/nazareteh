export function addChoiceItem({
    createId,
    questionId,
    questionMode,
    title,
    mode,
    hasDisabled
}) {
    const id = (mode == 'add') ? ($(`.choices-box-${questionId}`).find('.choice-container').last().data('choiceId') ?? 0) + 1 : createId
    const isFirst = ($(`.choices-box-${questionId}`).find('.choice-container').length == 0) ? true : false

    let content = `<div class="choice-container input-group has-validation mb-3" id="choice-${questionId}-${id}" data-choice-id="${id}">
                        <input type="text"
                        class="form-control choice-input"
                        id="question[${questionMode}][${questionId}][choice][${mode}][${id}]"
                        name="question[${questionMode}][${questionId}][choice][${mode}][${id}]" value="${title ?? ``}" required ${hasDisabled ? 'disabled': ''}>
                        ${!isFirst ?
                       `<button class="btn btn-danger choice-item-delete" type="button"><i class="bi-trash"></i></button>`
                        : ``}
                        <div class="invalid-feedback">
                            لطفا متن پاسخ را وارد کنید
                        </div>
                    </div>`

    $(`.choices-box-${questionId}`).append(content)
}

export function removeChoiceItem({
    id,
    questionId,
    questionMode,
    mode
}) {
    $(`#choice-${questionId}-${id}`).remove()
    if (questionMode == 'edit') {
        $('.delete-choices').append(`<input type="hidden" name="choices[delete][]" value="${id}">`)
    }
}
