export function addErrorQuestion({
    id,
    text,
    type
}) {
    let content = `<li class="mb-1" data-question-num="${id}" data-error-type="${type}">
                    ${text}
                </li>`

    $('.error-questions').append(content);
}

export function removeErrorQuestion({
    id
}) {
    if (typeof id === 'undefined') {
        $('.error-questions').empty()
    }

    $(`.error-questions li[data-question-num="${id}"]`).remove()
}
