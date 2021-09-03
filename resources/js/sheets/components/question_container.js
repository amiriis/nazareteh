export function addQuestionContainer({
    id,
    title,
    description,
    has_choice,
    has_descriptive,
    has_multiple_choice,
    choices,
}) {

    let content = `<div class="question-container" data-question-num="" data-question-id="${id}" aria-hidden="true">
                <div class="h4 mb-3"><span class="question-num"></span>.<span class="question-title p-1">${title}</span>
                </div>
                <p class="question-description mb-3">${description}</p>`
    if (has_choice) {
        content += `<div class="list-group mb-3">`
        if (has_multiple_choice) {
            for (let index = 0; index < choices.length; index++) {
                const choice = choices[index];
                content += `<label class="list-group-item">
                                <input class="form-check-input input-choice me-2" type="checkbox" name="answers[${id}][choices][]" value="${choice.id}">${choice.title}</label>`
            }
        } else {
            for (let index = 0; index < choices.length; index++) {
                const choice = choices[index];
                content += `<label class="list-group-item">
                                <input class="form-check-input input-choice me-2" type="radio" name="answers[${id}][choices][]" value="${choice.id}">${choice.title}</label>`
            }
        }
        content += `</div>`
    }
    if (has_descriptive) {
        content += `<div class="form-floating">
                    <textarea class = "form-control textarea-descriptive"
                    placeholder="پاسخ خود را بنویسید"
                    id="answers[${id}][description]" name="answers[${id}][description]"
                        style="height: 100px"></textarea>
                    <label for="answer[${id}][description]">پاسخ خود را بنویسید</label>
                </div>
            </div>`
    }

    $('.questions-container').append(content)
    updateQuestionItemNum()
}

function updateQuestionItemNum() {
    const questionItems = $('.question-container')
    for (let index = 0; index < questionItems.length; index++) {
        $(questionItems[index]).find('.question-num').text(index + 1)
        $(questionItems[index]).attr('data-question-num', index + 1)
    }
}
